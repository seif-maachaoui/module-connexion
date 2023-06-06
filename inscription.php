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
        <!-- L'en-tête du site -->
        <header>
            <img src="./logo/Mandalorian_Helmet1.jpg" alt="un logo personnalisé">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Connexion</a></li>
                </ul>
            </nav>
        </header>

        <section>
            <!-- Le formulaire d'inscription -->
            <form action="traitement-inscription.php" method="post">
                <h1>S'inscrire</h1>

                <label for="login">Login :</label>
                <input type="text" name="login" id="login" placeholder="Login*">

                <label for="firstname">Prénom :</label><br>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname*">

                <label for="lastname">Nom :</label>
                <input type="text" name="lastname" id="lastname" placeholder="Lastname*">

                <label for="password">Password :</label>
                <input type="password" name="password" id="password" placeholder="Password*">

                <label for="check_password">Veuillez confirmer votre mot de passe :</label>
                <input type="password" name="check_password" id="check_password" placeholder="Confirm Password*">

                <!-- J'affiche les messages d'erreurs dans le formulaire d'inscription -->
                <?php
                    if (isset($_GET['error'])) {
                        $errorMessages = explode(", ", $_GET['error']);
                        foreach ($errorMessages as $errorMessage) {
                            echo "<span style='color: red;'>$errorMessage</span><br>";
                        }
                    }
                ?>

                <input class="button" type="submit" name="submit" value='Envoyer'>
            </form>
        </section>

        <!-- Pied de page du site -->
        <footer>
            <h6>Copyright © 2023-2024, Seifeddine Maachaoui. All Rights Reserved.</h6>
        </footer>
    </main>
</body>
</html>
