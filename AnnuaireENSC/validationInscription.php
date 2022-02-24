<?php
require_once "includes/functions.php";
session_start();

    // On recupere les variables du formulaire d'inscription

    if (!empty($_POST['prenom']) and !empty($_POST['nom'])
    and !empty($_POST['telephone']) and !empty($_POST['choixtel'])
    and !empty($_POST['adresse']) and !empty($_POST['choixadresse'])
    and !empty($_POST['sexe']) and !empty($_POST['promotion'])
    and !empty($_POST['email']) and!empty($_POST['choixmail'])
    and !empty($_POST['login']) and !empty($_POST['mdp'])) {

        // Les variables issues du formulaire d'inscription

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
        $sex= escape($_POST['sexe']);
        if ($sex=="Masculin")
        {
            $sexe="m";
        }
        else
        {
            $sexe="f";
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
        $loginn= escape($_POST['login']);
        $mdp = escape($_POST['mdp']);
        $type="eleve";
        $validation=0; // car le compte ne sera pas directement validé


        // Connexion à la BDD
        try {
            $bdd=new PDO("mysql:host=localhost;dbname=id16503676_annuaireyilmazsaracco;charset=utf8",
            "id16503676_annuaireyilmazsaraccoo", "@lbE%!(fJ07Lk4?{",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e) {
            die('Erreur fatale : ' . $e->getMessage());
            }

            // requete insert pour ajouter les données liées à la table Utilisateur
            $requete = $bdd->prepare('insert into Utilisateur (login,mdp,type_compte) values(?,?,?) ');
            $requete->execute(array($loginn,$mdp,$type));

            // requete insert pour ajouter les données liées à la table Eleve
            $requete2=$bdd->prepare('insert into Eleve (nom,prenom,promo,adresse,adresse_visible,telephone,
          telephone_visible,sexe,mail,mail_visible,validation,login) values(?,?,?,?,?,?,?,?,?,?,?,?)');
          $requete2->execute(array($nom,$prenom,$promo,$adresse,$choixadd,$telephone,$choixtelephone,
            $sexe,$email,$choixmail,$validation,$loginn));


    }
    ?>
<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <?php require_once "includes/footer.php"; ?>
    </div>
    <p><h1 style="text-align: center;">Votre demande d'inscription a été faite,veuillez attendre la confirmation du gestionnaire.</h1></p>
    <?php require_once "includes/scripts.php"; ?>
</body>

</html>
