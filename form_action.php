<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

require "src/Bdd.php";

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
	exit;
}else{echo $_SESSION['id'];}

$Bdd = new Bdd();
 

if ( !isset($_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['q5'], $_POST['q6'], $_POST['q7'], $_POST['q8'], $_POST['q9'], $_POST['q10']) ) {
	exit('Please fill all fields!');
}else{
    if ($stmt = $Bdd->select("idformulaire" ,"formulaire" ,"WHERE users_id = '" . $_SESSION['id'] ."'")){
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {

            if ($stmt = $Bdd->update('formulaire', "q1='".$_POST['q1']."', q2='".$_POST['q2']."', q3='".$_POST['q3']."', q4='".$_POST['q4']."', q5='".$_POST['q5']."', q6='".$_POST['q6']."', q7='".$_POST['q7']."', q8='".$_POST['q8']."', q9='".$_POST['q9']."', q10='".$_POST['q10']."'","WHERE users_id = '" . $_SESSION['id'] ."'")) { 
                $stmt->execute();
                header("location: profile.php");
            }

        }else{
            if ($stmt = $Bdd->insert('formulaire', 'users_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10', "'".$_SESSION['id']."','".$_POST['q1']."','".$_POST['q2']."','".$_POST['q3']."','".$_POST['q4']."','".$_POST['q5']."','".$_POST['q6']."','".$_POST['q7']."','".$_POST['q8']."','".$_POST['q9']."','".$_POST['q10']."'")){   
                $stmt->execute();
                header("location: profile.php");
            }
        }
    }
}


