<?php
require_once "app/models/Beer.php";
require_once "app/models/Comment.php"; // Ajout de l'inclusion du modèle Comment

class BeerController
// Cette classe gère les actions liées aux bières
{

    // Définition d'une nouvelle fonction pour afficher la liste des bières
    public function index()
    {
        $beerModel = new Beer();
        $beers = $beerModel->getAll();

        $view = "beerList";
        include_once("app/views/layout.php");
    }


    // Définition d'une nouvelle fonction pour ajouter une bière
    public function add()
    {
        // Vérification du rôle admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['error_message'] = "Accès non autorisé. Seuls les administrateurs peuvent ajouter des bières.";
            header('Location: index.php');
            exit;
        }

        $errors = [];
        $success = false;
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $this->sanitizeInput($_POST);

            // Gestion de l'upload d'image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['image']);
                if ($uploadResult['success']) {
                    $formData['image'] = $uploadResult['path'];
                } else {
                    $errors[] = $uploadResult['error'];
                }
            }

            if (empty($errors)) {
                $beerModel = new Beer();
                if ($beerModel->addBeer(
                    $formData['name'],
                    $formData['origin'],
                    $formData['alcohol'],
                    $formData['description'],
                    $formData['image']
                )) {
                    $_SESSION['success_message'] = "La bière '{$formData['name']}' a été ajoutée avec succès ! 🍻";
                    header('Location: index.php?action=index');
                    exit;
                } else {
                    $errors[] = "Une erreur est survenue lors de l'ajout de la bière.";
                }
            }
        }

        $viewData = compact('errors', 'success', 'formData');
        $view = "add_beer"; // Définition de la vue
        include_once("app/views/layout.php");
    }


    // Définition d'une nouvelle fonction pour afficher le détail d'une bière
    public function detail($id)
    {
        if (!$id) {
            header('Location: index.php');
            exit;
        }

        $beerModel = new Beer();
        $commentModel = new Comment();
        $userModel = new User();

        $beer = $beerModel->getBeerById($id);
        if (!$beer) {
            header('Location: index.php');
            exit;
        }

        $comments = $commentModel->getCommentsForBeer($id);
        $viewData = compact('beer', 'comments', 'userModel');

        $view = "beer_detail";
        include_once("app/views/layout.php");
    }


    // Définition d'une nouvelle fonction pour supprimer d'une bière
    public function delete($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['error_message'] = "Accès non autorisé";
            header('Location: index.php');
            exit;
        }

        if ($id) {
            $beerModel = new Beer();
            if ($beerModel->deleteBeer($id)) {
                $_SESSION['success_message'] = "La bière a été supprimée avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression de la bière.";
            }
        }
        header('Location: index.php');
        exit;
    }


    // Définition d'une nouvelle fonction pour modifier une bière
    public function edit($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['error_message'] = "Accès non autorisé";
            header('Location: index.php');
            exit;
        }

        $errors = [];
        $beerModel = new Beer();
        $beer = $beerModel->getBeerById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $this->sanitizeInput($_POST);

            // Gestion de l'upload d'image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['image']);
                if ($uploadResult['success']) {
                    $formData['image'] = $uploadResult['path'];
                } else {
                    $errors[] = $uploadResult['error'];
                }
            } else {
                // Conserver l'image existante si aucune nouvelle image n'est uploadée
                $formData['image'] = $beer['image'];
            }

            if (empty($errors)) {
                if ($beerModel->updateBeer($id, $formData)) {
                    $_SESSION['success_message'] = "La bière a été modifiée avec succès.";
                    header('Location: index.php?action=beer_detail&id=' . $id);
                    exit;
                }
                $errors[] = "Erreur lors de la modification de la bière.";
            }
        }

        $viewData = compact('beer', 'errors');
        $view = "edit_beer";
        include_once("app/views/layout.php");
    }


    // Définition d'une nouvelle fonction pour afficher le tableau de bord de l'administrateur
    public function adminDashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['error_message'] = "Accès non autorisé";
            header('Location: index.php');
            exit;
        }

        $beerModel = new Beer();
        $commentModel = new Comment();

        $beers = $beerModel->getAll();
        $allComments = $commentModel->getAllComments();

        $viewData = compact('beers', 'allComments');
        $view = "admin_dashboard";
        include_once("app/views/layout.php");
    }


    // Définition d'une nouvelle fonction pour nettoyer les données d'une bière
    private function sanitizeInput($data)
    {
        return [
            // Retourne le résultat de la fonction
            'name' => trim(htmlspecialchars($data['name'] ?? '')),
            'origin' => trim(htmlspecialchars($data['origin'] ?? '')),
            'alcohol' => filter_var($data['alcohol'] ?? 0, FILTER_VALIDATE_FLOAT),
            'description' => trim(htmlspecialchars($data['description'] ?? '')),
            // Ne pas sanitizer l'image ici car elle sera gérée séparément
            'image' => $data['image'] ?? null
        ];
    }


    // Définition d'une nouvelle fonction pour valider les données d'une bière
    private function validateBeerData($data)
    {
        $errors = [];

        if (strlen($data['name']) < 2) {
            $errors[] = "Le nom de la bière doit contenir au moins 2 caractères.";
        }
        if (strlen($data['origin']) < 2) {
            $errors[] = "L'origine doit contenir au moins 2 caractères.";
        }
        if ($data['alcohol'] <= 0 || $data['alcohol'] > 67.5) {
            $errors[] = "Le pourcentage d'alcool doit être entre 0 et 67.5%.";
        }
        if (strlen($data['description']) < 10) {
            $errors[] = "La description doit contenir au moins 10 caractères.";
        }

        return $errors;
        // Retourne le résultat de la fonction
    }
    // Definition d'une nouvelle fonction pour gérer l'upload d'une image
    private function handleImageUpload($file)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        // Vérifications de base
        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'error' => 'Format de fichier non autorisé. Utilisez JPG, PNG ou WEBP.'];
        }

        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'L\'image est trop volumineuse (max 5MB).'];
        }

        // Génération d'un nom de fichier unique
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('beer_') . '.' . $extension;
        $uploadPath = 'uploads/' . $newFileName;

        // Déplacement du fichier
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return [
                'success' => true,
                'path' => $uploadPath
            ];
        }

        return ['success' => false, 'error' => 'Erreur lors de l\'upload du fichier.'];
    }
}
