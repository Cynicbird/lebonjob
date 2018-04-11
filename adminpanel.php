<?php
/**
 * Project Name : LeBonJob
 * Author : Thomas
 */
require_once('inc/header.php');
define("DB_HOST", "sql11.freesqldatabase.com");
	define("DB_NAME", "sql11213936");
	define("DB_USER", "sql11213936");
	define("DB_PASSWORD", "r325DyyrXh");
	define("DB_TABLE1", "lbj_users");
	define("DB_TABLE2", "lbj_entreprises");

try {
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	//Affichage optionnel
	// foreach($db->query('SELECT * from '.DB_TABLE) as $row) {
	//     print_r($row);
	// }
} catch (PDOException $e) {
	print "Erreur !: " . $e->getMessage() . "<br/>";
	die();
}

?>
    <div class="row">
        <div class="col-md-6">
            <h1>Liste des utilisateurs</h1>
            <?php
                foreach($db->query('SELECT * from '.DB_TABLE1) as $row) {
                    echo "
                        <div class='card' style='margin: 10px;' style='margin-top: 25px'>
                            <div class='card-header'>
                            Utilisateur n° ".$row['id'].
                            "</div>
                            <div class='card-block' style='padding: 20px;'>
                            <h5 class='card-title'>".$row['nom'] . " " .$row['prenom']."</h5></div>
                            <a class='btn btn-primary' href='delete.php?user=".$row['id']."'>Supprimer cet utilisateur</a>
                        </div>";
                }
            ?>
        </div>

        <div class="col-md-6">
            <h1>Liste des entreprises</h1>
            <?php
                foreach($db->query('SELECT * from '.DB_TABLE2) as $row) {
                    echo "
                        <div class='entreprise card' style='margin-top: 25px'>
                            <div class='card-header'>
                            <p>Entreprise n° ".$row['id']."</p></div><div class='card-block' style='padding: 20px;'>
                            <h5><b>".$row['nom']. "</b> - 
                            ".$row['courriel']."</h5></div>
                            <a class='btn btn-primary' href='delete.php?entreprise=".$row['id']."'>Supprimer cette entreprise</a>
                        </div>";
                }
            ?>
        </div>
<?php
require_once('inc/footer.php');
?>