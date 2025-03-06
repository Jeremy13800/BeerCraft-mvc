<?php
require_once "app/models/Beer.php";

class BeerController
{
    public function index()
    {
        $beerModel = new Beer();
        $beers = $beerModel->getAll();

        $view = "beerList";
        include_once("app/views/layout.php");
    }

    public function add()
    {
        $errors = [];
        $success = false;
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $this->sanitizeInput($_POST);
            $errors = $this->validateBeerData($formData);

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

    private function sanitizeInput($data)
    {
        return [
            'name' => trim(htmlspecialchars($data['name'] ?? '')),
            'origin' => trim(htmlspecialchars($data['origin'] ?? '')),
            'alcohol' => filter_var($data['alcohol'] ?? 0, FILTER_VALIDATE_FLOAT),
            'description' => trim(htmlspecialchars($data['description'] ?? '')),
            'image' => filter_var($data['image'] ?? '', FILTER_SANITIZE_URL)
        ];
    }

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
        if (!empty($data['image']) && !filter_var($data['image'], FILTER_VALIDATE_URL)) {
            $errors[] = "L'URL de l'image n'est pas valide.";
        }

        return $errors;
    }
}
