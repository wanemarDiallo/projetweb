<?php
session_start();
 include('lesInscris.php');
  /*test connexion */
  if(isset($_POST['login']) && isset($_POST['mdp'])){
      $login = $_POST['login'];
      $mdp = $_POST['mdp']; // password_hash($_POST['mdp'], PASSWORD_DEFAULT);
      if(array_key_exists($login, $table_inscris))
      {
        foreach ($table_inscris as $clef => $value) {
          if(strcmp($clef,$login)===0 && password_verify($mdp, $value['mdp']))
          {
            $_SESSION['login'] = array($clef => $value);
            $filename = "favorie.php";
            $nom = 'favorie';
            if (!file_exists($filename)){
              $file = fopen($filename, "w+");
              if($file) fclose($filename);
            }
            include $filename;
            if(isset($_COOKIE[$nom]))
            {//si le cookie exite
              $contenu = json_decode($_COOKIE[$nom]);
              if(!isset($tab_fav))
              {///si tableau favorie  existe pas dans le fichier  on le crée
                $tab_fav = array();
              }

              $tab_cocktail = $contenu ->{'cocktail'};
              if(!array_key_exists(key($_SESSION['login']), $tab_fav))
              {
                $l = array($login => array('cocktail' => array()));
                $tab_fav += $l;
              }
              $i=0;
              foreach ($tab_cocktail as $key => $value) {
                if(!in_array($value, $tab_fav[$login]['cocktail']))
                    {
                      array_push($tab_fav[$login]['cocktail'], $value);
                    }
              }
              file_put_contents($filename, '<?php $tab_fav = '.var_export($tab_fav, true).'; ?>', LOCK_EX);
              setcookie($nom,"");
              unset($_COOKIE[$nom]);
            }
            header('Location:index.php');
          }
        }
      }
      else {
         $nonInscris = 0;
         echo $nonInscris;
      }
  }
//////////////////////////////////////////////////////
/////////////////////////////////////////////////////
?>
