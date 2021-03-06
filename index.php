<?php
session_start();
//////////////////////////////////////////////
 include 'functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cocktail</title>
		<meta charset="uft-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"/>
		<link rel="icon" type="image/x-icon" href="photos/icon.png" />
		<style>
			footer {
				background-color: #424558;
				color: white;
				padding: 10px;
			}

			footer p {
				width: 30%;
				margin: 0 auto;
				padding: 5px;
				text-align: center;
				font-size: 0.8em;
				margin-left:40%
			}
			</style>
		</head>
	<body>
		<?php include 'header.php'; ?>
		<?php include 'nav.php'; ?>

		<main id="main_index">
			<?php include 'afficheRecette.php'; ?>
			<div id="main_contenu">
				<?php
				 	if(isset($_GET['titreRecettes'])){
						$nomImage = preg_replace('/[\s]/' ,'_', $_GET['titreRecettes']);
						?>
							<h1 class="titre"> <?php echo $_GET['titreRecettes'];?> </h1>
							<div class="imageRecette">
								<figure>
									<img src="photos/<?php if(is_file('photos/'.$nomImage.'.jpg')){echo $nomImage;}else{echo "cocktails";}?>.jpg" alt="l'image de cette recette est indisponible"/>
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
						include 'recettes.php';
					}
				 ?>

			</div>
		</main>
		<?php include "footer.php"; ?>
		<script src="jquery-3.3.1.min.js"></script>
    <script src="traitementAjaxRecette.js"></script>
	</body>
</html>
