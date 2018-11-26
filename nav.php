<nav>
  <ul id="nav">
    <?php

      //$_SESSION['chemin']=array();
      include "Donnees.inc.php";
      if(!isset($_GET['valeur'])) $_GET['valeur'] = 'Aliment';

      //tableau du chemin relatif et absolu
      if(!isset($_SESSION['chemin'])) $_SESSION['chemin']=array();

      if(!in_array($_GET['valeur'], $_SESSION['chemin']))
        array_push($_SESSION['chemin'], $_GET['valeur']);

        else{
       // Supression des éléméent du tableau quand on clique sur une case plus haute dans la hiérarchie 
            /*on parcours le tableau de la fin jusqu'a la position de l'élément et on supprime */
            $size = sizeof($_SESSION['chemin']);
            $pos = array_search($_GET['valeur'], $_SESSION['chemin']);

              for($i=$size - 1;$i>$pos;$i--){
                   array_pop($_SESSION['chemin']);
              }

            }
        ?>
      <li>
        <?php
        foreach ($_SESSION['chemin'] as $key => $value) {
        ?>
          <a href="?valeur=<?php echo $value ?>" id="chemin_absolu"><?php echo $value?></a>
        <?php
      }
      ?>
    </li>
  </ul>
</nav>
