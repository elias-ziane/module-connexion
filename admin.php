<?php
session_start();
$connexion = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
$query = mysqli_query($connexion, 'SELECT * FROM `utilisateurs` WHERE 1');

$all_result = mysqli_fetch_all($query);
    
    
        if (!isset($_SESSION["login"])) {
            header("Refresh: 3; url=connexion.php");
            echo "<p>Tu ne peux pas accéder a cette page.</p><br><p>Redirection en cours...</p>";
            exit(0);
        }
        if ($_SESSION["login"] != "admin") {
            header("Refresh: 3; url=profil.php");
            echo "<p>Vous n'etes pas un admin</p><br><p>Redirection en cours...</p>";
            exit(0);
        }


?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="index.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
        <title>Admin</title>
    </head>
    
    <body class="h1">
    <header>
<section class="encart">
                    <div class="titre1">
                    <a href="index.php">
                        <img src="https://ih1.redbubble.net/image.1931755741.6515/st,small,507x507-pad,600x600,f8f8f8.jpg" height="100" width="120">
                        </a>
                    </div>
                    <nav>
                        <li><a href="index.php"> Retour à l'Accueil</a></li>
                    </nav>
                </section>
</header>
        <main>
            <div class="titre-admin">
                Session Admin
            </div>
    <section class="tableaucentre">
        <table class="tab-or">
            <thead>
                <tr>
                    <td><h3>ID<h3></td>
                    <td><h3>Login<h3></td>
                    <td><h3>Prenom<h3></td>
                    <td><h3>Nom<h3></td>
                    <td><h3>Password<h3></td>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($all_result as $key) {
                echo "<tr>";
        
            foreach ($key as $value) {
                echo "<td>$value</td>";
            }
                echo "</tr>";
            }
            if (isset($_POST['deconnecter'])) {
                session_unset ( );
                header("Location: index.php"); 
                }
            ?>
            </tbody>
        </table>
    </section>
        <div class="button-deco">
            <form action="" method="post">
                <input type="submit" name="deconnecter" value="Déconnexion">
            </form>
        </div>
        </main>
        <footer class="footer-admin">
            <img class = "fot" src="images-module/playlogo.png" alt = " Logo playstation ">
        </footer>
    </body>
</html>