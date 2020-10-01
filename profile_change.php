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

if ( !isset($_POST['cemail'], $_POST['cmdp'], $_POST['cfmdp']) ) {
	exit('Please fill all fields!');
}
if ($_Post['cmdp']==$_Post['cfmdp']){
    
    if ($stmt = $Bdd->update('users', "email='".$_POST['cemail']."', password='".password_hash($_POST['cmdp'], PASSWORD_DEFAULT)."'","WHERE id = '" . $_SESSION['id'] ."'")) { 
        $stmt->execute();
        header("location: profile.php");
    }
}
