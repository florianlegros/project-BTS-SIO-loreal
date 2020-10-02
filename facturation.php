<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

require "src/Bdd.php";

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
	exit;
}

$Bdd = new Bdd();
$facture = unserialize($_COOKIE["facture"], ["allowed_classes" => false]);
$total = 0;
foreach($facture as $article){
    $total += $article["PrixTotal"];
    
};

if ($stmt = $Bdd->insert("commande" ,"users_id,date,total" , "'" . $_SESSION['id'] . "','" . date("Y/m/d") . "','" . $total . "'")) {
    $stmt->execute();
    $commandeid = $stmt->insert_id;
    $stmt->close();
    foreach($facture as $article){
        if ($stmt = $Bdd->insert("facture" ,"Article_idArticle,commandes_idcommandes,qte" , "'" . $article["id"] . "','" . $commandeid . "','" . $article["qte"] . "'")) { 
            $stmt->execute(); 
        }
    };
}
setcookie("facture", "", time() + 1, "/");
setcookie("panier", "", time() + 1, "/");
header("Location: facture.php");