<?php
    include 'procedure_connexion.php';
    session_start(); 
    if(isset($_GET['token']) && $_GET['token']!=''){
        $requete=$bd->prepare('SELECT EMAIL_CLT FROM Client WHERE MDP_COMPTE=?');
        $requete->execute(array($_GET['token']));
        $email=$requete->fetchColumn();
        if($email){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Récuperation du mot de passe</title>
            </head>
            <body>
                <div id="container">
                    <form method="post">
                        <h1>Récuperation du mot de passe</h1>
                        <hr width="250px"><br>
                        <label for="">Nouveau mot de passe:</label>
                        <input type="password" name="newpass">
                        <input type="submit" value="Confirmer" name="confirmer">
                    </form>
                </div>
            </body>
            </html>
            <?php
        }
    }
if(isset($_POST['newpass'])){
    $pass=htmlspecialchars($_POST['newpass']);
    $requete=$bd->prepare('UPDATE CLIENT SET MDP_COMPTE=?,TOKEN=NULL WHERE EMAIL_CLT=? AND ID_CLIT=?');
    $requete->execute(array($pass,$_POST['email'],$idclt));
    echo'Mot de passe modifié avec succés !';
}
?>