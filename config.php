<?php
    //Connexion à la base de donnée avec PDO(PHP Data Objects)
    $servername = 'localhost'; //On indique l'adresse du serveur MySQL
    $username = 'admin'; // Le nom de l'utilisateur
    $password = 'admin'; // Le mot de passe de l'utilisateur
    $database = 'moduleconnexion'; // Le nom de la base de donnée

    //On essaie de se connecter au serveur mySQL en PDO
    try{
        $conn = new PDO("mysql:host={$servername};dbname={$database};", $username, $password);
    }

    catch(Exception $e){
        die('Erreur' .$e->getMessage()); 
    }
?>
