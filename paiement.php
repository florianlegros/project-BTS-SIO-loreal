<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <title>Paiement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="style/commande.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000000;">
        <a href="profile.php" style="margin:auto;"><img src="img/logo_loreal_paris.png" alt="Oreal" style="height: 90px;"></a>
    </nav>
        <h3 style="text-align:center;margin-top:150px;"> MODE DE PAIEMENTS</h3>
            <br>
        <div class="mode">
            <div class="m">
                <h5>Carte bancaire</h5>
            </div>
            <br>


            <form class="cb">

                <input class="j" type="text" placeholder="Numero de carte" name="username" required><br>


                <input class="j" type="date" placeholder="Date d'expiration" name="password" required><br>


                <input class="j" type="number" placeholder="Cryptogramme" name="password" required><br>


                <input class="j" type="text" placeholder="Titulaire" name="password" required><br>

                
            </form>
            <br>
            <br>
            <div class="m">
                <h5>Paypal</h5>
            </div><br>
                <a target="_blank" href="https://paypal.me/Amarok00" style="margin:auto;"><img src="img/paypal.png" alt="Oreal" style="height: 90px;"></a>
        </div>
        <div style="text-align:center;">
        <input onclick="localStorage.clear();document.cookie = 'panier=[]'; location.href='facturation.php';" class="j" type="submit" id='submit' value='Confirmer'>
        <input onclick="location.href='panier.php';" class="j" type="submit" id='submit' value='Abandonner'>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous "></script>

</body>

</html>