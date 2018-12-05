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
            if (file_exists($filename)) include $filename;
            else header('Location:panier.php');////

              if(isset($_COOKIE['favorie_avant_connexion']))
                {//si le cookie exite
                  $contenu = json_decode($_COOKIE['favorie_avant_connexion']);
                  if(!isset($tab_fav))
                  {
                    $tab_fav = array(
                                      $login => array(
                                        'cocktail' => array()
                                      )
                                    );
                  }

                  $tab_rec = $contenu -> {'cocktail'};
                  if(array_key_exists(key($_SESSION['login']), $tab_fav))
                  {
                    foreach ($tab_rec as $key => $value) {
                          if(!in_array($tab_fav[$login], $value))
                          array_push($tab_fav[$login]['cocktail'], $value);
                    }
                  }
                  else
                  {
                    $l =array(
                      $login => array(
                      'cocktail' => array()
                    ));
                    $tab_fav += $l;
                    for ($i=0; $i < count($tab_cat); $i++) {
                          array_push($tab_fav[$login]['cocktail'], $tab_rec[$i]);
                        }
                  }

                  file_put_contents($filename, '<?php $tab_fav = '.var_export($tab_fav, true).'; ?>', LOCK_EX);
                  //setcookie($_COOKIE['favorie_avant_connexion'], "", -1);
                  //unset($_COOKIE['favorie_avant_connexion']);
                }
                else
                {//si le cookie existe pas
                  if(file_exists($filename) && !isset($tab_fav))
                  {
                    $tab_fav = array(
                                      $login => array(
                                        'cocktail' => array()
                                      )
                                    );

                    file_put_contents($filename, '<?php $tab_fav = '.var_export($tab_fav, true).'; ?>', LOCK_EX);
                  }

                }
              header('Location:index.php');
            }

            //break;
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
