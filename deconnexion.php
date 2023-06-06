<?php
    session_start();
    require_once 'config.php';

    // Je vérifie si le lien de déconnexion à été cliqué
    if (isset($_GET['logout']) && $_GET['logout'] == 'logout') {

        // Détruire toutes les variables de session
        session_unset();

        // Détruire la session
        session_destroy();

        // Redirection vers la page de connexion après la déconnexion
        header("Location: index.php");
        exit();
    }
?>