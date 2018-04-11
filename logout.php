<?php
/**
 * Project Name : LeBonJob
 * Author : Paartheepan
 */
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous êtes bien déconnecté.";
header("Location: login.php");
exit();