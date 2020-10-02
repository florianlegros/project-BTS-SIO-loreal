<?php
session_start();
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
    <link href="style/b.css" rel="stylesheet">
	


</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000000;">
	<a href="profile.php" style="margin:auto;"><img src="img/logo_loreal_paris.png" alt="Oreal" style="height: 90px;"></a>
</nav>
<header>
        <div class="formulaire" style="padding-bottom: 40px;">
            <h2>FORMULAIRE</h2>

        </div>

        <nav class="question" style="padding-bottom: 20px;">
            <h2>Question : </h2>

        </nav>


    </header>
    <form action="form_action.php" method="post" autocomplete="off">

                <div class="titre">
                    <h4>1- Quel est votre budget mensuel pour l'achat des produits ?</h4>
                </div>

				<label for="q1"></label>
                <input type="radio" id="a" name="q1" value="abordable" checked="checked">
                <label for="a"> Moins de 20€/mois </label><br>
                <input type="radio" id="b" name="q1" value="moyen">
                <label for="b"> Entre 20€ et 40€/mois </label><br>
                <input type="radio" id="c" name="q1" value="luxe">
                <label for="c"> Entre 40€ et 60€/mois</label><br>
                <input type="radio" id="d" name="q1" value="luxe+">
                <label for="d"> Plus de 60€/mois</label><br><br>               
        

                <div class="titre">
                    <h4>2- Achetez vous des produits naturels ou bio ?</h4>
                </div>
                <label for="q2"></label>
				<input type="radio" id="a" name="q2" value="Naturel" checked="checked">
                <label for="a"> Naturel </label><br>
                <input type="radio" id="b" name="q2" value="Bio">
                <label for="b"> Bio </label><br>
                <input type="radio" id="c" name="q2" value="">
                <label for="c"> Peu importe</label><br><br>
                
                <div class="titre">
                    <h4>3- Dans quelle tranche d'âge êtes-vous ?</h4>
                </div>
                <label for="q3"></label>
				<input type="radio" id="a" name="q3" value="jeune" checked="checked">
                <label for="a"> 18-24 ans </label><br>
                <input type="radio" id="b" name="q3" value="jeune adulte">
                <label for="b"> 25-34 </label><br>
                <input type="radio" id="c" name="q3" value="adulte">
                <label for="c"> 35-45</label><br>
                <input type="radio" id="d" name="q3" value="senior">
                <label for="d"> 46+</label><br><br>
                
                <div class="titre">
                    <h4>4- Quel type de peau avez-vous ?</h4>
                </div>
                <label for="q4"></label>
                <input type="radio" id="a" name="q4" value="Peau seche" checked="checked">
                <label for="a"> Peau sèche </label><br>
                <input type="radio" id="b" name="q4" value="Peau normale">
                <label for="b"> Peau normale </label><br>
                <input type="radio" id="c" name="q4" value="Peau mixte">
                <label for="c"> Peau mixte </label><br>
                <input type="radio" id="c" name="q4" value="Peau grasse">
                <label for="c"> Peau grasse </label><br><br>    
                
                <div class="titre">
                    <h4>5- Etes-vous un homme ou une femme ?</h4>
                </div>
                <label for="q5"></label>
				<input type="radio" id="a" name="q5" value="Homme" checked="checked">
                <label for="a"> Homme </label><br>
                <input type="radio" id="b" name="q5" value="Femme">
                <label for="b"> Femme </label><br><br>
                        
                <div class="titre">
                    <h4>6- Pour quelles raisons vous maquillez-vous ?</h4>
                </div>
                <label for="q6"></label>
				<input type="radio" id="a" name="q6" value="Plaisir" checked="checked">
                <label for="a"> Pour mon plaisir </label><br>
                <input type="radio" id="b" name="q6" value="Professionel">
                <label for="b"> Pour le travail </label><br>
                <input type="radio" id="c" name="q6" value="Soiree">
                <label for="c"> Pour une soirée </label><br>
                <input type="radio" id="d" name="q6" value="Correction">
                <label for="d"> Cacher mes imperfections </label><br><br>
                
                <div class="titre">
                    <h4>7- Quel type de produit avez-vous besoin ?</h4>
                </div>
                <label for="q7"></label>
				<input type="radio" id="a" name="q7" value="Visage" checked="checked">
                <label for="a"> Soin du visage </label><br>
                <input type="radio" id="b" name="q7" value="Corps">
                <label for="b"> Soin du corps </label><br>
                <input type="radio" id="c" name="q7" value="Cheveux">
                <label for="c"> Produit capillaire </label><br>
                <input type="radio" id="d" name="q7" value="Maquillage">
                <label for="d"> Maquillage </label><br><br>

                <div class="titre">
                    <h4>8- La texture de votre produit :</h4>
                </div>
                <label for="q8"></label>
				<input type="radio" id="a" name="q8" value="Huileux" checked="checked">
                <label for="a"> Huileuse </label><br>
                <input type="radio" id="b" name="q8" value="Leger">
                <label for="b"> Légère </label><br>
                <input type="radio" id="c" name="q8" value="Epais">
                <label for="c"> Epaisse </label><br>
                <input type="radio" id="d" name="q8" value="Normal">
                <label for="d"> Normale </label><br><br>
                
                <div class="titre">
                    <h4>9- Quel type de cheveux avez-vous ?</h4>
                </div>
                <label for="q9"></label>
                <input type="radio" id="a" name="q9" value="Cheveux Lisses" checked="checked">
                <label for="a"> Lisses </label><br>
                <input type="radio" id="b" name="q9" value="Cheveux Boucles">
                <label for="b"> Bouclés </label><br>
                <input type="radio" id="c" name="q9" value="Cheveux Crépus">
                <label for="c"> Crépus </label><br><br>
                        
                <div class="titre">
                    <h4>10- Avez-vous les cheveux :</h4>
                </div>
                <label for="q10"></label>
				<input type="radio" id="a" name="q10" value="Cheveux Gras" checked="checked">
                <label for="a"> Gras </label><br>
                <input type="radio" id="b" name="q10" value="Cheveux Fins">
                <label for="b"> Fins </label><br>
                <input type="radio" id="c" name="q10" value="Cheveux Cassants">
                <label for="c"> Cassants </label><br>
                <input type="radio" id="d" name="q10" value="Cheveux Colores">
                <label for="d"> Colorés </label><br>
                <input type="radio" id="e" name="q10" value="Cheveux Epais">
                <label for="e"> Epais </label><br><br><br>

                <input type="submit" value="Valider le Formulaire"><br><br>
                <br><br>
			</form>
	
	</body>
</html>