<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Module de connexion</title>
    </head>

    <body>
        <main>
            <header>
                <img src="./logo/Mandalorian_Helmet1.jpg" alt="un logo personnalisé">
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="deconnexion.php?logout=logout" class="btn-logout">Déconnexion</a></li>
                    </ul>
                </nav>
            </header>

            <?php
              session_start();
              require_once 'config.php';

              // Vérifier si l'utilisateur est connecté
              if (!isset($_SESSION['login'])) {
                header("Location: connexion.php");
                exit();
              }
              
              // Vérifier si l'utilisateur est connecté et est l'administrateur
              if (isset($_SESSION['login']) && $_SESSION['login'] === 'admin') {
                header("Location: admin.php");
                exit();
              }

              // Récupérer les données utilisateur
              $login = $_SESSION['login'];
              $firstname = $_SESSION['firstname'];
              $lastname = $_SESSION['lastname'];

              // Traitement du formulaire de modification du profil
              if (isset($_POST['new_login']) && isset($_POST['new_firstname']) && isset($_POST['new_lastname']) && isset($_POST['new_password'])) {
                // Récupérer les nouvelles données du formulaire
                $new_login = htmlspecialchars(trim($_POST['new_login']));
                $new_firstname = htmlspecialchars(trim($_POST['new_firstname']));
                $new_lastname = htmlspecialchars(trim($_POST['new_lastname']));
                $new_password = htmlspecialchars(trim($_POST['new_password']));

                // Mettre à jour les données utilisateur dans la base de données
                $update = $conn->prepare("UPDATE user SET login = :new_login, firstname = :new_firstname, lastname = :new_lastname, password = :new_password WHERE login = :login");
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update->execute(['new_login' => $new_login, 'new_firstname' => $new_firstname, 'new_lastname' => $new_lastname, 'new_password' => $hashed_password, 'login' => $login]);

                // Mettre à jour les données dans la session
                $_SESSION['login'] = $new_login;
                $_SESSION['firstname'] = $new_firstname;
                $_SESSION['lastname'] = $new_lastname;

                // Redirection vers la page de profil après la modification
                header("Location: profil.php");
                exit();
              }

              // Vérifier si le formulaire de déconnexion a été soumis
              if (isset($_POST['logout']) && $_POST['logout'] == 'true') {
                // Détruire toutes les variables de session
                session_unset();
                // Détruire la session
                session_destroy();
                // Redirection vers la page de connexion après la déconnexion
                header("Location: index.php");
                exit();
              }
            ?>

            <section>
              <h1>Bienvenue, <?php echo $login; ?></h1>

              <!-- Formulaire pour modifier le profil utilisateur -->
              <form method="POST" action="profil.php">
                <h2>Modifier le profil</h2>
                <label for="new_login">Pseudo :</label>
                <input type="text" name="new_login" id="new_login" value="<?php echo $login; ?>" required><br>

                <label for="new_firstname">Prénom :</label>
                <input type="text" name="new_firstname" id="new_firstname" value="<?php echo $firstname; ?>" required><br>

                <label for="new_lastname">Nom:</label>
                <input type="text" name="new_lastname" id="new_lastname" value="<?php echo $lastname; ?>" required><br>

                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" name="new_password" id="new_password" required><br>

                <input type="submit" class="btn-update" value="Modifier">
              </form>

              
            </section>


            <footer>
                <h6>Copyright © 2023-2024, Seifeddine Maachaoui. All Rights Reserved.</h6>
            </footer>

        </main>
    </body>
</html>
