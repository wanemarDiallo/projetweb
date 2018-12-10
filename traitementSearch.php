<?php 
include 'Donnees.inc.php';
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
$table_resultat = array(); //talbe qui stockera le resultat des recettes 
function resultat_reherche(&$tab_chaine, &$Hierarchie, &$Recettes){
  $tab_resultat = array();
  foreach ($tab_chaine as $value) {
    foreach($Hierarchie as $key => $value2){
      if(strstr($key, $value))
        array_push($tab_resultat, $key);
    }
    foreach($Recettes as $value3){
      if(strstr($value3['titre'], $value))
        array_push($tab_resultat, $value3['titre']);
    }
  }
  return $tab_resultat;
}
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

  if(isset($_POST['recherche']) && !empty($_POST['recherche'])){
    $valeur = trim($_POST['recherche']);
      $tab_chaine = explode(" ", $valeur);
      $table_resultat = resultat_reherche($tab_chaine, $Hierarchie, $Recettes);
      foreach($table_resultat as $value){
        ?>
          <p style="margin:0; padding:0;">
            <a href="index.php?valeur=<?php echo $value;?>" style="color:black; text-decoration: none; display:inline-block; padding:5px 0;"><?php echo $value;?></a>
          </p>
        <?php
      }
  }
  if(empty($_POST['recherche']))
  {
    die("aucun resultat, veuillez renseigner la recette que vous cherchez.");
  }
 ?>
