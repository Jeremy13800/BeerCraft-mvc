<?php
require_once "app/models/Beer.php";
require_once "app/models/Comment.php"; // Ajout de l'inclusion du modèle Comment

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
            $formData['image'] = UPLOADS_DIR . $formData['image'];
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

    public function addComment()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beerId = filter_input(INPUT_POST, 'beer_id', FILTER_VALIDATE_INT);
            $content = trim($_POST['content'] ?? '');
            $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);

            if ($beerId && $content && $rating >= 1 && $rating <= 5) {
                $commentModel = new Comment();
                if ($commentModel->addComment($content, $rating, $_SESSION['user']['id'], $beerId)) {
                    $_SESSION['success_message'] = "Votre commentaire a été ajouté avec succès !";
                } else {
                    $_SESSION['error_message'] = "Une erreur est survenue lors de l'ajout du commentaire.";
                }
            } else {
                $_SESSION['error_message'] = "Données de commentaire invalides.";
            }
            header("Location: index.php?action=beer_detail&id=$beerId");
            exit;
        }
    }

    public function editComment()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentId = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);
            $beerId = filter_input(INPUT_POST, 'beer_id', FILTER_VALIDATE_INT);
            $content = trim($_POST['content'] ?? '');
            $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);

            if ($commentId && $content && $rating >= 1 && $rating <= 5) {
                $commentModel = new Comment();
                if ($commentModel->updateComment($commentId, $content, $rating, $_SESSION['user']['id'])) {
                    $_SESSION['success_message'] = "Votre commentaire a été modifié !";
                }
            }
            header("Location: index.php?action=beer_detail&id=$beerId");
            exit;
        }
    }

    public function deleteComment()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $commentId = filter_input(INPUT_GET, 'comment_id', FILTER_VALIDATE_INT);
        $beerId = filter_input(INPUT_GET, 'beer_id', FILTER_VALIDATE_INT);

        if ($commentId) {
            $commentModel = new Comment();
            if ($commentModel->deleteComment($commentId, $_SESSION['user']['id'])) {
                $_SESSION['success_message'] = "Votre commentaire a été supprimé !";
            }
        }
        header("Location: index.php?action=beer_detail&id=$beerId");
        exit;
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
        if (empty($data['image'])) {
            $errors[] = "L'URL de l'image n'est pas valide. {$data['image']}";
        }

        //FILTER_VALIDATE_URL
        return $errors;
    }
}
