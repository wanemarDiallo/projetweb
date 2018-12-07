<div id="sous_nav">
  <ul>
      <?php
      if(!isset($tabRecettes)) $tabRecettes = array(); //table quiu contiendra les recettes sans doublons
      foreach ($Hierarchie as $clef => $valeur) {
        if(array_key_exists('super-categorie', $valeur) && $valeur['super-categorie'][0]==$_GET['valeur']){
          ?>
            <li class="lien_sous_nav">
              <a href="?valeur=<?php echo $clef ?>"><?php echo $clef ?></a>
            </li>
          <?php
        }
      }
    ?>
 </ul>
</div>
