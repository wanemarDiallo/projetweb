<?php
session_start();
include 'functions.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>cocktail</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
      main
      {
        display: flex;
        flex-direction: column;
      }
    </style>
  </head>
  <body>
    <?php
      include 'header.php';
    ?>
    <main id="main_panier">
      <?php
        include 'favorie.php';
        include 'Donnees.inc.php';
        $login = key($_SESSION['login']);//je reccupère le login
        ?>
        <p class="log" style="display:none"><?php echo $login;?></p>
        <?php
        foreach ($tab_fav[$login]['cocktail'] as $key => $value) {
          ?>
            <form action="t_panier.php" method="post"/>
            <h2 class="nom_rec"><?php echo $value; ?></h2>
              <div>
                <?php affiche_in_pre($value, $Recettes, 3, 3); ?>
                <input type="text" value="<?php echo $value; ?>" class="hidden" style="display:none"/>
                <input type="button" value="supprimer" class="supp_envoi"/>
              </div>
            </form>
          <?php
        }
       ?>
    </main>
    <footer>
    </footer>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="verification_formulaire.js"></script>
  </body>
</html>
