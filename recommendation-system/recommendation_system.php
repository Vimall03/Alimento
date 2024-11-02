<?php

class RecommendationSystem {
    private $conn;
    
    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    // Get user's order history
    public function getUserOrderHistory($userId) {
        $sql = "SELECT o.*, m.m_name, m.m_type, m.m_category, r.r_name, r.r_cuisine 
                FROM orders o 
                JOIN menu m ON o.menu_id = m.m_id 
                JOIN restaurant r ON o.r_id = r.r_id 
                WHERE o.user_id = ? 
                ORDER BY o.dt DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get user's preferred cuisines based on order history
    public function getUserPreferences($userId) {
        $sql = "SELECT r.r_cuisine, COUNT(*) as frequency 
                FROM orders o 
                JOIN restaurant r ON o.r_id = r.r_id 
                WHERE o.user_id = ? 
                GROUP BY r.r_cuisine 
                ORDER BY frequency DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get personalized restaurant recommendations
    public function getRestaurantRecommendations($userId, $limit = 5) {
        $preferences = $this->getUserPreferences($userId);
        $preferredCuisines = array_column($preferences, 'r_cuisine');
        
        $cuisinePreferences = implode("','", $preferredCuisines);
        
        $sql = "SELECT r.*, 
                (r.r_rating * 0.4 + 
                (CASE WHEN r.r_cuisine IN ('$cuisinePreferences') THEN 0.6 ELSE 0 END)) 
                as recommendation_score 
                FROM restaurant r 
                WHERE r.r_id NOT IN (
                    SELECT DISTINCT r_id FROM orders WHERE user_id = ?
                )
                ORDER BY recommendation_score DESC 
                LIMIT ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get dish recommendations based on user preferences
    public function getDishRecommendations($userId, $limit = 5) {
        $sql = "SELECT m.*, r.r_name, r.r_cuisine,
                COUNT(o2.order_id) as popularity
                FROM menu m 
                JOIN restaurant r ON m.r_id = r.r_id
                LEFT JOIN orders o2 ON m.m_id = o2.menu_id
                WHERE m.m_id NOT IN (
                    SELECT DISTINCT menu_id FROM orders WHERE user_id = ?
                )
                AND r.r_cuisine IN (
                    SELECT DISTINCT r_cuisine 
                    FROM orders o 
                    JOIN restaurant r ON o.r_id = r.r_id 
                    WHERE o.user_id = ?
                )
                GROUP BY m.m_id
                ORDER BY popularity DESC
                LIMIT ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $userId, $userId, $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}