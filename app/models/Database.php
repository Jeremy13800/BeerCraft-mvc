<?php
// app/models/Database.php
require_once 'config/config.php'; // Inclure les configurations globales

class Database
{
    private $pdo;

    /**
     * Constructor
     * Initialise la connexion à la base de données.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Établit la connexion à la base de données en utilisant PDO.
     */
    private function connect()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=utf8";
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    /**
     * Retourne l'objet PDO pour interagir avec la base de données.
     *
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }
}
