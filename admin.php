<?php 
    include 'procedure_connexion.php';
    session_start();
    if(!isset($_SESSION['email1']) && !isset( $_SESSION['password1'])){
        header("location:connexion_employe.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="UTF-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="admin.js"  charset="UTF-8"></script>
    <title>Administrateur</title>
</head>
<body> 
    <img src="photos/shopeline.png" alt="administrateur" class="administrateur">
    <button id="dcx"><a href="deconnexion1.php">Deconnexion <i class="fas fa-sign-out-alt"></i></a></button>
    <header class="tete">
        <?php
                $idemp=htmlspecialchars($_SESSION['id1']);
                $requete = $bd->prepare('SELECT IMAGE_EMP FROM EMPLOYEES WHERE ID_EMPLOYE=?');
                $requete->execute(array($idemp)); 
                $nb=$requete->rowcount(); 
                $ligne=$requete->fetch();
                $var='NULL';
                if(strcmp($ligne['IMAGE_EMP'],$var)!==0){
                    ?>
                        <button id="profile"><img src="<?php echo$ligne['IMAGE_EMP']?>" alt=""></button>
                    <?php
                }else {
                    ?>
                    <button id="profile1">
                        <?php
                            $nom=$_SESSION['nom1'];
                            $prenom=$_SESSION['prenom1'];
                            $nom1=str_split($nom);
                            $prenom1=str_split($prenom);
                            echo strtoupper($prenom1[0].''.$nom1[0]);   
                        ?>
                    </button>
                    <?php
                }   
        ?>
    </header>
    <div class="side-bar">
        <div class="menu">
            <div class="item">
                <button class="sub-btn"onclick="togglePopup_e()" id="employe-btn">
                    <i class="fas fa-user-tie icon1"></i>
                    <i class="t1">Employés</i>
                    <i class="fas fa-angle-down dropdown"></i>
               </button>
            </div>
            <div class="item">
                <button class="sub-btn" onclick="togglePopup_d()">
                    <i class="fas fa-house-user icon2"></i>
                    <i class="t2">Departements</i>
                    <i class="fas fa-angle-down dropdown"></i>
                </button>
            </div>
            <div class="item">
                <button class="sub-btn"  onclick="togglePopup_f()">
                    <i class="fas fa-truck icon3"></i>
                    <i class="t3">Fournisseur</i>
                    <i class="fas fa-angle-down dropdown"></i>
                </button>
            </div>
            <div class="item">
                <button class="sub-btn"  onclick="togglePopup_p()">
                    <i class="fas fa-circle icon4"></i>
                    <i class="t4">Produit</i>
                    <i class="fas fa-angle-down dropdown"></i>
                </button>
            </div>
            <div class="item">
                <button class="sub-btn"   onclick="togglePopup_c()">
                    <i class="fas fa-users icon6"></i>
                    <i class="t6">Client</i>
                    <i class="fas fa-angle-down dropdown"></i>
                </button>
            </div>
            <div class="item">
                <button class="sub-btn"   onclick="togglePopup_co()">
                    <i class="fas fa-shopping-cart icon7"></i>
                    <i class="t7">Commandes</i>
                    <i class="fas fa-angle-down dropdown"></i>
                </button>
            </div>
            <div class="item">
                <button class="sub-btn"   onclick="togglePopup_pro()">
                    <i class="fa-solid fa-badge-percent"></i>
                    <i class="t7">Promotions</i>
                    <i class="fas fa-angle-down dropdown"></i>
                </button>
            </div>
        </div>
    </div>
    <img src="photos/shopeline.png" alt="" id="image">
    <div class="centre">
        <div id="employee">
            <div class="popup" id="popup-e">
            <div class="content">
                <div class="close-btn" onclick="togglePopup_e()">&times;</div>
                <div class="boutton">
                    <button class="ajouter-btn" onclick="togglePopup1_e()"> Ajouter <i class="fas fa-plus"></i></button>
                    <button class="modifier-btn" onclick="togglePopup2_e()">Modifier <i class="fas fa-pencil-alt"></i></button>
                    <button class="chercher-btn"  onclick="togglePopup3_e()">Chercher <i class="fas fa-loupe"></i></button>
                    <button class="supprimer-btn" onclick="togglePopup4_e()">Supprimer <i class="fas fa-trash"></i></button>  
                </div>
                <div class="sous-popup" id="popup-1e" >
                        <div class="sous-content1">
                            <br>
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <input type="text" placeholder="  nom de l'employé" required="required" autofocus="autofocus" name="nom-emp-1" id="nom-emp-1">
                                    <input type="text" placeholder="  prénom de l'employé" required="required" id="prenom-emp-1" name="prenom-emp-1"><br>
                                    <input type="text" placeholder="  Id du departement" required="required" id="dept-emp-1" name="dept-emp-1" >
                                    <input type="date" id="date-emp-1" name="date-emp-1"><br>
                                    <input type="text" placeholder="  adresse de l'employé" required="required" id="adresse-emp-1" name="adresse-emp-1">
                                    <input type="email" placeholder="  email de l'employé" required="required" id="email-emp-1" name="email-emp-1"><br>
                                    <input type="text" placeholder="  téléphone de l'employé" required="required" id="tel-emp-1" name="tel-emp-1">
                                    <input type="number" placeholder="  salaire de l'employé" required="required" id="sal-emp-1" name="sal-emp-1">
                                    <label for="img" class="libchoice1">Image de l'employé(e): </label><input type="file" name="img[]" class="choiceinpt1" multiple="multiple">
                                    <input type="submit" value="Ajouter"  id="ajouter-1" name="ajouter-1" >
                                    <input type="reset" value="Annuler">
                                    <?php?>
                                    <?php
                                        try{
                                            if(isset($_POST['ajouter-1']) && $_POST['ajouter-1']=='Ajouter'){
                                                if(isset($_POST['dept-emp-1'])&&isset($_POST['nom-emp-1'])&&isset($_POST['prenom-emp-1'])&&isset($_POST['date-emp-1'])&&isset($_POST['adresse-emp-1'])&&isset($_POST['email-emp-1'])&&isset($_POST['tel-emp-1'])&&isset($_POST['sal-emp-1'])){
                                                    if(!empty($_POST['dept-emp-1'])&&!empty($_POST['nom-emp-1'])&&!empty($_POST['prenom-emp-1'])&&!empty($_POST['date-emp-1'])&&!empty($_POST['adresse-emp-1'])&&!empty($_POST['email-emp-1'])&&!empty($_POST['tel-emp-1'])&&!empty($_POST['sal-emp-1'])){
                                                        $dept=htmlspecialchars(intval($_POST['dept-emp-1']));
                                                        $nom=htmlspecialchars($_POST['nom-emp-1']);
                                                        $prenom=htmlspecialchars($_POST['prenom-emp-1']);
                                                        $dat=htmlspecialchars($_POST['date-emp-1']);
                                                        $adresse=htmlspecialchars($_POST['adresse-emp-1']);
                                                        $email=htmlspecialchars($_POST['email-emp-1']);
                                                        $tel=htmlspecialchars($_POST['tel-emp-1']);
                                                        $sal=htmlspecialchars($_POST['sal-emp-1']);
                                                        $filename=array();
                                                        foreach($_FILES['img']['tmp_name'] as $key=>$value){
                                                            array_push($filename,$_FILES['img']['name'][$key]);
                                                        }
                                                        $im1='photos/employés/'.array_pop($filename);
                                                        $requete=$bd->prepare('SELECT * FROM DEPARTEMENTS WHERE ID_DEPT=?');
                                                        $requete->execute(array($dept));
                                                        $nbligne=$requete->rowcount();
                                                        if($nbligne!=0)
                                                            $requete=$bd->prepare('SELECT * FROM EMPLOYEES WHERE NOM_EMP=? AND PRENOM_EMP=? AND EMAIL_EMP=? AND TELEPHONE_EMP=? ');
                                                            $requete->execute(array($nom,$prenom,$email,$tel));
                                                            $nbligne=$requete->rowcount();
                                                            if($nbligne==0){
                                                                $requete=$bd->prepare('INSERT INTO EMPLOYEES(ID_DEPT,NOM_EMP,PRENOM_EMP,DATE_EMBAUCHE,ADRESSE_EMP,EMAIL_EMP,IMAGE_EMP,TELEPHONE_EMP,SALAIRE) VALUES(?,?,?,?,?,?,?,?,?)');
                                                                $requete->execute(array($dept,$nom,$prenom,$dat,$adresse,$email,$im1,$tel,$sal));
                                                                $nbligne=$requete->rowcount();
                                                                if($nbligne!=0){
                                                                    $requete=$bd->prepare('SELECT NB_EMPLOYE FROM DEPARTEMENTS WHERE ID_DEPT=?');
                                                                    $requete->execute(array($dept));
                                                                    $nbligne=$requete->fetch();
                                                                    $nb=$nbligne['NB_EMPLOYE'];
                                                                    $nbe=(int)$nb+1;
                                                                    $requete=$bd->prepare('UPDATE DEPARTEMENTS SET NB_EMPLOYE=? WHERE ID_DEPT=?');
                                                                    $requete->execute(array($nbe,$dept));
                                                                    echo'<span class="succ">Ajout avec suucés</span>';
                                                                }
                                                                else{
                                                                    echo'<span class="err">Erreur</span>';
                                                                }
                                                            }
                                                            else{
                                                                echo'<span class="err">Cet employé existe déjà</span>';
                                                            }
                                                        }else{
                                                                echo'<span class="err">Erreur!! Vérifier l id du departement</span>';
                                                        } 
                                                    }    
                                                }    
                                            
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                    ?>
                                </form>
                        </div>
                </div>  
                <div class="sous-popup" id="popup-2e">
                        <div class="sous-content2">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="text" placeholder="  Id de l'employé" required="required" autofocus="autofocus" name="id-emp-2" id="id-emp-2">
                                    <input type="text" placeholder="  nom de l'employé" required="required" autofocus="autofocus" name="nom-emp-2" id="nom-emp-2"><br>
                                    <input type="text" placeholder="  prénom de l'employé" required="required" id="prenom-emp-2" name="prenom-emp-2">
                                    <input type="text" placeholder="  Id du departement" required="required" id="dept-emp-2" name="dept-emp-2" ><br>
                                    <input type="date" id="date-emp-2" name="date-emp-2">
                                    <input type="text" placeholder="  adresse de l'employé" required="required" id="adresse-emp-2" name="adresse-emp-2"><br>
                                    <input type="email" placeholder="  email de l'employé" required="required" id="email-emp-2" name="email-emp-2">
                                    <input type="text" placeholder="  téléphone de l'employé" required="required" id="tel-emp-2" name="tel-emp-2"><br>
                                    <input type="number" placeholder="  salaire de l'employé" required="required" id="sal-emp-2" name="sal-emp-2" class="solo">
                                    <label for="img" class="libchoice2">Image de l'employé(e): </label><input type="file" name="img[]" class="choiceinpt2" multiple="multiple">
                                    <input type="submit" value="Modifier"   id="modifier-1" name="modifier-1" >
                                    <input type="reset" value="Annuler">
                                    <?php 
                                         try{
                                            if(isset($_POST['modifier-1']) && $_POST['modifier-1']=='Modifier'){
                                                if(isset($_POST['id-emp-2'])&&isset($_POST['dept-emp-2'])&&isset($_POST['nom-emp-2'])&&isset($_POST['prenom-emp-2'])&&isset($_POST['date-emp-2'])&&isset($_POST['adresse-emp-2'])&&isset($_POST['email-emp-2'])&&isset($_POST['tel-emp-2'])&&isset($_POST['sal-emp-2'])){
                                                    if(!empty($_POST['id-emp-2'])&&!empty($_POST['dept-emp-2'])&&!empty($_POST['nom-emp-2'])&&!empty($_POST['prenom-emp-2'])&&!empty($_POST['date-emp-2'])&&!empty($_POST['adresse-emp-2'])&&!empty($_POST['email-emp-2'])&&!empty($_POST['tel-emp-2'])&&!empty($_POST['sal-emp-2'])){
                                                        $idempl=htmlspecialchars(intval($_POST['id-emp-2']));
                                                        $dept=htmlspecialchars(intval($_POST['dept-emp-2']));
                                                        $nom=htmlspecialchars($_POST['nom-emp-2']);
                                                        $prenom=htmlspecialchars($_POST['prenom-emp-2']);
                                                        $dat=htmlspecialchars($_POST['date-emp-2']);
                                                        $adresse=htmlspecialchars($_POST['adresse-emp-2']);
                                                        $email=htmlspecialchars($_POST['email-emp-2']);
                                                        $tel=htmlspecialchars($_POST['tel-emp-2']);
                                                        $sal=htmlspecialchars($_POST['sal-emp-2']);
                                                        $filename=array();
                                                        foreach($_FILES['img']['tmp_name'] as $key=>$value){
                                                            array_push($filename,$_FILES['img']['name'][$key]);
                                                        }
                                                        $im1='photos/employés/'.array_pop($filename);
                                                        if(filter_var($idempl,FILTER_VALIDATE_INT)){
                                                            $teste=$bd->prepare('SELECT * FROM  EMPLOYEES  WHERE ID_EMPLOYE='.$idempl);
                                                            $teste->execute();
                                                            $nbligne=$teste->rowcount();
                                                            if($nbligne!=0){
                                                                $requete=$bd->prepare('UPDATE  EMPLOYEES SET ID_DEPT=?,NOM_EMP=?,PRENOM_EMP=?,DATE_EMBAUCHE=?,ADRESSE_EMP=?,EMAIL_EMP=?,TELEPHONE_EMP=?,SALAIRE=?,IMAGE_EMP=? WHERE ID_EMPLOYE= '.$idempl);
                                                                $requete->execute(array($dept,$nom,$prenom,$dat,$adresse,$email,$tel,$sal,$im1));
                                                                echo'<span class="succ">Modification avec succés</span>';
                                                            }else{
                                                                echo'<span class="err">Cet employé n existe pas</span>';
                                                            }
                                                        }else{
                                                            echo'<span class="err">Cet id est non valide</span>';
                                                        }
                                                    }    
                                                }    
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                    ?>
                                </form>
                        </div>
                </div>  
                <div class="sous-popup" id="popup-3e">
                        <div class="sous-content3">
                            <form action="#" method="post" enctype="multipart/form-data" id="chercher-form" name="chercher-form">
                                <input type="text" placeholder="  Id de l'employé" required="required" autofocus="autofocus" name="id-emp-3" id="id-emp-3">
                                <input type="submit" value="Chercher"   id="chercher-1" name="chercher-1">
                                <input type="reset" value="Annuler">
                                <?php  
                                    try{
                                        if(isset($_POST['chercher-1']) && $_POST['chercher-1']=='Chercher'){
                                            if(isset($_POST['id-emp-3'])){
                                                if(!empty($_POST['id-emp-3'])){
                                                    $idempl=htmlspecialchars(intval($_POST['id-emp-3']));
                                                    if(filter_var($idempl,FILTER_VALIDATE_INT)){
                                                        $teste=$bd->prepare('SELECT * FROM  EMPLOYEES  WHERE ID_EMPLOYE='.$idempl);
                                                        $teste->execute();
                                                        $nbligne=$teste->rowcount();
                                                        if($nbligne!=0){
                                                            $requete=$bd->prepare('SELECT * FROM  EMPLOYEES  WHERE ID_EMPLOYE='.$idempl);
                                                            $requete->execute();
                                                            $tab = $requete->fetch(); 
                                                            ?>    
                                                                        <input type="text" value="<?php echo $tab['NOM_EMP'];?>" placeholder="  nom de l'employé" required="required" autofocus="autofocus" ><br>
                                                                        <input type="text" value="<?php echo $tab['PRENOM_EMP'];?>" placeholder="  prénom de l'employé" required="required" >
                                                                        <input type="text" value="<?php echo intval($tab['ID_DEPT']);?>" placeholder="  Id du departement" required="required" ><br>
                                                                        <input type="date" value="<?php echo $tab['DATE_EMBAUCHE']?>">
                                                                        <input type="text" value="<?php echo $tab['ADRESSE_EMP'];?>" placeholder="  adresse de l'employé" required="required"><br>
                                                                        <input type="email" value="<?php echo $tab['EMAIL_EMP'];?>" placeholder="  email de l'employé" required="required">
                                                                        <input type="text" value="<?php echo $tab['TELEPHONE_EMP'];?>" placeholder="  téléphone de l'employé" required="required"><br>
                                                                        <input type="number" value="<?php echo intval($tab['SALAIRE']);?>" placeholder="  salaire de l'employé" required="required"class="solo">                  
                                                        <?php
                                                        }else{
                                                            echo'<span class="err">Cet employé n existe pas</span>';
                                                        }
                                                    }else{
                                                        echo'<span class="err">Cet id est non valide</span>';
                                                    }
                                                }
                                            }    
                                        }
                                    }catch(Exception $ex){
                                        echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                    }                                   
                                ?>
                            </form>
                        </div>
                </div> 
                <div class="sous-popup" id="popup-4e">
                        <div class="sous-content4">
                            <form action="" method="post" enctype="multipart/form-data">
                                    <input type="text" placeholder="  Id de l'employé" required="required" autofocus="autofocus" name="id-emp-4" id="id-emp-4">
                                    <input type="text" placeholder="  Id du departement"  required="required" id="dept-emp-4" name="dept-emp-4" ><br>
                                    <input type="text" placeholder="  nom de l'employé"  autofocus="autofocus" name="nom-emp-4" id="nom-emp-4">
                                    <input type="text" placeholder="  prénom de l'employé"  id="prenom-emp-4" name="prenom-emp-4">
                                    <input type="submit" value="Supprimer"   id="supprimer-1" name="supprimer-1">
                                    <input type="reset" value="Annuler">
                                    <?php
                                        try{
                                            if(isset($_POST['supprimer-1']) && $_POST['supprimer-1']=='Supprimer'){
                                                if(isset($_POST['id-emp-4'])){
                                                    if(!empty($_POST['id-emp-4'])){
                                                        $idempl=htmlspecialchars(intval($_POST['id-emp-4']));
                                                        if(filter_var($idempl,FILTER_VALIDATE_INT)){
                                                            $teste=$bd->prepare('SELECT * FROM  EMPLOYEES  WHERE ID_EMPLOYE='.$idempl);
                                                            $teste->execute();
                                                            $nbligne=$teste->rowcount();
                                                            if($nbligne!=0){
                                                                $ligne=$teste->fetch();
                                                                $teste1=$bd->prepare('SELECT * FROM  DEPARTEMENTS WHERE ID_DEPT='.$ligne['ID_DEPT']);
                                                                $teste1->execute();
                                                                $ligne1=$teste1->fetch();
                                                                $nb=(int)$ligne1['NB_EMPLOYE'];
                                                                $nbe=$nb-1;
                                                                $requete=$bd->prepare('DELETE FROM  EMPLOYEES  WHERE ID_EMPLOYE='.$idempl);
                                                                $requete->execute();
                                                                $requete1=$bd->prepare('UPDATE DEPARTEMENTS SET NB_EMPLOYE=? WHERE ID_DEPT=?');
                                                                $requete1->execute(array($nbe,$ligne['ID_DEPT']));
                                                                $tst=$requete->rowcount();
                                                                $tst1=$requete1->rowcount();
                                                                    if($tst!=0 && $tst1!=0){
                                                                        echo'<span class="succ">Suppression avec succés</span>';
                                                                    }else{
                                                                        echo'<span class="err">Erreur</span>';
                                                                    }
                                                            }else{
                                                                echo'<span class="err">Cet employé n existe pas</span>';
                                                            }    
                                                        }else{
                                                            echo'<span class="err">Cet id est non valide</span>';
                                                        }
                                                    }    
                                                }    
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }                                  
                                    ?>
                            </form>
                        </div>
                </div> 
                <button class="emp" id="emp-btn">
                    <i class="fas fa-user-tie "></i> Employés
                    <?php 
                    $table='EMPLOYEES';
                          $count = countAdmin($table);
                          echo "<span  class=\"count\">$count</span>";        
                    ?>       
                </button>   
            </div>
            </div>
        </div>
        <div id="dpartements">
            <div class="popup" id="popup-d">
            <div class="overlay"></div>
            <div class="content">
                <div class="close-btn" onclick="togglePopup_d()">&times;</div>
                <div class="boutton">
                    <button class="ajouter-btn" onclick="togglePopup1_d()"> Ajouter <i class="fas fa-plus"></i></button>
                    <button class="modifier-btn" onclick="togglePopup2_d()">Modifier <i class="fas fa-pencil-alt"></i></button>
                    <button class="chercher-btn"  onclick="togglePopup3_d()">Chercher <i class="fas fa-loupe"></i></button>
                    <button class="supprimer-btn" onclick="togglePopup4_d()">Supprimer <i class="fas fa-trash"></i></button>  
                </div>
                    <div class="sous-popup" id="popup-1d">
                        <div class="overlay"></div>
                        <div class="sous-content1">
                            <br>
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <br>
                                    <input type="text" placeholder="  nom du departement" required="required" autofocus="autofocus" id="nom-dept1" name="nom-dept1"><br>
                                    <input type="text" placeholder="  Id du chef de departement" required="required" id="id-chef1" name="id-chef1"><br>
                                    <input type="number" placeholder="  nombre d'employés" required="required" id="nb-emp1" name="nb-emp1"><br>
                                    <input type="submit" value="Ajouter" id="ajouter-2" name="ajouter-2">
                                    <input type="reset" value="Annuler">
                                    <?php?>
                                    <?php
                                        try{
                                            if(isset($_POST['ajouter-2']) && $_POST['ajouter-2']=='Ajouter'){
                                                if(isset($_POST['nom-dept1'])&&isset($_POST['id-chef1'])&&isset($_POST['nb-emp1'])){
                                                    if(!empty($_POST['nom-dept1'])&&!empty($_POST['id-chef1'])&&!empty($_POST['nb-emp1'])){
                                                        $chef=htmlspecialchars(intval($_POST['id-chef1']));
                                                        $dept=htmlspecialchars($_POST['nom-dept1']);
                                                        $nb=htmlspecialchars($_POST['nb-emp1']);
                                                        $requete=$bd->prepare('SELECT * FROM DEPARTEMENTS WHERE NOM_DEPT=?');
                                                        $requete->execute(array($dept));
                                                        $nbligne=$requete->rowcount();
                                                        $requete1=$bd->prepare('SELECT * FROM EMPLOYEES WHERE ID_EMPLOYE=?');
                                                        $requete1->execute(array($chef));
                                                        $nbligne1=$requete1->rowcount();
                                                        if($nbligne==0 && $nbligne1!=0){
                                                            $requete=$bd->prepare('INSERT INTO DEPARTEMENTS(NOM_DEPT,ID_CHEF_DEPT,NB_EMPLOYE) VALUES(?,?,?)');
                                                            $requete->execute(array($dept,$chef,$nb));
                                                            $nbligne=$requete->rowcount();
                                                            if($nbligne!=0){
                                                                echo'<span class="succ">Ajout avec succés</span>';
                                                            }else{
                                                                echo'<span class="err">Erreur</span>';
                                                            }
                                                        }
                                                    }    
                                                }    
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                    ?>
                                </form>
                        </div>
                    </div>    
                    <div class="sous-popup" id="popup-2d">
                        <div class="sous-content2">
                            <br>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="text" placeholder="  Id du departement" required="required" autofocus="autofocus" id="id-dept2" name="id-dept2"><br>
                                    <input type="text" placeholder="  nom du departement" required="required" id="nom-dept2" name="nom-dept2"><br>
                                    <input type="text" placeholder="  Id du chef de departement" required="required" id="id-chef2" name="id-chef2"><br>
                                    <input type="number" placeholder="  nombre d'employés" required="required"  id="nb-emp2" name="nb-emp2"><br>
                                    <input type="submit" value="Modifier" id="modifier-2" name="modifier-2">
                                    <input type="reset" value="Annuler">
                                    <?php
                                        try{
                                            if(isset($_POST['modifier-2']) && $_POST['modifier-2']=='Modifier'){
                                                if(isset($_POST['id-dept2'])&&isset($_POST['nom-dept2'])&&isset($_POST['id-chef2'])&&isset($_POST['nb-emp2'])){
                                                    if(!empty($_POST['id-dept2'])&&!empty($_POST['nom-dept2'])&&!empty($_POST['id-chef2'])&&!empty($_POST['nb-emp2'])){
                                                        $dept_id=htmlspecialchars(intval($_POST['id-dept2']));
                                                        $chef=htmlspecialchars(intval($_POST['id-chef2']));
                                                        $dept=htmlspecialchars($_POST['nom-dept2']);
                                                        $nb=htmlspecialchars($_POST['nb-emp2']);
                                                        if(filter_var($dept_id,FILTER_VALIDATE_INT)){
                                                            $teste=$bd->prepare('SELECT * FROM  DEPARTEMENTS  WHERE ID_DEPT='.$dept_id);
                                                            $teste->execute();
                                                            $nbligne=$teste->rowcount();
                                                            $teste1=$bd->prepare('SELECT * FROM  EMPLOYEES  WHERE ID_EMPLOYE='.$chef);
                                                            $teste1->execute();
                                                            $nbligne1=$teste1->rowcount();
                                                            if($nbligne!=0 && $nbligne1!=0){
                                                                $requete=$bd->prepare('UPDATE  DEPARTEMENTS SET NOM_DEPT=?,ID_CHEF_DEPT=?,NB_EMPLOYE=? WHERE ID_DEPT='.$dept_id);
                                                                $requete->execute(array($dept,$chef,$nb));
                                                                echo'<span class="succ">Modification avec succés</span>';
                                                            }else{
                                                                echo'<span class="err">Cette departement ou son chef n existe pas</span>';
                                                            }
                                                        }else{
                                                            echo'<span class="err">Cet id est non valide</span>';
                                                        }
                                                    }    
                                                }    
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                    ?>
                                </form>
                        </div>
                    </div>  
                    <div class="sous-popup" id="popup-3d">
                        <div class="sous-content3">
                            <br>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="text" placeholder="  Id du departement" required="required" autofocus="autofocus"  id="id-dept3" name="id-dept3"><br>
                                    <input type="submit" value="Chercher"  id="chercher-2" name="chercher-2">
                                    <input type="reset" value="Annuler">
                                    <?php
                                         try{
                                            if(isset($_POST['chercher-2']) && $_POST['chercher-2']=='Chercher'){
                                                if(isset($_POST['id-dept3'])){
                                                    if(!empty($_POST['id-dept3'])){
                                                        $dept=htmlspecialchars(intval($_POST['id-dept3']));
                                                        if(filter_var($dept,FILTER_VALIDATE_INT)){
                                                            $requete=$bd->prepare('SELECT * FROM  DEPARTEMENTS  WHERE ID_DEPT='.$dept);
                                                            $requete->execute();
                                                            $tab = $requete->fetch();
                                                            $ligne=$requete->rowcount();
                                                            if($ligne!=0){
                                                                ?>
                                                                    <input type="text" value="<?php echo $tab['NOM_DEPT'];?>" placeholder="  nom du departement"  id="nom-dept3" name="nom-dept3"><br>
                                                                    <input type="text" value="<?php echo $tab['ID_CHEF_DEPT'];?>"  placeholder="  Id du chef de departement" id="id-chef3" name="id-chef3"><br>
                                                                    <input type="number" value="<?php echo $tab['NB_EMPLOYE'];?>" placeholder="  nombre d'employés"   id="nb-emp3" name="nb-emp3"><br>
                                                                <?php
                                                            }else{
                                                                echo'<span class="err">Cette departement n existe pas</span>';
                                                            }
                                                        }else{
                                                            echo'<span class="err">Cet id est non valide</span>';
                                                        }
                                                    }    
                                                }    
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                    ?>
                                </form>
                        </div>
                    </div> 
                    <div class="sous-popup" id="popup-4d">
                        <div class="sous-content4">
                            <br>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="text" placeholder="  Id du departement" required="required" autofocus="autofocus" id="id-dept4" name="id-dept4"><br>
                                    <input type="text" placeholder="  nom du departement"  id="nom-dept4" name="nom-dept4"><br>
                                    <input type="submit" value="Supprimer" id="supprimer_2" name="supprimer_2">
                                    <input type="reset" value="Annuler">
                                    <?php
                                         try{
                                            if(isset($_POST['supprimer_2']) && $_POST['supprimer_2']=='Supprimer'){
                                                if(isset($_POST['id-dept4'])){
                                                    if(!empty($_POST['id-dept4'])){
                                                        $dept=htmlspecialchars($_POST['id-dept4']);
                                                        if(filter_var($dept,FILTER_VALIDATE_INT)){
                                                            $teste=$bd->prepare('SELECT * FROM  DEPARTEMENTS  WHERE ID_DEPT='.$dept);
                                                            $teste->execute();
                                                            $nbligne=$teste->rowcount();
                                                            if($nbligne!=0){
                                                                $requete=$bd->prepare('DELETE FROM  DEPARTEMENTS  WHERE ID_DEPT='.$dept);
                                                                $requete->execute();
                                                                $tst=$requete->rowcount();
                                                                    if($tst!=0){
                                                                        echo'<span class="succ">Suppression avec succés</span>';
                                                                    }else{
                                                                        echo'<span class="err">Erreur</span>';
                                                                    }
                                                            }else{
                                                                echo'<span class="err">Cette departement n existe pas</span>';
                                                            }
                                                        }else{
                                                            echo'<span class="err">Cet id est non valide</span>';
                                                        }
                                                    }    
                                                }    
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                    ?>
                                </form>
                        </div>
                    </div> 
                    <button class="dept">
                        <i class="fas fa-house-user "></i> Departements 
                        <?php 
                        $table='DEPARTEMENTS';
                            $count = countAdmin($table);
                            echo "<span  class=\"count\">$count</span>";        
                        ?> 
                    </button>
            </div>
            </div>
        </div>
        <div id="fournisseur">
            <div class="popup" id="popup-f">
                <div class="overlay"></div>
                <div class="content">
                    <div class="close-btn" onclick="togglePopup_f()">&times;</div>
                    <div class="boutton">
                        <button class="ajouter-btn" onclick="togglePopup1_f()"> Ajouter <i class="fas fa-plus"></i></button>
                        <button class="modifier-btn" onclick="togglePopup2_f()">Modifier <i class="fas fa-pencil-alt"></i></button>
                        <button class="chercher-btn"  onclick="togglePopup3_f()">Chercher <i class="fas fa-loupe"></i></button>
                        <button class="supprimer-btn" onclick="togglePopup4_f()">Supprimer <i class="fas fa-trash"></i></button>  
                    </div>
                        <div class="sous-popup" id="popup-1f">
                            <div class="overlay"></div>
                            <div class="sous-content1">
                                <br>
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  nom du fournisseur" required="required" autofocus="autofocus" id="nom-fr1" name="nom-fr1">
                                        <input type="text" placeholder="  adresse du fournisseur" required="required" id="adresse-fr1" name="adresse-fr1"><br>
                                        <input type="email" placeholder="  email du fournisseur" required="required" id="email-fr1" name="email-fr1">
                                        <input type="text" placeholder="  téléphone du fournisseur" required="required" id="tel-fr1" name="tel-fr1"><br>
                                        <input type="text" placeholder="  Domaine du fournisseur" required="required"  id="cat-fr1" name="cat-fr1" class="solo">
                                        <input type="submit" value="Ajouter" id="ajouter-fr" name="ajouter-fr">
                                        <input type="reset" value="Annuler">
                                        <?php
                                            
                                                if(isset($_POST['ajouter-fr'])){
                                                        if(isset($_POST['nom-fr1'])&&isset($_POST['adresse-fr1'])&&isset($_POST['email-fr1'])&&isset($_POST['tel-fr1'])&&isset($_POST['cat-fr1'])){
                                                            if(!empty($_POST['nom-fr1'])&&!empty($_POST['adresse-fr1'])&&!empty($_POST['email-fr1'])&&!empty($_POST['tel-fr1'])&&!empty($_POST['cat-fr1'])){
                                                                $nom=htmlspecialchars($_POST['nom-fr1']);
                                                                $adresse=htmlspecialchars($_POST['adresse-fr1']);
                                                                $email=htmlspecialchars($_POST['email-fr1']);
                                                                $tel=htmlspecialchars(intval($_POST['tel-fr1']));
                                                                $cat=htmlspecialchars($_POST['cat-fr1']);
                                                                $requete=$bd->prepare('SELECT * FROM FOURNISSEUR WHERE NOM_FR=? AND EMAIL_FR=? AND TELEPHONE_FR=?');
                                                                $requete->execute(array($nom,$email,$tel));
                                                                $nbligne=$requete->rowcount();
                                                                if($nbligne==0){
                                                                    $requete=$bd->prepare('INSERT INTO FOURNISSEUR(NOM_FR,ADRESSE_FR,EMAIL_FR,TELEPHONE_FR,TYPE_FR) VALUES(?,?,?,?,?)');
                                                                    $requete->execute(array($nom,$adresse,$email,$tel,$cat));
                                                                    $nbligne=$requete->rowcount();
                                                                    if($nbligne!=0){
                                                                        echo'<span class="succ">Ajout avec succés</span>';
                                                                    }else{
                                                                        echo'<span class="err">Erreur</span>';
                                                                    }
                                                                }    
                                                            }    
                                                        }   
                                                }
                                        ?>
                                    </form>
                            </div>
                        </div>    
                        <div class="sous-popup" id="popup-2f">
                            <div class="sous-content2">
                                <br>
                                    <form  method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  Id du fournisseur" required="required" autofocus="autofocus"  id="id-fr2" name="id-fr2">
                                        <input type="text" placeholder="  nom du fournisseur" required="required"  id="nom-fr2" name="nom-fr2"><br>
                                        <input type="text" placeholder="  adresse du fournisseur" required="required" id="adresse-fr2" name="adresse-fr2">
                                        <input type="email" placeholder="  email du fournisseur" required="required" id="email-fr2" name="email-fr2"><br>
                                        <input type="tel" placeholder="  téléphone du fournisseur" required="required" id="tel-fr2" name="tel-fr2">
                                        <input type="text" placeholder="  Domaine du fournisseur" required="required" id="cat-fr2" name="cat-fr2">
                                        <input type="submit" value="Modifier" id="modifier-3" name="modifier-3">
                                        <input type="reset" value="Annuler">
                                        <?php
                                             try{
                                                if(isset($_POST['modifier-3']) && $_POST['modifier-3']=='Modifier'){
                                                    if(isset($_POST['id-fr2'])&&isset($_POST['nom-fr2'])&&isset($_POST['adresse-fr2'])&&isset($_POST['email-fr2'])&&isset($_POST['tel-fr2'])&&isset($_POST['cat-fr2'])){
                                                        if(!empty($_POST['id-fr2'])&&!empty($_POST['nom-fr2'])&&!empty($_POST['adresse-fr2'])&&!empty($_POST['email-fr2'])&&!empty($_POST['tel-fr2'])&&!empty($_POST['cat-fr2'])){
                                                            $idfr=htmlspecialchars(intval($_POST['id-fr2']));
                                                            $nom=htmlspecialchars($_POST['nom-fr2']);
                                                            $adresse=htmlspecialchars($_POST['adresse-fr2']);
                                                            $email=htmlspecialchars($_POST['email-fr2']);
                                                            $tel=htmlspecialchars(intval($_POST['tel-fr2']));
                                                            $cat=htmlspecialchars($_POST['cat-fr2']);
                                                            if(filter_var($idfr,FILTER_VALIDATE_INT)){
                                                                $teste=$bd->prepare('SELECT * FROM  FOURNISSEUR  WHERE ID_FR='.$idfr);
                                                                $teste->execute();
                                                                $nbligne=$teste->rowcount();
                                                                if($nbligne!=0){
                                                                    $requete=$bd->prepare('UPDATE FOURNISSEUR SET NOM_FR=?,ADRESSE_FR=?,EMAIL_FR=?,TELEPHONE_FR=?,TYPE_FR=? WHERE ID_FR='.$idfr);
                                                                    $requete->execute(array($nom,$adresse,$email,$tel,$cat));
                                                                    echo'<span class="succ">Modification avec succés</span>';
                                                                }else{
                                                                    echo'<span class="err">Ce fournisseur n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="succ">Cet id est non valide</span>';
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div> 
                        <div class="sous-popup" id="popup-3f">
                            <div class="sous-content3">
                                <br>
                                    <form  method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  Id du fournisseur" required="required" autofocus="autofocus"  id="id-fr3" name="id-fr3">
                                        <input type="submit" value="Chercher" id="chercher-3" name="chercher-3">
                                        <input type="reset" value="Annuler">
                                        <?php
                                             try{
                                                if(isset($_POST['chercher-3']) && $_POST['chercher-3']=='Chercher'){
                                                    if(isset($_POST['id-fr3'])){
                                                        if(!empty($_POST['id-fr3'])){
                                                            $idfr=htmlspecialchars(intval($_POST['id-fr3']));
                                                            if(filter_var($idfr,FILTER_VALIDATE_INT)){
                                                                $requete=$bd->prepare('SELECT * FROM  FOURNISSEUR  WHERE ID_FR='.$idfr);
                                                                $requete->execute();
                                                                $ligne=$requete->rowcount();
                                                                if($ligne!=0){
                                                                    $tab = $requete->fetch(); 
                                                                    ?>    
                                                                    <input type="text" value="<?php echo $tab['NOM_FR'];?>" placeholder="  nom du fournisseur" required="required"  id="nom-fr2" nom="nom-fr2"><br>
                                                                    <input type="text" value="<?php echo $tab['ADRESSE_FR'];?>" placeholder="  adresse du fournisseur" required="required" id="adresse-fr2" nom="adresse-fr2">
                                                                    <input type="email" value="<?php echo $tab['EMAIL_FR'];?>" placeholder="  email du fournisseur" required="required" id="email-fr2" nom="email-fr2"><br>
                                                                    <input type="tel" value="<?php echo $tab['TELEPHONE_FR'];?>" placeholder="  téléphone du fournisseur" required="required" id="tel-fr2" nom="tel-fr2">
                                                                    <input type="text" value="<?php echo $tab['TYPE_FR'];?>" placeholder="  catègorie du fournisseur" required="required"  id="cat-fr2" nom="cat-fr2"><br>
                                                                    <?php 
                                                                }else{
                                                                    echo'<span class="err">Ce fournisseur n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }                
                                        ?>
                                    </form>
                            </div>
                        </div> 
                        <div class="sous-popup" id="popup-4f">
                            <div class="sous-content4">
                                <br>
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  Id du fournisseur" required="required" autofocus="autofocus" id="id-fr4" name="id-fr4">
                                        <input type="text" placeholder="  nom du fournisseur"  id="nom-fr4" name="nom-fr4"><br>
                                        <input type="submit" value="Supprimer" id="supprimer-3" name="supprimer-3">
                                        <input type="reset" value="Annuler">
                                        <?php
                                            try{
                                                if(isset($_POST['supprimer-3']) && $_POST['supprimer-3']=='Supprimer'){
                                                    if(isset($_POST['id-fr4'])){
                                                        if(!empty($_POST['id-fr4'])){
                                                            $idfr=htmlspecialchars(intval($_POST['id-fr4']));
                                                            if(filter_var($idfr,FILTER_VALIDATE_INT)){
                                                                $teste=$bd->prepare('SELECT * FROM  FOURNISSEUR  WHERE ID_FR='.$idfr);
                                                                $teste->execute();
                                                                $nbligne=$teste->rowcount();
                                                                if($nbligne!=0){
                                                                    $requete=$bd->prepare('DELETE FROM FOURNISSEUR  WHERE ID_FR='.$idfr);
                                                                    $requete->execute();
                                                                    $tst=$requete->rowcount();
                                                                    if($tst!=0){
                                                                        echo'<span class="succ">Suppression avec succés</span>';
                                                                    }else{
                                                                        echo'<span class="err">Erreur</span>';
                                                                    }
                                                                }else{
                                                                    echo'<span class="err">Ce fournisseur n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div> 
                    <button class="four">
                        <i class="fas fa-truck icon3"></i> Fournisseur
                         <?php 
                        $table='FOURNISSEUR';
                            $count = countAdmin($table);
                            echo "<span  class=\"count\">$count</span>";        
                        ?> 
                    </button>
                </div>
                </div>    
        </div>
        <div id="produit">
            <div class="popup" id="popup-p">
                <div class="overlay"></div>
                <div class="content">
                    <div class="close-btn" onclick="togglePopup_p()">&times;</div>
                    <div class="boutton">
                        <button class="ajouter-btn" onclick="togglePopup1_p()"> Ajouter <i class="fas fa-plus"></i></button>
                        <button class="modifier-btn" onclick="togglePopup2_p()">Modifier <i class="fas fa-pencil-alt"></i></button>
                        <button class="chercher-btn"  onclick="togglePopup3_p()">Chercher <i class="fas fa-loupe"></i></button>
                        <button class="supprimer-btn" onclick="togglePopup4_p()">Supprimer <i class="fas fa-trash"></i></button>  
                    </div>
                        <div class="sous-popup" id="popup-1p">
                            <div class="overlay"></div>
                            <div class="sous-content1">
                                <br>
                                    <form action="#" method="post" enctype="multipart/form-data" >
                                        <div class="fr1">
                                            <input list="categories" type="text" placeholder="  Catégorie du produit" required="required"  autofocus="autofocus" id="id-emp1" name="id-emp1" >
                                            <datalist id="categories" aria-autocomplete="list">
                                                <option value="PHONE">PHONE</option>
                                                <option value="PC">PC</option>
                                                <option value="ACCESSOIRE">ACCESSOIRE</option>
                                                <option value="APPAREIL">APPAREIL</option>
                                                <option value="TV">TV</option>
                                            </datalist>
                                            <input type="text" placeholder="  Marque du produit" required="required"  autofocus="autofocus" id="marque1" name="marque1" ><br>
                                            <input type="text" placeholder="  nom du produit" required="required" id="libelle1" name="libelle1">
                                            <input type="number" placeholder="  prix d'achat" required="required" id="pa1" name="pa1"><br>
                                            <input type="number" placeholder="  prix de vente" required="required" id="pv1" name="pv1">
                                            <input type="text"placeholder="  description du produit " id="desc" name="desc"><br>
                                            <label for="img" class="libchoice">Images du produit: </label><input type="file" name="img[]" class="choiceinpt" multiple="multiple">
                                        </div>
                                        <input type="submit" value="Ajouter" id="ajouter-4" name="ajouter-4" >
                                        <input type="reset" value="Annuler">
                                        <?php
                                            try{
                                                if(isset($_POST['ajouter-4']) && $_POST['ajouter-4']=='Ajouter'){
                                                    if(isset($_POST['id-emp1'])&&isset($_POST['marque1'])&&isset($_POST['libelle1'])&&isset($_POST['pa1'])&&isset($_POST['pv1'])){
                                                        if(!empty($_POST['id-emp1'])&&!empty($_POST['marque1'])&&!empty($_POST['libelle1'])&&!empty($_POST['pa1'])&&!empty($_POST['pv1'])){
                                                            $idemp=htmlspecialchars($_POST['id-emp1']);
                                                            $marque=htmlspecialchars($_POST['marque1']);
                                                            $nom=htmlspecialchars($_POST['libelle1']);
                                                            $pa=htmlspecialchars(intval($_POST['pa1']));
                                                            $pv=htmlspecialchars(intval($_POST['pv1']));
                                                            $filename=array();
                                                            foreach($_FILES['img']['tmp_name'] as $key=>$value){
                                                                array_push($filename,$_FILES['img']['name'][$key]);
                                                            }
                                                            $cat=strtolower($_POST['id-emp1']);
                                                            $im1='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            $im2='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            $im3='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            $im4='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            $desc=htmlspecialchars($_POST['desc']);
                                                            $dat=date("Y-m-d H:i:s", strtotime('+1 hour') ); 
                                                            $requete=$bd->prepare('SELECT * FROM PRODUIT WHERE CATEGORIE=? AND MARQUE=? AND LIBELLE=? AND DESCRIPTION_P=? AND PRIX_ACHAT=? AND PRIX_VENTE=?');
                                                            $requete->execute(array($idemp,$marque,$nom,$desc,$pa,$pv));
                                                            $nbligne=$requete->rowcount();
                                                            if($nbligne==0){
                                                                $requete=$bd->prepare('INSERT INTO PRODUIT(CATEGORIE,MARQUE,LIBELLE,IMAGE,IMAGE1,IMAGE2,IMAGE3,DESCRIPTION_P,PRIX_ACHAT,PRIX_VENTE,DATE_ENTREE) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
                                                                $requete->execute(array($idemp,$marque,$nom,$im1,$im2,$im3,$im4,$desc,$pa,$pv,$dat));
                                                                $nbligne=$requete->rowcount();
                                                                if($nbligne!=0){
                                                                    echo'<span class="succ">Ajout avec succés</span>';
                                                                }else{
                                                                    echo'<span class="err">Erreur</span>';
                                                                }
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div>    
                        <div class="sous-popup" id="popup-2p">
                            <div class="sous-content2">
                                <br>
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  Id du produit" required="required" autofocus="autofocus" id="id-prd2" name="id-prd2" >
                                        <input type="text" placeholder="  nom du produit" required="required" id="libelle2" name="libelle2" ><br>
                                        <input type="number" placeholder="  prix d'achat" required="required" id="pa2" name="pa2" >
                                        <input type="number" placeholder="  prix de vente" required="required" id="pv2" name="pv2"><br>
                                        <input type="text"placeholder="  description du produit " id="desc" name="desc" class="solo">
                                        <label for="img" class="libchoice4">Images du produit: </label><input type="file" name="img[]" class="choiceinpt4" multiple="multiple"><br>
                                        <input type="submit" value="Modifier"  id="modifier-4" name="modifier-4">
                                        <input type="reset" value="Annuler">
                                        <?php
                                            try{
                                                if(isset($_POST['modifier-4']) && $_POST['modifier-4']=='Modifier'){
                                                    if(isset($_POST['id-prd2'])&&isset($_POST['libelle2'])&&isset($_POST['pa2'])&&isset($_POST['pv2'])&&isset($_POST['desc'])){
                                                        if(!empty($_POST['id-prd2'])&&!empty($_POST['libelle2'])&&!empty($_POST['pa2'])&&!empty($_POST['pv2'])&&!empty($_POST['desc'])){
                                                            $idprd=htmlspecialchars(intval($_POST['id-prd2']));
                                                            $nom=htmlspecialchars($_POST['libelle2']);
                                                            $pa=htmlspecialchars(intval($_POST['pa2']));
                                                            $pv=htmlspecialchars(intval($_POST['pv2']));
                                                            $desc=htmlspecialchars($_POST['desc']);
                                                            $filename=array();
                                                            foreach($_FILES['img']['tmp_name'] as $key=>$value){
                                                                array_push($filename,$_FILES['img']['name'][$key]);
                                                            }
                                                            $cat=strtolower($_POST['id-emp1']);
                                                            $im1='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            $im2='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            $im3='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            $im4='photos/Produits/'.$cat.'/'.array_pop($filename);
                                                            if(filter_var($idprd,FILTER_VALIDATE_INT)){
                                                                $teste=$bd->prepare('SELECT * FROM  PRODUIT  WHERE ID_PRODUIT='.$idprd);
                                                                $teste->execute();
                                                                $nbligne=$teste->rowcount();
                                                                if($nbligne!=0){
                                                                    $requete=$bd->prepare('UPDATE  PRODUIT SET LIBELLE=?,PRIX_ACHAT=?,PRIX_VENTE=?,DESCRIPTION_P=?,IMAGE=?,IMAGE1=?,IMAGE2=?,IMAGE3=? WHERE ID_PRODUIT= '.$idprd);
                                                                    $requete->execute(array($nom,$pa,$pv,$desc,$im1,$im2,$im3,$im4));
                                                                    echo'<span class="succ">Modification avec succés</span>';
                                                                }else{
                                                                    echo'<span class="err">Ce produit n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div>  
                        <div class="sous-popup" id="popup-3p">
                            <div class="sous-content3">
                                <br>
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  Id du produit" required="required" autofocus="autofocus" id="id-prd3" name="id-prd3" >
                                        <input type="submit" value="Chercher"  id="chercher-4" name="chercher-4">
                                        <input type="reset" value="Annuler">
                                        <?php
                                            try{
                                                if(isset($_POST['chercher-4']) && $_POST['chercher-4']=='Chercher'){
                                                    if(isset($_POST['id-prd3'])){
                                                        if(!empty($_POST['id-prd3'])){
                                                            $idprd=htmlspecialchars(intval($_POST['id-prd3']));
                                                            if(filter_var($idprd,FILTER_VALIDATE_INT)){
                                                                $requete=$bd->prepare('SELECT * FROM  PRODUIT  WHERE ID_PRODUIT='.$idprd);
                                                                $requete->execute();
                                                                $tab = $requete->fetch();
                                                                $ligne=$requete->rowcount();
                                                                if($ligne!=0){
                                                                    $requete=$bd->prepare('SELECT * FROM  PRODUIT  WHERE ID_PRODUIT='.$idprd);
                                                                    $requete->execute();
                                                                    ?>
                                                                    <input type="text" value="<?php echo $tab['CATEGORIE'];?>" placeholder="  Id de l'employé" required="required" autofocus="autofocus" name="id-emp-3" id="id-emp-3"><br>
                                                                    <input type="text" value="<?php echo $tab['MARQUE'];?>" placeholder="  Id de l'employé" required="required" autofocus="autofocus" name="id-emp-3" id="id-emp-3">
                                                                    <input type="text" value="<?php echo $tab['LIBELLE'];?>"  placeholder="  nom du produit" required="required" id="libelle1" name="libelle1"><br>
                                                                    <input type="number" value="<?php echo $tab['PRIX_ACHAT'];?>"  placeholder="  prix d'achat" required="required" id="pa1" name="pa1">
                                                                    <input type="number" value="<?php echo $tab['PRIX_VENTE'];?>"  placeholder="  prix de vente" required="required" id="pv1" name="pv1"><br>
                                                                    <input type="text" value="<?php echo $tab['DESCRIPTION_P'];?>"placeholder="  description du produit " id="desc" name="desc" class="solo">
                                                                    <?php
                                                                }else{
                                                                    echo'<span class="err">Ce produit n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }   
                                                        }    
                                                    } 
                                                }          
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div> 
                        <div class="sous-popup" id="popup-4p">
                            <div class="sous-content4">
                                <br>
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  Id du produit" required="required" autofocus="autofocus" id="id-prd4" name="id-prd4" >
                                        <input type="text" placeholder="  nom du produit"  id="libelle4" name="libelle4">
                                        <input type="submit" value="Supprimer"  id="supprimer-4" name="supprimer-4">
                                        <input type="reset" value="Annuler">
                                        <?php 
                                            try{
                                                if(isset($_POST['supprimer-4']) && $_POST['supprimer-4']=='Supprimer'){
                                                    if(isset($_POST['id-prd4'])){
                                                        if(!empty($_POST['id-prd4'])){
                                                            $idprd=htmlspecialchars(intval($_POST['id-prd4']));
                                                            if(filter_var($idprd,FILTER_VALIDATE_INT)){
                                                                $teste=$bd->prepare('SELECT * FROM  PRODUIT  WHERE ID_PRODUIT='.$idprd);
                                                                $teste->execute();
                                                                $nbligne=$teste->rowcount();
                                                                if($nbligne!=0){
                                                                    $requete=$bd->prepare('DELETE FROM  PRODUIT  WHERE ID_PRODUIT='.$idprd);
                                                                    $requete->execute();
                                                                    $tst=$requete->rowcount();
                                                                    if($tst!=0){
                                                                        echo'<span class="succ">Suppression avec succés</span>';
                                                                    }else{
                                                                        echo'<span class="err">Erreur</span>';
                                                                    }
                                                                }else{
                                                                    echo'<span class="err">Ce produit n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div> 
                    <button class="prd"><i class="fas fa-circle "></i> Produits
                        <?php 
                            $table='PRODUIT';
                                $count = countAdmin($table);
                                echo "<span  class=\"count\">$count</span>";        
                        ?>
                    </button>
                </div>
                </div>    
        </div>
        <div id="client">
            <div class="popup" id="popup-c">
                <div class="overlay"></div>
                <div class="content">
                    <div class="close-btn" onclick="togglePopup_c()">&times;</div>
                    <div class="boutton">
                        <button class="modifier-btn1" onclick="togglePopup2_c()">Modifier <i class="fas fa-pencil-alt"></i></button>
                        <button class="chercher-btn1"  onclick="togglePopup3_c()">Chercher <i class="fas fa-loupe"></i></button>
                        <button class="supprimer-btn1" onclick="togglePopup4_c()">Supprimer <i class="fas fa-trash"></i></button>  
                    </div> 
                        <div class="sous-popup" id="popup-2c">
                            <div class="sous-content2">
                                <br>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  ID client" required="required" autofocus="autofocus" id="id-clt2" name="id-clt2">
                                        <input type="text" placeholder="  nom du client" required="required" id="nom-clt2" name="nom-clt2"><br>
                                        <input type="text" placeholder="  prénom du client" required="required" id="prenom-clt2" name="prenom-clt2">
                                        <input type="text" placeholder="  adresse du client" required="required" id="adresse-clt2" name="adresse-clt2"><br>
                                        <input type="email" placeholder="  email du client" required="required" id="email-clt2" name="email-clt2">
                                        <input type="tel" placeholder="  téléphone du client" required="required" id="tel-clt2" name="tel-clt2"><br>
                                        <input type="text" placeholder="  mot de passe du client" required="required" id="mdp-clt2" name="mdp-clt2">
                                        <input type="number" placeholder="  nombre des points du client" required="required" id="nb-clt2" name="nb-clt2"><br>
                                        <input type="submit" value="Modifier"  id="modifier-5" name="modifier-5">
                                        <input type="reset" value="Annuler">
                                        <?php
                                            try{
                                                if(isset($_POST['modifier-5']) && $_POST['modifier-5']=='Modifier'){
                                                    if(isset($_POST['id-clt2'])&&isset($_POST['nom-clt2'])&&isset($_POST['prenom-clt2'])&&isset($_POST['adresse-clt2'])&&isset($_POST['email-clt2'])&&isset($_POST['tel-clt2'])&&isset($_POST['mdp-clt2'])&&isset($_POST['nb-clt2'])){
                                                        if(!empty($_POST['id-clt2'])&&!empty($_POST['nom-clt2'])&&!empty($_POST['prenom-clt2'])&&!empty($_POST['adresse-clt2'])&&!empty($_POST['email-clt2'])&&!empty($_POST['tel-clt2'])&&!empty($_POST['mdp-clt2'])&&!empty($_POST['nb-clt2'])){
                                                            $idclt=htmlspecialchars(intval($_POST['id-clt2']));
                                                            $nom=htmlspecialchars($_POST['nom-clt2']);
                                                            $prenom=htmlspecialchars($_POST['prenom-clt2']);
                                                            $adresse=htmlspecialchars($_POST['adresse-clt2']);
                                                            $email=htmlspecialchars($_POST['email-clt2']);
                                                            $tel=htmlspecialchars($_POST['tel-clt2']);
                                                            $mdp=htmlspecialchars($_POST['mdp-clt2']);
                                                            $pt=htmlspecialchars(intval($_POST['nb-clt2']));
                                                            if(filter_var($idclt,FILTER_VALIDATE_INT)){
                                                                $teste=$bd->prepare('SELECT * FROM  CLIENT  WHERE ID_CLT='.$idclt);
                                                                $teste->execute();
                                                                $nbligne=$teste->rowcount();
                                                                if($nbligne!=0){
                                                                    $requete=$bd->prepare('UPDATE  CLIENT SET NOM_CLT=?,PRENOM_CLT=?,ADRESSE_CLT=?,TELEPHONE_CLT=?,EMAIL_CLT=?,MDP_COMPTE=?,NB_POINTS=? WHERE ID_CLT='.$idclt);
                                                                    $requete->execute(array($nom,$prenom,$adresse,$tel,$email,$mdp,$pt));
                                                                    echo'<span class="succ">Modification avec succés</span>';
                                                                }else{
                                                                    echo'<span class="err">Ce client n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }
                                                        }
                                                    }    
                                                }    
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div>      
                        <div class="sous-popup" id="popup-3c">
                            <div class="sous-content3">
                                <br>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  ID client" required="required" autofocus="autofocus"  id="id-clt3" name="id-clt3">
                                        <input type="submit" value="Chercher" id="chercher-5" name="chercher-5">
                                        <input type="reset" value="Annuler">
                                        <?php
                                            try{
                                                if(isset($_POST['chercher-5']) && $_POST['chercher-5']=='Chercher'){
                                                    if(isset($_POST['id-clt3'])){
                                                        if(!empty($_POST['id-clt3'])){
                                                            $idclt=htmlspecialchars(intval($_POST['id-clt3']));
                                                            if(filter_var($idclt,FILTER_VALIDATE_INT)){
                                                                $requete=$bd->prepare('SELECT * FROM  CLIENT  WHERE ID_CLT='.$idclt);
                                                                $requete->execute();
                                                                $ligne=$requete->rowcount();
                                                                if($ligne!=0){
                                                                    $requete=$bd->prepare('SELECT * FROM  CLIENT  WHERE ID_CLT='.$idclt);
                                                                    $requete->execute();
                                                                    $tab = $requete->fetch();
                                                                    ?>
                                                                    <input type="text" value="<?php echo $tab['NOM_CLT'];?>" placeholder="  nom du client" id="nom-clt3" name="nom-clt3"><br>
                                                                    <input type="text" value="<?php echo $tab['PRENOM_CLT'];?>" placeholder="  prénom du client" id="prenom-clt3" name="prenom-clt3">
                                                                    <input type="text" value="<?php echo $tab['ADRESSE_CLT'];?>" placeholder="  adresse du client" id="adresse-clt3" name="adresse-clt3"><br>
                                                                    <input type="email" value="<?php echo $tab['EMAIL_CLT'];?>" placeholder="  email du client" id="email-clt3" name="email-clt3">
                                                                    <input type="tel" value="<?php echo $tab['TELEPHONE_CLT'];?>" placeholder="  téléphone du client" id="tel-clt3" name="tel-clt3"><br>
                                                                    <input type="text" value="<?php echo $tab['MDP_COMPTE'];?>" placeholder="  mot de passe du client" id="mdp-clt3" name="mdp-clt3">
                                                                    <input type="number" value="<?php echo $tab['NB_POINTS'];?>" placeholder="  nombre des points du client" id="nb-clt3" name="nb-clt3"><br>
                                                                    <?php
                                                                }else{
                                                                    echo'<span class="err">Ce client n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div> 
                        <div class="sous-popup" id="popup-4c">
                            <div class="sous-content4">
                                <br>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="text" placeholder="  ID client" required="required" autofocus="autofocus" id="id-clt4" name="id-clt4">
                                        <input type="text" placeholder="  nom du client" ><br>
                                        <input type="text" placeholder="  prénom du client" class="solo" >
                                        <input type="submit" value="Supprimer"  id="supprimer-5" name="supprimer-5">
                                        <input type="reset" value="Annuler">
                                        <?php
                                            try{
                                                if(isset($_POST['supprimer-5']) && $_POST['supprimer-5']=='Supprimer'){
                                                    if(isset($_POST['id-clt4'])){
                                                        if(!empty($_POST['id-clt4'])){
                                                            $idclt=htmlspecialchars(intval($_POST['id-clt4']));
                                                            if(filter_var($idclt,FILTER_VALIDATE_INT)){
                                                                $teste=$bd->prepare('SELECT * FROM  CLIENT  WHERE ID_CLT='.$idclt);
                                                                $teste->execute();
                                                                $nbligne=$teste->rowcount();
                                                                if($nbligne!=0){
                                                                    $requete=$bd->prepare('DELETE FROM  CLIENT  WHERE ID_CLT='.$idclt);
                                                                    $requete->execute();
                                                                    $tst=$requete->rowcount();
                                                                        if($tst!=0){
                                                                            echo'<span class="succ">Suppression avec succés</span>';
                                                                        }else{
                                                                            echo'<span class="err">Erreur</span>';
                                                                        }
                                                                }else{
                                                                    echo'<span class="err">Ce client n existe pas</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">Cet id est non valide</span>';
                                                            }
                                                        }    
                                                    }    
                                                }
                                            }catch(Exception $ex){
                                                echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                            }
                                        ?>
                                    </form>
                            </div>
                        </div> 
                    <button class="clt"><i class="fas fa-users "></i> Clients
                        <?php 
                            $table='CLIENT';
                                $count = countAdmin($table);
                                echo "<span  class=\"count\">$count</span>";        
                        ?>
                    </button>
                </div>
            </div>
        </div>
        <div id="commande"> 
            <div class="popup" id="popup-co">
                <div class="overlay"></div>
                <div class="content">
                    <div class="close-btn" onclick="togglePopup_co()">&times;</div>
                    <div class="boutton">
                        <button class="chercher-btn2" onclick="togglePopup1_com()">Modifier <i class="fas fa-pencil-alt"></i></button>
                    </div>
                    <div class="sous-popup" id="popup-1co">
                        <div class="sous-content1">
                            <form action="#" method="POST">
                                <input type="text" name="idcmd" id="idcmd" placeholder=" Numéro de la commande" required="required">
                                <input type="text" name="stt" id="stt" placeholder=" STATUT" required="required"><br>
                                <input type="submit" value="Modifier" name="mod" id="mod" >
                                <input type="reset" value="Annuler" name="ann" id="ann">
                            </form>
                                <?php
                                        try{
                                            if(isset($_POST['mod']) && $_POST['mod']=='Modifier'){
                                                if(isset($_POST['idcmd'])&&isset($_POST['stt'])){
                                                    if(!empty($_POST['idcmd'])&&!empty($_POST['stt'])){
                                                        $idcmd=htmlspecialchars(intval($_POST['idcmd']));
                                                        $stt=htmlspecialchars($_POST['stt']);
                                                        $requete=$bd->prepare('UPDATE COMMANDER SET STATUT=? WHERE ID_CMD=?');
                                                        $requete->execute(array($stt,$idcmd));
                                                        $nbligne=$requete->rowcount();
                                                        if($nbligne!=0){
                                                            echo'<span class="succ">Modification avec succés</span>';
                                                        }else{
                                                            echo'<span class="err">Erreur</span>';
                                                        }
                                                    }
                                                }
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                ?>
                        </div>
                        
                    </div>
                    <button class="cmd"><i class="fas fa-shopping-cart "></i> Commandes
                        <?php 
                            $table='COMMANDER';
                                $count = countAdmin($table);
                                echo "<span  class=\"count\">$count</span>";        
                        ?>
                    </button>
                </div>    
            </div>
        </div>
        <div id="promotion"> 
            <div class="popup" id="popup-pro">
                <div class="overlay"></div>
                <div class="content">
                    <div class="close-btn" onclick="togglePopup_pro()">&times;</div>
                    <div class="boutton">
                        <button class="ajouter-btn" onclick="togglePopup1_pro()">Ajouter <i class="fas fa-pencil-alt"></i></button>
                        <button class="modifier-btn" onclick="togglePopup2_pro()">Modifier <i class="fas fa-pencil-alt"></i></button>
                        <button class="chercher-btn" onclick="togglePopup3_pro()">Supprimer <i class="fas fa-pencil-alt"></i></button>
                        <button class="supprimer-btn" onclick="togglePopup4_pro()">Réduction</button>
                    </div>
                    <div class="sous-popup" id="popup-1pro">
                        <div class="sous-content1">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="text" placeholder="Id de produit" name="idp">
                                <input type="text" placeholder="nouveau prix" name="pr"><br>
                                <input type="date" placeholder="Date début" name="dat1">
                                <input type="date" placeholder="Date fin" name="dat2">
                                <input type="submit" name="ajt" value="Ajouter">
                                <input type="reset" name="ann" value="Annuler">
                            
                                <?php
                                        try{
                                            if(isset($_POST['ajt']) && $_POST['ajt']=='Ajouter'){
                                                if(isset($_POST['idp'])&&isset($_POST['pr'])&&isset($_POST['dat1'])&&isset($_POST['dat2'])){
                                                    if(!empty($_POST['idp'])&&!empty($_POST['pr'])&&!empty($_POST['dat1'])&&!empty($_POST['dat2'])){
                                                        $idp=htmlspecialchars(intval($_POST['idp']));
                                                        $pr=htmlspecialchars(intval($_POST['pr']));
                                                        $dat1=htmlspecialchars($_POST['dat1']);
                                                        $dat2=htmlspecialchars($_POST['dat2']);
                                                        $requete=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT=?');
                                                        $requete->execute(array($idp));
                                                        $nbligne=$requete->rowcount();
                                                        if($nbligne==0){
                                                            if($dat2>$dat1){
                                                                $requete=$bd->prepare('INSERT INTO PROMOTIONS(ID_PRODUIT,PRIX,DATE_DEBUT,DATE_FIN) VALUES(?,?,?,?)');
                                                                $requete->execute(array($idp,$pr,$dat1,$dat2));
                                                                $nbligne=$requete->rowcount();
                                                                if($nbligne!=0){
                                                                    echo'<span class="succ">Ajouter avec succés</span>';
                                                                }else{
                                                                    echo'<span class="err">Erreur</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">La date de début doit etre inferieur de la date du fin!!</span>';
                                                            }
                                                        }
                                                        else{
                                                            $ligne=$requete->fetch();
                                                            if($dat2>$dat1 && $ligne['PRIX']>$pr){
                                                                $requete=$bd->prepare('UPDATE PROMOTIONS SET PRIX=? AND DATE_DEBUT=? AND DATE_FIN=? WHERE ID_PRODUIT=?');
                                                                $requete->execute(array($pr,$dat1,$dat2,$idp));
                                                                $nbligne=$requete->rowcount();
                                                                if($nbligne!=0){
                                                                    echo'<span class="succ">Modification avec succés</span>';
                                                                }else{
                                                                    echo'<span class="err">Erreur</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">La date de début doit etre inferieur de la date du fin aussi que le prix!!</span>';
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                ?>
                            </form>
                        </div>
                        
                    </div>
                    <div class="sous-popup" id="popup-2pro">
                        <div class="sous-content2">
                            <form  method="POST" enctype="multipart/form-data">
                                <input type="text" placeholder="Id de produit" name="idp">
                                <input type="text" placeholder="nouveau prix" name="pr"><br>
                                <input type="date" placeholder="Date début" name="dat1">
                                <input type="date" placeholder="Date fin" name="dat2">
                                <input type="submit" name="mod" value="Modifier">
                                <input type="reset" name="ann" value="Annuler">
                                <?php
                                        try{
                                            if(isset($_POST['mod']) && $_POST['mod']=='Modifier'){
                                                if(isset($_POST['idp'])&&isset($_POST['pr'])&&isset($_POST['dat1'])&&isset($_POST['dat2'])){
                                                    if(!empty($_POST['idp'])&&!empty($_POST['pr'])&&!empty($_POST['dat1'])&&!empty($_POST['dat2'])){
                                                        $idp=htmlspecialchars(intval($_POST['idp']));
                                                        $pr=htmlspecialchars(intval($_POST['pr']));
                                                        $dat1=htmlspecialchars($_POST['dat1']);
                                                        $dat2=htmlspecialchars($_POST['dat2']);
                                                        $requete=$bd->prepare('SELECT NUM_PROMO FROM PROMOTIONS WHERE ID_PRODUIT=?');
                                                        $requete->execute(array($idp));
                                                        $nbligne=$requete->rowcount();
                                                        if($nbligne!=0){
                                                            $ligne=$requete->fetch();
                                                            if($dat2>$dat1 && $ligne['PRIX']>$pr){
                                                                $requete=$bd->prepare('UPDATE PROMOTIONS SET PRIX=? AND DATE_DEBUT=? AND DATE_FIN=? WHERE ID_PRODUIT=?');
                                                                $requete->execute(array($pr,$dat1,$dat2,$idp));
                                                                $nbligne=$requete->rowcount();
                                                                if($nbligne!=0){
                                                                    echo'<span class="err">Modification avec succés</span>';
                                                                }else{
                                                                    echo'<span class="err">Erreur</span>';
                                                                }
                                                            }else{
                                                                echo'<span class="err">La date de début doit etre inferieur de la date du fin aussi que le prix!!</span>';
                                                            }
                                                        }else{
                                                            echo'<span class="err">Cette promotion n existe pas</span>';
                                                        }
                                                    }
                                                }
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                ?>
                            </form>
                        </div>
                        
                    </div>
                    <div class="sous-popup" id="popup-3pro">
                        <div class="sous-content3">
                            <form action="#" method="POST">
                                <input type="text" placeholder="Id de produit" name="idp">
                                <input type="submit" name="ajt" value="Ajouter">
                                <input type="reset" name="ann" value="Annuler">
                            </form>
                                <?php
                                        try{
                                            if(isset($_POST['ajt']) && $_POST['ajt']=='Ajouter'){
                                                if(isset($_POST['idp'])){
                                                    if(!empty($_POST['idp'])){
                                                        $idcmd=htmlspecialchars(intval($_POST['idp']));
                                                        $requete=$bd->prepare('DELETE FROM PROMOTIONS WHERE ID_PRODUIT=?');
                                                        $requete->execute(array($idp));
                                                        $nbligne=$requete->rowcount();
                                                        if($nbligne!=0){
                                                            echo'<span class="succ">Suppression avec succés</span>';
                                                        }else{
                                                            echo'<span class="err">Erreur</span>';
                                                        }
                                                    }
                                                }
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                ?>
                        </div>
                        
                    </div>
                    <div class="sous-popup" id="popup-4pro">
                        <div class="sous-content4">
                            <form action="#" method="POST">
                                <input type="text" placeholder="Pourcentage de réduction" name="pr">
                                <input type="date" placeholder="Date début" name="dat1"><br>
                                <input type="date" placeholder="Date fin" name="dat2" class="solo">
                                <input type="submit" name="promo" value="Réduire">
                                <input type="reset" name="ann" value="Annuler">
                            </form>
                                <?php
                                        try{
                                            if(isset($_POST['promo']) && $_POST['promo']=='Réduire'){
                                                if(isset($_POST['pr'],$_POST['dat1'],$_POST['dat2'])){
                                                    if(!empty($_POST['pr'])&&!empty($_POST['dat1'])&&!empty($_POST['dat2'])){
                                                        $requete=$bd->prepare('SELECT * FROM PRODUIT');
                                                        $requete->execute();
                                                        $nbligne=$requete->rowcount(); 
                                                        $red=htmlspecialchars(intval($_POST['pr']));
                                                        $dat1=htmlspecialchars($_POST['dat1']);
                                                        $dat2=htmlspecialchars($_POST['dat2']);
                                                        $i=0;
                                                        if($nbligne!=0){
                                                            while($ligne=$requete->fetch()){
                                                                $requet=$bd->prepare('SELECT * FROM PROMOTIONS WHERE ID_PRODUIT='.$ligne['ID_PRODUIT']);
                                                                $requet->execute();
                                                                $nbligne=$requet->rowcount();
                                                                if($nbligne==0){ 
                                                                    $pr=$ligne['PRIX_VENTE']-(($ligne['PRIX_VENTE']/100)*$red);
                                                                    $requete1=$bd->prepare('INSERT INTO PROMOTIONS(ID_PRODUIT,PRIX,DATE_DEBUT,DATE_FIN) VALUES(?,?,?,?)');
                                                                    $requete1->execute(array($ligne['ID_PRODUIT'],$pr,$dat1,$dat2));
                                                                    $nbligne=$requete1->rowcount(); 
                                                                    if($nbligne!=0){
                                                                        $i++;
                                                                    }else{
                                                                        echo'<span class="err">Erreur</span>';
                                                                    } 
                                                                }else{
                                                                    $pr=$ligne['PRIX_VENTE']-(($ligne['PRIX_VENTE']/100)*$red);
                                                                    $requete1=$bd->prepare('UPDATE PROMOTIONS SET PRIX=? WHERE ID_PRODUIT=?');
                                                                    $requete1->execute(array($pr,$ligne['ID_PRODUIT']));
                                                                    $nbligne=$requete1->rowcount(); 
                                                                    if($nbligne!=0){
                                                                        $i++;
                                                                    }else{
                                                                        echo'<span class="err">Erreur</span>';
                                                                    }
                                                                }
                                                            } 
                                                            if($i==$requete->rowcount()){
                                                                echo'<span class="succ">La promotion est passée avec succés</span>';
                                                            }else{
                                                                echo'<span class="err">Erreur</span>';
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }catch(Exception $ex){
                                            echo'<span class="err">Erreur'.$ex->getMessage().'</span>';
                                        }
                                ?>
                        </div>
                        
                    </div>
                    <button class="cmd"><i class="fas fa-shopping-cart "></i>Promotions
                        <?php 
                            $table='PROMOTIONS';
                                $count = countAdmin($table);
                                echo "<span  class=\"count\">$count</span>";        
                        ?>
                    </button>
                </div>    
            </div>
        </div>
    </div>  
    <footer >
        <small>&copy; Copyright 2022 ESTM GI</small>
    </footer>
</body>
</html>
<?php } ?>