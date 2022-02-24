<?php require_once "includes/functions.php"; ?>

<nav class="navbar navbar-default navbar-fixed-top" style="background-color:beige;" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-earphone"></span> <strong>Annuaire des anciens eleves ENSC</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-target">
            <?php if (isUserConnected()) { ?>
                <ul class="nav navbar-nav">
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="addExp.php">Ajouter une expérience</a></li>
                    <li><a href="search.php">Consulter les metiers et stages</a></li>
                </ul>
            <?php } ?>
            <?php if (isUserConnectedG()) { ?>
                <ul class="nav navbar-nav">
                    <li><a href="voirDemandeInscription.php">Demande d'inscription</a></li>
                    <li><a href="TousCompte.php">Voir tous les comptes</a></li>
                    <li><a href="CompteEleve.php">Creer un compte eleve</a></li>

                    
                </ul>
            <?php } ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isUserConnected()) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Bienvenue, <?= $_SESSION['login'] ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="modifierProfil.php">Modifier mon profil</a></li>
                            <li><a href="logout.php">Se déconnecter</a></li>
                        </ul>
                    </li>
                <?php } elseif (isUserConnectedG()) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Bienvenue, <?= $_SESSION['loging'] ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">Se déconnecter</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Non connecté <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="inscription.php">Inscription</a></li>
                            <li><a href="login.php">Connexion-Eleve</a></li>
                            <li><a href="loginG.php">Connexion-Gestionnaire</a></li>
                        </ul>
                        </ul>
                        
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div><!-- /.container -->
</nav>
