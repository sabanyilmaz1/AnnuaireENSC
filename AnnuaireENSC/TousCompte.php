<?php
require_once "includes/functions.php";
session_start();


// connexion à la BDD
try {
    $bdd=new PDO("mysql:host=localhost;dbname=id16503676_annuaireyilmazsaracco;charset=utf8",
    "id16503676_annuaireyilmazsaraccoo", "@lbE%!(fJ07Lk4?{",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
    }

    // requete pour avoir tous les infos de tous les comptes validés
    $requete='select * from Eleve where validation=1';
    $resultat=$bdd->query($requete);
    $tabResultat=$resultat->fetchAll();

    

?>

<!doctype html>
<html>
<head>
    <title>Les Comptes</title>
</head>
<?php require_once "includes/head.php"; ?>

<body>

    
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>
       <center> <h3> Tous les comptes </h3> </center>
       </br>

         <?php 
        foreach ($tabResultat as $ligne)
        {
            // Stockage des infos de la ligne de requete
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
            
            // Affichage des informations 

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

            // Affichage des experiences sous forme de tableau
            echo '<strong>Les experiences de cet eleve :</strong> <br/>';

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
                
            // requete pour avoir les experiences
            $requete2=$bdd->prepare('select * from Exp where Exp.id_eleve=?');
            $requete2->execute(array($numcompte));
            $tabResultat2=$requete2->fetchAll();
            echo '<tbody>';
            foreach($tabResultat2 as $ligne2)
            {
                
                echo '<tr>';
                echo '<th scope="row"></th>';
                echo "<td>".$ligne2['nature_exp']."</td>";
                echo "<td>".$ligne2['lieu']."</td>";
                echo "<td>".$ligne2['description']."</td>";
                echo "<td>".$ligne2['competence1']."</td>";
                echo "<td>".$ligne2['competence2']."</td>";
                echo "<td>".$ligne2['secteur_activite1']."</td>";
                echo "<td>".$ligne2['secteur_activite2']."</td>";
                echo "<td>".$ligne2['salaire']."</td>";
                echo "<td>".$ligne2['date_debut']."</td>";
                echo "<td>".$ligne2['date_fin']."</td>";
                echo '</tr>';
            }
            echo '</table>';
            ?>
            </div></div></p>
            <?php 
            
            
            
        }
        ?>

        

        




        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>

