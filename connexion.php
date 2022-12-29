<?php
    session_start();
    // $etat=$_SESSION['etat'];
    // if(isset($_POST['connexion']) && $_POST['connexion']=='Connexion'){
    //     if($etat=='false'){
    //         echo'<span class="err">L email ou mot de passe est incorrect..!</span>';
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Connexion</title>
</head>
<body>
    <div id="container">
        <form action="connexion_test.php" method="POST">
            <h1>Connexion</h1>
            <hr width="250px">
            <div id="centre">
                <label ><b>Email d'utilisateur</b></label>
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Entrer l'email" name="username1"required>
                <label><b>Mot de passe</b></label>
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Entrer le mot de passe" name="password1" required>
                <input type="submit" id='connexion' value='Connexion' name="connexion" >
            </div>
            <a href="forgot_pass.php" id="lien1">Mot de passe oublié?</a>
            <a href="compte.php" class="inscription"><button>Inscription</button></a>
        </form>
    </div>
</body>
</html>