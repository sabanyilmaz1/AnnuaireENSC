<?php
require_once "includes/functions.php";
session_start();


?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>

     <h3> Ajouter une expérience!</h3> 

    <?php
    // Formulaire pour ajouter une experience
    ?>
    <form  role="form" action="validationExp.php" method="POST" >
            
            <div class="form-group">
                <label for="nature">Nature de l'expérience</label>
                <select id="nature" name="nature" class="form-control">
                    <option>Stage</option>
                    <option>Emploi</option>
                    <option>Thèse</option>
                </select>
            </div>
            <div class="form-group">
                <label for="datedebut">Date de debut</label>
                <input type="date" class="form-control" id="datedebut" name="datedebut" required>
            </div>
            <div class="form-group">
                <label for="datedefin">Date de fin (si l'experience est en cours mettez la date d'aujourd'hui)</label>
                <input type="date" class="form-control" id="datedefin" name="datedefin" required>
            </div>
            
            <div class="form-group">
                <label for="lieu">Lieu (Entreprise,laboratoire,..) (ecrivez 'rien' si vous ne voulez pas
                le renseigner)</label>
                <input type="text" class="form-control" id="lieu" name="lieu" required>
            </div>
            <div class="form-group">
                <label for="secteur1">Secteur d'activité 1</label>
                <input type="text" class="form-control" id="secteur1" name="secteur1" required>
            </div>
            <div class="form-group">
                <label for="secteur2">Secteur d'activité 2 (ecrivez 'rien' si vous ne voulez pas le renseigner)</label>
                <input type="text" class="form-control" id="secteur2" name="secteur2" required >
            </div>
            <div class="form-group">
                <label for="competence1">Domaine de compétences 1</label>
                <input type="text" class="form-control" id="competence1" name="competence1" required>
            </div>
            <div class="form-group">
                <label for="competence2">Domaine de compétences 2 (ecrivez 'rien' si vous ne voulez pas le renseigner)</label>
                <input type="text" class="form-control" id="competence2" name="competence2" required>
            </div>
            <div class="form-group">
                <label for="description">Description de l'expérience </label>
                <textarea type="text" class="form-control" id="description" cols="40" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="salaire">Salaire (ecrire 0 si vous ne voulez pas le renseigner)</label>
                <input type="number" class="form-control" id="salaire" name="salaire" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>

