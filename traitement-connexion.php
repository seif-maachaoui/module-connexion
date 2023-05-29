<?php
    session_start();
    require_once 'config.php';

    if (isset($_POST['login']) && isset($_POST['password'])) {
        // Je protège mes champs contre les injections SQL
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));

        // Vérifier si les identifiants correspondent à l'exception admin
        if ($login === 'admin' && $password === 'admin') {
            // Connecter l'administrateur avec les identifiants spécifiques
            $_SESSION['login'] = $login;
            header("Location: admin.php");
            exit();
        }

        // Vérification des informations de connexion
        $verify = $conn->prepare("SELECT * FROM user WHERE login = :login");
        $verify->execute(['login' => $login]);
        $user = $verify->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Informations de connexion valides
            $_SESSION['login'] = $user['login'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];

            // Rediriger les utilisateurs vers différentes pages en fonction du rôle
            if ($user['login'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: profil.php");
            }
            exit();
        } else {
            // Mot de passe invalide
            $_SESSION['error'] = "Identifiants invalides";
            header("Location: connexion.php");
            exit();
        }
    } else {
        // Informations de connexion manquantes
        header("Location: connexion.php?error=Veuillez remplir tous les champs");
        exit();
    }
?>

