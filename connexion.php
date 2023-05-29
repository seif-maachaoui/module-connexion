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
                        <li><a href="connexion.php">Connexion</a></li>
                    </ul>
                </nav>
            </header>

            <section>
                <form action="traitement-connexion.php" method="post">
                <h1>Se connecter</h1>

                <label for="username">Login :</label>
                <input type="text" name="login" id="login" placeholder="Login*" required="required">

                <label for="password">Password :</label>
                <input type="password" name="password" id="password" placeholder="Password*" required="required">
                <?php
                    session_start();

                    if (isset($_SESSION['error'])) {
                        echo "<span style='color: red;'>".$_SESSION['error']."</span><br>";
                        unset($_SESSION['error']);
                    }
                ?>
                <input class="button" type="submit" name="submit" value='Connexion'>
                </form>
            </section>

            <footer>
                <h6>Copyright © 2023-2024, Seifeddine Maachaoui. All Rights Reserved.</h6>
            </footer>

        </main>
    </body>
</html>













