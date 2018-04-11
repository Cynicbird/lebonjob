<?php

// $_SESSION['id'] = 1
require_once('inc/db.php');
$db = $pdo;
?>
<?php
$xml= new XMLWriter();

$xml->openUri("cv.xml");
$xml->startDocument('1.0', 'utf-8');

$xml->writePi('xml-stylesheet', 'version="1.0" type="text/xsl" href="template.xsl"'); 

$xml->startElement('cv');
$result = $db->prepare("SELECT * from lbj_cv WHERE id = ?");
$result->execute([$_GET['id']]);




while($data = $result->fetch()) {
    $xml->startElement('informations_personnelles');
		$xml->writeElement('nom',$data->nom);
		$xml->writeElement('prenom',$data->prenom);
		$xml->writeElement('naissance',$data->datenaissance);
		$xml->writeElement('adresse',$data->adresse);
		$xml->writeElement('ville',$data->ville);
		$xml->writeElement('codePostal',$data->codepostal);
		$xml->writeElement('mail',$data->courriel);
		$xml->writeElement('telephone',$data->telephone);
		$xml->writeElement('portfolio',$data->portfolio);
    $xml->endElement();

	$xml->startElement('formations');
		$formations = unserialize($data->formations);
		foreach ($formations as $key => $formation) {
			$xml->startElement('formation');
				$xml->writeElement('formation_titre',$formation[0]);
				$xml->writeElement('formation_annee',$formation[1]);
				$xml->writeElement('formation_etablissement',$formation[2]);
				$xml->writeElement('formation_lieu',$formation[3]);
			$xml->endElement();
		}
	$xml->endElement();

	$xml->startElement('competences');
		$competences = unserialize($data->competences);
		foreach ($competences as $key => $competence) {
			$xml->startElement('competence');
				$xml->writeElement('competence_nom',$competence[0]);
				$xml->writeElement('competence_niveau',$competence[1]);
			$xml->endElement();
		}
	$xml->endElement();

	$xml->startElement('experiences');
		$experiences = unserialize($data->experiences);
		foreach ($experiences as $key => $experience) {
			$xml->startElement('experience');
				$xml->writeElement('experience_nom',$experience[0]);
				$xml->writeElement('experience_entreprise',$experience[1]);
				$xml->writeElement('experience_mission',$experience[2]);
				$xml->writeElement('experience_duree',$experience[3]);
			$xml->endElement();
		}
	$xml->endElement();

	$xml->startElement('centre-interet');
		$centreinterets = unserialize($data->centreinteret);
		foreach ($centreinterets as $key => $centreinteret) {
			$xml->writeElement('centreinteret_nom', $centreinteret[0]);
		}
	$xml->endElement();

	$xml->startElement('langues');
		$langues = unserialize($data->langues);
		foreach ($langues as $key => $langue) {
			$xml->writeElement('langue', $langue[0]);
		}
	$xml->endElement();

	$xml->startElement('poste-recherche');
		$xml->writeElement('recherche',$data->posterecherche);
		$xml->writeElement('contrat',$data->typecontrat);
		$xml->writeElement('duree',$data->duree);
    $xml->endElement();
}
$xml->endElement();
$xml->flush();

header('Location: cv.xml');
exit();
?>