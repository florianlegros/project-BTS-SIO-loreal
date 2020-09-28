<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
require "src/Bdd.php";

$Bdd = new Bdd();

if (!isset($_POST['rusername'], $_POST['rpassword'], $_POST['remail'])) {
	exit('Please complete the registration form!');
}
if (empty($_POST['rusername']) || empty($_POST['rpassword']) || empty($_POST['remail'])) {
	exit('Please complete the registration form');
}
if (!filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
if (preg_match('/^[a-z]+[a-z0-9]*[.-_]*$/i', $_POST['rusername']) == 0) {
    exit('Username is not valid!');
}
if (strlen($_POST['rpassword']) > 20 || strlen($_POST['rpassword']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
if ($stmt = $Bdd->select("id, password" ,"users" ,"username = '" . $_POST['rusername']."'")) {
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo 'Username exists, please choose another!';
	} else {

if ($stmt = $Bdd->insert("users" ,"username,password,email" , "'" . $_POST['rusername'] . "','" . password_hash($_POST['rpassword'], PASSWORD_DEFAULT) . "','" . $_POST['remail'] . "'")) {
	$stmt->execute();

} else {
	echo 'Could not prepare statement!';
}
if ($stmt = $Bdd->select("id" ,"users" ,"username = '" . $_POST['rusername']."'")) {
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id);
		$stmt->fetch();
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['rusername'];
		$_SESSION['id'] = $id;
		header('Location: form.php');
	}
}else {
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
