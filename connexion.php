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
            header('Location:index.php');
            //break;
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
