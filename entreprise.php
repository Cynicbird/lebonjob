<?php
/**
 * Project Name : LeBonJob
 * Author : Paartheepan
 */
header("Content-type: text/xml");
require_once('inc/db.php');
?>
<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
if($id == null) {
    $_SESSION['flash']['danger'] = "KESTUFOU";
    header('Location: afficherentreprises.php');
    exit();
}
$req = $pdo->prepare('SELECT * FROM lbj_entreprises WHERE id = ?');
$req->execute([$id]);

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" '
  . 'standalone="yes"?><?xml-stylesheet type="text/xsl" href="templateEntreprise.xsl"?><xml/>');

?>
<?php if($ligne = $req->fetch()) {
    $entreprise = $xml->addChild('entreprise');
    $entreprise->addChild('nom',$ligne->nom);
    $entreprise->addChild('type',$ligne->type);
    $entreprise->addChild('secteuractivite',$ligne->secteuractivite);
    $entreprise->addChild('adresse',$ligne->adresse);
    $entreprise->addChild('courriel',$ligne->courriel);
    $entreprise->addChild('drh',$ligne->drh);
}
print($xml->asXML());
?>


<?php
/**
 * object(stdClass)[4]
 * public 'id' => string '3' (length=1)
 * public 'nom' => string 'IUTBobigny' (length=10)
 * public 'type' => string 'Université' (length=11)
 * public 'secteuractivite' => string 'Education' (length=9)
 * public 'adresse' => string '1 Rue de Chablis' (length=16)
 * public 'courriel' => string 'iut.bobigny@gmail.com' (length=21)
 * public 'password' => string '$2y$10$9LE0rpGjdWEbQqJM07Lm3.C2PUPCnIypIxE55h9dNKVzoA/lUICru' (length=60)
 * public 'drh' => string 'Limani' (length=6)
 */
?>