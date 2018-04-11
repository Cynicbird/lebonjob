<?php
/**
 * Project Name : LeBonJob
 * Author : Matthieu
 */
require_once('inc/db.php');
require_once('inc/header.php');
$Offre_Req=  "SELECT nom, descriptif, typecontrat, localisationposte, missions, objectifposte, salaire, id  FROM lbj_offre";  
$statement2 = $pdo->prepare($Offre_Req);
$statement2->execute();


while  ($Simple = $statement2->fetchAll(PDO::FETCH_ASSOC)){
    
    foreach ($Simple as $Data) {
        echo '<div style="background-color:white; padding: 20px;">';
            echo '<div class="card">';
                // echo "<p> id: $Data[id] </p>"; 

                echo '<div class="card-header">';
                    echo "<p>$Data[nom] </p>"; 
                echo '</div>';
                    echo '<div class="card-block" style="padding: 20px;">';
                        echo "<p> descriptif :$Data[descriptif] </p>"; 
                        echo "<p> Type de contrat : $Data[typecontrat] </p>"; 
                        echo "<p> Poste_local : $Data[localisationposte] </p>"; 
                        echo "<p> Salaire : $Data[salaire] </p>"; 
                    echo '</div>';
            echo '</div>';
        echo '</div>';
        
    }
    
    
    
}
require_once('inc/footer.php');
?>