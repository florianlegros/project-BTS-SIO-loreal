<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
require "src/Bdd.php";

$Bdd = new Bdd();

if (!isset($_POST['rusername'], $_POST['rpassword'], $_POST['remail'])) {
	setcookie("LoginStatus", "Champ manquant ", time() + 10, "/");
	header('Location: login.php');
	exit;

}
if (empty($_POST['rusername']) || empty($_POST['rpassword']) || empty($_POST['remail'])) {
	setcookie("LoginStatus", "Champ manquant ", time() + 10, "/");
	header('Location: login.php');
	exit;

}
if (!filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL)) {
	setcookie("LoginStatus", "Mauvais format d'email ", time() + 10, "/");
	header('Location: login.php');
	exit;

}
if (preg_match('/^[a-zA-Z0-9_ \\-]+/', $_POST['rusername']) == 0) {
    setcookie("LoginStatus", "Mauvais format d'indentifiant ", time() + 10, "/");
	header('Location: login.php');
	exit;

}
if (strlen($_POST['rpassword']) > 20 || strlen($_POST['rpassword']) < 5) {
	setcookie("LoginStatus", "Longeur de mot de passe incorrect", time() + 10, "/");
	header('Location: login.php');
	exit;
}
if ($stmt = $Bdd->select("id, password" ,"users" ,"WHERE username = '" . $_POST['rusername']."'")) {
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		setcookie("LoginStatus", "/!\ Identifiant existe deja /!\ ", time() + 10, "/");
		header('Location: login.php');
	} else {

if ($stmt = $Bdd->insert("users" ,"username,password,email" , "'" . $_POST['rusername'] . "','" . password_hash($_POST['rpassword'], PASSWORD_DEFAULT) . "','" . $_POST['remail'] . "'")) {
	$stmt->execute();

} else {
	setcookie("LoginStatus", "Erreur serveur ", time() + 60, "/");
	header('Location: login.php');
}
if ($stmt = $Bdd->select("id" ,"users" ,"WHERE username = '" . $_POST['rusername']."'")) {
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
	setcookie("LoginStatus", "Erreur serveur ", time() + 60, "/");
	header('Location: login.php');
}
	}
	$stmt->close();
} else {
	setcookie("LoginStatus", "Erreur serveur ", time() + 60, "/");
	header('Location: login.php');
}
