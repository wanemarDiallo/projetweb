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

				<?php
				 	if(isset($_GET['titreRecettes'])){
						$nomImage = preg_replace('/[\s]/' ,'_', $_GET['titreRecettes']);
						?>
							<h1 class="titre"> <?php echo $_GET['titreRecettes'];?> </h1>
							<div class="imageRecette">
								<img src="photos/<?php echo $nomImage;?>.jpg" alt="l'image de cette recette est indisponible"/>
								<svg class="svg-icon-favorie" viewBox="0 0 20 20">
									<path d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61">
									</path>
								</svg>
							</div>
							<div class="detailsRecettes">
						<?php

						foreach ($Recettes as $clef => $value) {
					    if(strcmp($value['titre'], $_GET['titreRecettes'])===0)
					    {
								?>
					       	<p><span class="ingredients">Ingredients :</span><br><?php echo $value['ingredients']?></p>
									<p><span class="preparation">Preparation :</span><br><?php echo $value['preparation']?></p>
									<p class="ajouter">
				 					 <button>ajouter au panier</button>

				 				 </p>
								<?php
					    }
					  }
					}else{
						?>
						<h1>Bienvenues</h1>
						<?php
					}
				 ?>
			 	</div>
			</div>
			<div id="main_recette">
				<?php
				 	function afficherLienRecette($element, &$Recettes, &$Hierarchie)
					{
<<<<<<< HEAD
=======
						
>>>>>>> 9e22a3e49e260f1ff55345edddf24412173d0f80
						if(array_key_exists('sous-categorie', $Hierarchie[$element]))
						{
							foreach ($Hierarchie[$element]['sous-categorie'] as $clef => $valeur) {
								afficherLienRecette($valeur, $Recettes, $Hierarchie);
							}
						}
<<<<<<< HEAD
						else
					 	{
							foreach ($Recettes as $clef => $valeur) {
								if(in_array($element, $valeur["index"]))
								{
									?>
										<a href="?valeur=<?php echo $_GET['valeur']?>&titreRecettes=<?php echo $valeur["titre"]?>" class="liens"><?php echo $valeur["titre"]?></a>
									<?php
								}
							}
						}
					}
					if($_GET['valeur']!=="Aliment")
					{
						?>
						<h2 class="listeRecettes">liste des recettes</h2>
						<?php
						 afficherLienRecette($_GET['valeur'], $Recettes, $Hierarchie);
>>>>>>> 9e22a3e49e260f1ff55345edddf24412173d0f80
					}
				 ?>
			</div>
		</main>
		<footer></footer>
		<script src="jquery-3.3.1.min.js"></script>
    <script src="traitementAjaxRecette.js"></script>
	</body>
</html>
