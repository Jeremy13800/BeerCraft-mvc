<?php
require_once 'app/models/Database.php';

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getPDO();
    }

    // Méthode pour récupérer toutes les catégories
    public function getAllCategories()
    {
        try {
            $stmt = $this->db->query("SELECT id, name FROM category ORDER BY name");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getAllCategories: " . $e->getMessage());
            return [];
        }
    }
}
