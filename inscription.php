<?php
session_start();
  /*Destruction de la session du menu url (le lien absolu)*/
  if(isset($_SESSION['chemin']) && isset($_SESSION['login'])){
    $_SESSION['chemin'] = array();
    session_destroy();
  }
  /////////////////////////////////////////////////////

  /*Partie table des inscris enregistré sur un fichier php*/
  $filename = "lesInscris.php";
  include('lesInscris.php');
  if(!isset($table_inscris)) $table_inscris = array();
/////////////////////////////////////////////////////////

  /*test connexion */
  if(isset($_POST['connecter'])){
      $login = $_POST['login'];
      $mdp = $_POST['mdp']; // password_hash($_POST['mdp'], PASSWORD_DEFAULT);
      if(array_key_exists($login, $table_inscris))
      {
        foreach ($table_inscris as $clef => $value) {
          if(strcmp($clef,$login)===0 && password_verify($mdp, $value['mdp']))
          {
            $_SESSION['login'] = array($clef => $value);
            header('Location:index.php');
            //break;
          }
        }
      }
      else {
        echo "vous êtes pas inscris, veuile <br>";
      }
  }
//////////////////////////////////////////////////////
/////////////////////////////////////////////////////

  /*Enregistrement au cour de l'inscription*/
  if(isset($_POST['envoie'])){
    if(!isset($_POST['sexe']) || !control_sexe($_POST['sexe'])) echo "veuillez renseignez le champ sexe";
    else
    {
      //  echo $_POST['sexe'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $mdp_conf = $_POST['mdp_conf'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];
        $cdp = $_POST['cdp'];
        $dateNaiss = $_POST['dateNaiss'];
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];

        $errorMg = "";

        if(!control_login($login)) $errorMg = "Login non valide, alpha-Numérique son valide (exemple: abc24)";
        else if(!control_mdp($mdp) || strcmp($mdp,$mdp_conf)!==0) $errorMg = "Mot de passe non valide il faut au moins 8 caractères";
        else if(!control_name($nom, $prenom)) echo "le nom ou prenom saisie n'est pas valide";
      //  else if(!control_sexe($sexe)) echo "veuillez renseignez le champ sexe";
        else if(!control_mail($mail)) echo "mail non valide";
        else if(!control_cdp($cdp)) echo "cdp non valide";
        else if(!control_date($dateNaiss)) echo "date de naissance non valide, exemple : 10/10/1998";
        else if(!control_ville($ville)) echo "le nom de la ville non valide";
        else if(!control_tel($tel)) echo "numéro de Téléphone non valide";
        else
        {
            if(!array_key_exists($login, $table_inscris))//verification s'il n'existe pas un login pareil
            $inscris = array(
                              $login => array(
                                          'mdp'=>password_hash($mdp, PASSWORD_DEFAULT),
                                          'nom'=>$nom,
                                          'prenom'=>$prenom,
                                          'sexe'=>$_POST['sexe'],
                                          'mail'=>$mail,
                                          'date' => $dateNaiss,
                                          'cdp' =>  $cdp,
                                          'ville' => $ville,
                                          'tel' =>   $tel
                              )
                            );
            $table_inscris +=$inscris;//ajout du nouveau utilisateur sur la table des inscris
            file_put_contents($filename, '<?php $table_inscris = '.var_export($table_inscris, true).'; ?>', LOCK_EX);
        }

      }
    }

  ////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////
  function control_login($data_login){
    if(!preg_match('/^[a-z]+[0-9]*$/i', trim($data_login)))
      return FALSE;
    else return TRUE;
  }
  function control_mdp($data_mdp){
    $taille = trim(strlen($data_mdp));
    if(($taille < 8)) return FALSE;
    else return TRUE;
  }
  function control_name($data_name, $data_lastName){
    if(!preg_match('/^[a-z-]+$/i', trim($data_name))) return FALSE;
    else if(!preg_match('/^[a-z-]+$/i', trim($data_lastName))) return FALSE;
    else return TRUE;
  }
  function control_sexe($data_sexe){
    if(strcmp(strtolower($data_sexe), 'homme')!==0 && strcmp(strtolower($data_sexe), 'femme')!==0) return FALSE;
    else return TRUE;
  }
  function control_mail($data_mail){
    if(!preg_match('/^[a-z0-9.-]+@[a-z0-9.-]{2,}[.]{1}[a-z]{2,3}$/', strtolower(trim($data_mail)))) return FALSE;
    else return TRUE;
  }
  function control_cdp($data_cdp){
    if(!preg_match('/^[0-9]{5}$/', strtolower(trim($data_cdp)))) return FALSE;
    else return TRUE;
  }
  function control_date($data_date){
    if(!preg_match('/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/', trim($data_date))) return FALSE;
    else
    {
      list($jour, $mois, $annee) = explode('/', $data_date);
      if($mois >= 1 && $mois <= 12){
        if(($mois != 2 && $jour >= 1 && $jour <= 31) || ($mois == 2 && $jour >= 1 && $jour <= 29)){
          if($annee >= 1 && $annee <= 32767){
            if(checkdate($mois, $jour, $annee)) return TRUE;
            else return FALSE;
          }
        else return FALSE;
        }
        else return FALSE;
      }
      else return FALSE;
    }
  }
  function control_ville($data_ville){//faut traiter les accents (éè)
    if(!preg_match('/^[a-z-\s]+$/', strtolower(trim($data_ville)))) return FALSE;
    else return TRUE;
  }
  function control_tel($data_tel){
    if(!preg_match('/^[0][1-9]{9}$/', trim($data_tel))) return FALSE;
    else return TRUE;
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////

	?>

  <!--page d'inscription et connexion -->
	<!DOCTYPE html>
	<html>
	<head>
		<title>projet</title>
		<meta charset="uft-8"/>
    <link rel="stylesheet" href="style.css"/>
	</head>
	<body>
    <!--le header -->
    <?php include 'header.php'; ?>
    <!--Le main-->
		<main class="main_inscription">
			<div id="formulaireIns">
				<form action="" method="post" id="inscription">

          <div class="sexe_ins inscription">
            <p>
              <input type="radio" name="sexe" id="sexe_h" value="Homme">
              <label for="sexe_h"><span></span>M.</label>
            </p>
            <p>
              <input type="radio" name="sexe" id="sexe_f" value="Femme">
              <label for="sexe_f"><span></span>Mm</label>
            </p>
          </div>

          <div class="login_ins inscription">
            <span class="span_ins span_login">Login</span>
            <label for="login_ins" class="label_ins">Login</label>
            <input type="text" name="login" id="login_ins">
            <span class="siError"></span>
          </div>

          <div class="mdp_ins inscription">
            <span class="span_ins span_mdp">Password</span>
            <label for="mdp_ins" class="label_ins">Password</label>
            <input type="password" name="mdp" id="mdp_ins">
            <span class="siError"></span>
          </div>

          <div class="mdp_ins_conf inscription">
            <span class="span_ins span_mdp_conf">Password</span>
            <label for="mdp_ins_conf" class="label_ins">Confirmez votre password</label>
            <input type="password" name="mdp_conf" id="mdp_ins_conf">
            <span class="siError"></span>
          </div>

          <div class="nom_ins inscription">
            <span class="span_ins span_nom">Nom</span>
            <label for="nom_ins" class="label_ins">Nom</label>
            <input type="text" name="nom" id="nom_ins">
            <span class="siError"></span>
          </div>

          <div class="prenom_ins inscription">
            <span class="span_ins span_prenom">Prénom</span>
            <label for="prenom_ins" class="label_ins">Prénom</label>
            <input type="text" name="prenom" id="prenom_ins">
            <span class="siError"></span>
          </div>

          <div class="mail_ins inscription">
            <span class="span_ins span_mail">email</span>
            <label for="mail_ins" class="label_ins">email</label>
            <input type="email" name="mail" id="mail_ins">
            <span class="siError"></span>
          </div>

          <div class="dateNaiss_ins inscription">
            <span class="span_ins span_date">Né(e) le</span>
            <label for="dateNaiss_ins" class="label_ins label_date">Exemple:jj/mm/aaaa</label>
            <input type="text" name="dateNaiss" id="dateNaiss_ins">
            <span class="siError"></span>
          </div>

          <div class="cdp_ins inscription">
            <span class="span_ins span_cdp">C.Postal</span>
            <label for="cdp_ins" class="label_ins label_cdp">Code postal</label>
            <input type="text" name="cdp" id="cdp_ins">
            <span class="siError"></span>
          </div>

          <div class="ville_ins inscription">
            <span class="span_ins span_ville">Ville</span>
            <label for="ville_ins" class="label_ins">Ville</label>
            <input type="text" name="ville" id="ville_ins">
            <span class="siError"></span>
          </div>

          <div class="tel_ins inscription">
            <span class="span_ins span_tel">Tél</span>
            <label for="tel_ins" class="label_ins label_tel">Téléphone</label>
            <input type="text" name="tel" id="tel_ins">
            <span class="siError"></span>
          </div>

          <div class="submit_ins">
            <input type="submit" name="envoie" value="Envoyer">
          </div>
				</form>
			</div>

      <!--Formulaire de connexion-->
      <div id="formulaireConnexion">
        <p class="text_connexion">Vous êtes déjà incris, renseignez votre login et mot de passe pour vous connecter</p>
        <form action="" method="post">

          <div class="login connexion">
            <span class="span_connexion span_login">Login</span>
            <label for="login" class="label_connexion">Login</label>
            <input type="text" name="login" id="login">
            <span class="siError"></span>
          </div>

          <div class="mdp connexion">
            <span class="span_connexion span_mdp">Password</span>
            <label for="mdp" class="label_connexion">Password</label>
            <input type="password" name="mdp" id="mdp">
            <span class="siError"></span>
          </div>

          <div class="submit_connexion">
            <input type="submit" name="connecter" value="connexion"/>
          </div>

        </form>

        <p class="mdp_oubier">
          <a href="#">Mot de passe oublier ?</a>
        </p>

      </div>
		</main>

    <!--Le <footer>-->
    <script src="jquery-3.3.1.min.js"></script>
    <script src="verification_formulaire.js"></script>
	</body>
	</html>
	<?php
?>
