<?php


class RecommendationCache {
    private $conn;
    private $cache_duration = 3600; // 1 hour

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    public function get($userId, $itemType) {
        $sql = "SELECT item_id, score FROM recommendation_cache 
                WHERE user_id = ? AND item_type = ? AND expiry_timestamp > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $itemType);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result ? $result : null;
    }

    public function store($userId, $itemType, $recommendations) {
        $sql = "INSERT INTO recommendation_cache (user_id, item_id, item_type, score, expiry_timestamp) 
                VALUES (?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL ? SECOND))
                ON DUPLICATE KEY UPDATE 
                score = VALUES(score), 
                expiry_timestamp = VALUES(expiry_timestamp)";
        $stmt = $this->conn->prepare($sql);

        foreach ($recommendations as $rec) {
            $stmt->bind_param("iisdi", $userId, $rec['item_id'], $itemType, $rec['score'], $this->cache_duration);
            $stmt->execute();
        }
    }
}