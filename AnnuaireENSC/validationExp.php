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

    // Requete pour recuperer le id de l'eleve connecté car on a besoin de cette id pour ajouter une experience
            $loginn=$_SESSION['login'];
            $requete2=$bdd->prepare('select * from Eleve where login=?');
            $requete2->execute(array($loginn));
            $id = $requete2->fetch();
    
?>
<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
<br/><br/><br/><br/>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <?php 
        
            
        while ($id)
        {
            // on stocke la variable id de la BDD
            $ideleve=$id['id_eleve'];
            $id = $requete2->fetch();
        }
            
            
            // On recupere les variable du formulaire d'experience

            if (!empty($_POST['nature']) and !empty($_POST['description']) and !empty($_POST['lieu'])
            and !empty($_POST['datedebut']) and !empty($_POST['datedefin'])
            and !empty($_POST['competence1']) and !empty($_POST['competence2'])
            and !empty($_POST['secteur1']) and !empty($_POST['secteur2'])
            )

            {
                
                // Les variables issues du formulaire

                $nature= escape($_POST['nature']);
                $datededebut = escape($_POST['datedebut']);
                $description= escape($_POST['description']);
                $datedefin = escape($_POST['datedefin']);
                $lieu = escape($_POST['lieu']);
                $lieu=strtolower($lieu);
                    if ($lieu=="rien")
                    {
                        $lieu="pas définie";
                    }
                $secteur1= escape($_POST['secteur1']);
                $secteur1=strtolower($secteur1);
                $secteur2= escape($_POST['secteur2']);
                $secteur2=strtolower($secteur2);
                    if ($secteur2=="rien")
                    {
                        $secteur2="pas définie";
                    }
                $competence1= escape($_POST['competence1']);
                $competence1=strtolower($competence1);
                $competence2= escape($_POST['competence2']);
                $competence2=strtolower($competence2);
                    if ($competence2=="rien")
                    {
                        $competence2="pas définie";
                    }
                $salaire= escape($_POST['salaire']);
                
                // requete insert pour ajouter les données du formulaire d'experience dans la base de donnée

                $requete = $bdd->prepare('insert into Exp (nature_exp,description,lieu,date_debut,date_fin,competence1,competence2,secteur_activite1,secteur_activite2,salaire,id_eleve) values(?,?,?,?,?,?,?,?,?,?,?) ');
                $requete->execute(array($nature,$description,$lieu,$datededebut,$datedefin,$competence1,$competence2,$secteur1,$secteur2,$salaire,$ideleve)); 
            }  
            
        
        ?>
        
        </div>
        
        <!-- Message d'alerte qui indique que l'experience a été ajouté -->

        <div class="alert alert-success" role="alert">
        <strong>Expérience ajoutée !</strong>
        </div>
    <?php require_once "includes/footer.php"; ?>
    
            
    <?php require_once "includes/scripts.php"; ?>
    </body>

    </html>