<?php
session_start();
///////////////////////////////////////////
//////////// test /////////////////////
if(isset($_COOKIE['favorie'])){
	$valeur_decode = json_decode($_COOKIE['favorie']);
	//var_dump($valeur_decode).'\n';
	 $tab_r = $valeur_decode -> {'cocktail'};
	 foreach ($tab_r as $key => $value) {
	 		echo $value;
	 }
}
else
{
	echo "not cookie";
}
//////////////////////////////////////////////
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
		    <input type="search" name="recherche" id="recherche" placeholder="faites un recherche"/>
		    <button type="button" id="button_recherche">
						<svg version="1.1" id="Capa_1"  x="0px" y="0px"
							 viewBox="0 0 489.9 489.9">
							<path d="M411.55,166.6c0-92-74.6-166.6-166.6-166.6S78.35,74.6,78.35,166.6c0,81.5,58.6,149.3,135.9,163.7l-6.8,121.5
								c-1.2,20.7,15.3,38.1,36,38.1h3l0,0c20.7,0,37.2-17.4,36-38.1l-6.8-121.5C353.05,315.9,411.55,248.1,411.55,166.6z M244.95,276
								c-60.4,0-109.4-49-109.4-109.4s49-109.4,109.4-109.4s109.4,49,109.4,109.4C354.35,227.1,305.35,276,244.95,276z"/>
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
		                <a href="panier.php" title="voir mon panier">Panier</a>
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
						if(!isset($tabRecettes)) $tabRecettes = array(); //table quiu contiendra les recettes sans doublons
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
								<figure>
									<img src="photos/<?php echo $nomImage;?>.jpg" alt="l'image de cette recette est indisponible"/>
									<figcaption>
										<hr class="hr"/><br/>
											<button type="button" name="favorie" class="buton_favorie">
												<svg class="svg-icon-favorie" viewBox="0 0 20 20">
													<path d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61">
													</path>
												</svg>
											</button>
									</figcaption>
								</figure>
									<?php
									 	affiche_in_pre($_GET['titreRecettes'], $Recettes, 3, 3);
								 	?>
							</div>
						<?php
					}
					else
					{
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
					}
				 ?>
			</div>
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
		</main>
		<footer></footer>
		<script src="jquery-3.3.1.min.js"></script>
    <script src="traitementAjaxRecette.js"></script>
	</body>
</html>
