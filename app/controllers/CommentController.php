<?php
require_once 'app/models/Database.php';
require_once 'app/models/Comment.php'; // Ajout de l'inclusion du modèle Comment


class CommentController
//Cette classe gère les actions liées aux commentaires
{

    // Définition d'une nouvelle fonction pour ajouter un commentaire
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

    // Définition d'une nouvelle fonction pour modifier un commentaire

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

    // Définition d'une nouvelle fonction pour supprimer un commentaire
    public function deleteComment()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $commentId = filter_input(INPUT_GET, 'comment_id', FILTER_VALIDATE_INT);
        $beerId = filter_input(INPUT_GET, 'beer_id', FILTER_VALIDATE_INT);
        $isAdmin = $_SESSION['user']['role'] === 'admin';

        if ($commentId) {
            $commentModel = new Comment();
            if ($commentModel->deleteComment($commentId, $_SESSION['user']['id'], $isAdmin)) {
                $_SESSION['success_message'] = "Le commentaire a été supprimé !";
            }
        }
        header("Location: index.php?action=beer_detail&id=$beerId");
        exit;
    }
}
