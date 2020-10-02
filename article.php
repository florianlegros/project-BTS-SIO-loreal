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
        $idArticle = $_GET['Articleid'];
        if ($stmt = $Bdd->select("Nom, Prix, description, image","Article","WHERE idArticle = '".$idArticle."'")){
            $stmt->execute();
            $stmt->bind_result($Nom,$Prix,$description,$image);
            $stmt->fetch();
            $article = array("Nom"=>$Nom,"description"=>$description,"Prix"=>$Prix,"image"=>$image);
        }
    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <link href="style/ar.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

    <title>Détails article - l'Oreal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body style="background-color: #04a2eb14;">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000000;">
	<a href="profile.php" style="margin:auto;"><img src="img/logo_loreal_paris.png" alt="Oreal" style="height: 90px;"></a>
</nav>

    <div class="art row" style="margin-top: 150px;">
        <div class="nom">
            <h3> <?php echo $article['Nom'];?></h3>
        </div>

        <div class="Imag col-6">
            <img src="img/<?php echo $article['image'];?>" alt="Parfum" style="height: 400px;border-radius:1000px;" ;>

        </div>
        <div class="enplus col-6 offset-5">
            <p> <?php echo $article['description'];?>
            </p>

        </div>
        <a class="buy col-6 offset-6" style="margin-top: 20%;">
            <div class="co"> Ajouter au panier
                <span class="cotext"> <?php echo $article['Prix'];?> €</span>
            </div>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>