<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forgot_pass.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Document</title>
</head>
<body>
    <div id="container">
        <form method="post">
            <br>
        <h1>mot de passe oublié</h1>
        <hr width="250px"><br>
        <i class="fas fa-user"></i> <label for="">Email:</label><br>
            <input type="email" placeholder="Entrer Email" name="email" required>
            <input type="submit" name="envoyer" value="Envoyer">
        </form>
    </div>
</body>
</html>
<?php
    session_start();
   include 'procedure_connexion.php';
   if(isset($_POST['envoyer'])){
        if(isset($_POST['email'])){
            if(!empty($_POST['email'])){
                $token=uniqid();
                $url="http://pfe/token?token=$token";
                $message="Bonjour, voici votre lien pour la réinitialisation de votre mot de passe: $url";
                $headers='Content-Type:text/plain; charset="utf-8"'." "; 
                // $headers = array(
                //     'From' => 'pfetest463@gmail.com',
                //     'Reply-To' => 'pfetest463@gmail.com',
                //     'X-Mailer' => 'PHP/' . phpversion()
                // );
                $rep=mail($_POST['email'],'Mot de passe oublié',$message,$headers);
                if($rep){
                    $requete=$bd->prepare('UPDATE CLIENT SET TOKEN=? WHERE EMAIL_CLT=?');
                    $requete->execute(array($token,$_POST['email']));
                    echo'Email envoyé';
                }else{
                    echo'<span class="err">Une erreur est servenue...</span>';
                }
            }
        }
   }

?>