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
        <br/><br/><br/>
       <article><h1 class="h3" style="text-align: center;">Faites votre demande d'inscription</h3></article>
       <!-- Formulaire d'inscription d'eleve --> 
       <form  role="form" action="validationInscription.php" method="post" >
            
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="number" class="form-control" id="telephone" name="telephone" required >
            </div>
            <p>Rendre visible mon numéro:</p>
            <div class="form-group">   
            <input type="radio"  id="Oui" value="Oui" name="choixtel" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixtel">
            <label for="non">Non</label>
            </div>
            <div class="form-group">
                <label for="telephone">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required >
            </div>
            <p>Rendre visible mon adresse:</p>
            <div class="form-group">   
            <input type="radio"  id="Oui" value="Oui" name="choixadresse" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixadresse">
            <label for="non">Non</label>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe</label>
                <select id="sexe" name="sexe" class="form-control">
                    <option selected>Masculin</option>
                    <option>Feminin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="promotion">Promotion</label>
                <input type="number" class="form-control" id="promotion" name="promotion" required >
            </div>
            <div class="form-group">
                <label for="pseudo">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" required >
            </div>
            <p>Rendre visible mon e-mail:</p>
            <div class="form-group">   
            <input type="radio"  id="Oui" value="Oui" name="choixmail" checked>
            <label for="oui">Oui</label>
            </div>
            <div class="form-group">
            <input type="radio"  id="Non" value="Non" name="choixmail">
            <label for="non">Non</label>
            </div>
            <div class="form-group">
                <label for="pseudo">Login</label>
                <input type="text" class="form-control" id="login" name="login" required >
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp"  required>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <br/>
        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>


