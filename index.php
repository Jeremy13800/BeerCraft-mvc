<?php


require_once "app/models/Database.php";
require_once "app/controllers/BeerController.php";
require_once "app/controllers/UserController.php";

// Récupération de l'action demandée
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller = new BeerController();
        $controller->index();
        break;
    case 'add_beer':
        $controller = new BeerController();
        $controller->add();
        break;
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'dashboard':
        $controller = new UserController();
        $controller->dashboard();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    default:
        $controller = new BeerController();
        $controller->index();
        break;
}
