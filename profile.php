<?php 
    session_start();
    include 'procedure_connexion.php';
    if(!isset($_SESSION['email']) && !isset( $_SESSION['password'])){
        header("location:connexion.php");
    }else{
        // if(isset($_POST['sauv']) && $_POST['sauv']=='Modifier'){
            if(isset($_POST['nom']) && isset($_POST['prénom']) && isset($_POST['phone']) && isset($_POST['adresse']) && isset($_POST['email']) && isset($_POST['mdp']) &&isset($_POST['mdpc'])){
                if(!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['phone']) && !empty($_POST['adresse']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdpc'])){
                    $idclt=htmlspecialchars($_SESSION['id']);
                    $nom=htmlspecialchars($_POST['nom']);
                    $pr=htmlspecialchars($_POST['prénom']);
                    $phone=htmlspecialchars(intval($_POST['phone']));
                    $adresse=htmlspecialchars($_POST['adresse']);
                    $email=htmlspecialchars($_POST['email']);
                    $mdp=htmlspecialchars($_POST['mdp']);
                    $requete=$bd->prepare('UPDATE CLIENT SET  NOM_CLT=?, PRENOM_CLT=?, TELEPHONE_CLT=?, ADRESSE_CLT=?, EMAIL_CLT=?, MDP_COMPTE=? WHERE ID_CLT=?');
                    $requete->execute(array($nom,$pr,$phone,$adresse,$email,$mdp,$idclt));
                    $nbligne=$requete->rowcount();
                    if($nbligne!=0){
                        echo'<span class="succ">La modification est faite avec succés!</span>';
                    }
                }
            }
            if(isset($_POST['pdp']) ){
                if(!empty($_POST['pdp'])){
                    $idclt=htmlspecialchars($_SESSION['id']);
                    $pdp='photos/'.htmlspecialchars($_POST['pdp']);
                    $requete=$bd->prepare('UPDATE CLIENT SET IMAGE=? WHERE ID_CLT=?');
                    $requete->execute(array($pdp,$idclt));
                    $nbligne=$requete->rowcount();
                    
                }
            }
        // }
?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="profile.css">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
                <title>Document</title>
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
                <div id="container">
                    <form action="" method="POST" >
                            <?php
                                $idclt=htmlspecialchars($_SESSION['id']);
                                $requete=$bd->prepare('SELECT * FROM CLIENT WHERE ID_CLT=?');
                                $requete->execute(array($idclt));
                                $nbligne=$requete->rowcount();
                                if($nbligne!=0){
                                    $ligne=$requete->fetch();
                                }
                            ?>
                            <div id="image">
                                <?php
                                    if($ligne['IMAGE']!=NULL){
                                        ?>
                                        <img src="<?php echo $ligne['IMAGE']?>" alt="">
                                        <?php
                                    }else{
                                        ?>
                                        <img src="photos/inconnu.png" alt="">
                                        <?php
                                    }
                                ?>
                                <input type="file" name="pdp" id="file" accept="image/*">
                                <label id="file" for="file">Changer</label>
                                <span>
                                    <?php echo $ligne['PRENOM_CLT'].' '.$ligne['NOM_CLT']?>
                                </span>
                            </div>
                            <div id="infos" >
                                    <span>Informations</span>
                                    <hr>
                                    <div id="centre">
                                        <label id="nm"><i class="fas fa-user icon0"></i><b> Nom </b></label><br>
                                        <input type="text" value="<?php echo $ligne['NOM_CLT']?>" name="nom" id="nom" required="required" ><br>

                                        <label id="pr"><i class="fas fa-user icon1"></i> <b>Prénom </b></label><br>
                                        <input type="text" value="<?php echo $ligne['PRENOM_CLT']?>" name="prénom" id="prénom" required="required">

                                        <label id="ph"><i class="fa fa-phone icon2" style="font-size:15px"></i> <b>Téléphone </b></label><br>
                                        <input type="tel" value="<?php echo $ligne['TELEPHONE_CLT']?>" name="phone" id="phone" pattern="^*[0-9]{2}([_/-]?)[0-9]{2}\1[0-9]{2}\1[0-9]{2}\1[0-9]{2}*$" >

                                        <label id="addr"><i class="fas fa-address-card icon3"></i> <b>Adresse </b></label><br>
                                        <input type="text" value="<?php echo $ligne['ADRESSE_CLT']?>" name="adresse" id="adresse" required="required">
                                        
                                        <label id="em"><i class="fa fa-envelope icone4"></i> <b>Email </b></label><br>
                                        <input type="email" value="<?php echo $ligne['EMAIL_CLT']?>" name="email" id="email" required="required" >

                                        <label id="pss"> <i class="fa fa-lock icone5"></i> <b>Mot de passe</b></label><br>
                                        <input type="password" value="<?php echo $ligne['MDP_COMPTE']?>" name="mdp" id="mdp" required="required"  >

                                        <label id="pssc"> <i class="fa fa-lock icone5" ></i> <b>Confirmer le mot de passe</b></label><br>
                                        <input type="password" value="<?php echo $ligne['MDP_COMPTE']?>" name="mdpc" id="mdpc" required="required"  >

                                        <?php
                                            if($ligne['NB_POINTS']!=0){
                                                ?>
                                                <input type="text" name="pt" id="pt" value="<?php echo $ligne['NB_POINTS'].' points'?>" disabled="disabled">
                                                <?php
                                            }else{
                                                ?>
                                                <input type="text" name="pt" id="pt" value="0 point" disabled="disabled">
                                                <?php
                                            }
                                        ?>
                                        <input type="submit" nom='sauv' value='Modifier' id="sauv">
                                        
                                        <!-- <input type="button" nom='mod' value='Modifier' id="mod" onclick="fld=document.getElementById('frm'); fld.disabled=!fld.disabled;"> -->
                                    </div>
                            </div>
                    </form>
                </div>
            </body>
        </html>
<?php } ?>        