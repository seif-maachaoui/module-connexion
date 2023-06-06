<?php
    session_start();
    require_once 'config.php';

    if (isset($_POST['login']) && isset($_POST['password'])) {
        // Je protège mes champs contre les injections SQL
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));

        // Je vérifie si les identifiants correspondent à l'exception admin
        if ($login === 'admin' && $password === 'admin') {

            // Si c'est le cas, je connecte l'administrateur avec ses identifiants spécifiques
            $_SESSION['login'] = $login;
            header("Location: admin.php");
            exit();
        }

        // Je vérifie des informations de connexion
        $verify = $conn->prepare("SELECT * FROM user WHERE login = :login");
        $verify->execute(['login' => $login]);
        $user = $verify->fetch();

        // Si le mot de passe correspond au mot de passe de la base de donnée alors...
        if ($user && password_verify($password, $user['password'])) {

            // Ses informations de connexion sont valides
            $_SESSION['login'] = $user['login'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];

            // Si l'utilisateur est l'admin, alors...
            if ($user['login'] === 'admin') {
                header("Location: admin.php");
                
            } else { 
                header("Location: profil.php"); // Sinon redirige l'utilisateur vers profil.php
            }
            exit();

        } else {
            // Indique que le mot de passe est invalide
            $_SESSION['error'] = "Identifiants invalides";
            header("Location: connexion.php");
            exit();
        }
    } else {
        // Indique qu'il manque des informations de connexion
        header("Location: connexion.php?error=Veuillez remplir tous les champs");
        exit();
    }
?>
