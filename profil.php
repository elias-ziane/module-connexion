  
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="index?css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Balthazar&family=Galdeano&family=Harmattan&display=swap" rel="stylesheet">
        <title>Profil</title>
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
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="admin.php">Admin</a></li>
                    </nav>
                </section>
</header>
        <main>
<section class = "profil"><div class = " tableauprofil " >
<div class="titre-admin">
                Profil
            </div><?php

session_start();
if (!isset($_SESSION['login'])) {
    header("Refresh: 1; url=connexion.php");
    echo "<h2>connecte toi.</h2><br><h2>Redirection...</h2>";
    exit();
}
$login = $_SESSION['login'];
$sql = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
        
    if (!$sql) {
            echo "Erreur connexion";
            exit();
    }else {
            echo "<h2>Bienvenue sur ton profil $login</h2><br>";
    }

$requete = mysqli_query($sql, "SELECT * FROM utilisateurs WHERE login='$login'");
$info = mysqli_fetch_assoc($requete);
$prenom = $info['prenom'];
$nom = $info['nom'];
$password = $info['password'];

$modification="";
$formNewLogin="";
$formNewPass="";
$formNewNom="";
$formNewPrenom="";
$same="";
$existe="";
$valide="";
$vide="";
$wrong="";
$delete="";
$oui="";






if ($login == "admin") {
    header("Location: admin.php");
}

echo "Login : $login<br>";
echo "Prénom : $prenom<br>";
echo "Nom : $nom<br>";
echo "Mot de passe : $password<br>";

    if (isset($_POST['modifier'])) {
        $modification =    "Modifier le Login cliquer <input class=\"identifiant\" type=\"submit\" name=\"modifierlogin\" value=\"ici\"><br>
                            Modifier le Nom cliquer <input class=\"identifiant\" type=\"submit\" name=\"modifiernom\" value=\"ici\"><br>
                            Modifier le Prénom cliquer <input class=\"identifiant\" type=\"submit\" name=\"modifierprenom\" value=\"ici\"><br>
                            Modifier le Mot de passe cliquer <input class=\"identifiant\" type=\"submit\" name=\"modifierpass\" value=\"ici\"><br>";
    }

    if (isset($_POST['modifierlogin'])) {
        $formNewLogin =  
            "<form method=\"post\">
                <input class=\"identifiant\" type=\"text\" name=\"newlogin\" id=\"login\" placeholder=\"nouveau login\">
                <input class=\"identifiant\" type=\"submit\" name=\"submitnewlogin\" value=\"valider\">
            </form>";
    }

    if (isset($_POST['submitnewlogin'])) {
        $newLogin = $_POST['newlogin'];
        $checklogin = mysqli_query($sql, "SELECT login FROM utilisateurs WHERE login='$login'");
        
        if (!empty(trim($newLogin))) {
            $query = "UPDATE utilisateurs SET login='" . htmlentities(trim($newLogin)) . "' WHERE login='$login'";

            if ($login == $newLogin) {
                $same = "utiliser un autre que $login<br>";
            }
            
            elseif (mysqli_num_rows($checklogin) == 0) {
                $existe = "Le login est déjà utilisé par un autre utilisateur<br>";
            }
            
            elseif (mysqli_query($sql, $query)) {
                $valide = "vous modifié '$login' à '$newLogin' <br>";
                header("Refresh:1");
                $_SESSION['login'] = $newLogin;
            }
            
        }else {
            $vide = "Remplissez le formulaire.<br>";
        }
    }

    if (isset($_POST['modifiernom'])) {
        $formNewNom = 
            "<form method=\"post\">
                <input class=\"identifiant\" type=\"text\" name=\"newnom\" id=\"nom\" placeholder=\"nouveau Nom\">
                <input class=\"identifiant\" type=\"submit\" name=\"submitnewnom\" value=\"valider\">
            </form>";
    }

    if (isset($_POST['submitnewnom'])) {
        $newNom = trim($_POST['newnom']);

        if (!empty($newNom)) {
            $query = "UPDATE utilisateurs SET nom='" . htmlentities(trim($newNom)) . "' WHERE login='$login'";

            if (mysqli_query($sql, $query)) {
                $valide = "vous avez bien modifier votre nom($nom) à ($newNom)";
                header("Refresh:3");

            }
            
        }else {
            $vide = "Remplissez le formulaire.<br>";
        }
    }

    if (isset($_POST['modifierprenom'])) {
        $formNewPrenom = "
            <form method=\"post\">
            <input class=\"identifiant\" type=\"text\" name=\"newprenom\" id=\"nom\" placeholder=\"nouveau Prénom\">
            <input class=\"identifiant\" type=\"submit\" name=\"submitnewprenom\" value=\"valider\">
            </form>
        ";
    }

    if (isset($_POST['submitnewprenom'])) {
        $newPrenom = trim($_POST['newprenom']);

        if (!empty($newPrenom)) {
            $query = "UPDATE utilisateurs SET prenom='" . htmlentities($newPrenom) . "' WHERE login='$login'";

            if (mysqli_query($sql, $query)) {
                $valide = "vous avez bien modifier votre prénom($prenom) à ($newPrenom)";
                header("Refresh:1"); 
            }
            
        }else {
            $vide = "Remplissez le formulaire.<br>";
        }
    }

    if (isset($_POST['modifierpass'])) { 
        $formNewPass = 
            "<form method=\"post\">
                <input class=\"identifiant\" type=\"text\" name=\"pass\" id=\"nom\" placeholder=\"Entrer l'ancien Password\"><br>
                <input class=\"identifiant\" type=\"text\" name=\"newpass\" id=\"nom\" placeholder=\"Entrer un nouveau Password\"><br>
                <input class=\"identifiant\" type=\"text\" name=\"confirmnewpass\" id=\"nom\" placeholder=\"Confirmer le nouveau Password\"><br>
                <input class=\"identifiant\" type=\"submit\" name=\"submitnewpass\" value=\"valider\">
            </form>
        ";
    }

    if (isset($_POST['submitnewpass'])) {
        $newpassword = trim($_POST['newpass']);
        $confirm_password = trim($_POST['confirmnewpass']);
        
        if (!empty($_POST['pass']) && !empty($newpassword) && !empty($confirm_password)) {
            $query = "UPDATE utilisateurs SET password='" . htmlentities($newpassword) . "' WHERE login='$login'";
    if ($_POST['pass'] == $password) {
        if ($newpassword != $confirm_password) {
            $same = "le mot de passe n'est pas identique.<br>";
        }
        
        elseif (mysqli_query($sql, $query)) {
            echo "Le mot de passe a bien été changé";
            header("Refresh:3"); 
        }
    }else {
        $wrong = "Le mot de passe n'est pas correct.";
        }
            
    
        } else {
            $vide = "Remplissez le formulaire.<br>";
        }
    
    }
    if (isset($_POST['deconnecter'])) {
        session_unset ( );
        header("Location: connexion.php"); 
        }

    if (isset($_POST['supprimer'])) {
        $delete =  'supprimer votre compte ?<br>
                    <form method="post">
                    <input class=\"identifiant\" type="submit" name="oui" value="oui">
                    <input class=\"identifiant\" type="submit" name="non" value="non">
                    </form>';
                    }

    if (isset($_POST['oui'])) {
         
        (mysqli_query($sql, "DELETE FROM utilisateurs WHERE login = '$login'"));
        session_unset ( );
        $oui = "compte supprimé.";
        header("Refresh:2"); 
        }

?> 
<div class = "espace">
                <form action="" method="post">
                    <h2>Tu peux modifier tes informations ici !<br>
                    <input class="identifiant" class="identifiant" type="submit" name="modifier" value="Modifier"></h2>
                    <h2><?php echo $modification ?></h2>
                    <h2><?php echo $formNewLogin ?></h2>
                    <h2><?php echo $formNewNom ?></h2>
                    <h2><?php echo $formNewPrenom ?></h2>
                    <h2><?php echo $formNewPass ?></h2>
                    <h2><?php echo $same ?></h2>
                    <h2><?php echo $existe ?></h2>
                    <h2><?php echo $valide ?></h2>
                    <h2><?php echo $vide ?></h2>
                    <h2><?php echo $wrong ?></h2>
                </form>
                <form action="" method="post">
                <input class="identifiant" class="identifiant" type="submit" name="deconnecter" value="Deconnexion">
                <input class="identifiant" class="identifiant"type="submit" name="supprimer" value="Supprimer">
                </form>
                <h2><?php  echo $delete   ?></h2>
                <h2><?php  echo $oui   ?></h2>
        </div></div></section>
    </main>
    
    </body>
</html>