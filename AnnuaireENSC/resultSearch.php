<?php
require_once "includes/functions.php";
session_start();
// page pour l'affichage de la recherche



//  Connexion à la BDD
try {
    $bdd=new PDO("mysql:host=localhost;dbname=id16503676_annuaireyilmazsaracco;charset=utf8",
    "id16503676_annuaireyilmazsaraccoo", "@lbE%!(fJ07Lk4?{",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
    }
// on stocke les variables du formulaire de recherche (elle peut etre vide par exemple $lieu="")

if (!empty($_POST['nature']))
{
    $nature=escape($_POST['nature']);
    $lieu=escape($_POST['lieu']);
    $lieu=strtolower($lieu);
    $competence=escape($_POST['competence']);
    $competence=strtolower($competence);
    $secteur=escape($_POST['secteur']);
    $secteur=strtolower($secteur);
   
}
// on va faire plusieurs requete pour traiter tous les cas


    // Cas 1 : la requete si l'eleve remplit seulement le critere de nature 
    $requete1 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=? ");
    $requete1->execute(array($nature));
    $tab1 = $requete1->fetchAll();

    
    // Cas 2: la requete si l'eleve remplit lieu et nature
    $requete2 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=? and Exp.lieu like '%$lieu%' ");
    $requete2->execute(array($nature));
    $tab2 = $requete2->fetchAll();

    
    // Cas 3: la requete si l'eleve remplit lieu,competence,nature
    $requete3 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=? and Exp.lieu like '%$lieu%' and Exp.competence1 LIKE '%$competence%' or Exp.competence2 LIKE '%$competence%' ");
    $requete3->execute(array($nature));
    $tab3 = $requete3->fetchAll();

    // Cas 4: la requete si l'eleve remplit lieu,competence,secteur,nature
    $requete4 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=? and Exp.lieu like '%$lieu%' and ( Exp.competence1 LIKE '%$competence%' or Exp.competence2 LIKE '%$competence%') and ( Exp.secteur_activite1 LIKE '%$secteur%' or Exp.secteur_activite2 LIKE '%$secteur%') ");
    $requete4->execute(array($nature));
    $tab4 = $requete4->fetchAll();

    // Cas 5:la requete si l'eleve remplit seulement le critere de nature et de secteur
    $requete5 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=?  and Exp.secteur_activite1 LIKE '%$secteur%' or Exp.secteur_activite2 LIKE '%$secteur%' ");
    $requete5->execute(array($nature));
    $tab5 = $requete5->fetchAll();

    // Cas 6:la requete si l'eleve remplit seulement le critere de nature et de competence
    $requete6 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=? and Exp.competence1 LIKE '%$competence%' or Exp.competence2 LIKE '%$competence%' ");
    $requete6->execute(array($nature));
    $tab6 = $requete6->fetchAll();

    // Cas 7 :la requete si l'eleve remplit secteur,competence,nature
    $requete7 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=? and ( Exp.competence1 LIKE '%$competence%' or Exp.competence2 LIKE '%$competence%' ) and ( Exp.secteur_activite1 LIKE '%$secteur%' or Exp.secteur_activite2 LIKE '%$secteur%' ) ");
    $requete7->execute(array($nature));
    $tab7 = $requete7->fetchAll();

    // Cas 8: la requete si l'eleve remplit lieu,secteur,nature
    $requete8 = $bdd->prepare("select * from Eleve JOIN Exp ON Eleve.id_eleve=Exp.id_eleve where Exp.nature_exp=? and Exp.lieu like '%$lieu%' and Exp.secteur_activite1 LIKE '%$secteur%' or Exp.secteur_activite2 LIKE '%$secteur%' ");
    $requete8->execute(array($nature));
    $tab8 = $requete8->fetchAll();

    
            

?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
<br/><br/><br/><br/>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <h3 style="text-align: center;"> Resultat de votre recherche </h3>
            <br/>

            <!-- Creation d'un tableau pour afficher les resultats -->
            <table class="table">
            <thead><tr>
            <th scope="col"></th>
            <th scope="col">Nature de l'expérience</th>
            <th scope="col">Lieu</th>
            <th scope="col">Description</th>
            <th scope="col">Competence 1</th>
            <th scope="col">Competence 2</th>
            <th scope="col">Secteur d'activté 1</th>
            <th scope="col">Secteur d'activté 2</th>
            <th scope="col">Salaire</th>
            <th scope="col">Date de debut</th>
            <th scope="col">Date de fin</th>
            <th scope="col">Nom de l'eleve</th>
            <th scope="col">Prenom de l'eleve</th>
            <th scope="col">Promotion</th>
            <th scope="col">Telephone</th>
            <th scope="col">Mail</th>
            </tr></thead>
            
        <?php 
        // cas 1
        if ($lieu=="" and $competence=="" and $secteur=="")
        {  
            foreach($tab1 as $ligne)
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
                echo "<td>".$ligne['nom']."</td>";
                echo "<td>".$ligne['prenom']."</td>";
                echo "<td>".$ligne['promo']."</td>";
                if ($ligne['telephone_visible']==0)
                {
                    echo "<td>Non renseigné</td>";
                }
                else
                {
                    echo "<td>".$ligne['telephone']."</td>";
                }
                if ($ligne['mail_visible']==0)
                {
                    echo "<td>Non renseigné</td>";
                }
                else
                {
                    echo "<td>".$ligne['mail']."</td>";
                }
                echo '</tr>';
                
            }
           echo '</table>';
        }
        // cas 2
        else if  ($lieu!="" and $competence=="" and $secteur=="")
        {     
                foreach ($tab2 as $ligne)
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
                    echo "<td>".$ligne['nom']."</td>";
                    echo "<td>".$ligne['prenom']."</td>";
                    echo "<td>".$ligne['promo']."</td>";
                    if ($ligne['telephone_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['telephone']."</td>";
                    }
                    if ($ligne['mail_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['mail']."</td>";
                    }
                    echo '</tr>';             
                }
                    echo '</table>';        
        }
        // cas 3
        else if  ($lieu!="" and $competence!="" and $secteur=="")
        {     
                foreach ($tab3 as $ligne)
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
                    echo "<td>".$ligne['nom']."</td>";
                    echo "<td>".$ligne['prenom']."</td>";
                    echo "<td>".$ligne['promo']."</td>";
                    if ($ligne['telephone_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['telephone']."</td>";
                    }
                    if ($ligne['mail_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['mail']."</td>";
                    }
                    echo '</tr>';             
                }
                    echo '</table>';        
        }
        // cas 4
        else if  ($lieu!="" and $competence!="" and $secteur!="")
        {     
                foreach ($tab4 as $ligne)
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
                    echo "<td>".$ligne['nom']."</td>";
                    echo "<td>".$ligne['prenom']."</td>";
                    echo "<td>".$ligne['promo']."</td>";
                    if ($ligne['telephone_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['telephone']."</td>";
                    }
                    if ($ligne['mail_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['mail']."</td>";
                    }
                    echo '</tr>';             
                }
                    echo '</table>';        
        }
        // cas 5
        else if  ($lieu=="" and $competence=="" and $secteur!="")
        {     
                foreach ($tab5 as $ligne)
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
                    echo "<td>".$ligne['nom']."</td>";
                    echo "<td>".$ligne['prenom']."</td>";
                    echo "<td>".$ligne['promo']."</td>";
                    if ($ligne['telephone_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['telephone']."</td>";
                    }
                    if ($ligne['mail_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['mail']."</td>";
                    }
                    echo '</tr>';             
                }
                    echo '</table>';        
        }
        // cas 6
        else if  ($lieu=="" and $competence!="" and $secteur=="")
        {     
                foreach ($tab6 as $ligne)
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
                    echo "<td>".$ligne['nom']."</td>";
                    echo "<td>".$ligne['prenom']."</td>";
                    echo "<td>".$ligne['promo']."</td>";
                    if ($ligne['telephone_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['telephone']."</td>";
                    }
                    if ($ligne['mail_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['mail']."</td>";
                    }
                    echo '</tr>';             
                }
                    echo '</table>';        
        }
        // cas 7
        else if  ($lieu=="" and $competence!="" and $secteur!="")
        {     
                foreach ($tab7 as $ligne)
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
                    echo "<td>".$ligne['nom']."</td>";
                    echo "<td>".$ligne['prenom']."</td>";
                    echo "<td>".$ligne['promo']."</td>";
                    if ($ligne['telephone_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['telephone']."</td>";
                    }
                    if ($ligne['mail_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['mail']."</td>";
                    }
                    echo '</tr>';             
                }
                    echo '</table>';        
        }
        //case 8
        else if  ($lieu!="" and $competence=="" and $secteur!="")
        {     
                foreach ($tab8 as $ligne)
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
                    echo "<td>".$ligne['nom']."</td>";
                    echo "<td>".$ligne['prenom']."</td>";
                    echo "<td>".$ligne['promo']."</td>";
                    if ($ligne['telephone_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['telephone']."</td>";
                    }
                    if ($ligne['mail_visible']==0)
                    {
                        echo "<td>Non renseigné</td>";
                    }
                    else
                    {
                        echo "<td>".$ligne['mail']."</td>";
                    }
                    echo '</tr>';             
                }
                    echo '</table>';        
        }




        
        ?>
        
    </div>    
    <?php require_once "includes/footer.php"; ?>           
    <?php require_once "includes/scripts.php"; ?>
    </body>

    </html>