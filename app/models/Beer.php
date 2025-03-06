<?php
require_once 'app/models/Database.php';

class Beer
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getPDO();
    }

    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM beer ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getAll: " . $e->getMessage());
            return [];
        }
    }

    public function addBeer($name, $origin, $alcohol, $description, $image)
    {
        try {
            if (!$this->validateBeerData($name, $origin, $alcohol, $description)) {
                return false;
            }

            $query = "INSERT INTO beer (name, origin, alcohol, description, image, created_at) 
                      VALUES (:name, :origin, :alcohol, :description, :image, NOW())";

            $stmt = $this->db->prepare($query);
            $result = $stmt->execute([
                ':name' => $name,
                ':origin' => $origin,
                ':alcohol' => floatval($alcohol),
                ':description' => $description,
                ':image' => !empty($image) ? $image : null
            ]);

            if ($result) {
                error_log("Bière ajoutée avec succès : $name");
                return true;
            } else {
                error_log("Échec de l'ajout de la bière : $name");
                return false;
            }
        } catch (PDOException $e) {
            error_log("Erreur dans addBeer: " . $e->getMessage());
            return false;
        }
    }

    private function validateBeerData($name, $origin, $alcohol, $description)
    {
        return !empty($name) &&
            !empty($origin) &&
            is_numeric($alcohol) &&
            $alcohol >= 0 &&
            $alcohol <= 67.5 &&
            !empty($description);
    }
}
