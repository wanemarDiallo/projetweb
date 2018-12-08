<?php
  if(isset($_POST['nom']) && $_POST['login'])
  {// s'il existe le nom d'une recette à supprimer
    $filename = 'favorie.php'; // le nom du fichier favorie
    
    $nom = $_POST['nom']; //affecte le nom à une variable
    $login = $_POST['login']; // je recupère le login
    include 'favorie.php';//j'inclue le fichier favorie.php

    
    $pos = array_search($nom, $tab_fav[$login]['cocktail']);
            
    unset($tab_fav[$login]['cocktail'][$pos]);
    file_put_contents($filename, '<?php $tab_fav = '.var_export($tab_fav, true).'; ?>', LOCK_EX);
    header('Location:panier.php');
  }
?>
