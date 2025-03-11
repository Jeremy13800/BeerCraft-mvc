<?php
require_once 'app/models/Database.php';

class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getPDO();
    }

    // Méthode pour ajouter un commentaire à une bière
    public function addComment($content, $rating, $userId, $beerId)
    {
        try {
            $sql = "INSERT INTO comment (content, rating, user_id, beer_id, created_at) 
                    VALUES (:content, :rating, :user_id, :beer_id, NOW())";

            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                ':content' => $content,
                ':rating' => $rating,
                ':user_id' => $userId,
                ':beer_id' => $beerId
            ]);

            if (!$result) {
                error_log("Échec de l'ajout du commentaire: " . print_r($stmt->errorInfo(), true));
                return false;
            }
            return true;
        } catch (PDOException $e) {
            error_log("Erreur dans addComment: " . $e->getMessage());
            return false;
        }
    }

    // Méthode pour supprimer un commentaire
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

    // Méthode pour récupérer tous les commentaires

    public function getAllComments()
    {
        try {
            $sql = "SELECT c.*, u.first_name, u.last_name, b.name as beer_name 
                    FROM comment c 
                    JOIN users u ON c.user_id = u.id 
                    JOIN beer b ON c.beer_id = b.id 
                    ORDER BY c.created_at DESC";

            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getAllComments: " . $e->getMessage());
            return [];
        }
    }

    // Méthode pour modifier un commentaire
    public function updateComment($id, $content, $rating, $userId)
    {
        try {
            $sql = "UPDATE comment 
                    SET content = :content, rating = :rating 
                    WHERE id = :id AND user_id = :user_id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':content' => $content,
                ':rating' => $rating,
                ':id' => $id,
                ':user_id' => $userId
            ]);
        } catch (PDOException $e) {
            error_log("Erreur dans updateComment: " . $e->getMessage());
            return false;
        }
    }

    // Méthode pour supprimer un commentaire
    public function deleteComment($commentId, $userId, $isAdmin = false)
    {
        try {
            // Si l'utilisateur est admin, on ignore la vérification du user_id
            $sql = $isAdmin
                ? "DELETE FROM comment WHERE id = :id"
                : "DELETE FROM comment WHERE id = :id AND user_id = :user_id";

            $stmt = $this->db->prepare($sql);

            $params = [':id' => $commentId];
            if (!$isAdmin) {
                $params[':user_id'] = $userId;
            }

            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erreur dans deleteComment: " . $e->getMessage());
            return false;
        }
    }

    // Méthode pour récupérer les statistiques d'un utilisateur
    public function getUserCommentCount($userId)
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM comment WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Erreur dans getUserCommentCount: " . $e->getMessage());
            return 0;
        }
    }

    // Méthode pour récupérer la moyenne de rating d'un utilisateur
    public function getUserAverageRating($userId)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT AVG(rating) 
                FROM comment 
                WHERE user_id = :user_id
            ");
            $stmt->execute([':user_id' => $userId]);
            $average = $stmt->fetchColumn();
            return $average ? round($average, 1) : 0;
        } catch (PDOException $e) {
            error_log("Erreur dans getUserAverageRating: " . $e->getMessage());
            return 0;
        }
    }

    // Méthode pour récupérer les commentaires récents d'un utilisateur
    public function getUserRecentComments($userId, $limit = 5)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT c.*, b.name as beer_name 
                FROM comment c 
                JOIN beer b ON c.beer_id = b.id 
                WHERE c.user_id = :user_id 
                ORDER BY c.created_at DESC 
                LIMIT :limit
            ");
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getUserRecentComments: " . $e->getMessage());
            return [];
        }
    }
}
