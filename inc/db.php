<?php
define("DB_HOST", "sql11.freesqldatabase.com");
define("DB_NAME", "sql11213936");
define("DB_USER", "sql11213936");
define("DB_PASSWORD", "r325DyyrXh");
define("DB_TABLE", "lbj_users");

$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);