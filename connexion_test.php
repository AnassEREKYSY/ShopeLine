<?php
    session_start();
    $_SESSION['etat']='true';
        if(isset($_POST['username1']) && isset($_POST['password1'])){
            if(!empty($_POST['username1'])&& !empty($_POST['password1'])){
                $email=htmlspecialchars($_POST['username1']);
                $mdp=htmlspecialchars($_POST['password1']);
                $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
                $bd->query("SET NAMES 'utf8'");
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $requete=$bd->prepare('SELECT * FROM Client WHERE EMAIL_CLT=? AND MDP_COMPTE=?');
                $requete->execute(array($email,$mdp));
                $nbligne=$requete->rowcount();
                $ligne=$requete->fetch();
                if($nbligne!=0){
                    $_SESSION['email']=$_POST['username1'];
                    $_SESSION['password']=$_POST['password1'];
                    $_SESSION['nom']=$ligne['NOM_CLT'];
                    $_SESSION['prenom']=$ligne['PRENOM_CLT'];
                    $_SESSION['id']=$ligne['ID_CLT'];
                    header("location:Client.php");
                }else{
                    $_SESSION['etat']='false';
                    echo "<script>alert('Erreur!! Email ou mot de passe est incorrecte')</script>";
                    header("location:connexion.php");
                }   
            }
        }else if(isset($_POST['username2']) && isset($_POST['password2'])){
            if(!empty($_POST['username2'])&& !empty($_POST['password2'])){
                $email=htmlspecialchars($_POST['username2']);
                $mdp=htmlspecialchars(intval($_POST['password2']));
                $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
                $bd->query("SET NAMES 'utf8'");
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $requete=$bd->prepare('SELECT * FROM EMPLOYEES WHERE EMAIL_EMP=? AND ID_EMPLOYE=?');
                $requete->execute(array($email,$mdp));
                $nbligne=$requete->rowcount();
                $ligne=$requete->fetch();
                if($nbligne!=0){
                    $_SESSION['nom1']=$ligne['NOM_EMP'];
                    $_SESSION['prenom1']=$ligne['PRENOM_EMP'];
                    $_SESSION['id1']=$ligne['ID_EMPLOYE'];
                    $_SESSION['email1']=$_POST['username2'];
                    $_SESSION['password1']=$_POST['password2'];
                    header("location:admin.php");
                }else{
                    $_SESSION['etat']='false';
                    header("location:connexion_employe.php");
                }   
            }
        }    
?>