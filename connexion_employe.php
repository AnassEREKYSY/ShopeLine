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
        <form action="connexion_test.php" method="POST" class="form1">
            <h1>Connexion</h1>
            <hr width="250px">
            <div id="centre1">
                <label><b>ID d'utilisateur</b></label>
                <i class="fas fa-lock"></i>
                <input type="text" placeholder="Entrer l'id" name="password2" required>
                <label><b>Email d'utilisateur</b></label>
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Entrer l'email" name="username2" required>
                <input type="submit" id='submit' value='Connexion' name="connexion" >
            </div>
            <!-- <a href="" id="lien1">Mot de passe oublié?</a> -->
        </form>
    </div>
</body>
</html>