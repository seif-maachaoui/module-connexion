<?php

    session_start();
    require_once 'config.php';
    
    if(isset($_POST['login']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['check_password'])){
        //Je protège mes champs contre les injections SQL
        $login = htmlspecialchars(trim($_POST['login']));
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $password = htmlspecialchars(trim($_POST['password']));
        $check_password = htmlspecialchars(trim($_POST['check_password']));
    }

    // Vérifier si les identifiants correspondent à l'exception
    if ($login === 'admin' && $password === 'admin') {
        // Créer l'utilisateur avec les identifiants spécifiques
        $create = $conn->prepare("INSERT INTO user (login, password, firstname, lastname) VALUES (?, ?, ?, ?)");
        $create->execute([$login, $password, $firstname, $lastname]);

        // Rediriger vers la page de connexion
        header("Location: connexion.php");
        exit();
    }

    // Je vérifie la correspondance des mots de passe
    if ($password !== $check_password) {
        $errors[] = "Les mots de passe ne correspondent pas";
    }

    // Je vérifie si le mot de passe entré est conforme aux exigences de sécurité
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $errors[] = "Le mot de passe doit comporter au moins 8 caractères, une majuscule, un chiffre et un caractère spécial";
    }

    // Je vérifie si le pseudo de l'utilisateur est unique 
    $insert = $conn->prepare("SELECT COUNT(*) FROM user WHERE login = :login");
    $insert->execute(['login' => $login]);
    if ($insert->fetchColumn()) {
        $errors[] = "Le nom d'utilisateur est déjà utilisé";
    }

    // Si des erreurs sont présentes, je redirige l'utilisateur vers la page d'inscription avec les erreurs dans l'URL
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header("Location: inscription.php?error=$errorString");
        exit();
    }

    // Requête d'insertion des données à l'intérieur de ma table user
    $insert = $conn->prepare("INSERT INTO user (login, firstname, lastname, password) VALUES (:login, :firstname, :lastname, :password)");
    $insert->execute(['login' => $login, 'firstname' => $firstname, 'lastname' => $lastname, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

    // Redirection vers la page de connexion
    header("Location: connexion.php");
    exit();

?>