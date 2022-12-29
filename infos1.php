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
    <link rel="stylesheet" href="infos1.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Document</title>
</head>
<body>

    <header class="tete">
        <img src="photos/shopeline.png" alt="es" class="logo">
                       
         <a href="connexion.php"><i class="fas fa-user-plus"></i></a>
        <a href="Page_Principale.php"><button class="compte">Home</button></a>
                        
    </header>
    <span class="spn">Trouvez-nous sur la carte</span>
    <hr class="hr">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3313.252443778907!2d-5.582065168403947!3d33.85738444493763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda05aa3aa69119f%3A0x227685e2846b5a39!2sEcole%20Sup%C3%A9rieure%20de%20Technologie!5e0!3m2!1sfr!2sma!4v1648046795384!5m2!1sfr!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    <section id="sec1">
        <h1 class="ct">Contactez-nous :</h1>
        <p> Si jamais vous avez des questions, n'hésiter pas à nous contacter par téléphone ou par email nous serons à votre disposition pour vous répondre le plus vite possible</p>
        <div>
            <span class="add"><i class="fas fa-solid fa-location-pin"></i> Route Agouray Meknès Maroc</span>
            <span class="em"><i class="fas fa-solid fa-envelope"></i> ESTM@MEKNES.COM</span>
            <span class="ph"><i class="fas fa-solid fa-phone"></i> +2120000000000</span>
            
        </div>
    </section>
    <section id="sec2">
        <h1 class="ct">Politique de retour :</h1>
        <div> Shopline fait le possible pour satisfaire ses clients.
            Si jamais vous avez reçu un produit et vous le trouvrez pas comme  il est indiqué sur le site ou bien que vous le trouvrez en mauvaise état aussi si vous faite un mauvais choix vous pouvez rendre le produit dans un délai de 5jours à partir de la date de la réception de la commande
            Pour nous rendre le produit et être rembourser vous devrez suivre les étapes suivantes:
            <section>
                1-Mettez le produit dans un packet où il est indiqué notre adresse (vous la trouverez dans la section contactez-nous).<br>
                2-Accompagnez le paquet avec une copie de votre carte d'identitée.<br>
                3-Envoyez un email à l'adresse indiquée dans la section contactez-nous avec l'objet Retour(Votre nom,prénom).<br>
            </section>
        </div>
    </section>
    <section id="sec3">
        <h1 class="ct">Signaler un produit :</h1>
            <div> Shopline se base sur les avis de ses clients pour s'améloirer et pour proposer toujours les meilleurs produits.
                Si jamais vous avez une remarque que ça soit positive ou négative à propos d'un produit n'hésitez pas à nous donner vos avis en envoyant des emails ou bien par téléphone
                car ça nous pousse à se developper
            </div>
    </section>
    <section id="sec5">
        <h1 class="ct">Aide :</h1>
            <div> 
                pour toutes questions n'hésiter pas à nous contacter dans les adresse mentionnées dans la section contacter-nous
            </div>
    </section>
</body>
</html>