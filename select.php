<?php
/**
 * Project Name : LeBonJob
 * Author : Paartheepan
 */
require_once('inc/db.php');

$req = $pdo->query('SELECT * FROM lbj_entreprises');

while($ligne = $req->fetch()) {
    var_dump($ligne);
}