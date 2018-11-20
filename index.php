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
		    <button type="submit" id="button_recherche">
					<svg class="svg-icon" viewBox="0 0 20 20">
							<path d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path>
						</svg>
				</button>
		  </form>
		  <?php
		    if(isset($_SESSION['login']))
				{
		      ?>
		        <!--Le profil d'utilisateur-->
		        <ul id="profil">
		          <li >
								<div class="avatar">
									<a href="#"><img src="https://img.icons8.com/ios/50/000000/user-filled.png"></a>
									<span class="user_login"><?php echo key($_SESSION['login']);?></span>
								</div>
		            <ul id="detail_profil">
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
		    }
				else
				{
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
