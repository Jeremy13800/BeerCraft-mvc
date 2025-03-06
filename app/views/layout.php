<!doctype html>
<html lang="fr">
<?php include 'app/views/inc/head.php'; ?>

<body>
    <?php include 'app/views/inc/header.php'; ?>



    <main>
        <?php
        if (isset($view) && file_exists("app/views/{$view}.php")) {
            include "app/views/{$view}.php";
        } else {
            echo "<p class='text-red-500 p-4'>Erreur : vue '$view' non trouvée.</p>";
        }
        ?>
    </main>

    <?php include 'app/views/inc/footer.php'; ?>
</body>

</html>