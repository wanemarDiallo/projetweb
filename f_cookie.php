<?php
session_start();
  $nom = 'favorie';
  if(isset($_POST['recette'])){
    $value_array = array(
                          'cocktail' => array(htmlspecialchars($_POST['recette']))
                        );

    if(!isset($_COOKIE[$nom]) && !isset($_SESSION['login']))
    {
      $value_json = json_encode($value_array);
      if(setcookie($nom, $value_json, time()+3600/10)) echo "ok";
    }
    elseif(isset($_COOKIE[$nom]) && !isset($_SESSION['login']))
    {
      $valeur_decode = json_decode($_COOKIE['favorie']);
      $tab_rec = $valeur_decode -> {'cocktail'};
      foreach ($tab_rec as $key => $value) {
        if(!in_array(htmlspecialchars($value), $value_array['cocktail']))
          array_push($value_array['cocktail'], htmlspecialchars($value));
      }

      /**
      Ensuite
      */
      $value_json = json_encode($value_array);
      if(setcookie($nom, $value_json, time()+3600/10)) echo "ajouté";
    }
    else
    {
      $filename = "favorie.php";
      include 'favorie.php';
      $login = key($_SESSION['login']);
      if(!in_array($value_array['cocktail'][0], $tab_fav[$login]['cocktail']))
          {
            array_push($tab_fav[$login]['cocktail'], $value_array['cocktail'][0]);
          }
      echo "ok avec session";
      file_put_contents($filename, '<?php $tab_fav = '.var_export($tab_fav, true).'; ?>', LOCK_EX);
    }
  }
?>
