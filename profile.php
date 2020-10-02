<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require "src/Bdd.php";

$Bdd = new Bdd();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}   
if(!isset($_COOKIE['panier'])){
    setcookie("panier","[]");
}
if ($stmt = $Bdd->select("q1, q2, q3, q4, q5, q6, q7, q8, q9, q10" ,"formulaire" ,"WHERE users_id = '" . $_SESSION['id'] ."'")){
    $stmt->execute();
    $stmt->bind_result($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10);
    $stmt->fetch();
    $question = array($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10);
    $stmt->close();
}

$articles = array();
$idfavoris = array();
$favoris = array();

if ($stmt = $Bdd->select("Article_idArticle","favoris","WHERE user_id = '" . $_SESSION['id'] ."'")){
    $stmt->execute();
    $stmt->bind_result($id);
    while ($stmt->fetch()) {
	    array_push($idfavoris,$id);
    }
}

if ($stmt = $Bdd->select("idArticle, Nom, Prix, tags, image","Article","")){
    $stmt->execute();
    $stmt->bind_result($id,$Nom,$Prix,$tags,$image);
	while ($stmt->fetch()) {
        if(in_array($id,$idfavoris)){
            $arrayfavoris = array("id"=>$id,"Nom"=>$Nom,"Prix"=>$Prix,"image"=>$image);
            array_push($favoris,$arrayfavoris);
        }else{
            if(in_array($tags,$question)){
            $arrayArticle = array("id"=>$id,"Nom"=>$Nom,"Prix"=>$Prix,"image"=>$image);
			array_push($articles,$arrayArticle);
    	    }
        }
    }
	$stmt->close();
}

if ($stmt = $Bdd->select("username, email" ,"users" ,"WHERE id = '" . $_SESSION['id'] ."'")){
    $stmt->execute();
    $stmt->bind_result($username,$email);
    $stmt->fetch();
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Oréal</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/w3.css">

</head>

<body> 
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000000;">
    <img class="offset-2" src="img/logo_loreal_paris.png" alt="Oreal" style="height: 90px;">

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive" s>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link" href="facture.php"><i class="fas fa-folder-open">factures</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="panier.php"><i class="fas fa-shopping-bag">panier</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="form.php"><i class="fas fa-edit">formulaire</i></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
    </nav>
    
    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
    <div class="d-flex">
    <h1 class="fas fa-user-circle"></h1>
    <h3 class="nom"><?php echo $username?></h3>
    </div>
    
    <form action="profile_change.php" method="post" autocomplete="off">
        
        <br>
        <h6>Adresse mail</h6>
        <label for="cemail"></label>
        <input type="text" name="cemail" placeholder="Changer l'email" id="cemail" value="<?php echo $email?>" required>
        <br>
        <br>
        <h6>Mot de passe</h6>
        <label for="cmdp"></label>
        <input type="password" name="cmdp" placeholder="Changer votre mot de passe" id="cmdp" required>
        <br>
        <h6>Confirmation</h6>
        <label for="cfmdp"></label>
        <input type="password" name="cfmdp" placeholder="Confirmer le mot de passe" id="cfmdp" required>
        <br>
        <br>

        <input type="submit" value="Valider Modification">
    </form>

    </div>
    <div class="row">
    <div class="articles offset-2">
        <?php
            foreach($favoris as $fav){
                echo '<div class="bloc">
                    <a href="article.php?Articleid='.$fav["id"].'">
                    <img class="Image-du-produit" src="img/'.$fav["image"].'.png"></img>
                    </a>
                    <div class="Description">
                    <h6>'.$fav["Nom"].'</h6>
                    Prix : '.$fav["Prix"].'€
                    </div>
                    <a href="favoris.php?Articleid='.$fav["id"].'&favoris=True">
                    <i class="favoris fas fa-star"></i>
                    </a>
				<br>
                <div class="Ajouter" data-id="'.$fav["id"].'">
                          Ajout
                </div>

            </div>';
            }
            foreach($articles as $article){
                echo '<div class="bloc">
                    <a href="article.php?Articleid='.$article["id"].'">
                    <img class="Image-du-produit" src="img/'.$article["image"].'.png"></img>
                    </a>
                    <div class="Description">
                    <h6>'.$article["Nom"].'</h6>
                    Prix : '.$article["Prix"].'€
                    </div>
                    <a href="favoris.php?Articleid='.$article["id"].'&favoris=False">
                    <i class="favoris far fa-star"></i>
                    </a>
				<br>
                <div class="Ajouter" data-id="'.$article["id"].'">
                          Ajout
                </div>

            </div>';
            }
        ?>
        
    </div>
    </div>
    <script>
function w3_open() {
document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
document.getElementById("mySidebar").style.display = "none";
}
</script>
    <script src="js/jquery.min.js "></script>
    <script type="text/javascript" src="js/index.js"></script>
    </body>
</html> 