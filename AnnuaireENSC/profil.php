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
    // requete pour avoir les informations de l'eleve connecté et ses experiences 
    $loginco=$_SESSION['login'];
    $requete = $bdd->prepare("select distinct * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve WHERE validation=1 and Eleve.login=?");
    $requete->execute(array($loginco));
    $tab = $requete->fetchAll();

?>



<!doctype html>
<html>
<head>
    <title>Profil</title>
</head>
<center>
<?php require_once "includes/head.php"; ?>
<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>
        <h3> Mon profil</h3>
        <?php
        $compteur=1;
        foreach ( $tab as $ligne ) {
            if ($compteur==1)
            {
                // on stock les donéées de la ligne de requete
                $nom=escape($ligne["nom"]);
                $prenom=escape($ligne["prenom"]);
                $login=escape($ligne["login"]);
                $promo=escape($ligne["promo"]);
                $numcompte=escape($ligne['id_eleve']);
                $numtel=escape($ligne['telephone']);
                $email=escape($ligne['mail']);
                $sex= escape($ligne['sexe']);

                        if ($sex=="m")
                    {
                        $sexe="Masculin";
                    }
                    else
                    {
                        $sexe="Féminin";
                    }
                     $adresse=escape($ligne['adresse']);

                     // affichage des informations
                     echo '<p style="border-style: inset;">';
                    echo '<div class="card" style="width: 30rem;">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Compte n°'.$numcompte.'</h5>';

                    echo '<p class="card-text"><strong>'.$nom.' '.$prenom.' </strong>(login :'.$login;
                    echo ')<br/><strong>Promotion</strong> : '.$promo;
                    echo '<br/><strong>Sexe</strong> : '.$sexe;
                    echo '<br/> <strong>E-Mail : </strong>'.$email;
                    echo '<br/> <strong>Telephone : </strong>'.$numtel;
                    echo  '<br/> <strong> Adresse : </strong>'.$adresse;
                    echo '</p>';

            }
            $compteur++;    
        }
        // affichage des experiences sous forme de tableau
                echo "</center>";
                echo "<center><h4>Expériences </h4></center>";
                echo '<table class="table">';
                echo  '<thead><tr>';
                echo  '<th scope="col"></th>';
                echo '<th scope="col">Nature de l\'expérience</th>';
                echo '<th scope="col">Lieu</th>';
                echo '<th scope="col">Description</th>';
                echo '<th scope="col">Competence 1</th>';
                echo '<th scope="col">Competence 2</th>';
                echo '<th scope="col">Secteur d\'activté 1</th>';
                echo '<th scope="col">Secteur d\'activté 2</th>';
                echo '<th scope="col">Salaire</th>';
                echo '<th scope="col">Date de debut</th>';
                echo '<th scope="col">Date de fin</th>';
                echo '</tr></thead>';
                foreach($tab as $ligne)
            {
                echo '<tr>';
                echo '<th scope="row"></th>';
                echo "<td>".$ligne['nature_exp']."</td>";
                echo "<td>".$ligne['lieu']."</td>";
                echo "<td>".$ligne['description']."</td>";
                echo "<td>".$ligne['competence1']."</td>";
                echo "<td>".$ligne['competence2']."</td>";
                echo "<td>".$ligne['secteur_activite1']."</td>";
                echo "<td>".$ligne['secteur_activite2']."</td>";
                echo "<td>".$ligne['salaire']."</td>";
                echo "<td>".$ligne['date_debut']."</td>";
                echo "<td>".$ligne['date_fin']."</td>";
                echo '</tr>';
            }
            echo '</table>';
        ?>

    </div>



    </div>
    <br/><br/>
    <!-- Image de l'ensc -->
    <center>
    <p><img src="images/ensc2.jpg" class="img-fluid reduireimage enscImage" alt="image ensc"></p>
    </center>

<?php require_once "includes/footer.php"; ?>
</div>

<?php require_once "includes/scripts.php"; ?>
</body>

</html>
