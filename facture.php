<?php

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
        session_start();
        require "src/Bdd.php";

        $Bdd = new Bdd();

        if (!isset($_SESSION['loggedin'])) {
            header('Location: login.php');
            exit;
        }   
        
        $facture = array();
        
        if ($stmt = $Bdd->select("idcommandes, date, total","commande","WHERE users_id = '".$_SESSION["id"]."'")){
            $stmt->execute();
            $stmt->bind_result($id,$date,$total);
            while ($stmt->fetch()) {
                    $arrayfacture = array("id"=>$id,"date"=>$date,"total"=>$total);
                    array_push($facture,$arrayfacture);
            }
            $stmt->close();
        }
    
        
    
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/index.css" rel="stylesheet">
    <title>Historique d'achat - l'Oréal</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<body  style="background-color: #04a2eb14;">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000000;">
        <a href="profile.php" style="margin:auto;"><img src="img/logo_loreal_paris.png" alt="Oreal" style="height: 90px;"></a>
    </nav>

    <div style="margin-top:150px;">
        <h3>Factures:</h3>
    </div>
    <div class="liste">
        
        <?php
            foreach($facture as $commande){
            echo '
            <div class="achat" style="margin-top: 10px;
            border-bottom: dotted;
            padding-bottom: 10px;
            display:flex;">
            <div class="panier">
                <img class="image" src="img/images.png" alt="panier" style="height: 90px;border-radius: 50px;">
            </div>
            <div class="date col-9 offset-1" style="margin: 20px 0px 20px 0px;">
                '.substr($commande["date"],0, -8).'
                <p>Total : '.$commande["total"].' €</p>

            </div><br><br>
        </div>
            ';}
        ?>
    
    </div>

    <footer></footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous "></script>

</body>

</html>