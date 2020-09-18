<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a href="index.html">
            <img src="img/logo.png" id="logo">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive" s>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.html">Acceuil
                
              </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="form.php">formulaire</a>
                </li>
				<li class="nav-item active">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
			
				
			
        </div>
    </nav>
	
	</body>
</html>