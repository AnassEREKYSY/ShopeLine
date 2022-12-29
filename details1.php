<?php
    session_start();
    include 'procedure_connexion.php';  
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="details.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
            <title>Détails</title>
        </head>
        <body>
                <header class="tete">
                        <img src="photos/shopeline.png" alt="es" class="logo">
                        <a href="connexion.php"><i class="fas fa-user-plus"></i></a>
                        <a href="Page_Principale.php"><button class="compte">Home</button></a> 
                </header>
            <?php
                $idp=$_SESSION['id-produit'];
                $requete=$bd->prepare('SELECT * FROM PRODUIT WHERE ID_PRODUIT=?');
                $requete->execute(array($idp));
                $res=$requete->fetch();
                $nbligne=$requete->rowcount();
                if($nbligne!=0){
                    $requete1=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT=?');
                    $requete1->execute(array($idp));
                    $l=$requete1->fetch();
                    $nb=$requete1->rowcount();
                    if($nb==0){
                        Productdetails_pp($res['IMAGE'],$res['IMAGE1'],$res['IMAGE2'],$res['IMAGE3'],$res['CATEGORIE'],$res['LIBELLE'],$res['DESCRIPTION_P'],$res['PRIX_VENTE'],$res['ID_PRODUIT']);
                        if($res['IMAGE1']== NULL && $res['IMAGE2']==NULL && $res['IMAGE3']==NULL){
                            echo'<style>';
                                echo'.small-img-div div img{';
                                    echo'width: 80px;';
                                    echo'cursor: pointer;';
                                echo'}';
                            echo'</style>';
                        }else{
                            echo'<style>';
                                echo'.small-img-div div img{';
                                    echo'width: 80px;';
                                    echo'height: 80px;';
                                    echo'cursor: pointer;';
                                echo'}';
                            echo'</style>';
                        }
                        if (isset($_POST['add'])){
                            header("location:connexion.php");
                        } 
                    }else{
                        Productdetails_pp_promotion($res['IMAGE'],$res['IMAGE1'],$res['IMAGE2'],$res['IMAGE3'],$res['CATEGORIE'],$res['LIBELLE'],$res['DESCRIPTION_P'],$res['PRIX_VENTE'],$l['PRIX'],$res['ID_PRODUIT']);
                        if($res['IMAGE1']== NULL && $res['IMAGE2']==NULL && $res['IMAGE3']==NULL){
                            echo'<style>';
                                echo'.small-img-div div img{';
                                echo'width: 80px;';
                                echo'cursor: pointer;';
                            echo'}';
                        echo'</style>';
                        }else{
                            echo'<style>';
                                echo'.small-img-div div img{';
                                    echo'width: 80px;';
                                    echo'height: 80px;';
                                    echo'cursor: pointer;';
                                echo'}';
                            echo'</style>';
                        }
                        if (isset($_POST['add'])){
                            header("location:connexion.php");
                        } 
                    }
                    
                }else{
                    echo "<span class=\"echec\">Erreur essayer encore une fois..!</span>";
                }
            ?>
        </body>
        </html>
