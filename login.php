<?php
/**
 * Project Name : LeBonJob
 * Author : Paartheepan
 */
ob_start();
?> 
<?php 
if(!empty($_POST) && !empty($_POST['username'] && !empty($_POST['password']))) {
    require_once 'inc/db.php';
    require_once 'inc/functions.php';
    $req = $pdo->prepare('SELECT * FROM lbj_users WHERE email = ?');
    $req->execute([$_POST['username']]);
    $user = $req->fetch();
    $req2 = $pdo->prepare('SELECT * FROM lbj_entreprises WHERE courriel = ?');
    $req2->execute([$_POST['username']]);
    $user2 = $req2->fetch();

    session_start();
    if(password_verify($_POST['password'], $user->password)){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Vous êtes maintenant connnecté.";
        header("Location: account.php");
        exit();
    }elseif(password_verify($_POST['password'], $user2->password)) {
        $_SESSION['auth'] = $user2;
        $_SESSION['flash']['success'] = "Vous êtes maintenant connnecté.";
        header("Location: account.php");
        exit();
    }
    else {
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
    }
}
require 'inc/header.php';
?>

    <h1>Se connecter</h1>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Adresse Mail</label>
                <input name="username" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input name="password" type="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>

<?php
require 'inc/footer.php';
?>