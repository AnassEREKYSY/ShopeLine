<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="compte.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <script src="compte.js"></script>
    <title>Créer un Compte </title>
</head>
<body>
    <div id="container">
        <form action="#" method="POST" enctype="multipart/form-data">
            <h1>Créer un compte</h1>
            <hr width="250px">
            <i class="fas fa-user icon0"></i>
            <label><b>Nom </b></label><br>
            <input type="text" placeholder="nom d'utilisateur" name="nom" id="nom" required="required" autofocus="autofocus" ><br>

            <i class="fas fa-user icon1"></i>
            <label id="pr"><b>Prénom </b></label>
            <input type="text" placeholder="prénom d'utilisateur" name="prénom" id="prénom" required="required">

            <i class="fa fa-phone" style="font-size:15px"></i>
            <label><b>Téléphone </b></label>
            <input type="tel" placeholder="Entrer le numéro de téléphone d'utilisateu" name="phone" id="phone" pattern="^*[0-9]{2}([_/-]?)[0-9]{2}\1[0-9]{2}\1[0-9]{2}\1[0-9]{2}*$" >

            <i class="fas fa-address-card"></i>
            <label><b>Adresse </b></label>
            <input type="text" placeholder="Entrer l'adresse d'utilisateur" name="adresse" id="adresse" required="required">
            
            <i class="fa fa-envelope" style="font-size:15px"></i>
            <label><b>Email </b></label>
            <input type="email" placeholder="Entrer l'email d'utilisateur" name="email" id="email" required="required" >

            <i class="fa fa-lock" style="font-size:17px"></i>
            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="mdp" id="mdp" required="required"  >

            <input type="submit" nom='créer' value='Créer' id="créer">
            <a href="connexion.php"></a><input type="reset" nom='annuler'  value='Annuler' >
        </form> 
    </div>

    <?php  
        session_start(); 
        include 'procedure_connexion.php'; 
        try{
            $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '');
            $bd->query("SET NAMES 'utf8'");
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if(isset($_POST['nom']) && isset($_POST['prénom']) && isset($_POST['phone']) && isset($_POST['adresse']) && isset($_POST['email']) && isset($_POST['mdp'])){
                    if(!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['phone']) && !empty($_POST['adresse']) && !empty($_POST['email']) && !empty($_POST['mdp'])){
                        $nom=htmlspecialchars($_POST['nom']);
                        $prenom=htmlspecialchars($_POST['prénom']);
                        $telephon=htmlspecialchars($_POST['phone']);
                        $adresse=htmlspecialchars($_POST['adresse']);
                        $email=htmlspecialchars($_POST['email']);
                        $mdp=htmlspecialchars($_POST['mdp']);
                        $requete=$bd->prepare('SELECT * FROM CLIENT WHERE NOM_CLT=? AND PRENOM_CLT=? OR EMAIL_CLT=?');
                        $requete->execute(array($nom,$prenom,$email));
                        $nb=$requete->rowcount();
                        if($nb==0){                         
                            $requete=$bd->prepare('INSERT INTO CLIENT(NOM_CLT,PRENOM_CLT,ADRESSE_CLT,TELEPHONE_CLT,EMAIL_CLT,MDP_COMPTE) VALUES(?,?,?,?,?,?)');
                            $requete->execute(array($nom,$prenom,$adresse,$telephon,$email,$mdp));
                            echo'<span class="succ">La création de votre compte s est faite par succés!</span>';
                            echo'<button class="conn"><a href="connexion.php">Connexion</a></button>';
                        }else{
                            echo'<span class="err">Ce compte existe déjà!</span>';
                            echo'<button class="conn"><a href="connexion.php">Connexion</a></button>';
                        }
                    }
                    else{
                        echo'<span class="err">Erreur!!Tous les champs sont obligatoires</span>';   
                    }
                }   
        }catch(Exception $e){
            echo'ERREUR : '.$e->getMessage();
        }            
?>
</body>
</html>