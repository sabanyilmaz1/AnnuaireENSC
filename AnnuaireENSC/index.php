<?php
require_once "includes/functions.php";
session_start();

$pageTitle="accueil";
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>
        <!-- Insertion d'une image de l'ecole-->
        <center><p><img src="images/ensc.jpg" class="img-fluid reduireimage enscImage" alt="image ensc"></p></center>

        <!-- Descripition du site -->
        <article>
            </br></br>
            Le but de ce site d'aider les élèves actuels de l'école notamment
            pour la recherche de stage, ou d'emploi (premier emploi ou ultérieur) et consulter les emplois
            occupés par les anciens élèves de l'école (domaine d'activités, répartition géographique, types de
            postes, …). </br></br>

            Les élèves pourront fournir leurs informations personnelles (nom, prénom, promotion,
            adresses postale et électronique, téléphone, sexe, ...). Ils pourront intégrer leurs
            expériences professionnelles : stages, emplois, thèse. Chacune de ces expériences
            possède une date de début et éventuellement une date de fin. Elle a lieu dans une
            organisation (entreprise, laboratoire, …) sur un lieu donné et est liée à un ou plusieurs
            secteurs d’activités. Cette expérience porte sur un ou plusieurs domaines de compétences.
            Chaque expérience peut être décrite en quelques lignes décrivant le travail effectué.
            L’élève peut, s’il le souhaite, renseigner son salaire pour ce poste.
            </br></br>









        </article>

        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>
