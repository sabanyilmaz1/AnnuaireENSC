<?php
require_once "includes/functions.php";
session_start();




// On verifie que le formulaire de login est bien rempli
if (!empty($_POST['loging']) and !empty($_POST['mdpg'])) {
    $loging = $_POST['loging'];
    $mdpg = $_POST['mdpg'];
    $type="gest";


    // Connexion à la BDD
    try {
      $bdd=new PDO("mysql:host=localhost;dbname=id16503676_annuaireyilmazsaracco;charset=utf8",
      "id16503676_annuaireyilmazsaraccoo", "@lbE%!(fJ07Lk4?{",
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
      catch (Exception $e) {
      die('Erreur fatale : ' . $e->getMessage());
      }
    
    //la requete pour verifier les informations login et mdp sont bonnes
    $requete = $bdd->prepare(' select* from Utilisateur where login=? and mdp=? and type_compte=?');
    $requete->execute(array($loging,$mdpg,$type));
    
    if ($requete->rowCount() == 1 ) {
        // Connexion reussi
        $_SESSION['loging'] = $loging; // on stocke le login commme variable de session
        redirect("index.php");
    }
    else {
        $error = "Utilisateur non reconnu";
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Connexion Gestionnaire</title>
</head>
<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>

<center> <h3> Connectez-vous en tant que Gestionnaire !</h3> </center>
      <!-- Formulaire de login gestionnaire -->
        <form action="loginG.php" method="post">
          <div class="form-group">
            <label for="loging">Login</label>
            <input type="text" class="form-control" id="loging"  name="loging" placeholder="Entrer votre pseudo" required>
          </div>
          <div class="form-group">
          <label for="mdpg">Mot de passe</label>
          <input type="password" class="form-control" id="mdpg" name="mdpg" placeholder="Entrer votre mot de passe" required>
          </div>
          <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
        </div>


        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>
