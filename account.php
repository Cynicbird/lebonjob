<?php 
/**
 * Project Name : LeBonJob
 * Author : Paartheepan
 */
session_start();
require 'inc/functions.php';
require 'inc/db.php';
logged_only();
require 'inc/header.php';
?>
<?php
$auth = $_SESSION['auth'];
?>


<h1>Bonjour 
<?php
switch($_SESSION['state']) {
    case "c" :
        echo $auth->prenom;
    break;
    case "e" : 
        echo $auth->nom;
    break;
    default: 
        $_SESSION['flash']['danger'] = "Vous n'avez pas été reconnu (switch)";
        unsset($_SESSION['auth']);
        header('Location: login.php');
        exit();
}
?>
</h1>

</div><!--h_jumbotron-->
</div><!--h_container_fluid-->

<?php
require 'inc/footer.php';
?>