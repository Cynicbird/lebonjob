<?php
/**
 * Project Name : LeBonJob
 * Author : Paartheepan
 */
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <title>root</title>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-md navbar-light navbar-fixed-bottom bg-primary">
        <div class="navbar-brand">
            <a>LBJ</a>
        </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav">
                    <?php if(isset($_SESSION['auth'])): ?>
                        <li class="nav-item">
                            <a href="account.php" class="nav-link">Accueil</a>
                        </li>

                        <?php
                            if($_SESSION['state'] == "c") :
                        ?>
                            <?php
                                if($_SESSION['auth']->state == "a") :
                            ?>
                                <li class="nav-item">
                                    <a href="afficherlistecv.php" class="nav-link">Afficher les CV</a>
                                </li>
                                <li class="nav-item">
                                    <a href="afficherentreprises.php" class="nav-link">Voir les entreprises</a>
                                </li>
                                <li class="nav-item">
                                    <a href="afficheroffre.php" class="nav-link">Afficher les offres</a>
                                </li>
                            <?php else: ?>
                            
                            <li class="nav-item">
                                <a href="afficheroffre.php" class="nav-link">Afficher les offres</a>
                            </li>
                            <li class="nav-item">
                                <a href="deposercv.php" class="nav-link">Deposer un CV</a>
                            </li>
                            <li class="nav-item">
                                <a href="afficherentreprises.php" class="nav-link">Voir les entreprises</a>
                            </li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            if($_SESSION['state'] == "e") :
                        ?>
                            <li class="nav-item">
                                <a href="afficherlistecv.php" class="nav-link">Afficher les CV</a>
                            </li>
                            <li class="nav-item">
                                <a href="deposeroffre.php" class="nav-link">Deposer une offre</a>
                            </li>
                        <?php endif; ?>
                        <?php
                        if(isset($_SESSION['auth']->state)) {
                            if($_SESSION['auth']->state == "a") {
                        ?>
                            <li class="nav-item">
                                <a href="adminpanel.php" class="nav-link">Panneau d'administration</a>
                            </li>
                        <?php }
                        } ?>
                        

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Se deconnecter</a>
                    </li>
                    <?php endif; ?>
                    <?php if(!(isset($_SESSION['auth']))): ?>
                            <li class="nav-item">
                                <a href="login.php" class="nav-link">Se connecter</a>
                            </li>
                            <li class="nav-item">
                                <a href="register.php" class="nav-link">S'inscrire en tant que candidat</a>
                            </li>
                            <li class="nav-item">
                                <a href="eregister.php" class="nav-link">S'inscrire en tant qu'entreprise</a>
                            </li>
                        <?php endif; ?>
                </ul>
            </div>
    </nav>
    <div class="container-fluid" >
    <div class="jumbotron">
        <div class="container">
            <?php if(isset($_SESSION['flash'])): ?>
                <?php foreach($_SESSION['flash'] as $type=>$message):?>
                    <div class="container">
                        <div class="alert alert-<?= $type; ?>">
                            <?= $message ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['flash']); ?>
            <?php endif;?>

