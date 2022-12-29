<?php
    session_start();
    include 'procedure_connexion.php';
    if(!isset($_SESSION['email']) && !isset( $_SESSION['password'])){
        header("location:connexion.php");
    }else{
        if (isset($_GET['add1'])){
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
                echo "<script>window.location = 'menu_produit.php'</script>";
            }else{
                echo "<script>alert(' Attention!!Le produit existe déjà au panier..')</script>";
                echo "<script>window.location = 'menu_produit.php'</script>";
            }
        } 
        if(isset($_GET['view'])){
            $_SESSION['id-produit']=htmlspecialchars($_GET['produit_id']);
            header("location:details.php");
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
                <link rel="stylesheet" href="lightslider.css">
                <script src="JQuery.js"></script>
                <script src="lightslider.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="menu_produit.css">
                <title>Document</title>
            </head>
            <body>
                    <header class="tete">
                        <div id="panier">
                            <a href="panier.php" >
                                <i class="fas fa-shopping-basket"></i><span> Panier</span>
                                <?php
                                    $count = countProducts_panier();
                                    echo "<span  class=\"panier-count\">$count</span>";
                                ?>
                            </a>
                        </div>
                        <div id="cmd">
                            <a href="commande.php" >
                                <i class="fas fa-shipping-fast"></i><span> Commandes</span>
                                    <?php
                                        $count = countCommande();
                                        echo "<span  class=\"cmd-count\">$count</span>";
                                    ?>
                            </a>
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
                                        <img src="<?php echo $ligne['IMAGE']?>" alt="" class="pic-profil">
                                    <?php
                                }else{
                                    ?>
                                    <button class="btn-profil"> 
                                        <?php
                                            $nom=$_SESSION['nom'];
                                            $prenom=$_SESSION['prenom'];
                                            $nom1=str_split($nom);
                                            $prenom1=str_split($prenom);
                                            echo strtoupper($prenom1[0].''.$nom1[0]);
                                        ?>
                                    </button>
                                    <?php
                                }   
                        ?>
                        <a href="Client.php"><button class="compte">Home</button></a>
                        
                    </header>
                    <section id="barre-haute">
                        <form action="menu_produit.php" method="GET">
                            <input type="text" name="chercher-produit" id="chercher-produit" placeholder="   chercher un produit">
                            <input type="submit" value="chercher" name="chercher-h" id="chercher-h">
                        </form>
                        <div style='margin-top:1px'>
                            <div id="resultat"></div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $('#chercher-produit').keyup(function(){
                                    $('#resultat').html('');
                                    var produit=$(this).val();
                                    if(produit!=""){
                                        $.ajax({
                                            type:'POST',
                                            url:'barre.php',
                                            data:'produit1=' + encodeURIComponent(produit),
                                            success:function(data){
                                                if(data!=""){
                                                    $('#resultat').append(data);
                                                }else{
                                                    // document.getElementById('resultat').innerHTML="<div style='font-size:20px;text-align:center;margin-top:20px;position: absolute;top:20%'>Aucun produit</div>"
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
                    </section>
                <span class="produit-6"><?php echo$_SESSION['marque']?></span>
                <hr class="hr-6">
                <?php
                        $marque=$_SESSION['marque'];
                        $cat=$_SESSION['cat'];
                        $res=getproduit_menu($marque,$cat);
                        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
                        $bd->query("SET NAMES 'utf8'");
                        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    if($res!=NULL){
                            $i=1;
                            $z=1;
                            $haut=24.5;
                            $espace=100;
                            while($row=$res->fetch()){
                                $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$row['ID_PRODUIT']);
                                $requete->execute();
                                $nbligne=$requete->rowcount();
                                $l=$requete->fetch();
                                if($nbligne==0){
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i++;
                                    } 
                                }else{
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
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
                                echo'<script>';
                                    echo'$(document).ready(function(){';
                                    echo'    $(".dive-prd").on({';
                                    echo'        click:function(){';
                                    echo'            $("#view'.$j.'").show();';
                                    echo'        },';
                                    echo'        dblclick:function(){';
                                    echo'            $("#view'.$j.'").hide();';
                                    echo'        }';
                                    echo'    });';
                                    echo'});';
                                echo'</script>';
                                $espace+=290;
                                $z++;
                            }
                    }else if(isset($_GET['prd'])){
                        $marque1=$_GET['prd'];
                        $name1=$_GET['prd'];
                        $res1=getproduit_recherche($marque1,$name1);
                        if($res1!=NULL){
                            $i=1;
                            $z=1;
                            $haut=24.5;
                            $espace=100;
                            while($row=$res1->fetch()){
                                $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$row['ID_PRODUIT']);
                                $requete->execute();
                                $nbligne=$requete->rowcount();
                                $l=$requete->fetch();
                                if($nbligne==0){
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i++;
                                    }
                                }else{
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
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
                                echo'<script>';
                                    echo'$(document).ready(function(){';
                                    echo'    $(".dive-prd").on({';
                                    echo'        click:function(){';
                                    echo'            $("#view'.$j.'").show();';
                                    echo'        },';
                                    echo'        dblclick:function(){';
                                    echo'            $("#view'.$j.'").hide();';
                                    echo'        }';
                                    echo'    });';
                                    echo'});';
                                echo'</script>';
                                $espace+=290;
                                $z++;
                            }
                        }else{
                            echo "<span class=\"pan-vide\">Désolé ce produit n'existe pas..!</span>";
                        }
                    }else if(isset($_GET['prd1'])){
                        $marque1=$_GET['prd1'];
                        $name1=$_GET['prd1'];
                        $res1=getproduit_recherche($marque1,$name1);
                        if($res1!=NULL){
                            $i=1;
                            $z=1;
                            $haut=24.5;
                            $espace=100;
                            while($row=$res1->fetch()){
                                $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$row['ID_PRODUIT']);
                                $requete->execute();
                                $nbligne=$requete->rowcount();
                                $l=$requete->fetch();
                                if($nbligne==0){
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i++;
                                    }
                                }else{
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
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
                                echo'<script>';
                                    echo'$(document).ready(function(){';
                                    echo'    $(".dive-prd").on({';
                                    echo'        click:function(){';
                                    echo'            $("#view'.$j.'").show();';
                                    echo'        },';
                                    echo'        dblclick:function(){';
                                    echo'            $("#view'.$j.'").hide();';
                                    echo'        }';
                                    echo'    });';
                                    echo'});';
                                echo'</script>';
                                $espace+=290;
                                $z++;
                            }
                        }else{
                            echo "<span class=\"pan-vide\">Désolé ce produit n'existe pas..!</span>";
                        }
                    }else if(isset($_GET['chercher-h'])){
                        $marque2=$_GET['chercher-produit'];
                        $name2=$_GET['chercher-produit'];
                        $res2=getproduit_recherche($marque2,$name2);
                        if($res2!=NULL){
                            $i=1;
                            $z=1;
                            $haut=24.5;
                            $espace=100;
                            while($row=$res2->fetch()){
                                $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$row['ID_PRODUIT']);
                                $requete->execute();
                                $nbligne=$requete->rowcount();
                                $l=$requete->fetch();
                                if($nbligne==0){
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i++;
                                    }
                                }else{
                                    if($i>4){
                                        echo'<br><br>';
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                        $i=0;
                                        $haut+=30;
                                    }else{
                                        getProductmenu_promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
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
                                echo'<script>';
                                    echo'$(document).ready(function(){';
                                    echo'    $(".dive-prd").on({';
                                    echo'        click:function(){';
                                    echo'            $("#view'.$j.'").show();';
                                    echo'        },';
                                    echo'        dblclick:function(){';
                                    echo'            $("#view'.$j.'").hide();';
                                    echo'        }';
                                    echo'    });';
                                    echo'});';
                                echo'</script>';
                                $espace+=290;
                                $z++;
                            }
                        }else{
                            echo "<span class=\"pan-vide\">Désolé ce produit n'existe pas..!</span>";
                        }
                    }else{
                        echo "<span class=\"pan-vide\">Désolé ce produit n'est encore arriver au stock..!</span>";
                    }
                ?>
            </body>
        </html>
<?php } ?>
