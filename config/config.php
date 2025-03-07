<?php
// config/config.php

session_start([
    'cookie_lifetime' => 3600, // 1 heure
    'cookie_secure' => isset($_SERVER['HTTPS']), // Activer uniquement si HTTPS
    'cookie_httponly' => true
]);

define('DB_HOST', 'mysql');
define('DB_DATABASE', 'BeerCraft');
define('DB_USER', 'root');
define('DB_PASS', 'root');


//AlwaysData
// define('DB_HOST', 'mysql-php-sql.alwaysdata.net');
// define('DB_DATABASE', 'php-sql_beercraft');
// define('DB_USER', 'php-sql');
// define('DB_PASS', 'cutkiller7');

// Définir un chemin de base pour les URLs et les fichiers
define('BASE_URL', '/beercraft/');
define('UPLOADS_DIR', 'uploads/');
