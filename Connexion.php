<?php 
session_start();

?>



<html lang="fr">
    <head>
<link rel="stylesheet" href="index.css" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Balthazar&family=Galdeano&family=Harmattan&display=swap" rel="stylesheet">
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
                        <li><a href="admin.php">Admin</a></li>
                        <li><a href="profil.php">Profil</a></li>
                    </nav>
                </section>
</header>
<body>
<section class="form1">
<div class="input">
<form class="formconnexion" method="post" action="">
    <h1>Connexion</h1>
    <br />
    <h1>Identifiant: </h1>
<input class="identifiant" type="text" name="login" placeholder="identifiant" required>
        <hr>
        <h1>Mot De Passe :</h1>
<input class="identifiant" type="password" name="password" placeholder="mot de passe" required>
        <hr>
        <input class="submit" type="submit" value="submit" name = "submit">
        <hr>
        
    </form>
    

</div>
<div class = "message">
<?php 
//à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION//
if(isset($_POST['submit'])) 
{// Pour vérifier que ce qui est écrit est pas "null"//
    if(!empty($_POST['login']) || !empty($_POST['password'])) 
    {
    
    $login = htmlentities($_POST['login']);
    $password= htmlentities($_POST['password']);
    $mysqli = mysqli_connect("localhost", "root", "", "moduleconnexion");

    $Requete = mysqli_query($mysqli,"SELECT id FROM utilisateurs WHERE login = '$login' AND password = '$password'");
    $Result = mysqli_num_rows($Requete);
    
        if($Result === 0)
        {
        echo "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
        }
        else {
            $_SESSION['login'] = $login; 
            echo "Vous êtes à présent connecté !";
            echo "</br>" ;
            echo $_SESSION['login'];
            }
    }
}
?>
</div>


</section>


</body>

</html>
