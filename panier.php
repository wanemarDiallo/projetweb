<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>cocktail</title>
    <link rel="stylesheet" href="style.css"/>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <main id="main_panier">
      <?php
        $filename = "favorie.php";
          include $filename;
          $login = key($_SESSION['login']);
          if(array_key_exists($login, $tab_fav))
          {
            $tab_log = $tab_fav[$login]['cocktail'];
          }
        else
        {
          echo "not exist!";
        }
      ?>
    </main>
    <footer>
    </footer>
  </body>
</html>
