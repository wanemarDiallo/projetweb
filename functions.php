<?php
  function afficherLienRecette($element, &$tabRecettes, &$Recettes, &$Hierarchie)
  {
    if(array_key_exists('sous-categorie', $Hierarchie[$element]))
    {
      foreach ($Hierarchie[$element]['sous-categorie'] as $clef => $valeur) {
        afficherLienRecette($valeur, $tabRecettes, $Recettes, $Hierarchie);
      }
    }
    else
    {
      foreach ($Recettes as $clef => $valeur) {
        if(in_array($element, $valeur["index"]))
        {
          if(!in_array($valeur["titre"], $tabRecettes))
            array_push($tabRecettes, $valeur["titre"]);
        }
      }
    }
  }
  function affiche_in_pre($recette, &$Recettes, $index_in, $index_pre)
  {
    foreach ($Recettes as $clef => $value) {
      if(strcmp($value['titre'], $recette)===0)
      {
        if($index_in == 1)
        {
          ?>
            <p class="text_recette"><span class="ingredients">Ingredients :</span><br><?php echo $value['ingredients']."."?></p>
          <?php
        }
        elseif ($index_pre == 2) {
          ?>
            <p class="text_recette"><span class="preparation">Preparation :</span><br><?php echo $value['preparation']?></p>
          <?php
        }
        else{
          if($index_in ==3 & $index_pre ==3)
          {
            ?>
              <p class="text_recette "><span class="ingredients">Ingredients :</span><br><?php echo $value['ingredients']."."?></p>
              <p class="text_recette "><span class="preparation">Preparation :</span><br><?php echo $value['preparation']?></p>
            <?php
          }
        }
      }
    }
  }
?>
