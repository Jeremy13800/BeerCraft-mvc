<?php

// Charger les variables d'environnement
$envFile = __DIR__ . '/../../.env';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!empty($name)) {
            define($name, $value);
        }
    }
}

// Définir les valeurs par défaut si non définies
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_NAME')) define('DB_NAME', 'beercraft');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');

if (!defined('UPLOADS_DIR')) define('UPLOADS_DIR', 'uploads/');
