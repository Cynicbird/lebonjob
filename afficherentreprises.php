<?php
/**
 * Project Name : LeBonJob
 * Author : Maxence
 */
require_once('inc/functions.php');
require_once('inc/db.php');
require_once('inc/header.php');
logged_only();
?>
<div class="col-md-12">
<?php
echo"<h1><center>Entreprises recherchant un stagiaire</center></h1>";
    try {
        $result=$pdo->query("SELECT * from lbj_entreprises");
        
        while($data = $result->fetch()) {
            $t = $data->id;
            // on affiche les résultats
            echo '<a class="list-group-item list-group-item-action" href="entreprise.php?id='.$t.'">' . $data->nom.' - '.$data->type.'</a>';
        }
    }
    catch (PDOException $e) {
    print $e->getMessage();
    }
?>
</div>
<?php
require_once('inc/footer.php');
?>