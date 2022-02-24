<?php
require_once "includes/functions.php";
session_start();

    if (!empty($_POST['prenom']) and !empty($_POST['nom'])
    and !empty($_POST['telephone']) and !empty($_POST['choixtel'])
    and !empty($_POST['adresse']) and !empty($_POST['choixadresse'])
    and !empty($_POST['sexe']) and !empty($_POST['promotion'])
    and !empty($_POST['email']) and!empty($_POST['choixmail'])
    and !empty($_POST['login']) and !empty($_POST['mdp'])) {

        /* On recupere tous les informations du formulaire d'inscription d'eleve par
         le gestionnaire */

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
        $validation=1; // le compte est deja validé car c'est le gestionnaire qui crée le compte
        
        // connexion à la bdd
            try {
            $bdd=new PDO("mysql:host=localhost;dbname=id16503676_annuaireyilmazsaracco;charset=utf8",
            "id16503676_annuaireyilmazsaraccoo", "@lbE%!(fJ07Lk4?{",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e) {
            die('Erreur fatale : ' . $e->getMessage());
            }

        // ligne de cote pour la requete insert
            $requete = $bdd->prepare('insert into Utilisateur (login,mdp,type_compte) values(?,?,?) ');
            $requete->execute(array($loginn,$mdp,$type));
            $requete2=$bdd->prepare('insert into Eleve (nom,prenom,promo,adresse,adresse_visible,telephone,
             telephone_visible,sexe,mail,mail_visible,validation,login) values(?,?,?,?,?,?,?,?,?,?,?,?)');
            $requete2->execute(array($nom,$prenom,$promo,$adresse,$choixadd,$telephone,$choixtelephone,
            $sexe,$email,$choixmail,$validation,$loginn));
        
        
    }
    // message de succés qui confirme l'inscription
    echo '<div class="alert alert-success" role="alert">';
    echo "L'inscription a été effectuée";
    echo '</div>'; 
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <br/><br/><br/>
       <article><h1 class="h3" style="text-align: center;">Créer un compte Eleve</h3></article>

        <!-- formulaire d'inscription d'eleve par le gestionnaire -->
       <form  role="form" action="CompteEleve.php" method="post" >
            
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="number" class="form-control" id="telephone" name="telephone" required >
            </div>
            <p>Rendre visible son numéro:</p>
            <div class="form-group">   
            <input type="radio"  id="Oui" value="Oui" name="choixtel" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixtel">
            <label for="non">Non</label>
            </div>
            <div class="form-group">
                <label for="telephone">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required >
            </div>
            <p>Rendre visible son adresse:</p>
            <div class="form-group">   
            <input type="radio"  id="Oui" value="Oui" name="choixadresse" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixadresse">
            <label for="non">Non</label>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe</label>
                <select id="sexe" name="sexe" class="form-control">
                    <option selected>Masculin</option>
                    <option>Feminin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="promotion">Promotion</label>
                <input type="number" class="form-control" id="promotion" name="promotion" required >
            </div>
            <div class="form-group">
                <label for="pseudo">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" required >
            </div>
            <p>Rendre visible son e-mail:</p>
            <div class="form-group">   
            <input type="radio"  id="Oui" value="Oui" name="choixmail" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixmail">
            <label for="non">Non</label>
            </div>
            <div class="form-group">
                <label for="pseudo">Login</label>
                <input type="text" class="form-control" id="login" name="login" required >
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp"  required>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <br/>
        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>


