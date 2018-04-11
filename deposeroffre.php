<?php
/**
 * Project Name : LeBonJob
 * Author : Thomas
 */
require_once('inc/functions.php');
require_once('inc/db.php');
logged_only();
require_once('inc/header.php');
?>


<?php


if(isset($_POST['form_offre'])) {
  $nom = htmlspecialchars($_POST['nom']);
  $descriptif = htmlspecialchars($_POST['descriptif']);
  $typecontrat = htmlspecialchars($_POST['typecontrat']);
  $localisationposte = htmlspecialchars($_POST['localisationposte']);

  $missions = getMissions();
  $objectifposte = getObjectifs();
  $niveaudetude = htmlspecialchars($_POST['niveaudetude']);
  $domainedetude = htmlspecialchars($_POST['domainedetude']);
  $competences = getCompetences();
  $experience = htmlspecialchars($_POST['experience']);
  $salaire = htmlspecialchars($_POST['salaire']);
  $avantages = getAvantages();

	$inserttmbr = $pdo->prepare('INSERT INTO offre(nom, descriptif, typecontrat, localisationposte, missions, objectifposte, niveaudetude, domainedetude, competences, experience, salaire, avantages) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
	$inserttmbr->bindParam(1, $nom);
	$inserttmbr->bindParam(2, $descriptif);
	$inserttmbr->bindParam(3, $typecontrat);
	$inserttmbr->bindParam(4, $localisationposte);
	$inserttmbr->bindParam(5, $missions);
	$inserttmbr->bindParam(6, $objectifposte);
	$inserttmbr->bindParam(7, $niveaudetude);
	$inserttmbr->bindParam(8, $domainedetude);
	$inserttmbr->bindParam(9, $competences);
	$inserttmbr->bindParam(10, $experience);
	$inserttmbr->bindParam(11, $salaire);
	$inserttmbr->bindParam(12, $avantages);
	$inserttmbr->execute();

	echo("alert('bien envoyé')<br>");
}

?>
<?php

function getMissions(){
	$storage_missions = array();
	for ($i=1; $i <= $_POST['missions_number'] ; $i++) {
		$number = strval($i);
		$temp_array = array();
		array_push($temp_array,	htmlspecialchars($_POST['mission'.$number]));
		array_push($storage_missions, $temp_array);
	}
	return serialize($storage_missions);
}

function getObjectifs(){
	$storage_objectifs = array();
	for ($i=1; $i <= $_POST['objectifs_number'] ; $i++) {
		$number = strval($i);
		$temp_array = array();
		array_push($temp_array,	htmlspecialchars($_POST['objectif'.$number]));
		array_push($storage_objectifs, $temp_array);
	}
	return serialize($storage_objectifs);
}

function getCompetences(){
	$storage_competences = array();
	for ($i=1; $i <= $_POST['competences_number'] ; $i++) {
		$number = strval($i);
		$temp_array = array();
		array_push($temp_array,	htmlspecialchars($_POST['nomcompetence'.$number]), htmlspecialchars($_POST['niveaucompetence'.$number]));
		array_push($storage_competences, $temp_array);
	}
	return serialize($storage_competences);
}

function getAvantages(){
	$storage_avantages = array();
	for ($i=1; $i <= $_POST['avantages_number'] ; $i++) {
		$number = strval($i);
		$temp_array = array();
		array_push($temp_array,	htmlspecialchars($_POST['nomavantage'.$number]));
		array_push($storage_avantages, $temp_array);
	}
	return serialize($storage_avantages);
}

?>


<form class="formulaire" action="deposeroffre.php" method="post">
		<legend><h1>Bienvenue sur notre formulaire destiné aux offreurs d'emplois </h1></legend>
		<fieldset>

			<h2>Informations globales</h2>

            <div class="form-group">            
                <label for="nom">Nom de l'offre:</label><br/>
                <input type="text" name="nom" required /><br/>
            </div>
            <div class="form-group">
                <label for="descriptif">Descriptif :</label><br/>
                <textarea type="text" name="descriptif" rows="8" cols="80" required></textarea><br/>
            </div>
            <div class="form-group">
                <label for="typecontrat">Type de contrat :</label><br/>
                <input type="text" name="typecontrat" required /><br/>
            </div>
            <div class="form-group">
                <label for="localisationposte">Lieu de travail :</label><br/>
                <input type="text" name="localisationposte" required /><br/>
            </div>
		</fieldset>

		<fieldset>

			<h2>Informations spécifiques</h2>

			<label for="niveaudetude">Niveau d'étude requis :</label><br/>
			<input type="text" name="niveaudetude" required /><br/>

			<label for="domainedetude">Domaine d'étude :</label><br/>
			<input type="text" name="domainedetude" required /><br/>

			<label for="experience">Experience :</label><br/>
			<input type="text" name="experience" required /><br/>

			<label for="salaire">Salaire :</label><br/>
			<input type="text" name="salaire" required /><br/>
		</fieldset>

		<fieldset>
			<h2>Missions</h2>
			<label for="missions">Ajouter des missions auxquelles le salarié devra participé :</label><br/>
			<div class="missions">
			</div>
			<button id="missions_button" type="button" name="button">+</button><br/>
			<input id="missions_number" name="missions_number" type="hidden" value="0">
		</fieldset>

		<fieldset>
			<h2>Objectifs du poste</h2>
			<label for="objectifs">Ajouter les objectifs de ce poste par rapport à l'entreprise :</label><br/>
			<div class="objectifs">
			</div>
			<button id="objectifs_button" type="button" name="button">+</button><br/>
			<input id="objectifs_number" name="objectifs_number" type="hidden" value="0">
		</fieldset>

		<fieldset>
			<h2>Compétences</h2>
			<label for="competences">Ajouter des compétences requises au poste que vous proposez :</label><br/>
			<div class="competences">
			</div>
			<button id="competences_button" type="button" name="button">+</button><br/>
			<input id="competences_number" name="competences_number" type="hidden" value="0">
		</fieldset>

		<fieldset>
			<h2>Avantages</h2>
			<label for="avantages">Ajouter des avantages auxquels le salarié pourra bénéficier :</label><br/>
			<div class="avantages">
			</div>
			<button id="avantages_button" type="button" name="button">+</button><br/>
			<input id="avantages_number" name="avantages_number" type="hidden" value="0">
		</fieldset>

		<script type="text/javascript">

		var i = 1;
		$('#missions_button').click(function(){
			$('.missions').append("<fieldset style='margin:10px;width:250px;float:left'>Mission "+i+"<div class='missions_container'"+i+"><label for='mission"+i+"'>Description de la mission :</label><br/><input type='text' name='mission"+i+"' required /><br/></div></fieldset>");
			i++;
			$('#missions_number').val(i-1);
		});

		var j = 1;
		$('#objectifs_button').click(function(){
			$('.objectifs').append("<fieldset style='margin:10px;width:250px;float:left'>Objectif "+j+"<div class='objectifs_container'"+j+"><label for='objectif"+j+"'>Decription de l'objectif :</label><br/><input type='text' name='objectif"+j+"' required /><br/></div></fieldset>");
			j++;
			$('#objectifs_number').val(j-1);
		});

		var k = 1;
		$('#competences_button').click(function(){
			$('.competences').append("<fieldset style='margin:10px;width:250px;float:left'>Compétence "+k+"<div class='competence_container'"+k+"><label for='nomcompetence"+k+"'>Nom de la competence :</label><br/><input type='text' name='nomcompetence"+k+"' required /><br/><label for='niveaucompetence"+k+"'>Niveau de la compétence :</label><br/><input type='text' name='niveaucompetence"+k+"' required /><br/></div></fieldset>");
			k++;
			$('#competences_number').val(k-1);
		});

		var l = 1;
		$('#avantages_button').click(function(){
			$('.avantages').append("<fieldset style='margin:10px;width:250px;float:left'>Avantage : "+l+"<div class='avantages_container'"+l+"><label for='nomavantage"+l+"'>Description de l'avantage :</label><br/><input type='text' name='nomavantage"+l+"' required /><br/></div></fieldset>");
			l++;
			$('#avantages_number').val(l-1);
		});
		</script>
		<input type="submit" name="form_offre">
	</form>



<?php
    require_once('inc/footer.php');
?>