<?php
afficherLienRecette($_GET['valeur'], $tabRecettes, $Recettes, $Hierarchie);
/*Pour cheaque elements du tableau (tab_recettes) on affiche ceux qui ont des image*/
foreach ($tabRecettes as $value) {
  $elem = preg_replace('/[\s]/' ,'_', $value);
  if(is_file('photos/'.$elem.'.jpg'))
  {	?>
      <div class="block_recettes">
        <p class="image">
          <!--<img src="photos/<?php //echo $elem;?>.jpg" alt="l'image de cette recette est indisponible"/>-->
        </p>
        <p class="a">
          <a href="?valeur=<?php echo $_GET['valeur']?>&titreRecettes=<?php echo $value?>" class="liens"><?php echo $value?></a>
        </p>
        <?php affiche_in_pre($value, $Recettes, 1, 0); ?>
      </div>
    <?php
  }
}
/*affiche pour ceux qui nom pas d'image*/
foreach ($tabRecettes as $value) {
  $elem = preg_replace('/[\s]/' ,'_', $value);
  if(!is_file('photos/'.$elem.'.jpg'))
  {	?>
      <div class="block_recettes">
        <p class="a">
          <a href="?valeur=<?php echo $_GET['valeur']?>&titreRecettes=<?php echo $value?>" class="liens"><?php echo $value?></a>
        </p>
        <?php affiche_in_pre($value, $Recettes, 1, 0); ?>
      </div>
    <?php
  }
}
?>
