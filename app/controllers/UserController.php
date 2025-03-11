<?php
require_once "app/models/User.php";

class UserController
//Cette classe gère les actions liées aux utilisateurs
{
    public function register()
    {
        $errors = [];
        $success = false;
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération et nettoyage des données
            $formData = [
                'first_name' => trim(htmlspecialchars($_POST['first_name'] ?? '')),
                'last_name' => trim(htmlspecialchars($_POST['last_name'] ?? '')),
                'email' => filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL),
                'password' => $_POST['password'] ?? '',
                'role' => $_POST['role'] === 'admin' ? 'admin' : 'member' // Validation du rôle
            ];

            // Validation
            if (strlen($formData['first_name']) < 2) {
                $errors[] = "Le prénom doit contenir au moins 2 caractères.";
            }
            if (strlen($formData['last_name']) < 2) {
                $errors[] = "Le nom doit contenir au moins 2 caractères.";
            }
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide.";
            }
            if (strlen($formData['password']) < 6) {
                $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
            }

            // Si pas d'erreurs, on tente l'inscription
            if (empty($errors)) {
                $userModel = new User();
                $result = $userModel->register(
                    $formData['first_name'],
                    $formData['last_name'],
                    $formData['email'],
                    $formData['password'],
                    $formData['role']
                );

                if ($result['success']) {
                    $_SESSION['success_message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    header('Location: index.php?action=login');
                    exit;
                } else {
                    $errors[] = $result['error'];
                }
            }
        }

        $view = "register";
        include_once("app/views/layout.php");
    }

    public function login()
    {
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $errors[] = "Tous les champs sont obligatoires.";
            } else {
                $userModel = new User();
                $user = $userModel->login($email, $password);

                if ($user) {
                    $_SESSION['user'] = $user;
                    $_SESSION['success_message'] = "Bienvenue, {$user['first_name']} ! 🍻";
                    header('Location: index.php?action=dashboard');
                    exit;
                } else {
                    $errors[] = "Email ou mot de passe incorrect.";
                }
            }
            $formData = ['email' => $email];
        }

        $view = "login";
        include_once("app/views/layout.php");
    }

    public function dashboard()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $commentModel = new Comment();

        $userStats = [
            'comment_count' => $commentModel->getUserCommentCount($userId),
            'average_rating' => $commentModel->getUserAverageRating($userId),
            'recent_comments' => $commentModel->getUserRecentComments($userId, 5) // 5 derniers commentaires
        ];

        $view = "dashboard";
        $viewData = compact('userStats');
        include_once("app/views/layout.php");
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
