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
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
            <link rel="stylesheet" href="commande.css">
            <title>Commande</title>
        </head>
        <body>
            <header class="tete">
                        <div id="cmd">
                            <button type="button" >
                                <i class="fas fa-shipping-fast"></i><span> Commandes</span>
                                    <?php
                                        $count = countCommande();
                                        echo "<span  class=\"cmd-count\">$count</span>";
                                    ?>
                            </button>
                            </a>
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
                        $result=getcommandes();
                        $i=20;
                        if($result!=NULL){
                            while ($row=$result->fetch()){
                                Commandes($row['ID_CMD'],$row['IMAGE'], $row['LIBELLE'],$row['DESCRIPTION_P'], $row['ID_PRODUIT'],$row['QUANTITE_CMD'],$row['PRIX_TOTAL'],$row['DATE_CMD'],$row['STATUT'],$row['DATE_LIVRAISON']);
                                echo'<style>';
                                    echo'.cmd-dive-'.$row['ID_CMD'].'{';
                                        echo'position: absolute;';
                                        echo'border-radius: 10px;';
                                        echo'top:'.$i.'%;';
                                        echo'box-shadow: 2px 2px 10px rgba(0, 0, 0,0.16);';
                                        echo'width: 750px;';
                                        echo'height: 200px;';
                                        echo'right:440px';
                                    echo'}';
                                    echo'.cmd-dive-'.$row['ID_CMD'].' img{';
                                        echo'position: relative;';
                                        echo'width: 140px;';
                                        echo'height: 150px;';
                                        echo'right: -3px;';
                                        echo'top: 15%;';
                                    echo'}';
                                    echo'.prd-div-'.$row['ID_CMD'].'{';
                                        echo'position: absolute;';
                                        echo'width: 440px;';
                                        echo'position: absolute;';
                                        echo'top: 5%;';
                                        echo'right: 140px;';
                                        echo'font-size: 26px;';
                                        echo'font-family:"Bahnschrift";';
                                        echo'text-align: center;';
                                    echo'}';
                                    echo'.desc-div-'.$row['ID_CMD'].'{';
                                        echo'position: absolute;';
                                        echo'top: 20%;';
                                        echo'width: 72%;';
                                        echo'height: 50px;';
                                        echo'right: 70px;';
                                        echo'font-size: 18px;';
                                        echo'color: rgb(112, 111, 111);';
                                        echo'font-family: "Bahnschrift";';
                                        echo'text-align: center;';
                                    echo'}';
                                    echo'.info-'.$row['ID_CMD'].'{';
                                        echo'width: 82%;';
                                        echo'position: relative;';
                                        echo'right: -160px;';
                                        echo'top: -40%;';
                                    echo'}';
                                    echo'.sbinfo1-'.$row['ID_CMD'].'{';
                                        echo'position: relative;';
                                        echo'width: 46%;';
                                        echo'border-right: rgb(104, 103, 103) 2px solid;';
                                    echo'}';
                                    echo'.sbinfo2-'.$row['ID_CMD'].'{';
                                        echo'position: absolute;';
                                        echo'width: 48%;';
                                        echo'right: 2%;';
                                        echo'top: -1%;';
                                    echo'}';
                                    echo'.idcmd-input{';
                                        echo'width:120px;';
                                    echo'}';
                                    echo'input{';
                                        echo'width: 134px;';
                                        echo'height: 20px;';
                                        echo'user-select: none;';
                                        echo'border: none;';
                                        echo'font-size: 14px;';
                                    echo'}';
                                    echo'label{';
                                        echo'font-family: "Bahnschrift";';
                                        echo'font-size:14px ;';
                                        echo'font-weight: 320;';
                                    echo'}';
                                echo'</style>';
                                $i+=40;
                            }  
                        }else{
                            echo "<span class=\"pan-vide\">Vous avez aucunes commandes..!</span>";
                        }              
            ?>
        </body>
        </html>
<?php }?>
