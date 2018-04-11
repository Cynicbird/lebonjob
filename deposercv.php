<?php
/**
 * Project Name : LeBonJob
 * Author : Thomas
 */
require_once('inc/functions.php');
require_once('inc/db.php');
logged_only();
if(isset($_POST['form_cv'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $datenaissance = htmlspecialchars($_POST['datenaissance']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $codepostal = htmlspecialchars($_POST['codepostal']);
    $courriel = htmlspecialchars($_POST['courriel']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $portfolio = htmlspecialchars($_POST['portfolio']);
  
    $formations = getFormations();
    $competences = getCompetences();
    $experiences = getExperiences();
    $centreinteret = getCentresInterets();
    $langues = getLangues();
  
    $posterecherche = htmlspecialchars($_POST['posterecherche']);
    $typecontrat = htmlspecialchars($_POST['typecontrat']);
    $duree = htmlspecialchars($_POST['duree']);
  
      $inserttmbr = $pdo->prepare('INSERT INTO lbj_cv(nom, prenom, datenaissance, adresse, ville, codepostal, courriel, telephone, portfolio, formations, competences, experiences, centreinteret, langues, posterecherche, typecontrat, duree) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
      $inserttmbr->execute([
        $nom, $prenom, $datenaissance, $adresse, $ville, $codepostal, $courriel, $telephone, $portfolio, $formations, $competences, $experiences, $centreinteret, $langues, $posterecherche, $typecontrat, $duree ]);

        $_SESSION['flash']['success'] = "Votre CV a bien été publié.";
        header('Location: account.php');
        exit();
  }
  require_once('inc/functions.php');
  require_once('inc/header.php');
  
  ?>

    <body>

<?php
  function getFormations(){
      $storage_formations = array();
      for ($i=1; $i <= $_POST['formations_number'] ; $i++) {
          $number = strval($i);
          $temp_array = array();
          array_push($temp_array,	htmlspecialchars($_POST['diplome'.$number]), htmlspecialchars($_POST['periode'.$number]),  htmlspecialchars($_POST['etablissement'.$number]), htmlspecialchars($_POST['lieu'.$number]));
          array_push($storage_formations, $temp_array);
      }
      var_dump($storage_formations);
      return serialize($storage_formations);
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
  
  function getExperiences(){
      $storage_experiences = array();
      for ($i=1; $i <= $_POST['experiences_number'] ; $i++) {
          $number = strval($i);
          $temp_array = array();
          array_push($temp_array,	htmlspecialchars($_POST['nomexperience'.$number]), htmlspecialchars($_POST['entreprise'.$number]), htmlspecialchars($_POST['mission'.$number]), htmlspecialchars($_POST['duree'.$number]));
          array_push($storage_experiences, $temp_array);
      }
      return serialize($storage_experiences);
  }
  
  function getCentresInterets(){
      $storage_centresinterets = array();
      for ($i=1; $i <= $_POST['centreinteret_number'] ; $i++) {
          $number = strval($i);
          $temp_array = array();
          array_push($temp_array,	htmlspecialchars($_POST['nomcentreinteret'.$number]));
          array_push($storage_centresinterets, $temp_array);
      }
      return serialize($storage_centresinterets);
  }
  
  function getLangues(){
      $storage_langues = array();
      for ($i=1; $i <= $_POST['langues_number']; $i++) {
          $number = strval($i);
          $temp_array = array();
          array_push($temp_array,	htmlspecialchars($_POST['nomlangue'.$number]));
          array_push($storage_langues, $temp_array);
      }
      return serialize($storage_langues);
  }
  ?>


            <form class="formaulaire" action="deposercv.php" method="post">
                <h1>Bienvenue sur notre formulaire destiné aux demandeurs d'emploi </h1>
                <br>
                <fieldset>

                    <h2>Informations personnelles</h2>

                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prenom :</label>
                        <input type="text" name="prenom" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="date">Date de naissance :</label>
                        <input type="date" size="8" name="datenaissance" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse :</label>
                        <input type="text" name="adresse" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="adresse">Ville :</label>
                        <input type="text" name="ville" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="adresse">Code postal :</label>
                        <input type="text" name="codepostal" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="courriel">Courriel :</label>
                        <input type="text" name="courriel" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="telephone">Télephone :</label>
                        <input type="text" name="telephone" class="form-control" required />
                    </div>



                    <div class="form-group">
                        <label for="portfolio">Portfolio :</label>
                        <br/>
                        <input type="text" name="portfolio" class="form-control" required />
                        <br/>
                    </div>

                </fieldset>

                <fieldset>
                    <h2>Formations</h2>

                    <label for="formations">Ajouter des formations :</label>
                    <div class="formations">
                    </div>
                    <button id="formations_button" type="button" name="button">+</button>
                    <br/>
                    <input id="formations_number" name="formations_number" type="hidden" value="0">
                </fieldset>

                <fieldset>
                    <h2>Compétences</h2>
                    <label for="competences">Ajouter des compétences :</label>
                    <br/>
                    <div class="competences">
                    </div>
                    <button id="competences_button" type="button" name="button">+</button>
                    <br/>
                    <input id="competences_number" name="competences_number" type="hidden" value="0">
                </fieldset>

                <fieldset>
                    <h2>Experiences</h2>
                    <label for="experiences">Ajouter des experiences :</label>
                    <br/>
                    <div class="experiences">
                    </div>
                    <button id="experiences_button" type="button" name="button">+</button>
                    <br/>
                    <input id="experiences_number" name="experiences_number" type="hidden" value="0">
                </fieldset>

                <fieldset>
                    <h2>Centre d'intêret</h2>
                    <label for="centresinterets">Ajouter des centres d'interet :</label>
                    <br/>
                    <div class="centresinterets">
                    </div>
                    <button id="centreinteret_button" type="button" name="button">+</button>
                    <br/>
                    <input id="centreinteret_number" name="centreinteret_number" type="hidden" value="0">
                </fieldset>

                <fieldset>
                    <h2>Langues</h2>
                    <label for="langues">Ajouter des langues :</label>
                    <br/>
                    <div class="langues">
                    </div>
                    <button id="langues_button" type="button" name="button">+</button>
                    <br/>
                    <input id="langues_number" name="langues_number" type="hidden" value="0">
                </fieldset>

                <script type="text/javascript">
                    var i = 1;
                    $('#formations_button').click(function () {
                        $('.formations').append(
                            "<fieldset style='margin: 10px; width: 250px; float: left; border: solid 0.2px lightgrey; padding: 2%; background-color: white;'>Formation " + i +
                            "<div class='formation_container'" + i + "><label for='diplome" + i +
                            "'>Diplome :</label><br/><input type='text' name='diplome" + i +
                            "' required /><br/><label for='periode" + i +
                            "'>Période :</label><br/><input type='text' name='periode" + i +
                            "' required /><br/><label for='etablissement" + i +
                            "'>Etablissement :</label><br/><input type='text' name='etablissement" + i +
                            "' required /><br/><label for='lieu" + i +
                            "'>Lieu :</label><br/><input type='text' name='lieu" + i +
                            "' required /><br/></div></fieldset>")
                        i++;
                        $('#formations_number').val(i - 1);
                    });

                    var j = 1;
                    $('#competences_button').click(function () {
                        $('.competences').append(
                            "<fieldset style='margin: 10px; width: 250px; float: left; border: solid 0.2px lightgrey; padding: 2%; background-color: white;'>Compétence " + j +
                            "<div class='competence_container'" + j + "><label for='nomcompetence" + j +
                            "'>Nom de la competence :</label><br/><input type='text' name='nomcompetence" +
                            j + "' required /><br/><label for='niveaucompetence" + j +
                            "'>Niveau Competence :</label><br/><input type='text' name='niveaucompetence" +
                            j + "' required /><br/></div></fieldset>")
                        j++;
                        $('#competences_number').val(j - 1);
                    });

                    var k = 1;
                    $('#experiences_button').click(function () {
                        $('.experiences').append(
                            "<fieldset style='margin: 10px; width: 250px; float: left; border: solid 0.2px lightgrey; padding: 2%; background-color: white;'>Experience " + k +
                            "<div class='experience_container'" + k + "><label for='nomexperience" + k +
                            "'>Nom de l'experience :</label><br/><input type='text' name='nomexperience" +
                            k + "' required /><br/><label for='entreprise" + k +
                            "'>Entreprise :</label><br/><input type='text' name='entreprise" + k +
                            "' required /><br/><label for='mission" + k +
                            "'>Mission :</label><br/><input type='text' name='mission" + k +
                            "' required /><br/><label for='duree" + k +
                            "'>Durée :</label><br/><input type='text' name='duree" + k +
                            "' required /><br/></div></fieldset>")
                        k++;
                        $('#experiences_number').val(k - 1);
                    });

                    var l = 1;
                    $('#centreinteret_button').click(function () {
                        $('.centresinterets').append(
                            "<fieldset style='margin: 10px; width: 250px; float: left; border: solid 0.2px lightgrey; padding: 2%; background-color: white;'>Centre d'interêt " + l +
                            "<div class='centresinterets_container'" + l + "><label for='nomcentreinteret" +
                            l +
                            "'>Nom de votre centre d'interet :</label><br/><input type='text' name='nomcentreinteret" +
                            l + "' required /><br/></div></fieldset>")
                        l++;
                        $('#centreinteret_number').val(l - 1);
                    });

                    var m = 1;
                    $('#langues_button').click(function () {
                        $('.langues').append("<fieldset style='margin: 10px; width: 250px; float: left; border: solid 0.2px lightgrey; padding: 2%; background-color: white;'>Langue " + m +
                            "<div class='langues_container'" + m + "><label for='nomlangue" + m +
                            "'>Nom de la langue :</label><br/><input type='text' name='nomlangue" + m +
                            "' required /><br/></div></fieldset>")
                        m++;
                        $('#langues_number').val(m - 1);
                    });
                </script>

                <fieldset>
                <br>
                    <h2>Poste recherché</h2>
                    
                    <div class="form-group">
                        <label for="posterecherche">Nom du poste recherché :</label>
                        <input type="text" name="posterecherche" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="typecontrat">Type du contrat :</label>
                        <input type="text" name="typecontrat" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="duree">Durée du contrat recherché :</label>
                        <input type="text" name="duree" class="form-control" required />
                    </div>
                </fieldset>

                <input type="submit" name="form_cv">
            </form>
<?php
    require_once('inc/footer.php');
?>