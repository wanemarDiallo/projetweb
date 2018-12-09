<?php
session_start();
  include "miseAjourPhp.php";///pour la mise à jour
  /*Destruction de la session du menu url (le lien absolu)*/
  if(isset($_SESSION['chemin']) && isset($_SESSION['login'])){
    $_SESSION['chemin'] = array();
    session_destroy();
  }
  /////////////////////////////////////////////////////
  $errorMg = '';
  $el = 0;
  /*Partie table des inscris enregistré sur un fichier php*/
  $filename = "lesInscris.php";
  include('lesInscris.php');
  if(!isset($table_inscris)) $table_inscris = array();
/////////////////////////////////////////////////////////

  /*Enregistrement au cour de l'inscription*/
  if(isset($_POST['envoie'])){
    if(!isset($_POST['sexe']) || !control_sexe($_POST['sexe'])) { $errorMg = "veuillez renseignez le champ sexe"; $el = 1;}
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

        if(!control_login($login)) { $el = 2; $errorMg = "Login non valide, essayez un login alpha-Numérique (exemple: abc24)";}
        else if(!control_mdp($mdp) || strcmp($mdp,$mdp_conf)!==0) { $el = 3; $errorMg = "Le mot de passe non valide ou non conforme, **il faut au moins 8 caractères";}
        else if(!control_name($nom, $prenom)) { $el = 4; $errorMg = "les données(nom ou prénom) ne sont pas valident.";}

        else if(!control_mail($mail)) { $el = 5; $errorMg = "Votre e-mail n'est pas valide.";}
        else if(!control_cdp($cdp)) { $el = 6; $errorMg = "le code postal doit être numerique et 5 chiffres";}
        else if(!control_date($dateNaiss)) {$el=7; $errorMg ="Date de naissance non valide, exemple : 10/10/1998";}
        else if(!control_ville($ville)) {$el = 8; $errorMg = "Le nom de la ville n'est pas valide";}
        else if(!control_tel($tel)) {$el = 9; $errorMg = "Numéro de Téléphone non valide";}
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
    include 'functions_verif.php';
	?>

  <!--page d'inscription et connexion -->
	<!DOCTYPE html>
	<html>
	<head>
		<title>Cocktail</title>
		<meta charset="uft-8"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/x-icon" href="photos/icon.png" />
    <style>
      footer{
        background-color:#424558;
        color:white;
        padding:10px;
        margin-top:10px;
      }
      footer p{
        width:50%;
        margin:0 auto;
        padding:5px;
        text-align:center;
        font-size:0.8em;
      }
      .siError{
        width: 40%;
      }
      .span_connexion{
        width:20%;
      }
    </style>
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
            <p class="error_sex" style="width:60%; padding:5px; color: red;"><?php if(strcmp($errorMg,'')!==0 && $el===1) echo $errorMg;?></p>
          </div>

          <div class="login_ins inscription">
            <span class="span_ins span_login">Login</span>
            <label for="login_ins" class="label_ins">Login</label>
            <input type="text" name="login" id="login_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el===2) echo $errorMg;?></span>
          </div>

          <div class="mdp_ins inscription">
            <span class="span_ins span_mdp">Password</span>
            <label for="mdp_ins" class="label_ins">Password</label>
            <input type="password" name="mdp" id="mdp_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el ===3) echo $errorMg;?></span>
          </div>

          <div class="mdp_ins_conf inscription">
            <span class="span_ins span_mdp_conf">Password</span>
            <label for="mdp_ins_conf" class="label_ins">Confirmez votre password</label>
            <input type="password" name="mdp_conf" id="mdp_ins_conf">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el ===3) echo $errorMg;?></span>
          </div>

          <div class="nom_ins inscription">
            <span class="span_ins span_nom">Nom</span>
            <label for="nom_ins" class="label_ins">Nom</label>
            <input type="text" name="nom" id="nom_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el===4) echo $errorMg;?></span>
          </div>

          <div class="prenom_ins inscription">
            <span class="span_ins span_prenom">Prénom</span>
            <label for="prenom_ins" class="label_ins">Prénom</label>
            <input type="text" name="prenom" id="prenom_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el===4) echo $errorMg;?></span>
          </div>

          <div class="mail_ins inscription">
            <span class="span_ins span_mail">email</span>
            <label for="mail_ins" class="label_ins">email</label>
            <input type="email" name="mail" id="mail_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el === 5) echo $errorMg;?></span>
          </div>

          <div class="dateNaiss_ins inscription">
            <span class="span_ins span_date">Né(e) le</span>
            <label for="dateNaiss_ins" class="label_ins label_date">Exemple:jj/mm/aaaa</label>
            <input type="text" name="dateNaiss" id="dateNaiss_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el === 6) echo $errorMg;?></span>
          </div>

          <div class="cdp_ins inscription">
            <span class="span_ins span_cdp">C.Postal</span>
            <label for="cdp_ins" class="label_ins label_cdp">Code postal</label>
            <input type="text" name="cdp" id="cdp_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el === 7) echo $errorMg;?></span>
          </div>

          <div class="ville_ins inscription">
            <span class="span_ins span_ville">Ville</span>
            <label for="ville_ins" class="label_ins">Ville</label>
            <input type="text" name="ville" id="ville_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el === 8) echo $errorMg;?></span>
          </div>

          <div class="tel_ins inscription">
            <span class="span_ins span_tel">Tél</span>
            <label for="tel_ins" class="label_ins label_tel">Téléphone</label>
            <input type="tel" name="tel" id="tel_ins">
            <span class="siError"><?php if(strcmp($errorMg,'')!==0 && $el===9) echo $errorMg;?></span>
          </div>

          <div class="submit_ins">
            <input type="submit" name="envoie"  value="Envoyer">
          </div>
				</form>
			</div>

      <!--Formulaire de connexion-->
      <div id="formulaireConnexion">
        <p class="text_connexion">Vous êtes déjà incris, renseignez votre login et mot de passe pour vous connecter</p>
        <form action="connexion.php" method="post" id="connexion">

          <div class="login connexion">
            <span class="span_connexion span_login">Login</span>
            <label for="login" class="label_connexion">Login</label>
            <input type="text" name="login" id="login">
          </div>

          <div class="mdp connexion">
            <span class="span_connexion span_mdp">Password</span>
            <label for="mdp" class="label_connexion">Password</label>
            <input type="password" name="mdp" id="mdp">
          </div>

          <div class="submit_connexion">
            <input type="submit" name="connecter" id="connecter" value="connexion"/>
          </div>

        </form>

        <p class="mdp_oubier">
          <a href="modifPassword.php">Mot de passe oublier ?</a>
        </p>

        <p class="siError err_log err_mdp" style="padding:10px; text-align:center; width:80%; margin:20px auto;"></p>
      </div>
		</main>

    <!--Le <footer>-->
    <?php include "footer.php";?>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="verification_formulaire.js"></script>
	</body>
	</html>
	<?php
?>
