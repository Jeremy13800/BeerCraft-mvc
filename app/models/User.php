<?php
require_once 'app/models/Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getPDO();
    }

    public function login($email, $password)
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Retirer le mot de passe avant de stocker en session
                unset($user['password']);
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Erreur login: " . $e->getMessage());
            return false;
        }
    }

    public function register($firstName, $lastName, $email, $password, $role)
    {
        try {
            // Vérifier si l'email existe déjà
            $checkEmail = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $checkEmail->execute([$email]);
            if ($checkEmail->fetch()) {
                return ['success' => false, 'error' => "Cet email est déjà utilisé."];
            }

            // Hash du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion du nouvel utilisateur
            $query = "INSERT INTO users (first_name, last_name, email, password, role, created_at) 
                      VALUES (:first_name, :last_name, :email, :password, :role, NOW())";

            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role === 'admin' ? 'admin' : 'member'
            ]);

            if ($success) {
                return ['success' => true];
            } else {
                return ['success' => false, 'error' => "Erreur lors de l'inscription."];
            }
        } catch (PDOException $e) {
            error_log("Erreur registration: " . $e->getMessage());
            return ['success' => false, 'error' => "Une erreur est survenue lors de l'inscription."];
        }
    }

    public function getUserStats($userId)
    {
        try {
            // Nombre de bières ajoutées
            $beerQuery = "SELECT COUNT(*) FROM beer WHERE user_id = :user_id";
            $beerStmt = $this->db->prepare($beerQuery);
            $beerStmt->execute([':user_id' => $userId]);
            $beerCount = $beerStmt->fetchColumn();

            // Nombre de commentaires
            $commentQuery = "SELECT COUNT(*) as comment_count, AVG(rating) as avg_rating 
                           FROM comment WHERE user_id = :user_id";
            $commentStmt = $this->db->prepare($commentQuery);
            $commentStmt->execute([':user_id' => $userId]);
            $commentStats = $commentStmt->fetch(PDO::FETCH_ASSOC);

            return [
                'beer_count' => $beerCount,
                'comment_count' => $commentStats['comment_count'],
                'average_rating' => round($commentStats['avg_rating'] ?? 0, 1)
            ];
        } catch (PDOException $e) {
            error_log("Erreur getUserStats: " . $e->getMessage());
            return ['beer_count' => 0, 'comment_count' => 0, 'average_rating' => 0];
        }
    }

    public function isAdmin($userId)
    {
        try {
            $query = "SELECT role FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':id' => $userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result && $result['role'] === 'admin';
        } catch (PDOException $e) {
            error_log("Erreur isAdmin: " . $e->getMessage());
            return false;
        }
    }
}
