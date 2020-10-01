<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
	exit;
}else{echo $_SESSION['id'];}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <title>L'Oréal</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
	<link rel="stylesheet" href="css/all.css">
	


</head>

<body>
    <form action="form_action.php" method="post" autocomplete="off">

				<label for="q1"></label>
				<input type="text" name="q1" placeholder="q1" id="q1" required>
				
                <label for="q2"></label>
				<input type="text" name="q2" placeholder="q2" id="q2" required>
				
                <label for="q3"></label>
				<input type="text" name="q3" placeholder="q3" id="q3" required>
				
                <label for="q4"></label>
				<input type="text" name="q4" placeholder="q4" id="q4" required>
				
                <label for="q5"></label>
				<input type="text" name="q5" placeholder="q5" id="q5" required>
				
                <label for="q6"></label>
				<input type="text" name="q6" placeholder="q6" id="q6" required>
				
                <label for="q7"></label>
				<input type="text" name="q7" placeholder="q7" id="q7" required>
				
                <label for="q8"></label>
				<input type="text" name="q8" placeholder="q8" id="q8" required>
				
                <label for="q9"></label>
				<input type="text" name="q9" placeholder="q9" id="q9" required>
				
                <label for="q10"></label>
				<input type="text" name="q10" placeholder="q10" id="q10" required>
				
				<input type="submit" value="Form">
			</form>
	
	</body>
</html>