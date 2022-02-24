<?php
require_once "includes/functions.php";
session_start();


?>

<!doctype html>
<html>
<head>
    <title>Recherche expérience</title>
</head>
<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        </br></br></br>

<center> <h3> Recherchez l'expérience qui vous correspond !</h3> </center>

<!-- Formulaire pour la recherche d'experience -->
        <form action="resultSearch.php" method="post">

          <div class="form-group">
                          <label for="nature">Nature de l'expérience</label>
                          <select id="nature" name="nature" class="form-control">
                              <option >Stage</option>
                              <option>Emploi</option>
                              <option>Thèse</option>
                          </select>
                      </div>

    <div class="form-group">
      <label for="lieu">Lieu(Entreprise,Laboratoire,etc..)</label>
      <input type="text" class="form-control" id="lieu"  name="lieu">

    </div>
    <div class="form-group">
      <label for="competence">Domaine de compétence</label>
      <input type="text" class="form-control" id="competence" name="competence">
    </div>

<div class="form-group">
    <label for="domaine">Secteur d'activité</label>
    <input type="text" class="form-control" id="secteur"  name="secteur">
  </div>

    <button type="submit" class="btn btn-primary">Rechercher</button>

  </form>
        </div>


        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>



