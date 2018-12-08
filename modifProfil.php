<?php
session_start();

$filename = "lesInscris.php";
include('lesInscris.php');

$login = key($_SESSION['login']);//on reccupère le login du user
if(isset($_POST['envoie'])){
  
}

$table_inscris = array_merge($table_inscris,$_SESSION['login'] );//ajout du nouveau utilisateur sur la table des inscris
file_put_contents($filename, '<?php $table_inscris = '.var_export($table_inscris, true).'; ?>', LOCK_EX);

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
        border:1px solid red;
        width:30%;
        padding:10px;
        margin: 10px auto;;
        tex-align: center;
        color:red;
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
      <p class="print_error"></p>
    </main>
      <?php include "footer.php";?>
      <script src="jquery-3.3.1.min.js"></script>
      <script src="modif_js.js"></script>
  </body>
</html>
