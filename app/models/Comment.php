<?php
require_once 'app/models/Database.php';

class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getPDO();
    }

    public function addComment($content, $rating, $userId, $beerId)
    {
        try {
            $sql = "INSERT INTO comment (content, rating, user_id, beer_id, created_at) 
                    VALUES (:content, :rating, :user_id, :beer_id, NOW())";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':content' => $content,
                ':rating' => $rating,
                ':user_id' => $userId,
                ':beer_id' => $beerId
            ]);
        } catch (PDOException $e) {
            error_log("Erreur dans addComment: " . $e->getMessage());
            return false;
        }
    }

    public function getCommentsForBeer($beerId)
    {
        try {
            $sql = "SELECT c.*, u.first_name, u.last_name 
                    FROM comment c 
                    JOIN users u ON c.user_id = u.id 
                    WHERE c.beer_id = :beer_id 
                    ORDER BY c.created_at DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':beer_id' => $beerId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getCommentsForBeer: " . $e->getMessage());
            return [];
        }
    }
}
