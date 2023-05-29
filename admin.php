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
                <h1>Bienvenue sur le module de connexion !</h1>
                <article>
                <?php
                    session_start();
                    require 'config.php';
                    
                    // Vérifier si l'utilisateur est connecté et est l'administrateur
                    if (!isset($_SESSION['login']) || $_SESSION['login'] !== 'admin') {
                        header("Location: connexion.php");
                        exit();
                    }

                    // Récupérer les informations de tous les utilisateurs
                    $get = $conn->prepare("SELECT * FROM user");
                    $get->execute();
                    $users = $get->fetchAll();

                    // Afficher les informations des utilisateurs
                    echo "<h1>Administration</h1>";
                    echo "<table border>";
                    echo "<tr>";
                    echo "<th>Pseudo</th>";
                    echo "<th>Prénom</th>";
                    echo "<th>Nom</th>";
                    echo "</tr>";
                
                    // Afficher les informations des utilisateurs
                    $count = 0;
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . $user['login'] . "</td>";
                        echo "<td>" . $user['firstname'] . "</td>";
                        echo "<td>" . $user['lastname'] . "</td>";
                        echo "</tr>";
                        
                        $count++;
                        if ($count >= 10) {
                            break; // Arrêter la boucle après 10 lignes
                        }
                    }
                
                    echo "</table>";
                
                ?>
                </article>
            </section>

            <footer>
                <h6>Copyright © 2023-2024, Seifeddine Maachaoui. All Rights Reserved.</h6>
            </footer>

        </main>
    </body>
</html>