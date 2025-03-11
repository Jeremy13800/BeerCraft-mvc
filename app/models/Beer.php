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

    public function getBeerById($id)
    {
        $query = "SELECT * FROM beer WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function updateBeer($id, $data)
    {
        try {
            $query = "UPDATE beer SET 
                        name = :name, 
                        origin = :origin, 
                        alcohol = :alcohol, 
                        description = :description, 
                        image = :image 
                      WHERE id = :id";

            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':id' => $id,
                ':name' => $data['name'],
                ':origin' => $data['origin'],
                ':alcohol' => floatval($data['alcohol']),
                ':description' => $data['description'],
                ':image' => !empty($data['image']) ? $data['image'] : null
            ]);
        } catch (PDOException $e) {
            error_log("Erreur dans updateBeer: " . $e->getMessage());
            return false;
        }
    }

    public function deleteBeer($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM beer WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Erreur dans deleteBeer: " . $e->getMessage());
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
