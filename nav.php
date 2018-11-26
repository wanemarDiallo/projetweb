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
        //suppression des éléments lien dans le chemin absolu quand on clique sur un lien dans le chemin
        /* On recupère la taille du tableau, on recupère la position de la liste d'élément que l'on veut,
        Ensuite on boucle grace à la position de l'élément dans le tableau jusqu'à la taille du tableau,
        si l'indice est inferieur à la taille du tableau -1, on dépile le dernier element du tableau*/
            $size = count($_SESSION['chemin']);
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
