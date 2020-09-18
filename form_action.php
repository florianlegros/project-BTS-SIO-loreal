<?php
session_start();
$DATABASE_HOST = 'localhost:3306';
$DATABASE_USER = 'loreal';
$DATABASE_PASS = 'w{X?x2K30t)p)ql(';
$DATABASE_NAME = 'loreal';
 
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if ( !isset($_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['q5'], $_POST['q6'], $_POST['q7'], $_POST['q8'], $_POST['q9'], $_POST['q10']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill all fields!');
}else{
    if ($stmt = $con->prepare('UPDATE formulaire SET q1=?, q2=?, q3=?, q4=?, q5=?, q6=?, q7=?, q8=?, q9=?, q10=? WHERE users_id = ?')) { 
        $stmt->bind_param('ssssssssssi', $_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['q5'], $_POST['q6'], $_POST['q7'], $_POST['q8'], $_POST['q9'], $_POST['q10'], $_SESSION['id']);
        $stmt->execute();
        header("location: profile.php");
          
    }else{
        if ($stmt = $con->prepare('INSERT INTO formulaire (users_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $stmt->bind_param('issssssssss', $_SESSION['id'], $_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['q5'], $_POST['q6'], $_POST['q7'], $_POST['q8'], $_POST['q9'], $_POST['q10']);
            $stmt->execute();
            header("location: profile.php");
        }
 else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}}}

?>
