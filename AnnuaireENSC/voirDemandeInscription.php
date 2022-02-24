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

    // requete pour avoir tous les comptes pas encore validés 

    $requete='select * from Eleve where validation=0';
    $resultat=$bdd->query($requete);
    $tabResultat=$resultat->fetchAll();

    

?>

<!doctype html>
<html>
<head>
    <title>Les demandes d'inscriptions</title>
</head>
<?php require_once "includes/head.php"; ?>

<body>

    
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>
       <center> <h3> Les demandes d'inscription en attente</h3> </center>
       </br>

         <?php 
        foreach ($tabResultat as $ligne)
        {
            // les variables issues de la requete 

            $nom=escape($ligne["nom"]);
            $prenom=escape($ligne["prenom"]);
            $login=escape($ligne["login"]);
            $promo=escape($ligne["promo"]);

            // Affichage des infos de l'eleve
            echo '<p style="border-style: inset;">';
            echo '<div class="card" style="width: 30rem;">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Demande en attente</h5>';
            echo '<h6 class="card-subtitle mb-2 text-muted">Promotion :'.$promo.'</h6>';
            echo '<p class="card-text">'.$nom.' '.$prenom.' ('.$login.')'.'</p>'; ?>

            <!-- Formulaire pour recuperer l'information : si le gestionnaire valide l'inscription ou pas -->

            <form  role="form" action="voirDemandeInscription.php" method="post" >
            <div class="form-group">
            <label for="nature">Valider l'inscription ?</label>   
            <select id="nature" name="nature" class="form-control">
            <option >Non</option>
            <option >Oui</option>
            </select><br/>
            <button type="submit" class="btn btn-primary">Confimer</button>
            </form></div></div></div></p>
            <?php //echo '<p><br/></p>';
            
            if (!empty($_POST['nature']))
            {
                // On recupere la variable nature qui egale soit à "oui" ou "non"

                $choixvalidation=escape($_POST['nature']);
                if ($choixvalidation=="Oui") // Si oui alors on valide le compte avec une requete update qui modifie validation=0 en validation=1
                {
                    $requete2=$bdd->prepare('update Eleve set validation=1 where login=?');
                    $requete2->execute(array($login));
                    
                }
            }
            
        }
        ?>

        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>

