<?php
require_once "includes/functions.php";
session_start();


// Connexion à la BDD
    try {
    $bdd=new PDO("mysql:host=localhost;dbname=id16503676_annuaireyilmazsaracco;charset=utf8",
    "id16503676_annuaireyilmazsaraccoo", "@lbE%!(fJ07Lk4?{",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
    }

    // requete pour avoir tous les informations de l'eleve connecté
    $loginco=$_SESSION['login'];
    $requete = $bdd->prepare("select * from Eleve where login=?");
    $requete->execute(array($loginco));
    $ligne = $requete->fetch();


?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <br/><br/><br/>
       <article><h1 class="h3" style="text-align: center;">Modifier votre Profil</h3></article>
         
        <?php 
        
        while ( $ligne ) {
            // On stocke les informations via la ligne de la requete
            $nomA=escape($ligne["nom"]);
            $prenomA=escape($ligne["prenom"]);
            $promoA=escape($ligne["promo"]); 
            $numtelA=escape($ligne['telephone']);
            $emailA=escape($ligne['mail']);
            $adresseA=escape($ligne['adresse']);
            $ligne = $requete->fetch();
        }
        
        ?>
        <!-- Formulaire de mofication du profil 
        car les champs sont deja rempli avec les informations de base grace à value
        l'utilisateur a donc besoin de modifier seulement les informations qu'il souhaite
        -->
       <form  role="form" action="validationmodifierprofil.php" method="post" >

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nomA ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenomA ?>" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="number" class="form-control" id="telephone" name="telephone" value="<?php echo $numtelA ?>" required >
            </div>
            <p>Rendre visible mon numéro:</p>
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
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $adresseA ?>" required >
            </div>
            <p>Rendre visible mon adresse:</p>
            <div class="form-group">
            <input type="radio"  id="Oui" value="Oui" name="choixadresse" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixadresse" required>
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
                <input type="number" class="form-control" id="promotion" name="promotion" value="<?php echo $promoA ?>" required >
            </div>
            <div class="form-group">
                <label for="pseudo">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $emailA ?>" required >
            </div>
            <p>Rendre visible mon e-mail:</p>
            <div class="form-group">
            <input type="radio"  id="Oui" value="Oui" name="choixmail" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixmail">
            <label for="non">Non</label>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Modifier votre profil </button>
        </form>
        <br/>
        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>
