<?php


require_once "app/models/Database.php";
require_once "app/controllers/BeerController.php";
require_once "app/controllers/UserController.php";
require_once "app/controllers/CommentController.php";

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
    case 'beer_detail':
        $controller = new BeerController();
        $controller->detail($_GET['id'] ?? null);
        break;
    case 'add_comment':
        $controller = new CommentController();
        $controller->addComment();
        break;
    case 'edit_comment':
        $controller = new CommentController();
        $controller->editComment();
        break;
    case 'delete_comment':
        $controller = new CommentController();
        $controller->deleteComment();
        break;
    case 'edit_beer':
        $controller = new BeerController();
        $controller->edit($_GET['id'] ?? null);
        break;
    case 'delete_beer':
        $controller = new BeerController();
        $controller->delete($_GET['id'] ?? null);
        break;
    case 'admin_dashboard':
        $controller = new BeerController();
        $controller->adminDashboard();
        break;
    default:
        $controller = new BeerController();
        $controller->index();
        break;
}
