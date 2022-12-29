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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Document</title>
</head>
<style>
    body{
        overflow-X:hidden;
        overflow-Y:scroll;
    }
    .im{
        width: 1250px;
        height:220px;
        right:7px;
        position: absolute;
        top: 10%;
    }
    .title{
        z-index: 1;
        position:absolute;
        top:20%;
        font-size:50px;
        color:white;
        right:380px;
        font-family: 'Bahnschrift';
    }
    .title1{
        z-index: 1;
        position:absolute;
        top:29%;
        font-size:24px;
        color:white;
        right:550px;
        font-family: 'Bahnschrift';
    }
    .im1{
        width: 500px;
        height: 300px;
        position:absolute;
        right:680px;
        top:55%;
        border-radius:13px;
    }
    .section2{
        width:600px;
        position:absolute;
        right:40px;
        top:69%;
        height:230px;
    }
    h3{
        text-align:left;
        font-family: 'Bahnschrift';
        font-size:40px;
        margin:0;
    }
    header{
        height: 45px;
        background: #FFF;
    }
    .titre{
        position: absolute; 
        right:930px;
        top: 1.4%;
        width: 200px;
        height: 65px;
        font-size: 45px;
        font-family: 'Gabriola';
        font-weight: 570;
        letter-spacing: 1px;
    }

    .logo{
        position: absolute; 
        right:960px;
        top: 0%;
        width: 250px;
        height: 55px;
    }

    .decnx{
        width: 30px;
        height: 30px;
        position: absolute;
        top: 2.8%;
        right: 22px;
    }
    .btn-profil{
        border: #000 1px solid ;    
        position: absolute;
        top: 1.7%;
        right: 90px;
        height: 42px;
        font-size: 25px;
        width:42px;
        border-radius:30px ;
        cursor: pointer;
        padding: 2px;
        background-color: rgb(193, 196, 197);
    }
    .pic-profil{
        border: #000 1px solid ;    
        position: absolute;
        top: 1.7%;
        right: 90px;
        height: 42px;
        font-size: 25px;
        width:42px;
        border-radius:30px ;
        cursor: pointer;
        padding: 2px;
    }
    .aide{
        position: absolute;
        top: 3%;
        right: 430px;
        width:60px;
        height: 30px;
        font-size: 16px;
        border: none;
        background: #FFF;
        font-family: 'Bahnschrift';
        cursor: pointer;

        border-radius: 15px;
    }
    .aide:hover{
        border-bottom: #8d8e91 1.5px solid;
        border-radius: 5px;
    }
    .contacter-nous{
        position: absolute;
        top: 3%;
        right: 265px;
        height: 30px;
        width:140px;
        font-size: 16px;
        border: none;
        background: #FFF;
        border-radius: 15px;
        font-family: 'Bahnschrift';

        cursor: pointer;
    }
    .contacter-nous:hover{
        border-bottom: #8d8e91 1.5px solid;
        border-radius: 5px;
    }
    .home{
        position: absolute;
        top: 3%;
        right: 170px;
        height: 30px;
        width:70px;
        font-size: 16px;
        border: none;
        background: #FFF;
        border-radius: 15px;
        font-family: 'Bahnschrift';

        cursor: pointer;
    }
    .home:hover{
        border-bottom: #8d8e91 1.5px solid;
        border-radius: 5px;
    }
    .fa-user-plus{
    position: absolute;
    top: 2.5%;
    right: 50px;
    height: 33px;
    font-size: 25px;
    width:80px;
    background: #FFF;
    cursor: pointer;
    border: none;
    color: #000000; 
    }
    .home{
    position: absolute; 
    right:170px;
    top: 3%;
    width:80px;
    height: 30px;
    text-align: center;
    font-size: 16px;
    border: none;
    background: #FFF;
    font-family: 'Bahnschrift';
    cursor: pointer;
    border-radius: 15px;
    }
    .home:hover{
        border-bottom: #8d8e91 1.5px solid;
        border-radius: 5px;
    }
    .section1{
        width:635px;
        position:absolute;
        right:20px;
        top:50%;
        height:80px;
    }
    .ig1{
        position: absolute;
        top:5%;
        right:500px;
        width:80px;
        height:80px;
        border-radius:50px;
    }
    .s1{
        font-family: 'Bahnschrift';
        font-size:20px;
        position: absolute;
        top:40%;
        right:360px;
    }
    .ig2{
        position: absolute;
        top:5%;
        right:220px;
        width:80px;
        height:80px;
        border-radius:50px;
    }
    .s2{
        font-family: 'Bahnschrift';
        font-size:19px;
        position: absolute;
        top:40.5%;
        right:60px;
    }

</style>
<body>
    <header class="tete">
        <img src="photos/shopeline.png" alt="es" class="logo">
        <a href="Page_Principale.php"><button class="home">Home</button></a>
         <a href="infos1.php#sec1"><button class="contacter-nous">Contacter-Nous</button></a>
         <a href="infos1.php#sec5"><button class="aide">Aide</button></a>
         <a href="connexion.php"><i class="fas fa-user-plus"></i></a>
        
    </header>
    
    <img src="photos/banner.png" class="im">
    <span class="title">#Qui sommes-nous?</span>
    <span class="title1">Shopeline</span>
    <img src="photos/a6.jpg" class="im1">
    <section class="section1">
        <img src="photos/respo1.jpg" class="ig1">
        <span class="s1">Anass Erekysy</span>
        <img src="photos/respo2.jpeg" class="ig2">
        <span class="s2">EL-Mehdi Bahou</span>
    </section>
    <section class="section2">
        <h3>  Qui sommes-nous?</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Et mollitia tempore laboriosam illo libero, delectus accusamus natus 
            illum a quasi. Atque eaque excepturi aliquam. Magnam quam minima adipisci vero error.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Et mollitia tempore laboriosam illo libero, delectus accusamus natus 
            illum a quasi. Atque eaque excepturi aliquam. Magnam quam minima adipisci vero error.
        </p>
    </section>
</body>
</html>