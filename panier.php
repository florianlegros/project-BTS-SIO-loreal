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
        $panier = json_decode($_COOKIE["panier"]);
        $facture = array();
        foreach($panier as $article){
            if ($stmt = $Bdd->select("idArticle, Nom, description, Prix, image","Article","WHERE idArticle = '" . $article->id ."'")){
                $stmt->execute();
                $stmt->bind_result($id,$Nom,$description,$Prix,$image);
                while ($stmt->fetch()) {
                        $arrayPanier = array("id"=>$id,"Nom"=>$Nom,"description"=>$description,"Prix"=>$Prix,"image"=>$image,"qte"=>$article->qte,"PrixTotal"=>$Prix*$article->qte);
                        array_push($facture,$arrayPanier);
                }
                setcookie("facture", serialize($facture), time() + 60000, "/");
                $stmt->close();
            }
        };
    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/c.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <title>Panier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="background-color: #04a2eb14;">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000000;">
	<a href="profile.php" style="margin:auto;"><img src="img/logo_loreal_paris.png" alt="Oreal" style="height: 90px;"></a>
</nav>

    <div class="commande row" style="margin-top:150px;">
        
        <?php

            foreach($facture as $article){
                echo ' <div class="produit col-7">
                <div class="img col-3 ">
                <img class="image" src="img/'.$article["image"].'" alt="Parfum ">
                </div>
                <div class="article col-7 ">
                <h4>'.$article["Nom"].'</h4>
                <div class="Desc ">
                    <p>'.$article["description"].'</p>
                </div>

            </div>
            <div class="prix col-1">
            <h4> '.$article["Prix"].' €</h4>
            </div>
            <div class="quantite col-1" style="display:flex;font-size:x-large;">
            <div style="margin-right:5px;" class="Enlever" data-id="'.$article["id"].'">
                            -
                </div>
                <h4>'.$article["qte"].'</h4>
                <div style="margin-left:5px;" class="Ajouter" data-id="'.$article["id"].'">
                          +
                </div>
            </div>

            </div>';
            }
        ?>
    
        <div class="resume col-4 offset-8 " style="position: fixed;">
            <div class="ticket container ">
                <div class="details">
                    <p>
                        Panier
                    </p>
                    <?php
                     foreach($facture as $article){
                        echo '
                        <p>'.$article["Nom"].": ".$article["PrixTotal"].' €</p>
                        <br>
                        
                        ';}
                    ?>
                </div>
                <div class="t col-6 offset-6"></div>

                <hr>

                <div class="details">
                    <h3>TOTAL</h3>
                    <?php
                    $total = 0;
                    foreach($facture as $article){
                        $total += $article["PrixTotal"];
                        }

                        echo '<h4>'.$total.' €</h4>';
                    ?>  

                </div>
                <div class="p col-6 offset-6"></div><br><br>
                
                <div class="validation" onclick="location.href='paiement.php';">Valider</div></button>

            </div>

        </div>

    </div>
    <script src="js/jquery.min.js "></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous "></script>
</body>

</html>