<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
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
            var_dump($tab_fav);
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
