<?php
require_once "includes/functions.php";
session_start();

    
    ?>
<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <br/><br/><br/>
        <?php 
        
        // On recupere les variables du formulaire de modification de profil
            if (!empty($_POST['prenom']) and !empty($_POST['nom'])
        and !empty($_POST['telephone']) and !empty($_POST['choixtel'])
        and !empty($_POST['adresse']) and !empty($_POST['choixadresse'])
        and !empty($_POST['sexe']) and !empty($_POST['promotion'])
        and !empty($_POST['email']) and!empty($_POST['choixmail'])) 
        {

            // les variables issues de ce formulaire
                $nom = escape($_POST['nom']);
                $prenom = escape($_POST['prenom']);
                $telephone = escape($_POST['telephone']);
                $choixtel = escape($_POST['choixtel']);
                if ($choixtel=="Oui")
                {
                    $choixtelephone=1;
                }
                else
                {
                    $choixtelephone=0;
                }
                $adresse= escape($_POST['adresse']);
                $choixadresse = escape($_POST['choixadresse']);
                if ($choixadresse=="Oui")
                {
                    $choixadd=1;
                }
                else
                {
                    $choixadd=0;
                }
                
                $promo= escape($_POST['promotion']);
                $email = escape($_POST['email']);
                $choixemail= escape($_POST['choixmail']);
                if ($choixemail=="Oui")
                {
                    $choixmail=1;
                }
                else if ($choixemail=="Non")
                {
                    $choixmail=0;
                }
                $loginn=$_SESSION['login'];        
                
                // Connexion à la BDD
                try {
                    $bdd=new PDO("mysql:host=localhost;dbname=id16503676_annuaireyilmazsaracco;charset=utf8",
                    "id16503676_annuaireyilmazsaraccoo", "@lbE%!(fJ07Lk4?{",
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                    catch (Exception $e) {
                    die('Erreur fatale : ' . $e->getMessage());
                    }

                    // requete update pour mettre à jour les informations de l'eleve

                    $requete=$bdd->prepare('update Eleve set nom = ?,prenom = ?,promo = ?,adresse=?,adresse_visible = ?,telephone = ?,telephone_visible = ?,mail=?,mail_visible=? where login = ?');
                    $requete->execute(array($nom,$prenom,$promo,$adresse,$choixadd,$telephone,$choixtelephone,$email,$choixmail,$loginn));
         }
    

        
        ?>

        <?php redirect ("profil.php"); ?>
        <?php require_once "includes/footer.php"; ?>
    </div>
    <?php require_once "includes/scripts.php"; ?>
</body>

</html>
