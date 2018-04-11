<?php
ob_start();
?> 
<?php
if(isset($_SESSION['auth'])) {
    header('Location: account.php');
    exit();
}else {
    header('Location: register.php');
    exit();
}