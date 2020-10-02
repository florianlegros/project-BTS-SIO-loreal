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

$Articleid = $_GET['Articleid'];
$favStatus = $_GET['favoris'];  

if($favStatus == "False"){

    if ($stmt = $Bdd->insert("favoris" ,"user_id, Article_idArticle" , "'" . $_SESSION['id'] . "','" . $Articleid . "'")) {
        $stmt->execute();
    }
}else{
    if ($stmt = $Bdd->delete("favoris" ,"WHERE Article_idArticle='" . $Articleid . "'")) {
        $stmt->execute();
    }
}

header("Location: profile.php");