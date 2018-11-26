<?php
  session_start();
  include "Donnees.inc.php";
  //$_GET['titreRecettes'];
  foreach ($Recettes as $clef => $value) {
    if(strcmp($value['titre'], $_GET['titreRecettes'])===0)
    {
      echo $value['ingredients'].'<br>';
      echo $value['preparation'].'<br>';
    }
  }
 ?>
