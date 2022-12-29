<?php
session_start();
include 'procedure_connexion.php';
echo'<link rel=\"stylesheet\" href=\"Client.css\">';

    if(isset($_POST['produit'])){
        $prd=(string) trim($_POST['produit']);
        $prd1=(string) trim($_POST['produit']);
        $prd2=(string) trim($_POST['produit']);
        $requete=$bd->prepare('SELECT * FROM PRODUIT WHERE LOWER(LIBELLE) LIKE LOWER(?) OR LOWER(MARQUE) LIKE LOWER(?) OR LOWER(CATEGORIE) LIKE LOWER(?) LIMIT 10');
        $requete->execute(array("%$prd%","%$prd1%","%$prd2%"));
        $res=$requete->fetchAll();
        echo'<div class="recherche">';
            foreach($res as $r){
                ?>
                <form action="menu_produit.php" methode="POST" class="chercher-form">
                    <input type="submit" id="prd" name="prd" value="<?= $r['LIBELLE']?>" >
                </form>
                <!-- <div style='margin-top:20px 0; border-bottom:2px solid #ccc'><button type="submit" name="prd"></button></div> -->
                <?php
                if(isset($_GET['prd']) && !empty($_GET['prd'])){
                    $_SESSION['name']=$_GET['prd'];
                    header("location:menu_produit.php");
                }
            }
        echo'</div>';
    }
    else if(isset($_POST['produit1'])){
        $prd=(string) trim($_POST['produit1']);
        $prd1=(string) trim($_POST['produit1']);
        $prd2=(string) trim($_POST['produit1']);
        $requete=$bd->prepare('SELECT * FROM PRODUIT WHERE LOWER(LIBELLE) LIKE LOWER(?) OR LOWER(MARQUE) LIKE LOWER(?) OR LOWER(CATEGORIE) LIKE LOWER(?) LIMIT 10');
        $requete->execute(array("%$prd%","%$prd1%","%$prd2%"));
        $res=$requete->fetchAll();
        echo'<div class="recherche">';
            foreach($res as $r){
                ?>
                <form action="menu_produit.php" methode="POST" class="chercher-form">
                    <input type="submit" id="prd1" name="prd1" value="<?= $r['LIBELLE']?>" >
                </form>
                <!-- <div style='margin-top:20px 0; border-bottom:2px solid #ccc'><button type="submit" name="prd"></button></div> -->
                <?php
                if(isset($_GET['prd1']) && !empty($_GET['prd1'])){
                    $_SESSION['name1']=$_GET['prd1'];
                    header("location:menu_produit.php");
                }
            }
        echo'</div>';
    }
?>
