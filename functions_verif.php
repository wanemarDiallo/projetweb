<?php
    ////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////
  function control_login($data_login){
    if(!preg_match('/^[a-z]+[0-9]*$/i', trim($data_login)))
      return FALSE;
    else return TRUE;
  }
  function control_mdp($data_mdp){
    $taille = trim(strlen($data_mdp));
    if(($taille < 8)) return FALSE;
    else return TRUE;
  }
  function control_name($data_name, $data_lastName){
    if(!preg_match('/^[a-z-]+$/i', trim($data_name))) return FALSE;
    else if(!preg_match('/^[a-z-]+$/i', trim($data_lastName))) return FALSE;
    else return TRUE;
  }
  function control_sexe($data_sexe){
    if(strcmp(strtolower($data_sexe), 'homme')!==0 && strcmp(strtolower($data_sexe), 'femme')!==0) return FALSE;
    else return TRUE;
  }
  function control_mail($data_mail){
    if(!preg_match('/^[a-z0-9.-]+@[a-z0-9.-]{2,}[.]{1}[a-z]{2,3}$/', strtolower(trim($data_mail)))) return FALSE;
    else return TRUE;
  }
  function control_cdp($data_cdp){
    if(!preg_match('/^[0-9]{5}$/', strtolower(trim($data_cdp)))) return FALSE;
    else return TRUE;
  }
  function control_date($data_date){
    if(!preg_match('/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/', trim($data_date))) return FALSE;
    else
    {
      list($jour, $mois, $annee) = explode('/', $data_date);
      if($mois >= 1 && $mois <= 12){
        if(($mois != 2 && $jour >= 1 && $jour <= 31) || ($mois == 2 && $jour >= 1 && $jour <= 29)){
          if($annee >= 1 && $annee <= 32767){
            if(checkdate($mois, $jour, $annee)) return TRUE;
            else return FALSE;
          }
        else return FALSE;
        }
        else return FALSE;
      }
      else return FALSE;
    }
  }
  function control_ville($data_ville){//faut traiter les accents (éè)
    if(!preg_match('/^[a-z-\s]+$/', strtolower(trim($data_ville)))) return FALSE;
    else return TRUE;
  }
  function control_tel($data_tel){
    if(!preg_match('/^[0][1-9]{9}$/', trim($data_tel))) return FALSE;
    else return TRUE;
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>