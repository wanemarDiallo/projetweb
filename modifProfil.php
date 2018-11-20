<?php
session_start();

$filename = "lesInscris.php";
include('lesInscris.php');

$login = key($_SESSION['login']);//on reccupère le login du user
if(isset($_POST['modif_submit'])){
  $donnee = $_POST['modif'];
  $champ = $_POST['data'];
  $_SESSION['login'][$login][$champ] = $donnee;
}

$table_inscris = array_merge($table_inscris,$_SESSION['login'] );//ajout du nouveau utilisateur sur la table des inscris
/*foreach ($table_inscris as $key => $value) {
    if($key === $login){
      foreach ($value as $key => $value2) {
        echo $key .' => '.$value2.'<br>';
      }

    }
}*/
file_put_contents($filename, '<?php $table_inscris = '.var_export($table_inscris, true).'; ?>', LOCK_EX);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>cocktail</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
  <head>

  <body>
    <?php include 'header.php'; ?>
    <main class="main_Modif">
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
            <?php
              foreach ($_SESSION['login'][$login] as $key => $value) {
                if($key!=='mdp')
                {
                  ?>
                  <div class="datas_profil">
                    <p class="datas_name">
                      <?php
                        if(strcmp($key, 'prenom')===0) echo "Prénom";
                        else if(strcmp($key, 'mail')===0) echo "email";
                        else if(strcmp($key, 'cdp')===0) echo "Code postal";
                        else if(strcmp($key, 'date')===0) echo "Date de naissance";
                        else if(strcmp($key, 'tel')===0) echo "Téléphone ";
                        else echo $key;
                       ?>
                    </p>
                    <p class="datas_values"><?php echo $value?></p>
                  </div>
                  <?php
                }
              }
            ?>
      </details>
      <details open class="details_modif">
        <summary>les données possibles d'être modifiées</summary>
        <form action="#" method="post">
          <p class="data_info">Selectionnez l'information à modifier *</p>
          <select class="data_modif" id="select_modif" name="data" title="Selectionnez le champ">
            <optgroup label="vos données"><!--indique-->
              <option value="nom">Nom</option>
              <option value="prenom">Prénom</option>
              <option value="mail">E-mail</option>
              <option value="tel">Téléphone</option>
            </optgroup>
            <optgroup label="Adresse">
              <option value="cdp">Code postal</option>
              <option value="ville">ville</option>
            </optgroup>
          </select>
          <input type="text" name="modif" placeholder="nom" class="modif_input"/>
          <input type="submit" name="modif_submit" value="Modifier" title="Modifier"/>
        </form>
      </details>
    <main>
      <script src="jquery-3.3.1.min.js"></script>
      <script src="modif_js.js"></script>
  </body>
</html>
