<?php 
    session_start();
    include 'procedure_connexion.php'; 
    if(isset($_POST['view1'])){
        $_SESSION['id-produit']=htmlspecialchars($_POST['produit_id']);
        header("location:details1.php"); 
    } 
    if(isset($_POST['add'])){
        header("location:connexion.php");
    } 
    $_SESSION['marque']='';
    $_SESSION['cat']='';
    // phone 
    if(isset($_POST['iphone'])){
        $_SESSION['marque']='iphone';
        $_SESSION['cat']='PHONE';
        header("location:menu_produit1.php");
    }  
    if(isset($_POST['samsung'])){
        $_SESSION['marque']='samsung';
        $_SESSION['cat']='PHONE';
        header("location:menu_produit1.php");
    }  
    if(isset($_POST['xiaomi'])){
        $_SESSION['marque']='xiaomi';
        $_SESSION['cat']='PHONE';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['huawei'])){
        $_SESSION['marque']='huawei';
        $_SESSION['cat']='PHONE';
        header("location:menu_produit1.php");
    } 
    // pc 
    if(isset($_POST['apple'])){
        $_SESSION['marque']='apple';
        $_SESSION['cat']='PC';
        header("location:menu_produit1.php");
    }  
    if(isset($_POST['hp'])){
        $_SESSION['marque']='hp';
        $_SESSION['cat']='PC';
        header("location:menu_produit1.php");
    }  
    if(isset($_POST['dell'])){
        $_SESSION['marque']='dell';
        $_SESSION['cat']='PC';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['acer'])){
        $_SESSION['marque']='acer';
        $_SESSION['cat']='PC';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['lenovo'])){
        $_SESSION['marque']='lenovo';
        $_SESSION['cat']='PC';
        header("location:menu_produit1.php");
    } 
    // ACCESSOIRE 
    if(isset($_POST['ecouteurs'])){
        $_SESSION['marque']='ecouteurs';
        $_SESSION['cat']='ACCESSOIRE';
        header("location:menu_produit1.php");
    }  
    if(isset($_POST['chrg'])){
        $_SESSION['marque']='chargeur';
        $_SESSION['cat']='ACCESSOIRE';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['rt'])){
        $_SESSION['marque']='routeur';
        $_SESSION['cat']='APPAREIL';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['accp'])){
        $_SESSION['marque']='accessoire du pc';
        $_SESSION['cat']='ACCESSOIRE';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['watch'])){
        $_SESSION['marque']='watch';
        $_SESSION['cat']='ACCESSOIRE';
        header("location:menu_produit1.php");
    } 
    // TV 
    if(isset($_POST['smg'])){
        $_SESSION['marque']='samsung';
        $_SESSION['cat']='TV';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['phl'])){
        $_SESSION['marque']='philips';
        $_SESSION['cat']='TV';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['lg'])){
        $_SESSION['marque']='lg';
        $_SESSION['cat']='TV';
        header("location:menu_produit1.php");
    } 
    if(isset($_POST['sny'])){
        $_SESSION['marque']='sony';
        $_SESSION['cat']='TV';
        header("location:menu_produit1.php");
    } 
    if(isset($_GET['chercher-h']) && !empty($_GET['chercher-produit'])){
        // $_SESSION['prod']=$_GET['chercher-produit'];
        header("location:menu_produit1.php");
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Principale</title>
    <link rel="stylesheet" href="Page_Principale.css">
    <link rel="stylesheet" href="lightslider.css">
    <script src="JQuery.js"></script>
    <script src="lightslider.js"></script>
    <script src="Page_Principale.js" type="text/javascript"></script> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
    <body>
        <div id="conteneur-global">
                    <header class="tete">
                        <img src="photos/shopeline.png" alt="es" class="logo">
                         <a href="infos1.php#sec1"><button class="contacter-nous">Contacter-Nous</button></a>
                         <a href="infos1.php#sec5"><button class="aide">Aide</button></a>
                         <a href="About1.php"><button class="ab">About</button></a>
                         <a href="connexion.php"><i class="fas fa-user-plus"></i></a>                       
                    </header>
                    <section id="barre-haute">
                        <form action="menu_produit1.php" method="GET">
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
                                            type:'GET',
                                            url:'barre1.php',
                                            data:'produit=' + encodeURIComponent(produit),
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
                    <section id="panneau">
                        <img src="photos/Produits/backg/pexels-mockupeditorcom-205316.jpg" alt="" class="bg">
                        <section id="parole1">
                            <span id="s11">Shopeline</span><br>
                            <span id="s12">pour vous!</span>
                        </section>
                        <img src="photos/shopeline.png" alt="es" class="logo1">
                        <div class="wrapper1">
                            <div class="icon1 facebook">
                                <div class="tooltip1">Facebook</div>
                                <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
                            </div>
                            <div class="icon1 twitter">
                                <div class="tooltip1">Twitter</div>
                                <span><a href="#"><i class="fab fa-twitter"></i></a></span>
                            </div>
                            <div class="icon1 instagram">
                                <div class="tooltip1">Instagram</div>
                                <span><a href="#"><i class="fab fa-instagram"></i></a></span>
                            </div>
                            <div class="icon1 snapchat">
                                <div class="tooltip1">Spanchat</div>
                                <span><a href="#"><i class="fab fa-snapchat"></i></a></span>
                            </div>
                            <div class="icon1 youtube">
                                <div class="tooltip1">Youtube</div>
                                <span><a href="#"><i class="fab fa-youtube"></i></a></span>
                            </div>
                        </div>
                    </section>
                    <section class="photos-section">
                        <img src="photos/—Pngtree—shopping cart mobile shopping_5407927.png" class="imgcart1">
                        <img src="photos/—Pngtree—bank terminal and credit card_6959910.png" class="imgcart2">
                    </section>
                    <section id="sec1new">
                        <span id="sp1">New Arrivals</span><br>
                        <span id="sp2">New Modern Products</span>
                        <a href="promotion_pp.php">voir plus de promotions</a>
                    </section>
                    <section class="produit">
                        <?php
                            $result=getData();
                            $i=0;
                            $z=1;
                            $haut=0.2;
                            $espace=60;
                            while($row=$result->fetch()){
                                $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
                                $bd->query("SET NAMES 'utf8'");
                                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                if($z<=28){
                                    $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$row['ID_PRODUIT']);
                                    $requete->execute();
                                    $nbligne=$requete->rowcount();
                                    $l=$requete->fetch();
                                    if($nbligne==0){
                                        if($i >=4){
                                            echo'<br><br>';
                                            getProduct_pp($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                            $i=1;
                                            $haut+=14.4;
                                            $espace=60;
                                        }else{
                                            getProduct_pp($row['LIBELLE'],$row['PRIX_VENTE'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                            $i++;
                                        } 
                                    }else{
                                        if($i >=4){
                                            echo'<br><br>';
                                            getProduct_pp_Promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
                                            $i=1;
                                            $haut+=14.4;
                                            $espace=60;
                                        }else{
                                            getProduct_pp_Promotion($row['LIBELLE'],$row['PRIX_VENTE'],$l['PRIX'],$row['MARQUE'],$row['IMAGE'],$row['ID_PRODUIT'],$z);
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
                                            echo'user-select:none;';
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
                                            echo'position: absolute;';
                                            echo'top: 28%;';
                                            echo'left: 10px;';
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
                                    // echo'<script>';
                                    //     echo'$(document).ready(function(){';
                                    //     echo'    $(".dive-prd").on({';
                                    //     echo'        click:function(){';
                                    //     echo'            $("#view'.$row['ID_PRODUIT'].'").show()';
                                    //     echo'        },';
                                    //     echo'        dblclick:function(){';
                                    //     echo'            $("#view'.$row['ID_PRODUIT'].'").hide();';
                                    //     echo'        }';
                                    //     echo'    });';
                                    //     echo'});';
                                    // echo'</script>';
                                    // echo'<script>';
                                    //     echo'$(document).ready(function(){';
                                    //         echo'$(".produit-dive'.$z.'").on({';
                                    //             echo'click:function(){';
                                    //                 echo'$("#view'.$row['ID_PRODUIT'].'").toggle();';
                                    //                 // echo'$("#image-prd'.$row['ID_PRODUIT'].'").css("width","160px");';
                                    //             echo'},';
                                    //             echo'dblclick:function(){';
                                    //                 echo'$("#view'.$row['ID_PRODUIT'].'")..toggle();';
                                    //                 // echo'$("#image-prd'.$row['ID_PRODUIT'].'").css("width","180px");';
                                    //             echo'},';
                                    //         echo'});';
                                    //     echo'});';
                                    // echo'</script>';
                                    $espace+=287;
                                    $z++;
                                }
                            }
                        ?>
                    </section>
                    <section id="barre-menu">
                        <div class="panier-class">
                            <a href="connexion.php">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Panier</span>
                            </a>
                        </div>
                        <div class="commande-class">
                            <a href="connexion.php">
                                <i class="fas fa-shipping-fast"></i>
                                <span>Mes commandes</span>
                            </a>
                        </div>
                    </section>
                    <section id="menu">
                        <nav>
                            <div class="drop-btn">
                            Menu des produits <span class="fas fa-caret-down"></span>
                            </div>
                            <div class="tooltip"></div>
                            <div class="wrapper">
                            <ul class="menu-bar">
                                <li class="phone-item">
                                    <div class="dive">
                                        <div class="icon">
                                        <span class="fas fa-mobile"></span>
                                        </div>
                                        Smartphone & Tablette<i class="fas fa-angle-right"></i>
                                    </div>
                                </li>
                                <li class="pc-item">
                                    <div class="dive">
                                        <div class="icon">
                                        <span class="fas fa-laptop"></span>
                                        </div>
                                        PC <i class="fas fa-angle-right"></i>
                                    </div>
                                </li>
                                <li class="acc-item">
                                    <div class="dive">
                                        <div class="icon">
                                        <span class="fas fa-headphones"></span>
                                        </div>
                                        Accesoires &Appareils<i class="fas fa-angle-right"></i>
                                    </div>
                                </li>
                                <li class="tv-item">
                                    <div class="dive">
                                        <div class="icon">
                                        <span class="fas fa-tv"></span>
                                        </div>
                                        Télèvision & Ecran<i class="fas fa-angle-right"></i>    
                                    </div>
                                </li>
                            </ul>
                            <!-- smartphone & tablette Menu-items -->
                            <ul class="phone-drop">
                                <li class="arrow back-phone-btn"><span class="fas fa-arrow-left"></span>Téléphone & Tablette</li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="iphone" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-mobile"></span>
                                                </div>
                                                Iphone
                                            </button>
                                        </form>
                                </li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="samsung"  class="dive">
                                                <div class="icon">
                                                <span class="fas fa-mobile"></span>
                                                </div>
                                                Samsung
                                            </button>
                                        </form>
                                </li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="xiaomi"  class="dive">
                                                <div class="icon">
                                                <span class="fas fa-mobile"></span>
                                                </div>
                                                Xiaomi
                                            </button>
                                        </form>
                                </li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="huawei"  class="dive">
                                                <div class="icon">
                                                <span class="fas fa-mobile"></span>
                                                </div>
                                                Huawei
                                            </button>
                                        </form>
                                </li>
                            </ul>
                            <!-- pc Menu-items -->

                            <ul class="pc-drop">
                                <li class="arrow back-pc-btn"><span class="fas fa-arrow-left"></span>PC</li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="apple" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-laptop"></span>
                                                </div>Apple 
                                            </button>
                                        </form>
                                </li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="hp" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-laptop"></span>
                                                </div>HP 
                                            </button>
                                        </form>
                                </li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="dell" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-laptop"></span>
                                                </div>DELL
                                            </button>
                                        </form>
                                </li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="acer" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-laptop"></span>
                                                </div>ACER 
                                            </button>
                                        </form>
                                </li>
                                <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="lenovo" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-laptop"></span>
                                                </div>LENOVO 
                                            </button>
                                        </form>
                                </li>

                            </ul>
                                <!-- accessoires Menu-items -->
                                <ul class="acc-drop">
                                    <li class="arrow back-acc-btn"><span class="fas fa-arrow-left"></span>Accessoires</li>
                                    <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="ecouteurs" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-headphones"></span>
                                                </div>Ecouteurs
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                    <form action="" method="POST">
                                            <button type="submit"  name="chrg" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-plug"></span>
                                                </div>Chargeurs 
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                    <form action="" method="POST">
                                            <button type="submit"  name="rt" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-hdd"></span>
                                                </div>Routeurs 
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                    <form action="" method="POST">
                                            <button type="submit"  name="accp" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-keyboard"></span>
                                                </div>Accesoires du pc 
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                    <form action="" method="POST">
                                            <button type="submit"  name="watch" class="dive">
                                                <div class="icon">
                                                <span class="fa-solid fa-watch-smart"></span>
                                                </div>Watch
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                                <!-- TV Menu-items -->
                                <ul class="tv-drop">
                                    <li class="arrow back-tv-btn"><span class="fas fa-arrow-left"></span>TV</li>
                                    <li>
                                        <form action="" method="POST">
                                            <button type="submit"  name="smg" class="dive">
                                                <div class="icon">
                                                    <span class="fas fa-tv"></span>
                                                </div>Samsung
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                    <form action="" method="POST">
                                            <button type="submit"  name="phl" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-tv"></span>
                                                </div>Philips
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                    <form action="" method="POST">
                                            <button type="submit"  name="lg" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-tv"></span>
                                                </div>LG 
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                    <form action="" method="POST">
                                            <button type="submit"  name="sny" class="dive">
                                                <div class="icon">
                                                <span class="fas fa-tv"></span>
                                                </div>Sony
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <script>
                                const drop_btn = document.querySelector(".drop-btn span");
                                const tooltip = document.querySelector(".tooltip");
                                const menu_wrapper = document.querySelector(".wrapper");
                                const menu_bar = document.querySelector(".menu-bar");
                                const phone_drop = document.querySelector(".phone-drop");
                                const tv_drop = document.querySelector(".tv-drop");
                                const acc_drop = document.querySelector(".acc-drop");
                                const pc_drop = document.querySelector(".pc-drop");
                                const phone_item = document.querySelector(".phone-item");
                                const tv_item = document.querySelector(".tv-item");
                                const pc_item = document.querySelector(".pc-item");
                                const acc_item = document.querySelector(".acc-item");
                                const phone_btn = document.querySelector(".back-phone-btn");
                                const pc_btn = document.querySelector(".back-pc-btn");
                                const tv_btn = document.querySelector(".back-tv-btn");
                                const acc_btn = document.querySelector(".back-acc-btn");
                                drop_btn.onclick = (()=>{
                                    menu_wrapper.classList.toggle("show");
                                    tooltip.classList.toggle("show");
                                });
                                phone_item.onclick = (()=>{
                                    menu_bar.style.marginLeft = "-300px";
                                    setTimeout(()=>{
                                    phone_drop.style.display = "block";
                                    }, 100);
                                });
                                pc_item.onclick = (()=>{
                                    menu_bar.style.marginLeft = "-300px";
                                    setTimeout(()=>{
                                    pc_drop.style.display = "block";
                                    }, 100);
                                });
                                acc_item.onclick = (()=>{
                                    menu_bar.style.marginLeft = "-300px";
                                    setTimeout(()=>{
                                    acc_drop.style.display = "block";
                                    }, 100);
                                });
                                tv_item.onclick = (()=>{
                                    menu_bar.style.marginLeft = "-300px";
                                    setTimeout(()=>{
                                    tv_drop.style.display = "block";
                                    }, 100);
                                });
                                phone_btn.onclick = (()=>{
                                    menu_bar.style.marginLeft = "0px";
                                    phone_drop.style.display = "none";
                                });
                                pc_btn.onclick = (()=>{
                                    pc_drop.style.display = "none";
                                    menu_bar.style.marginLeft = "0px";
                                });
                                acc_btn.onclick = (()=>{
                                    acc_drop.style.display = "none";
                                    menu_bar.style.marginLeft = "0px";
                                });
                                tv_btn.onclick = (()=>{
                                    tv_drop.style.display = "none";
                                    menu_bar.style.marginLeft = "0px";
                                });
                        </script>
                    </section> 
                    <section class="produit-cher1"> 
                        <h2>Nos conventions</h2>
                        <ul id="autoWidth1" class="cs-hidden1">
                            <li class="item-a">
                                <div class="box1">
                                    <div class="slide-image1">
                                        <img src="photos/apple.png" alt="apple" >
                                        <div class="overlay1">
                                            <a href="#" class="buy-btn1">Apple</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item-b">
                                <div class="box1">
                                    <div class="slide-image1">
                                        <img src="photos/samsung.png" alt="phone">
                                        <div class="overlay1">
                                            <a href="#" class="buy-btn2">Samsung</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item-c">
                                <div class="box1">
                                    <div class="slide-image1">
                                        <img src="photos/xiaomi.png" alt="watch">
                                        <div class="overlay1">
                                            <a href="#" class="buy-btn3">Xiaomi</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item-d">
                                <div class="box1">
                                    <div class="slide-image1">
                                        <img src="photos/hp.png" alt="tv">
                                        <div class="overlay1">
                                            <a href="#" class="buy-btn4">Hp</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item-e">
                                <div class="box1">
                                    <div class="slide-image1">
                                        <img src="photos/dell.png" alt="Casque">
                                        <div class="overlay1">
                                            <a href="#" class="buy-btn5">Dell</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                            <script>
                                $(document).ready(function() {
                                    $('#autoWidth1').lightSlider({
                                        autoWidth:true,
                                        loop:false,
                                        onSliderLoad: function() {
                                            $('#autoWidth1').removeClass('cS-hidden1');
                                        } 
                                    });  
                                });
                                
                            </script>
                    </section>
                    <footer>
                        <img src="photos/shopeline1.png" alt="" class="imgfoot1">
                        <img src="photos/—Pngtree—couriers delivery packages by motorbike_5872435.png" class="imgfoot2" alt="">
                        <div class="foot" >
                            <hr>
                            <small>&copy; Copyright 2022 ESTM GI</small>
                        </div>
                        <pre >
                            <div class="telecharger">
                            <b>Bientôt notre site dans votre poche !</b>
                            Télechargez notre application gratuite
                            </div>
                        </pre>
                        <a href="#"><img src="photos/app-store.png" alt="appstore" class="appstore"></a>
                        <a href="#"><img src="photos/play-store.png" alt="playstore" class="playstore"></a>
                        <table class="tab1">
                            <thead><tr><td>Sevice Client</td></tr></thead>
                            <tbody>
                                <tr><td><a href="infos1.php#sec1" style="text-decoration: none;">Contactez-nous</a></td></tr>
                                <tr><td><a href="infos1.php#sec2" style="text-decoration: none;">Politique de retour</a></td></tr>
                                <tr><td><a href="infos1.php#sec3" style="text-decoration: none;">Signaler un produit</a></td></tr>
                            </tbody>
                        </table>
                        <table class="tab2">
                            <thead><tr><td>Apropos du magasin</td></tr></thead>
                            <tbody>
                                <tr><td><a href="infos1.php#sec4" style="text-decoration: none;">Qui sommes-nous?</a></td></tr>
                            </tbody>
                        </table>
                        <pre>
                        <b class="paiement"><i class="fas fa-money"></i>Paiement à domicile !!</b> 
                        </pre>
                    </footer>
        </div>
    </body>
</html>

