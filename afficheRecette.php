<?php
  session_start();
  $_SESSION['nomRecette'] = $_GET['titreRecettes'];
  header('Location:index.php');
 ?>
