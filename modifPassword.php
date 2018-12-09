<?php session_start();

include "miseAjourPhp.php";//include pour la mise à jour
$filename = 'lesInscris.php';
if(isset($_POST['envoie'])){

	$mdp = $_POST['mdp'];
	$login = $_POST['login'];
	$mdp_conf = $_POST['mdp_conf'];

	include 'lesInscris.php';
	if(control_login($login,$table_inscris)) {
		if(control_mdp($mdp) && strcmp($mdp,$mdp_conf)===0)
		{
			$table_inscris[$login]['mdp'] = password_hash($mdp, PASSWORD_DEFAULT);
			file_put_contents($filename, '<?php $table_inscris = '.var_export($table_inscris, true).'; ?>', LOCK_EX);
			header('Location:inscription.php');
		}
		else
		{
			echo "mdp non correct";
		}
	}
	else
	{
		echo 'vous êtes pas inscris';
	}
}
	 function control_mdp($data_mdp){
    $taille = trim(strlen($data_mdp));
    if(($taille < 8)) return FALSE;
    else return TRUE;
	 }

	function control_login($data_login, &$table_inscris){
    if(!array_key_exists($data_login, $table_inscris)) return FALSE;
    else return true;
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cocktail</title>
	<link rel="icon" type="image/x-icon" href="photos/icon.png" />
  <style>
	body{
		margin: 0;
		padding: 0;
		display:flex;
		flex-direction:column;
	}
	main{
		width:50%;
		align-self:center;
		margin: 150px 0;
	}
	.tete{
		background-color:#424558;
		color:white;
		display: flex;
		justify-content: space-between;
	}
	footer{
    background-color:#424558;
    color:white;
    padding:10px;
    margin-top:10px;
  }
  footer p{
    width:50%;
  	margin:0 auto;
    padding:5px;
    text-align:center;
    font-size:0.8em;
	}
	form{
		display:flex;
		justify-content:center;
		flex-direction:column;
	}
	form>div{
		display:flex;
		justify-content:space-between;
		margin: 5px 0;
	}label{
		font-size:0.8em;
	}
	form>div input{
		border:1px solid #CC8E69;
		padding:10px;
	}
	.submit{
		flex-direction:column;
		border-top: 1px solid gray;
		margin-top:10px;
		padding-top:5px;
	}
	.submit>input{
		align-self:center;
		border:none;
		padding:10px;
		border:1px solid #CC8E69;
		background-color:#CC8E69;
		color:white;
		cursor:pointer;
	}
	.submit>input:hover{
		background-color: rgba(204, 142, 105, .80);
	}
	/* -----
SVG Icons - svgicons.sparkk.fr
----- */

.svg-icon {
  width: 2em;
  height: 2em;
}

.svg-icon path,
.svg-icon polygon,
.svg-icon rect {
  fill: white;
}

.svg-icon circle {
  stroke: white;
  stroke-width: 1;
}
	</style>
</head>
<body>
	<div class="tete">
		<h4>Modifier votre mot de passe</h4>
		<p>
			<a href="index.php">
				<svg class="svg-icon" viewBox="0 0 20 20">
					<path d="M15.971,7.708l-4.763-4.712c-0.644-0.644-1.769-0.642-2.41-0.002L3.99,7.755C3.98,7.764,3.972,7.773,3.962,7.783C3.511,8.179,3.253,8.74,3.253,9.338v6.07c0,1.146,0.932,2.078,2.078,2.078h9.338c1.146,0,2.078-0.932,2.078-2.078v-6.07c0-0.529-0.205-1.037-0.57-1.421C16.129,7.83,16.058,7.758,15.971,7.708z M15.68,15.408c0,0.559-0.453,1.012-1.011,1.012h-4.318c0.04-0.076,0.096-0.143,0.096-0.232v-3.311c0-0.295-0.239-0.533-0.533-0.533c-0.295,0-0.534,0.238-0.534,0.533v3.311c0,0.09,0.057,0.156,0.096,0.232H5.331c-0.557,0-1.01-0.453-1.01-1.012v-6.07c0-0.305,0.141-0.591,0.386-0.787c0.039-0.03,0.073-0.066,0.1-0.104L9.55,3.75c0.242-0.239,0.665-0.24,0.906,0.002l4.786,4.735c0.024,0.033,0.053,0.063,0.084,0.09c0.228,0.196,0.354,0.466,0.354,0.76V15.408z"></path>
				</svg>
			</a>
		</p>
	</div>
  <main id="mod_mdp">
    <form action="" method="post">
      <div>
        <label for="login">Nom d'utilisateur</label>
        <input type="text" name="login" id="login">
      </div>
      <div>
        <label for="mdp"> Nouveau Mot de passe</label>
        <input type="password" name="mdp" id="mdp">
      </div>
      <div>
        <label for="mdp_conf">Confirmation du nouveau mot de passe</label>
        <input type="password" name="mdp_conf" id="mdp_conf">
      </div>
      <div class="submit">
        <input type="submit" name="envoie" value="valider">
      </div>
    </form>
	</main>
	<?php include 'footer.php' ?>
</body>
</html>
