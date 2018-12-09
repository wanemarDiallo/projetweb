<?php
session_start();

$filename = "lesInscris.php";
include('lesInscris.php');

$login = key($_SESSION['login']);//on reccupère le login du user
$error = '';
if(isset($_POST['envoie'])){
  if(isset($_POST['nom']) && !empty($_POST['nom'])){
    if(!control_nom($_POST['nom'])) $error = "Nom non valide.";
    else $_SESSION ['login'][$login]['nom'] = $_POST['nom'];
  }
  if(isset($_POST['prenom']) && !empty($_POST['prenom'])){
    if(!control_lastName($_POST['prenom'])) $error = 'Prénom non valide.';
    else $_SESSION ['login'][$login]['prenom'] = $_POST['prenom'];
  }
  if(isset($_POST['mail']) && !empty($_POST['mail'])){
    if(!control_mail($_POST['mail'])) $error = 'E-mail non valide.';
    else $_SESSION ['login'][$login]['mail'] = $_POST['mail'];
  }
  if(isset($_POST['date']) && !empty($_POST['date'])){
    if(!control_date($_POST['date'])) $error = "Date de naissance non valide, exemple=(jj/mm/aaaa)";
    else $_SESSION['login'] [$login]['date'] = $_POST['date'];
  }
  if(isset($_POST['cdp']) && !empty($_POST['cdp'])){
    if(!control_cdp($_POST['cdp'])) $error = "Le code postal n'est pas valide.";
    else $_SESSION ['login'][$login]['cdp'] = $_POST['cdp'];
  }
  if(isset($_POST['ville']) && !empty($_POST['ville'])){
    if(!control_ville($_POST['ville'])) $error = "Nom de la ville n'est pas valide.";
    else $_SESSION ['login'][$login]['ville'] = $_POST['ville'];
  }
  if(isset($_POST['tel']) && !empty($_POST['tel'])){
    if(!control_tel($_POST['tel'])) $error = "Numéro de téléphone non valide.";
    else $_SESSION ['login'][$login]['tel'] = $_POST['tel'];
  }
  if(empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['mail'])
      && empty($_POST['date']) && empty($_POST['cdp']) && empty($_POST['ville']) 
      && empty($_POST['tel']))
  {
    $error = "Pour modifier une information, veuillez renseigner le champ correspondant.";
  }
  $table_inscris = array_merge($table_inscris, $_SESSION['login']);
  file_put_contents($filename, '<?php $table_inscris = '.var_export($table_inscris, true).'; ?>', LOCK_EX);

}

/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

function type($value){
  if(strcmp($value, 'mail')===0) return "email";
  else if(strcmp($value, 'tel')===0) return "tel";
  else return "text";
}
function titre($value){
  if(strcmp($value, 'prenom')===0) return "Prénom";
  else if(strcmp($value, 'nom')===0) return "nom";
  else if(strcmp($value, 'mail')===0) return "email";
  else if(strcmp($value, 'cdp')===0) return "Code postal";
  else if(strcmp($value, 'date')===0) return "Date de naissance";
  else if(strcmp($value, 'tel')===0) return "Téléphone ";
  else return $value;
}
function control_nom($data_name){
  if(!preg_match('/^[a-z-]+$/i', trim($data_name))) return FALSE;
  else return TRUE;
}
function control_lastName($data_lName){
  if(!preg_match('/^[a-z-]+$/i', trim($data_lastName))) return FALSE;
  return true;
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
//////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
  <head>
    <title>cocktail</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/x-icon" href="photos/icon.png" />
    <style>
			footer {
				background-color: #424558;
				color: white;
        padding: 30px;
        margin-top:10px;
			}

			footer p {
				width: 50%;
				margin: 0 auto;
				padding: 5px;
				text-align: center;
        font-size: 0.8em;
       
      }
      .print_error{
        width:30%;
        padding:10px;
        margin: 10px auto;;
        tex-align: center;
        color:red;
        font-size: 0.7em;
      }
			</style>
  </head>

  <body>
    <?php include 'header.php'; ?>
    <main class="main_Modif">
      <div class="info_modif">
        <h3>Modification des données personnelles</h3>
        <p>Vous souhaitez modifier l'une de vos informations? cliquez ou sélectionnez l'information correspondante ensuite renseigné et valider.</p>
      </div>
      <details open class="details_modif">
        <summary>Votre profil
            <?php
              if($_SESSION['login'][$login]['sexe']==='Homme')
              {
                ?>
                  <span class="modif_nom"> <?php echo ' M. '.strtoupper($_SESSION['login'][$login]['nom']).' "'.$login.' "';?> </span>
                <?php
              }
               else
               {
                 ?>
                   <span class="modif_nom"> <?php echo ' Mm. '.strtoupper($_SESSION['login'][$login]['nom']).' " '.$login.' "';?> </span>
                 <?php
               }
            ?>
        </summary>
          <form name ="form_modif" action="" method="post" class="datas_profil">
            <?php
              foreach ($_SESSION['login'][$login] as $key => $value ) {
                if(strcmp($key,'mdp')!==0 && strcmp($key,'sexe')!==0)
                {
                  ?>
                    <div id="champs">
                      <label for="<?php echo $key?>">
                        <span class="title_datas"><?php echo titre($key);?></span>
                        <?php echo $value;?>
                      </label>
                      <input type="<?php echo type($key);?>" name="<?php echo $key?>" id="<?php echo $key?>"/>
                    </div>
                  <?php
                }
              }
            ?>
            <div id="valider">
              <input type="submit" name="envoie" id="modif_envoie" value="Valider"/>
            </div>
          </form>
      </details>
      <p class="print_error"> <?php echo $error;?> </p>
    </main>
      <?php include "footer.php";?>
      <script src="jquery-3.3.1.min.js"></script>
      <script src="modif_js.js"></script>
  </body>
</html>
