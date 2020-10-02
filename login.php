
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <title>L'Oréal - Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/all.css">


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000000;">
	<img src="img/logo_loreal_paris.png" alt="Oreal" style="height: 90px;margin:auto;">
</nav>
<?php
		if($_COOKIE['LoginStatus']!=""){
		echo "
		<div class='alert alert-danger' role='alert' style='text-align:center;margin-top:5px;'> ".$_COOKIE['LoginStatus']." </div>

		";
		}
	?>
	<div class="formulaires">
	
		<div class="login">
			<h1>Login</h1>
			<form action="auth.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	<div class="register">
			<h1>Register</h1>
			<form action="register.php" method="post" autocomplete="off">
				<label for="rusername">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="rusername" placeholder="Username" id="rusername" required>
				<label for="rpassword">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="rpassword" placeholder="Password" id="rpassword" required>
				<label for="remail">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="remail" placeholder="Email" id="remail" required>
				<input type="submit" value="Register">
			</form>
		</div>
		</div>
		
	</body>
</html>