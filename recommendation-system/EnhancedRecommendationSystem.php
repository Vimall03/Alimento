<?php
// File: includes/EnhancedRecommendationSystem.php

class EnhancedRecommendationSystem {
    private $conn;
    private $cache;
    private $cache_duration = 3600; // 1 hour cache duration
    private $logger;
    
    public function __construct($database_connection, $logger = null) {
        $this->conn = $database_connection;
        $this->cache = new RecommendationCache($database_connection);
        $this->logger = $logger;
    }

    /**
     * Get optimized restaurant recommendations for a user
     */
    public function getOptimizedRestaurantRecommendations($userId, $limit = 10) {
        try {
            // Check cache first
            $cached = $this->cache->get($userId, 'restaurant');
            if ($cached !== null) {
                return array_slice($cached, 0, $limit);
            }

            // Get both types of recommendations
            $collaborative = $this->getCollaborativeRecommendations($userId, 'restaurant');
            $contentBased = $this->getContentBasedRecommendations($userId, 'restaurant');

            // Merge and optimize recommendations
            $recommendations = $this->mergeRecommendations($collaborative, $contentBased, $userId, 'restaurant');
            
            // Cache the results
            $this->cache->store($userId, 'restaurant', $recommendations);

            return array_slice($recommendations, 0, $limit);
        } catch (Exception $e) {
            $this->logError("Error getting restaurant recommendations: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get optimized dish recommendations for a user
     */
    public function getOptimizedDishRecommendations($userId, $limit = 10) {
        try {
            // Check cache first
            $cached = $this->cache->get($userId, 'dish');
            if ($cached !== null) {
                return array_slice($cached, 0, $limit);
            }

            // Get both types of recommendations
            $collaborative = $this->getCollaborativeRecommendations($userId, 'dish');
            $contentBased = $this->getContentBasedRecommendations($userId, 'dish');

            // Merge and optimize recommendations
            $recommendations = $this->mergeRecommendations($collaborative, $contentBased, $userId, 'dish');
            
            // Cache the results
            $this->cache->store($userId, 'dish', $recommendations);

            return array_slice($recommendations, 0, $limit);
        } catch (Exception $e) {
            $this->logError("Error getting dish recommendations: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Track user interactions with items
     */
    public function trackInteraction($userId, $itemId, $itemType, $interactionType) {
        try {
            $weight = $this->getInteractionWeight($interactionType);
            
            $sql = "INSERT INTO user_interactions 
                    (user_id, item_id, item_type, interaction_type, interaction_weight) 
                    VALUES (?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE 
                    interaction_weight = interaction_weight + VALUES(interaction_weight)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iissd", $userId, $itemId, $itemType, $interactionType, $weight);
            $stmt->execute();
            
            // Update item popularity scores
            $this->updatePopularityScores($itemId, $itemType);
            
            // Invalidate user's cached recommendations
            $this->cache->invalidate($userId, $itemType);
            
        } catch (Exception $e) {
            $this->logError("Error tracking interaction: " . $e->getMessage());
        }
    }

    /**
     * Get interaction weight based on type
     */
    private function getInteractionWeight($type) {
        $weights = [
            'view' => 1,
            'order' => 5,
            'rating' => 3,
            'favorite' => 2
        ];
        return $weights[$type] ?? 1;
    }

    /**
     * Update popularity scores for items
     */
    private function updatePopularityScores($itemId, $itemType) {
        try {
            $table = $itemType === 'restaurant' ? 'restaurant' : 'menu';
            $idField = $itemType === 'restaurant' ? 'r_id' : 'm_id';
            
            $sql = "UPDATE $table SET 
                    popularity_score = (
                        SELECT (COUNT(*) * 0.4 + 
                               SUM(interaction_weight) * 0.6) / 
                               (SELECT MAX(interaction_weight) FROM user_interactions)
                        FROM user_interactions
                        WHERE item_id = ? AND item_type = ?
                    ),
                    total_orders = (
                        SELECT COUNT(*) 
                        FROM user_interactions 
                        WHERE item_id = ? AND item_type = ? 
                        AND interaction_type = 'order'
                    )
                    WHERE $idField = ?";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isisi", $itemId, $itemType, $itemId, $itemType, $itemId);
            $stmt->execute();
            
        } catch (Exception $e) {
            $this->logError("Error updating popularity scores: " . $e->getMessage());
        }
    }

    /**
     * Get user preferences based on their interaction history
     */
    private function getUserPreferences($userId, $itemType) {
        try {
            if ($itemType === 'restaurant') {
                $sql = "SELECT r.r_cuisine, COUNT(*) as frequency,
                        AVG(ui.interaction_weight) as preference_score
                        FROM user_interactions ui
                        JOIN restaurant r ON ui.item_id = r.r_id
                        WHERE ui.user_id = ? AND ui.item_type = 'restaurant'
                        GROUP BY r.r_cuisine
                        ORDER BY preference_score DESC";
            } else {
                $sql = "SELECT m.m_category, COUNT(*) as frequency,
                        AVG(ui.interaction_weight) as preference_score,
                        AVG(m.m_price) as avg_price_preference
                        FROM user_interactions ui
                        JOIN menu m ON ui.item_id = m.m_id
                        WHERE ui.user_id = ? AND ui.item_type = 'dish'
                        GROUP BY m.m_category
                        ORDER BY preference_score DESC";
            }
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            
        } catch (Exception $e) {
            $this->logError("Error getting user preferences: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get collaborative filtering recommendations
     */
    private function getCollaborativeRecommendations($userId, $itemType) {
        try {
            $sql = "SELECT i2.item_id, 
                    AVG(i1.interaction_weight * i2.interaction_weight) as recommendation_score
                    FROM user_interactions i1
                    JOIN user_interactions i2 ON i1.user_id != i2.user_id 
                    AND i1.item_type = i2.item_type
                    WHERE i1.user_id = ? 
                    AND i1.item_type = ?
                    AND i2.item_id NOT IN (
                        SELECT item_id FROM user_interactions 
                        WHERE user_id = ? AND item_type = ?
                    )
                    GROUP BY i2.item_id
                    HAVING recommendation_score > 0
                    ORDER BY recommendation_score DESC
                    LIMIT 50";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isis", $userId, $itemType, $userId, $itemType);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            $this->logError("Error in collaborative recommendations: " . $e->getMessage());
            return [];
        }
    }

    private function getContentBasedRecommendations($userId, $itemType) {
        $preferences = $this->getUserPreferences($userId, $itemType);
        if (empty($preferences)) {
            return [];
        }

        try {
            if ($itemType === 'restaurant') {
                return $this->getRestaurantContentRecommendations($preferences);
            } else {
                return $this->getDishContentRecommendations($preferences);
            }
        } catch (Exception $e) {
            $this->logError("Error in content-based recommendations: " . $e->getMessage());
            return [];
        }
    }

    private function mergeRecommendations($collaborative, $contentBased, $userId, $itemType) {
        $merged = [];
        $weights = [
            'collaborative' => 0.6,
            'content_based' => 0.4
        ];

        foreach ($collaborative as $item) {
            $merged[$item['item_id']] = [
                'score' => $item['recommendation_score'] * $weights['collaborative'],
                'data' => $item
            ];
        }

        foreach ($contentBased as $item) {
            $itemId = $item['item_id'];
            if (isset($merged[$itemId])) {
                $merged[$itemId]['score'] += $item['relevance_score'] * $weights['content_based'];
            } else {
                $merged[$itemId] = [
                    'score' => $item['relevance_score'] * $weights['content_based'],
                    'data' => $item
                ];
            }
        }

        usort($merged, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return array_map(function($item) {
            return $item['data'];
        }, $merged);
    }

    private function logError($message) {
        if ($this->logger) {
            $this->logger->error($message);
        }
        error_log($message);
    }
}