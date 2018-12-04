<?php
  $nom = 'favorie_avant_connexion';
  if(isset($_POST['recette']) && isset($_POST['categorie'])){
    $value_array = array(
                          'categorie' => array(
                                                htmlspecialchars($_POST['categorie'])
                                              ),
                          'recette' => array(
                                                htmlspecialchars($_POST['recette'])
                                            )
                        );

    if(!isset($_COOKIE['favorie_avant_connexion']))
    {
      $value_json = json_encode($value_array);
      if(setcookie($nom, $value_json, time()+3600)) echo "ok";
    }
    else
    {

      //$value_array = array('categorie' => array(), 'recette' => array());

      $valeur_decode = json_decode($_COOKIE['favorie_avant_connexion']);
      $tab_cat = $valeur_decode -> {'categorie'};
      $tab_rec = $valeur_decode -> {'recette'};
      foreach ($tab_cat as $key => $value) {
        //if(!in_array(htmlspecialchars($value), $value_array['categorie']))
        array_push($value_array['categorie'], htmlspecialchars($value));
      }
      foreach ($tab_rec as $key => $value) {
        //if(!in_array(htmlspecialchars($value), $value_array['recette']))
        array_push($value_array['recette'], htmlspecialchars($value));
      }

      /**
      Ensuite
      */
      //array_push(tmlspecialchars($_POST['categorie']), $value_array['categorie']);
      //array_push(tmlspecialchars($_POST['recette']), $value_array['recette']);
      $value_json = json_encode($value_array);
      if(setcookie($nom, $value_json, time()+3600)) echo "ajouté";
    }
  }
?>
