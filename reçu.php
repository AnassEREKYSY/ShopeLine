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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Reçu</title>
</head>
<style>
    form{
        position: absolute;
        width: 70%;
        height: 500px;
        right: 200px;
        top: 12%;
        box-shadow: 2px 2px 10px rgba(0, 0, 0,0.2);
    }
    legend{
        font-size: 37px;
        font-family: 'Bahnschrift';
        font-weight: 700;
        position: absolute;
        right: 20%;
        width: 47%;
        top: 4%;
    }
    label{
        font-size: 16px;
        font-family: 'Bahnschrift';
        font-weight: 400;
    }
    table{
        border: 1px solid #000;
        width: 96%;
        position: absolute;
        right: 22px;
        top: 55%;
    }
    th{
        font-weight: 700;
        border: 1px solid #000;
        font-family: 'Bahnschrift';
    }
    td{
        font-weight: 600;
        text-align:center;
        border: 1px solid #000;
        font-family: 'Bahnschrift';
    }
    .id{
        width: 130px;
    }
    .prd{
        width: 160px;
    }
    .qte{
        width: 60px;
    }
    .prix{
        width: 110px;
    }
    .par1{
        font-size: 14px;
        text-align: center;
        position: absolute;
        top: 85%;
        width: 97%;
        right: 10px;
    }
    .par2{
        font-size: 14px;
        text-align: center;
        position: absolute;
        top: 92%;
        right: 150px;
    }
    input{
        border: none;
        font-size: 14px;
        font-family: 'Bahnschrift';
        font-weight: 400;
        right:-5px;
        position: relative;
    }
    .inf{
        position: absolute;
        right: 10px;
        top: 0%;
        width: 990px;
        height: 230px;
    }
    .lib{
        width: 600px;
        height: 150px;
        position: relative;
        top: 12%;
        right: -40px;
    }
    img{
        position: absolute;
        width: 200px;
        right: 10px;
    }
    .panier-class{
    position: absolute;
    top: 3.8%;
    right: 280px;
    width: 130px;
    height: 26px;
    text-align: center;
    cursor: pointer;
    }
    .panier-class:hover{
        border-bottom: #8d8e91 1.5px solid;
        border-radius: 5px;
    }
    .panier-class a {
        text-decoration: none;
        position: relative;
        border: none;
        background: none;
        top: 6%;
        text-align: center;
    }
    .panier-class a span{
        font-size: 16px;
        font-family: 'Bahnschrift';
        letter-spacing: 1px;
        color: #222538;
        position: relative;
        top: 1%;
        right: 0px;
    }
    .panier-class a  .fa-shopping-cart{
        position: relative;
        right: 12px;
        font-size: 13px;
        color: #252525;
        cursor: pointer;
    }
    .panier-class a  .count{
        font-size: 16px;
        right: -2px;
        color: #252525;
        cursor: pointer;
    }
    .succés{
        color: rgba(10, 184, 106, 0.829);
        font-size: 20px;
        font-weight: 600;
        position: fixed;
        top: 4%;
        right: 880px;
    }
</style>
<body>
    <span class="succés">Votre commande est passée avec succés</span>
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
    <form action="" method="post" enctype="multipart/form-data">
        <img src="photos/shopeline.png" alt="">
        <legend>Facture de commande:</legend><br>
            <br>
            <section class="lib">
                <label for="">Facture N°: <input value="" type="text" name="id-fact" size="35"></label><br>
                <label for="">Numéro de commande: <input value="<?php echo $_SESSION['idcmd'] ?>" type="text" name="id-cmd" size="35"></label><br>
                <label for="">Id du client: <input value="<?php echo $_SESSION['idclt']?>" type="text" name="id-clt" size="35"></label><br>
                <label for="">Nom: <input value="<?php echo $_SESSION['nom']?>" type="text" name="nom" size="35"></label><br>
                <label for="">Prénom: <input value="<?php echo $_SESSION['prn']?>" type="text" name="prenom" size="35"></label><br>
                <label for="">Téléphone<input value="<?php echo $_SESSION['tel']?>" type="text" name="tel" size="35"></label><br>
                <label for="">Adresse: <input value="<?php echo $_SESSION['add']?>" type="text" name="addr" size="35"></label><br>
                <label for="">Email: <input value="<?php echo $_SESSION['em']?>" type="text" name="email" size="35"></label><br><br>
            </section><br>
        <table>
            <tr>
                <th class="id">Numéro de produit</th>
                <th class="prd">Produit</th>
                <th class="qte">Qte</th>
                <th class="prix">Prix Total</th>
                <th class="dcmd">Date de commande</th>
                <th class="liv">Date de livraison</th>
            </tr>
            <tr>
                <td><?php echo $_SESSION['idprd']?></td>
                <td><?php echo $_SESSION['lib']?></td>
                <td><?php echo $_SESSION['qte']?></td>
                <td><?php echo $_SESSION['prt']?></td>
                <td><?php echo $_SESSION['dc']?></td>
                <td><?php echo $_SESSION['dl']?></td>
            </tr>
        </table>
                <p class="par1">Nous vous remercions de votre confiance en nos produits
                    et c'est grâce à vous que nous pouvons avoir la motivation 
                    pour vous proposer les meilleurs produits du marché 
                </p>
                <p class="par2">
                    La livraison s'effectue dans les 15 jours au plus tot 
                    et les 25 jours au plus tard de la date du commande 
                </p>
    </form>
</body>
</html>