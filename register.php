<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'loreal';
$DATABASE_PASS = 'w{X?x2K30t)p)ql(';
$DATABASE_NAME = 'loreal';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['rusername'], $_POST['rpassword'], $_POST['remail'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['rusername']) || empty($_POST['rpassword']) || empty($_POST['remail'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}
if (!filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
if (preg_match('/[A-Za-z0-9]+/', $_POST['rusername']) == 0) {
    exit('Username is not valid!');
}
if (strlen($_POST['rpassword']) > 20 || strlen($_POST['rpassword']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['rusername']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	} else {
		// Username doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['rpassword'], PASSWORD_DEFAULT);
	$stmt->bind_param('sss', $_POST['rusername'], $password, $_POST['remail']);
	$stmt->execute();
	

} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
if ($stmt = $con->prepare('SELECT id FROM users WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['rusername']);
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
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>