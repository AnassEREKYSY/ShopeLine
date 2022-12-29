<?php
    session_start();
    include 'procedure_connexion.php';
    if(!isset($_SESSION['email']) && !isset( $_SESSION['password'])){
        header("location:connexion.php");
    }else{      
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
                         <a href="deconnexion.php"><img src="photos/deconnex.png" alt="" class="decnx"></a>
                        <?php
                                $idclt=htmlspecialchars($_SESSION['id']);
                                $requete = $bd->prepare('SELECT IMAGE FROM CLIENT WHERE ID_CLT=?');
                                $requete->execute(array($idclt)); 
                                $nb=$requete->rowcount(); 
                                $ligne=$requete->fetch();
                                if($ligne['IMAGE']!=NULL){
                                    ?>
                                        <a href="profile.php"><img src="<?php echo $ligne['IMAGE']?>" alt="" class="pic-profil"></a>
                                    <?php
                                }else{
                                    ?>
                                    <a href="profile.php"><button class="btn-profil"> 
                                        <?php
                                            $nom=$_SESSION['nom'];
                                            $prenom=$_SESSION['prenom'];
                                            $nom1=str_split($nom);
                                            $prenom1=str_split($prenom);
                                            echo strtoupper($prenom1[0].''.$nom1[0]);
                                            
                                        ?>
                                    </button></a>
                                    <?php
                                }   
                        ?>
                        <div class="panier-class">
                            <a href="panier.php">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Panier</span>
                                <?php
                                    $count  = countProducts_panier();
                                    ?>
                                    <span class="count"><?php echo $count ?></span>
                                    <?php
                                ?>
                            </a>
                        </div>
                        <a href="Client.php"><button class="compte">Home</button></a>
                        
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
                        Productdetails($res['IMAGE'],$res['IMAGE1'],$res['IMAGE2'],$res['IMAGE3'],$res['CATEGORIE'],$res['LIBELLE'],$res['DESCRIPTION_P'],$res['PRIX_VENTE'],$res['ID_PRODUIT']);
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
                            $idclt=htmlspecialchars($_SESSION['id']);
                            $requete = $bd->prepare('SELECT * FROM PANIER WHERE ID_CLT='.$idclt.' AND ID_PRODUIT='.$_POST['idhide']);
                            $requete->execute(); 
                            $nb=$requete->fetch(); 
                            if($nb==0){
                                $idp=htmlspecialchars($_POST['idhide']);
                                $requete = $bd->prepare('INSERT INTO PANIER(ID_PRODUIT,ID_CLT) VALUES(?,?)');
                                $requete->execute(array($idp,$idclt));    
                                echo "<script>alert('Le produit est ajouté au panier avec succés')</script>";
                                echo "<script>window.location = 'details.php'</script>";
                            }else{
                                echo "<script>alert(' Attention!!Le produit existe déjà au panier..')</script>";
                                echo "<script>window.location = 'details.php'</script>";
                            }
                        } 
                    }else{
                        Productdetails_promotion($res['IMAGE'],$res['IMAGE1'],$res['IMAGE2'],$res['IMAGE3'],$res['CATEGORIE'],$res['LIBELLE'],$res['DESCRIPTION_P'],$res['PRIX_VENTE'],$l['PRIX'],$res['ID_PRODUIT']);
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
                            $idclt=htmlspecialchars($_SESSION['id']);
                            $requete = $bd->prepare('SELECT * FROM PANIER WHERE ID_CLT='.$idclt.' AND ID_PRODUIT='.$_POST['idhide']);
                            $requete->execute(); 
                            $nb=$requete->fetch(); 
                            if($nb==0){
                                $idp=htmlspecialchars($_POST['idhide']);
                                $requete = $bd->prepare('INSERT INTO PANIER(ID_PRODUIT,ID_CLT) VALUES(?,?)');
                                $requete->execute(array($idp,$idclt));    
                                echo "<script>alert('Le produit est ajouté au panier avec succés')</script>";
                                echo "<script>window.location = 'details.php'</script>";
                            }else{
                                echo "<script>alert(' Attention!!Le produit existe déjà au panier..')</script>";
                                echo "<script>window.location = 'details.php'</script>";
                            }
                        }
                    }
                    
                }else{
                    echo "<span class=\"echec\">Erreur esseyer encore une fois..!</span>";
                }
            ?>
        </body>
        </html>
<?php } ?>