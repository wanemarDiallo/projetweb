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
      $mdp = $_POST['mdp'];
      if(array_key_exists($login, $table_inscris))
      {
        foreach ($table_inscris as $clef => $value) {
          if($clef===$login && $value['mdp']===$mdp)
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

    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $mail = $_POST['mail'];

    if(!control_login($login)) echo "valuer login non valide";
    else if(!control_mdp($mdp)) echo "valuer mdp non valide il faut au moins 8 caractères";
    else if(!control_name($nom, $prenom)) echo "le nom ou prenom saisie n'est pas valide";
    else if(!control_sexe($sexe)) echo "veuillez renseignez le champ sexe";
    else if(!control_mail($mail)) echo "mail non valide";
    else
    {
        if(!array_key_exists($login, $table_inscris))//verification s'il n'existe pas un login pareil
        $inscris = array(
                          $login => array(
                                      'mdp'=>password_hash($mdp, PASSWORD_DEFAULT),
                                      'nom'=>$nom,
                                      'prenom'=>$prenom,
                                      'sexe'=>$sexe,
                                      'mail'=>$mail,
                                      'date' => $_POST['dateNaiss'],
                                      'cdp' =>  $_POST['cdp'],
                                      'ville' => $_POST['ville'],
                                      'tel' =>   $_POST['num']
                          )
                        );
        $table_inscris +=$inscris;//ajout du nouveau utilisateur sur la table des inscris
        file_put_contents($filename, '<?php $table_inscris = '.var_export($table_inscris, true).'; ?>', LOCK_EX);
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
    if(!preg_match('/^[a-z]+$/i', trim($data_name))) return FALSE;
    else if(!preg_match('/^[a-z-]+$/i', trim($data_lastName))) return FALSE;
    else return TRUE;
  }
  function control_sexe($data_sexe){
    if(strcmp(strtolower($data_sexe), 'homme')!==0 && strcmp(strtolower($data_sexe), 'femme')!==0) return FALSE;
    else return TRUE;
  }
  function control_mail($data_mail){
    if(!preg_match('/^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/', strtolower(trim($data_mail)))) return FALSE;
    else return TRUE;
  }

  /*
  function control_date($data_date){

  }
  function control_cdp($data_cdp){

  }
  function control_ville($data_ville){

  }
  function control_tel($data_tel){

  }*/
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
          <table>
            <tr>
      				<td colspan="2" class="colspan">
                	<select name="sexe" id="sexe">
                  <option value="">- sexe -</option>
      						<option value="Homme">Homme</option>
      						<option value="Femme">Femme</option>
      					</select>
              </td>
            </tr>
            <tr>
              <td>
    					  <input type="text" name="login" id="login" placeholder="<?php if(!isset($_POST['login'])) echo "Login";?>">
              </td>
              <td>
    					  <input type="password" name="mdp" placeholder="<?php if(!isset($_POST['mdp'])) echo "Mot de passe";?>">
              </td>
            <tr>
            <tr>
              <td>
  					     <input type="text" name="nom" id="nom" placeholder="<?php if(!isset($_POST['nom'])) echo "Nom";?>">
              </td>
            <td>
  					       <input type="text" name="prenom" placeholder="<?php if(!isset($_POST['prenom'])) echo "Prénom";?>">
            </td>
            </tr>

            <tr>
              <td>
  					     <input type="text" name="cdp" placeholder="<?php if(!isset($_POST['cdp'])) echo "Code postal";?>">
              </td>
              <td>
  					       <input type="text" name="ville" placeholder="<?php if(!isset($_POST['ville'])) echo "Ville";?>">
              </td>
            </tr>

            <tr>
  					 <td colspan="2" class="colspan">
               <input type="email" name="mail" placeholder="<?php if(!isset($_POST['mail'])) echo "E-mail : @domaine.com";?>">
             </td>
            </tr>

            <tr>
  					<td colspan="2" class="colspan">
              <input type="text" name="dateNaiss" placeholder="<?php if(!isset($_POST['dateNaiss'])) echo "Date naissance : 10/10/2010";?>">
            </td>
          </tr>

            <tr>
  				      <td colspan="2" class="colspan">
            	     <input type="text" name="num" value="<?php if(isset($_POST['num']) && $_POST['num']!='') echo $_POST['num']?>" placeholder="<?php if(!isset($_POST['num'])) echo "Téléphone : 0753164581";?>">
                </td>
            <tr>

            <tr>
  				     <td colspan="2" class="buttonSubmit">
                  <!--<button id="submit">Envoie</button>-->
            	     <input type="submit" name="envoie" id="ins_submit" value="Envoie" />
              </td>
            </tr>
          </table>
				</form>
			</div>

      <!--Formulaire de connexion-->
      <div id="formulaireConnexion">
        <p class="text_connexion">Vous êtes déjà incris, renseignez votre login et mot de passe pour vous connecter</p>
        <form action="#" method="post" name="connexion">
          <table>
            <tr>
              <td>
                <input type="text" name="login" value="<?php if(isset($_POST['login']) && $_POST['login']!='') echo $_POST['login']?>" placeholder="<?php if(!isset($_POST['login'])) echo "Login";?>">
              </td>
              <td>
                <input type="password" name="mdp">
              </td>
            </tr>
            <tr>
              <td colspan="2" class="buttonSubmit">
                <input type="submit" name="connecter" value="connecion"/>
              </td>
            </tr>
          </table>
        </form>
      </div>
		</main>

    <!--Le <footer>-->
    <script src="jquery-3.3.1.min.js"></script>
    <script src="verification_formulaire.js"></script>
	</body>
	</html>
	<?php
?>
