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
echo "<h1><center>CV disponible</center></h1>";
    try {
        $result=$pdo->query("SELECT prenom, nom, typecontrat, posterecherche, ville, codepostal, id from lbj_cv");
        
        while($data = $result->fetch()) {
            $t = $data->id;
            // on affiche les résultats
            echo '<a class="list-group-item list-group-item-action" href="generatexml.php?id='.$t.'">' . $data->prenom.' '.$data->nom.' : '.$data->typecontrat.' '.$data->posterecherche.' - '.$data->ville.' ('.$data->codepostal.')' . '</a>';
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