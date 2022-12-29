<?php
    session_start();
    include 'procedure_connexion.php';
    if(!isset($_SESSION['email']) && !isset( $_SESSION['password'])){
        header("location:connexion.php");
    }else{
        if (isset($_GET['add11'])){
            $idclt=htmlspecialchars($_SESSION['id']);
            $idp=htmlspecialchars($_GET['produit_id']);
            $requete = $bd->prepare('SELECT * FROM PANIER WHERE ID_CLT=? AND ID_PRODUIT=?');
            $requete->execute(array($idclt,$idp)); 
            $nb=$requete->fetch(); 
            if($nb==0){
                $idclt=htmlspecialchars($_SESSION['id']);
                $idp=htmlspecialchars($_GET['produit_id']);
                $requete = $bd->prepare('INSERT INTO PANIER(ID_PRODUIT,ID_CLT) VALUES(?,?)');
                $requete->execute(array($idp,$idclt));    
                echo "<script>alert('Le produit est ajouté au panier avec succés')</script>";
                echo "<script>window.location = 'promotions.php'</script>";
            }else{
                echo "<script>alert(' Attention!!Le produit existe déjà au panier..')</script>";
                echo "<script>window.location = 'promotions.php'</script>";
            }
        } 
        if(isset($_GET['view11'])){
            $_SESSION['id-produit']=htmlspecialchars($_GET['produit_id']);
            header("location:details.php");
        }
        // $date =date('Y-m-d');
        // $requete = $bd->prepare('SELECT * FROM PROMOTIONS WHERE DATE_DEBUT=?');
        // $requete->execute(array($date)); 
        // $nb=$requete->rowcount(); 
        // if($nb!=0){
        //     while($ligne=$requete->fetch()){
        //         $requete = $bd->prepare('SELECT * FROM PRODUIT WHERE ID_PRODUIT=?');
        //         $requete->execute(array($ligne['ID_PRODUIT'])); 
        //         $nb=$requete->fetch(); 
        //         $message='Nouvelle promotions : profiter de '.$nb['LIBELLE'].' juste à  '.$ligne['PRIX'].' au lieu de '.$nb['PRIX_VENTE'].' à partir de '.$ligne['DATE_DEBUT'].' et jusqu à '.$ligne['DATE_FIN'];
        //         $headers='Content-Type:text/plain; charset="utf-8"'." ";
        //         if(mail($_POST['email'],'Promotions chez Shopeline',$message,$headers)){
        //             echo'Email envoyé';
        //         }else{
        //             echo'Une erreur est servenue...';
        //         }
        //     }
            
        // }else{
        //     echo'aaaaa';
        // }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="promotions.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
            <title>Document</title>
        </head>
        <body>
            <header class="tete">
                <img src="photos/shopeline.png" alt="es" class="logo">
                <a href="Client.php"><button class="home">Home</button></a>
                <a href="infos.php#sec1"><button class="contacter-nous">Contacter-Nous</button></a>
                <a href="infos.php#sec5"><button class="aide">Aide</button></a>
                <a href="About.php"><button class="ab">About</button></a>
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
                        }else {
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
            </header>
        <section>
            <?php
                $res=getDataPromotion();
                $i=1;
                $z=1;
                $haut=24.5;
                $espace=100;
                $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
                $bd->query("SET NAMES 'utf8'");
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($res!=NULL){
                    echo'<div id="divp">';
                        echo'<span>Profitez de nos promotions et acheter des produits jusqu à -50%</span>';
                    echo'</div>';
                    while($row=$res->fetch()){
                        $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE PROMOTIONS.ID_PRODUIT='.$row['ID_PRODUIT']);
                        $requete->execute();
                        $nbligne=$requete->rowcount();
                        $l=$requete->fetch();
                        if($nbligne!=0){
                            if($i>4){
                                echo'<br><br>';
                                getProductPromotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                $i=1;
                                $haut+=70;
                                $espace=100;
                            }else{
                                getProductPromotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                $i++;
                            } 
                        }
                        echo'<style>';

                                                echo'#produit-dive'.$z.'{';
                                                    echo'height: 360px;';
                                                    echo'width: 235px;';
                                                    echo'position: absolute;';
                                                    echo'top:'.$haut.'%;';
                                                    echo'right:'.$espace.'px;';
                                                    echo'box-shadow: 2px 12px 30px rgba(121, 119, 119,0.2);';
                                                    echo'border-radius: 18px;';
                                                    echo'cursor: pointer;';
                                                    echo'display: flex;';
                                                    echo'background-color:white;';
                                                echo'}';
                                                echo'#produit-dive'.$z.':hover{';
                                                    echo'box-shadow: 1px 1px 15px rgba(121, 119, 119,0.35);';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #image-prd'.$z.'{';
                                                    echo'position: relative;';
                                                    echo'width: 210px ;';
                                                    echo'height: 220px;';
                                                    echo'right: -11px;';
                                                    echo'border-radius: 10px;';
                                                    echo'top: 5%;';
                                                    echo'box-shadow: 12px 12px 30px rgba(121, 119, 119,0.2);';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #ajtpanier-btn'.$z.'{';
                                                    echo'font-size: 19px;';
                                                    echo'font-weight: 700;';
                                                    echo'width: 38px;';
                                                    echo'height: 38px;';
                                                    echo'position: absolute;';
                                                    echo'top: 86%;';
                                                    echo'border: none;';
                                                    echo'right: 15px;';
                                                    echo'color: black;';
                                                    echo'background-color:  rgba(180, 224, 218, 0.45);;';
                                                    echo'cursor: pointer;';
                                                    echo"font-family: 'Bahnschrift';";
                                                    echo'border-radius: 50px;';
                                                    echo'align-items:centrer;';
                                                    echo'box-shadow: 1px 1px 6px rgba(0, 0, 0,0.2);';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #ajtpanier-btn'.$z.' i{';
                                                    echo'font-size: 15px;';
                                                    echo'color: rgba(125, 194, 185);';
                                                    echo'font-weight:900;';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #ajtpanier-btn'.$z.':hover{';
                                                    echo'background-color: rgba(55, 139, 128, 0.842);';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #ajtpanier-btn'.$z.':hover i{';
                                                    echo'color: #FFF;';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #titre-prd'.$z.'{';
                                                    echo'font-size: 20px;';
                                                    echo'width: 200px;';
                                                    echo'text-align:justify;';
                                                    echo'position: absolute;';
                                                    echo'top: 70%;';
                                                    echo'right: 7%;';
                                                    echo"font-family: 'Bahnschrift';";
                                                    echo'font-weight: 600;';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #marque'.$z.'{';
                                                    echo'font-size: 14.5px;';
                                                    echo'width: 200px;';
                                                    echo'text-align:justify;';
                                                    echo'position: absolute;';
                                                    echo'top: 64.5%;';
                                                    echo'right: 7%;';
                                                    echo'   color:  rgb(138, 137, 137);';
                                                    echo"font-family: 'Bahnschrift';";
                                                    echo'font-weight: 500;';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #prix'.$z.'{';
                                                    echo'font-size: 17px;';
                                                    echo'width: 120px;';
                                                    echo'position: absolute;';
                                                    echo'top: 89%;';
                                                    echo'right: 95px;';
                                                    echo'font-weight: 500;';
                                                    echo'cursor: pointer;';
                                                    echo'color: rgba(105, 174, 185);';
                                                echo'}';
                                                echo'#produit-dive'.$z.' #prixp'.$z.'{';
                                                    echo'font-size: 14px;';
                                                    echo'width: 120px;';
                                                    echo'position: absolute;';
                                                    echo'top: 71.5%;';
                                                    echo'right: -45px;';
                                                    echo'font-weight: 600;';
                                                    echo'cursor: pointer;';
                                                    echo'color:rgb(229, 45, 32);                                              ;                                                ';
                                                echo'}';
        
                                                echo'#view'.$row['ID_PRODUIT'].'{';
                                                    echo'height: 28px;';
                                                    echo'width: 70px;';
                                                    echo'font-size: 19px;';
                                                    echo'font-family: "Bahnschrift";';
                                                    echo'position: absolute;';
                                                    echo'top: 2%;';
                                                    echo'right: 157px;';
                                                    echo'background-color: rgba(209, 209, 209, 0.373);';
                                                    echo'border: none;';
                                                    echo'border-radius: 10px;';
                                                    echo'cursor:pointer;';
                                                echo'}'; 
                                                echo'#view'.$row['ID_PRODUIT'].':hover{';
                                                echo'background: #FFF;';
                                                echo'border:0.5px solid #000;';
                                                echo'}';
                        echo'</style>'; 
                        $espace+=287;
                        $z++;
                    }
                }else{
                    echo'<div id="divp">';
                        echo'<span>Les promotions ne sont pas encore commencer!!</span>';
                    echo'</div>';
                }
            ?>
        </section>
                
        </body>
        </html>
    <?php } ?>