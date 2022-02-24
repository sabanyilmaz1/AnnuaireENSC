<?php
require_once "includes/functions.php";
session_start();


// On verifie que le formulaire de login est bien rempli
if (!empty($_POST['login']) and !empty($_POST['mdp'])) {
  // affection des données du formulaire de login
    $login = $_POST['login'];
    $mdpg = $_POST['mdp'];
    $type="eleve";


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
    $requete->execute(array($login,$mdpg,$type));
    
    // deuxieme requete pour verifier si ce compte est validé
    $requete2=$bdd->prepare('select validation from Eleve where login=?');
    $requete2->execute(array($login));
    $estvalide = $requete2->fetch();


    if ($requete->rowCount() == 1 ) {
        // Connexion reussi
          while ($estvalide)
          {
            if ($estvalide['validation']==0) // Compte pas encore validé
            {
                // message d'alerte qui indique que le compte n'est pas validé
                print '<br/><br/><p><div class="alert alert-danger" role="alert">
               <strong>Votre inscription n\'est pas encore validé!</strong></div></p>';
            }
            else
            {
              $_SESSION['login'] = $login; // on stocke le login commme variable de session
              redirect("index.php"); // quand on se connecte on se retrouve à la page d'accueil
            }
            $estvalide = $requete2->fetch();
          }
        }







    else {
         $error = "Utilisateur non reconnu";
         print $error;
    }

}

?>

<!doctype html>
<html>
<head>
    <title>Connexion Eleve</title>
</head>
<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>

<center> <h3> Connectez-vous en tant qu'élève !</h3> </center>
    <!-- Formulaire de login eleve-->
        <form action="login.php" method="post">
          <div class="form-group">
          <label for="login">Login</label>
          <input type="text" class="form-control" id="login"  name="login" required>
           </div>
          <div class="form-group">
          <label for="mdp1">Mot de passe</label>
          <input type="password" class="form-control" id="mdp" name="mdp" required>
          </div>
          <button type="submit" class="btn btn-primary">Connexion</button>

        </form>
        </div>


        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>
