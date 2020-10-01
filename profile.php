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

if ($stmt = $Bdd->select("q1, q2, q3, q4, q5, q6, q7, q8, q9, q10" ,"formulaire" ,"WHERE users_id = '" . $_SESSION['id'] ."'")){
    $stmt->execute();
    $stmt->bind_result($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10);
    $stmt->fetch();
    $question = array($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10);
    $stmt->close();
}

$articles = array();
$favoris = array();

if ($stmt = $Bdd->select("Article_idArticle","favoris","WHERE user_id = '" . $_SESSION['id'] ."'")){
    $stmt->execute();
    $stmt->bind_result($id);
	array_push($favoris,$id);
	$stmt->close();
}

if ($stmt = $Bdd->select("idArticle, Nom, Prix, tags","Article","")){
    $stmt->execute();
    $stmt->bind_result($id,$Nom,$Prix,$tags);
	while ($stmt->fetch()) {
		if(in_array($tags,$question)){
            $arrayArticle = array("id"=>$id,"Nom"=>$Nom,"Prix"=>$Prix);
			array_push($articles,$arrayArticle);
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive" s>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.html">Acceuil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="form.php">formulaire</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
            
        </div>
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
    
    
    <div class="articles offset-2">
        <?php

            foreach($articles as $article){
                echo $article["Nom"] . " prix : ".$article["Prix"]." <br>";
            }
        ?>
    </div>
    <script>
function w3_open() {
document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
document.getElementById("mySidebar").style.display = "none";
}
</script>
    </body>
</html>