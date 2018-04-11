<?php
/**
 * Project Name : LeBonJob
 * Author : Paartheepan
 */
require_once 'inc/functions.php';
session_start();
if(!empty($_POST)){
    $errors = array();
    require_once 'inc/db.php';

        if(empty($_POST['nom']) || !preg_match('/^[a-zA-Z0-9]+$/', $_POST['nom'])){
            $errors['username'] = "Pseudo non valide";
        }

        if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $errors['mail'] = "Email non valide";
        }else {
            $req = $pdo->prepare('SELECT id FROM lbj_users WHERE email = ?');
            $req->execute([$_POST['mail']]);
            $user = $req->fetch();
            if($user){
                $errors['mail'] = 'Cet email existe déjà';
            }
        }
        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
            $errors['password'] = "Mot de passe non valide";
        }

        if(empty($errors)) {
            $req = $pdo->prepare("INSERT INTO lbj_entreprises SET nom= ?, type = ?, secteuractivite = ?, adresse = ?, courriel = ?, drh = ?, password = ?");
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            $req->execute([$_POST['nom'], $_POST['type'], $_POST['secteuractivite'], $_POST['adresse'], $_POST['mail'], $_POST['drh'], $password]);
            $message = "Vous venez de créer un compte entreprise";
            mail($_POST['mail'], "Confirmation du compte", $message);
            $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé.";
            header('Location: login.php');
            exit();
        }
    }
?>
<?php require 'inc/header.php' ?>
            <div class="row">
                <div class="col-md-12">
                    <h2>S'inscrire en tant qu'entreprise</h2>
                    <p>Connectez-vous pour accéder à l'espace administrateur.</p>
                </div>
            </div>
        </div><!-- h_container -->
        
        <div class="container">
                <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                    <?php
                        foreach($errors as $e){
                            echo "<li>" . $e . "</li>";
                        }
                    ?>
                    </ul>
                </div>
                <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input name="nom" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <input name="type" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="secteuractivite">Secteur d'activité</label>
                    <input name="secteuractivite" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input name="adresse" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mail">Courriel</label>
                    <input name="mail" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="drh">DRH</label>
                    <input name="drh" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirmez votre mot de passe</label>
                    <input name="password_confirm" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
    </div><!--h_jumbotron-->
    </div><!--h_container_fluid-->
<?php require 'inc/footer.php' ?>

