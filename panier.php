<?php 
    session_start();
    include 'procedure_connexion.php'; 
    if(!isset($_SESSION['email']) && !isset( $_SESSION['password'])){
        header("location:connexion.php");
    }else{
        if(isset($_POST['remove'])){
            $idp=htmlspecialchars($_GET['id']);
            $idclt=htmlspecialchars($_SESSION['id']);
            $requete = $bd->prepare('DELETE FROM PANIER WHERE ID_PRODUIT=? AND ID_CLT=?');
            $requete->execute(array($idp,$idclt)); 
            $nb=$requete->rowcount();
            if($nb!=0){
                echo "<span class=\"succés\">Le produit est supprimé avec succés</span>";
            }
            // if($_GET['action']=='remove'){
            //     foreach($_SESSION['panier'] as $key=>$value){
            //         if($value['product_id']==$_GET['id']){
            //             unset($_SESSION['panier'][$key]);
            //             echo"<script>alert(LE produit est supprimé..!)</script>";
            //             echo"<script>window.location='cart.php'</script>"; 
            //         }
            //     }
            // }
        }
        if(isset($_POST['acheter'])){
                $idp=htmlspecialchars($_GET['id']);
                $qte=htmlspecialchars(intval($_POST['qte-prd']));
                $idclt=htmlspecialchars($_SESSION['id']);
                $requete = $bd->prepare('SELECT * FROM PRODUIT WHERE ID_PRODUIT='.$idp);
                $requete->execute(); 
                $nb=$requete->rowcount();
                if($nb!=0){
                    $requete1 = $bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$idp);
                    $requete1->execute(); 
                    $nb=$requete1->rowcount();
                    if($nb==0){
                        $prd=$requete->fetch();
                        $pt=$qte*intval($prd['PRIX_VENTE']);
                        $dat=date("Y-m-d H:i:s", strtotime('+1 hour') ); 
                        $dt= date('Y-m-d', strtotime('+15 days'));
                        $requete = $bd->prepare('SELECT * FROM COMMANDER WHERE ID_CLT=? AND DATE_CMD =? ');
                        $requete->execute(array($idclt,$dat)); 
                        $nbr=$requete->rowcount(); 
                        if($nbr==0){
                            $requete1 = $bd->prepare('INSERT INTO COMMANDER(ID_PRODUIT,ID_CLT,ID_EMPLOYE,QUANTITE_CMD,PRIX_TOTAL,DATE_CMD,DATE_LIVRAISON) VALUES(?,?,?,?,?,?,?)');
                            $requete1->execute(array($idp,$idclt,1,$qte,$pt,$dat,$dt)); 
                            $nb=$requete1->rowcount();
                            if($nb!=0){
                                $idclt=htmlspecialchars($_SESSION['id']);
                                $requete2 = $bd->prepare('DELETE FROM PANIER WHERE ID_PRODUIT='.$idp);
                                $requete2->execute(); 
                                $n=$requete2->rowcount();
                                $requete3 = $bd->prepare('SELECT * FROM CLIENT WHERE ID_CLT=?');
                                $requete3->execute(array($idclt)); 
                                $n1=$requete3->rowcount();
                                if($n1>0){
                                    $ligne=$requete3->fetch();
                                    $nbp=htmlspecialchars($ligne['NB_POINTS']);
                                    $nbp++;
                                    $requete4 = $bd->prepare('UPDATE CLIENT SET NB_POINTS=? WHERE ID_CLT=?');
                                    $requete4->execute(array($nbp,$idclt)); 
                                }
                                echo "<span class=\"succés\">Votre commande est passeée avec succés</span>";
                                // echo" <i class=\"tele\">Télècharger votre facture: </i><button class=\"uplode\"><i class=\"fa fa-upload\"></i> reçu</button>";  
                                $requete1 = $bd->prepare('SELECT * FROM COMMANDER WHERE DATE_CMD=? AND ID_CLT=?');
                                $requete1->execute(array($dat,$idclt)); 
                                $nb=$requete1->rowcount();
                                if($nb!=0){
                                    $ligne=$requete1->fetch();
                                    $_SESSION['idcmd']=$ligne['ID_CMD'];
                                    $_SESSION['qte']=$ligne['QUANTITE_CMD'];
                                    $_SESSION['prt']=$ligne['PRIX_TOTAL'];
                                    $_SESSION['dc']=$ligne['DATE_CMD'];
                                    $_SESSION['dl']=$ligne['DATE_LIVRAISON'];
                                }
                                $requete1 = $bd->prepare('SELECT ID_PRODUIT FROM COMMANDER WHERE DATE_CMD=? AND ID_CLT=?');
                                $requete1->execute(array($dat,$idclt)); 
                                $nb=$requete1->rowcount();
                                if($nb!=0){
                                    $ligne=$requete1->fetch();
                                    $_SESSION['idprd']=$ligne['ID_PRODUIT'];
                                    $idproduit=$ligne['ID_PRODUIT'];
                                    $requete1 = $bd->prepare('SELECT * FROM PRODUIT WHERE ID_PRODUIT=?');
                                    $requete1->execute(array($idproduit)); 
                                    $nb=$requete1->rowcount();
                                    if($nb!=0){
                                        $ligne=$requete1->fetch();
                                        $_SESSION['lib']=$ligne['LIBELLE'];
                                    }
                                }
                                $requete1 = $bd->prepare('SELECT * FROM CLIENT WHERE ID_CLT=?');
                                $requete1->execute(array($idclt)); 
                                $nb=$requete1->rowcount();
                                if($nb!=0){
                                    $ligne=$requete1->fetch();
                                    $_SESSION['nom']=$ligne['NOM_CLT'];
                                    $_SESSION['prn']=$ligne['PRENOM_CLT'];
                                    $_SESSION['em']=$ligne['EMAIL_CLT'];
                                    $_SESSION['tel']=$ligne['TELEPHONE_CLT'];
                                    $_SESSION['add']=$ligne['ADRESSE_CLT'];
                                }
                                $_SESSION['idclt']=$idclt;
                                header('Location: reçu.php');   
                            }
                            else{
                                echo "<span class=\"echec\"Erreur!!essayer encore une fois..</span>";
                            }
                        }
                        else{
                            echo "<span class=\"echec\"Erreur!!essayer encore une fois..</span>";
                        }
                    }else{
                        $prd=$requete->fetch();
                        $prd1=$requete1->fetch();
                        $pt=$qte*intval($prd1['PRIX']);
                        $dat=date("Y-m-d H:i:s", strtotime('+1 hour') ); 
                        $dt= date('Y-m-d', strtotime('+15 days'));
                        $requete = $bd->prepare('SELECT * FROM COMMANDER WHERE ID_CLT=? AND DATE_CMD =? ');
                        $requete->execute(array($idclt,$dat)); 
                        $nbr=$requete->rowcount(); 
                        if($nbr==0){
                            $requete1 = $bd->prepare('INSERT INTO COMMANDER(ID_PRODUIT,ID_CLT,ID_EMPLOYE,QUANTITE_CMD,PRIX_TOTAL,DATE_CMD,DATE_LIVRAISON) VALUES(?,?,?,?,?,?,?)');
                            $requete1->execute(array($idp,$idclt,1,$qte,$pt,$dat,$dt)); 
                            $nb=$requete1->rowcount();
                            if($nb!=0){
                                $idclt=htmlspecialchars($_SESSION['id']);
                                $requete2 = $bd->prepare('DELETE FROM PANIER WHERE ID_PRODUIT='.$idp);
                                $requete2->execute(); 
                                $n=$requete2->rowcount();
                                $requete3 = $bd->prepare('SELECT * FROM CLIENT WHERE ID_CLT=?');
                                $requete3->execute(array($idclt)); 
                                $n1=$requete3->rowcount();
                                if($n1>0){
                                    $ligne=$requete3->fetch();
                                    $nbp=htmlspecialchars($ligne['NB_POINTS']);
                                    $nbp++;
                                    $requete4 = $bd->prepare('UPDATE CLIENT SET NB_POINTS=? WHERE ID_CLT=?');
                                    $requete4->execute(array($nbp,$idclt)); 
                                }
                                echo "<span class=\"succés\">Votre commande est passeée avec succés</span>";
                                // echo" <i class=\"tele\">Télècharger votre facture: </i><button class=\"uplode\"><i class=\"fa fa-upload\"></i> reçu</button>";  
                                $requete1 = $bd->prepare('SELECT * FROM COMMANDER WHERE DATE_CMD=? AND ID_CLT=?');
                                $requete1->execute(array($dat,$idclt)); 
                                $nb=$requete1->rowcount();
                                if($nb!=0){
                                    $ligne=$requete1->fetch();
                                    $_SESSION['idcmd']=$ligne['ID_CMD'];
                                    $_SESSION['qte']=$ligne['QUANTITE_CMD'];
                                    $_SESSION['prt']=$ligne['PRIX_TOTAL'];
                                    $_SESSION['dc']=$ligne['DATE_CMD'];
                                    $_SESSION['dl']=$ligne['DATE_LIVRAISON'];
                                }
                                $requete1 = $bd->prepare('SELECT ID_PRODUIT FROM COMMANDER WHERE DATE_CMD=? AND ID_CLT=?');
                                $requete1->execute(array($dat,$idclt)); 
                                $nb=$requete1->rowcount();
                                if($nb!=0){
                                    $ligne=$requete1->fetch();
                                    $_SESSION['idprd']=$ligne['ID_PRODUIT'];
                                    $idproduit=$ligne['ID_PRODUIT'];
                                    $requete1 = $bd->prepare('SELECT * FROM PRODUIT WHERE ID_PRODUIT=?');
                                    $requete1->execute(array($idproduit)); 
                                    $nb=$requete1->rowcount();
                                    if($nb!=0){
                                        $ligne=$requete1->fetch();
                                        $_SESSION['lib']=$ligne['LIBELLE'];
                                    }
                                }
                                $requete1 = $bd->prepare('SELECT * FROM CLIENT WHERE ID_CLT=?');
                                $requete1->execute(array($idclt)); 
                                $nb=$requete1->rowcount();
                                if($nb!=0){
                                    $ligne=$requete1->fetch();
                                    $_SESSION['nom']=$ligne['NOM_CLT'];
                                    $_SESSION['prn']=$ligne['PRENOM_CLT'];
                                    $_SESSION['em']=$ligne['EMAIL_CLT'];
                                    $_SESSION['tel']=$ligne['TELEPHONE_CLT'];
                                    $_SESSION['add']=$ligne['ADRESSE_CLT'];
                                }
                                $_SESSION['idclt']=$idclt;
                                header('Location: reçu.php');   
                            }
                            else{
                                echo "<span class=\"echec\"Erreur!!essayer encore une fois..</span>";
                            }
                        }
                        else{
                            echo "<span class=\"echec\"Erreur!!essayer encore une fois..</span>";
                        }
                    }

                }else{
                    echo "<span class=\"echec\"Erreur!!essayer encore une fois..</span>";
                }
        }
?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
                <link rel="stylesheet" href="panier.css">
                <title>Panier</title>
            </head>
            <body>
                <header class="tete">
                        <div id="panier">
                            <button type="button" >
                                <i class="fas fa-shopping-basket"></i><span> Panier</span>
                                <?php
                                    $count = countProducts_panier();
                                    echo "<span  class=\"panier-count\">$count</span>";
                                ?>
                            </button>
                        </div>
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
                        <a href="Client.php"><button class="compte">Home</button></a>
                        
                </header>
                <?php
                    $total = 0;
                            // $product_id = array_column($_SESSION['panier'], 'product_id');
                            $result=getProducts_panier();
                            $i=20;
                            if($result!=NULL){
                                while ($row=$result->fetch()){
                                    $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
                                    $bd->query("SET NAMES 'utf8'");
                                    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$row['ID_PRODUIT']);
                                    $requete->execute();
                                    $nbligne=$requete->rowcount();
                                    $l=$requete->fetch();
                                    if($nbligne==0){
                                        panierProducts($row['IMAGE'], $row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['DESCRIPTION_P'], $row['ID_PRODUIT'],$row['QTE']);
                                        if($row['QTE']==1){
                                            $total = $total + (int)$row['PRIX_VENTE'];
                                        }else{
                                            $total = $total + intval($row['QTE'])*((int)$row['PRIX_VENTE']);
                                        }
                                    }else{
                                        panierProducts_promotion($row['IMAGE'], $row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['DESCRIPTION_P'], $row['ID_PRODUIT'],$row['QTE']);
                                        if($row['QTE']==1){
                                            $total = $total + (int)$l['PRIX'];
                                        }else{
                                            $total = $total + intval($row['QTE'])*((int)$row['PRIX_VENTE']);
                                        }
                                    }
                                    echo'<style>';
                                        echo'.panier-dive'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'border-radius: 10px;';
                                            echo'top:'.$i.'%;';
                                            echo'box-shadow: 1px 1px 15px rgba(0, 0, 0,0.15);';
                                            echo'width: 660px;';
                                            echo'height: 200px;';
                                            echo'cursor:pointer;';
                                        echo'}';
                                        echo'.panier-dive'.$row['ID_PRODUIT'].' img{';
                                            echo'position: relative;';
                                            echo'width: 210px;';
                                            echo'height: 190px;';
                                            echo'right: -10px;';
                                            echo'top: 2%;';
                                            echo'border-radius: 18px;';
                                        echo'}';
                                        echo'.prd-div'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'width: 440px;';
                                            echo'position: absolute;';
                                            echo'top: 15%;';
                                            echo'right: -10px;';
                                            echo'font-size: 28px;';
                                            echo'font-family:"Bahnschrift";';
                                        echo'}';
                                        echo'.prd-marq'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'width: 440px;';
                                            echo'position: absolute;';
                                            echo'top: 4%;';
                                            echo'right: -12px;';
                                            echo'font-size: 15px;';
                                            echo'font-family:"Bahnschrift";';
                                            echo'color: rgb(173, 173, 173);';
                                        echo'}';
                                        echo'.desc-div'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'top: 32%;';
                                            echo'width: 62%;';
                                            echo'height: 75px;';
                                            echo'right: 17px;';
                                            echo'font-size: 20px;';
                                            echo'color: rgb(112, 111, 111);';
                                            echo'font-family: "Bahnschrift";';
                                        echo'}';
                                        echo'.prix-div'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'top: 86%;';
                                            echo'right: 350px;';
                                            echo'font-size: 20px;';
                                            echo'font-family:"Bahnschrift";';
                                            echo'color: rgb(173, 173, 173);';
                                        echo'}';
                                        echo'.prixp-div'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'top: 86%;';
                                            echo'right: 220px;';
                                            echo'font-size: 20px;';
                                            echo'font-family:"Bahnschrift";';
                                            echo'color: rgb(229, 45, 32);';
                                        echo'}';
                                        echo'.remove-btn'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'top: 8%;';
                                            echo'right: 2%;';
                                            echo'text-align: center;';
                                            echo'border: none;';
                                            echo'border-radius: 10px;';
                                            echo'width: 30px;';
                                            echo'height: 28px;';
                                            echo'font-weight: 600;';
                                            echo'font-size: 23px;';
                                            echo'font-family:"Bahnschrift";';
                                            echo'background-color: #fff;';
                                            echo'background:none;';
                                            echo'cursor: pointer;';
                                            echo'color:#000;';
                                        echo'}';
                                        echo'.remove-btn'.$row['ID_PRODUIT'].':hover{';
                                            echo'color: rgb(233, 90, 90);';
                                        echo'}';
                                        echo'.qte-input'.$row['ID_PRODUIT'].'{';
                                            echo"background: #FFF;";
                                            echo'border: 1px solid #000;';
                                            echo'width: 80px;';
                                            echo'txet-align:center;';
                                            echo'height: 20px;';
                                            echo'border-radius: 7px;';
                                        echo'}';
                                        echo'.qte-div'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'top: 72%;';
                                            echo'right: 130px;';
                                            echo'width: 170px;';
                                        echo'}';
                                        echo'.acheter'.$row['ID_PRODUIT'].'{';
                                            echo'position: absolute;';
                                            echo'top: 79%;';
                                            echo'right: 2%;';
                                            echo'font-size: 21px;';
                                            echo'font-weight: 600;';
                                            echo"font-family: 'Bahnschrift';";
                                            echo'width: 120px;';
                                            echo'color:#000;';
                                            echo'border: none;';
                                            echo'background:#fff;';
                                            echo'border-radius: 10px;';
                                            echo"border: 1px solid #000;";
                                            echo'cursor: pointer;';
                                        echo'}';
                                        echo'.acheter'.$row['ID_PRODUIT'].' i{';
                                            echo'font-size: 16px;';
                                            echo'right: 3%;';
                                        echo'}';
                                        echo'.acheter'.$row['ID_PRODUIT'].':hover{';
                                            echo'color: rgba(56, 128, 68, 0.904);';
                                        echo'}';
                                    echo'</style>';
                                    $i+=40;
                                }  
                            }else{
                                echo "<span class=\"pan-vide\">Votre panier est vide..!</span>";
                            }              
                ?>
                <div id="details">
                    <span class="details-titre">Détails</span>
                    <hr class="titre-hr">
                    <div class="class-details">
                        <div class="det-titre">
                            <?php
                                $count  = countProducts_panier();
                                echo "<span class=\"prix-titre\">Prix ($count produits)</span><br>";
                            ?>
                            <span class="frais-titre">Frais de livraison</span>
                            <hr class="hr1">
                            <span class="total-titre">Total</span>
                        </div>
                        <div class="det-txt">
                            <span class="prix-txt"><?php echo $total; ?>  dhs</span>
                            <span class="frais-txt">Gratuite</span>
                            <span class="total-txt" name="total"><?php
                                echo $total;
                                ?>  dhs</span>
                        </div>
                    </div>
                </div>
            </body>
        </html>
<?php } ?>