<?php $ddb = mysqli_connect("localhost", "root", "", "moduleconnexion"); ?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="index.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Balthazar&family=Galdeano&family=Harmattan&display=swap" rel="stylesheet">
        <title>Accueil</title>
    </head>
    <header>
<section class="encart">
                    <div class="titre1">
                    <a href="index.php">
                        <img src="https://ih1.redbubble.net/image.1931755741.6515/st,small,507x507-pad,600x600,f8f8f8.jpg" height="100" width="120">
                        </a>
                    </div>
                    <nav>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="connexion.php">Connexion</a></li>
                    </nav>
                </section>
</header>
<body class="bodyinscription">
<section class="form1">
<div class="input">
<form method="post" action="" class=forminscription>
    <h1>Inscription</h1>
    <br />
    <h2>Identifiant: <h1>
<input class="identifiant" type="text" name="login" placeholder="identifiant" required>
        <hr>
        <h2>Prénom<h1>
<input class="identifiant" type="text" name="prenom" placeholder="Prénom" required>
        <hr>
        <h2>Nom<h1>
<input class="identifiant" type="text" name="name" placeholder="Nom" required>
        <hr>
        <h2>Mot De Passe :<h1>
<input class="identifiant" type="password" name="password" placeholder="mot de passe" required>
        <hr>
        <input class="submit" type="submit" value="submit" name = "submit">
        <hr>
</div>
</form>

<div class = "message1">
<?php
                        if(isset($_POST['submit'])){
                            $login = $_POST['login'];
                            $name = $_POST['name'];
                            $password = $_POST['password'];
                            $prenom = $_POST ['prenom'];

                     if(!empty($_POST['login']) && !empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['prenom'])){
                         $requete = "INSERT INTO utilisateurs  (login, prenom, nom, password) VALUES ('$login', '$prenom', '$name', '$password')"; 
                         $execute = mysqli_query($ddb, $requete);
                         var_dump($execute);
                         echo "Votre inscription a été faites avec succès";
                     }else{ 
                     echo 'Certains Champs sont vides.';
                     }
                    
                }
            
                        
?>
</div>
               </section>     
    </body>
                    </html>
    