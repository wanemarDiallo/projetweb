<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>projet</title>
		<meta charset="uft-8"/>
		<link rel="stylesheet" href="style.css"/>
		 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	</head>
	<body>
		<?php include 'header.php'; ?>

		<div class="login_index" id="login">
		  <!--Réccuperation de la session-->
		  <form action="#" method="post" id="form_recherche">
		    <input type="text" name="recherche" id="recherche" placeholder="faites un recherche"/>
		    <button id="button_recherche">loupe-ico</button>
		  </form>
		  <?php
		    if(isset($_SESSION['login'])) {
		      ?>
		        <!--Le profil d'utilisateur-->
		        <ul id="profil">
		          <li>Profil : <?php echo key($_SESSION['login']);?></summary>
		            <ul id="detail_profil">
		              <!--<li>
		                <?php// $login = key($_SESSION['login']); echo $_SESSION['login'][$login]['nom'].' '.$_SESSION['login'][$login]['prenom']?>
		              </li>-->
		              <li>
		                <a href="Panier.php" title="voir mon panier">Panier</a>
		              </li>
		              <li>
		                <a href="modifProfil.php" title="Editer ou voir">Profil</a>
		              </li>
		              <li>
		                <a href="deconnexion.php" title="se deconnecter">Deconnexion</a>
		              </li>
		            </ul>
		          </li>
		        </ul>
		      <?php
		    } else {
		      ?>
		        <p>
		          <a href="inscription.php" id="connexion_button">connexion</a>
		        </p>
		      <?php
		    }
		  ?>
		</div>

		<?php include 'nav.php'; ?>

		<main id="main_index">
			<div id="sous_nav">
				<ul>
			      <?php
			      foreach ($Hierarchie as $clef => $valeur) {
			        if(array_key_exists('super-categorie', $valeur) && $valeur['super-categorie'][0]==$_GET['valeur']){
			          ?>
			            <li>
			              <a href="?valeur=<?php echo $clef ?>"><?php echo $clef ?></a>
			            </li>
			          <?php
			        }
			      }
			    ?>
			 </ul>
			</div>
			<div id="main_contenu">
				<p>les recettes</p>
			</div>
			<div id="main_panier">
				<p>liste des choix</p>
			</div>
		</main>
		<footer></footer>
	</body>
</html>
