
<?php session_start();

include 'lesInscris.php';
$filename = 'lesInscris.php';
if(isset($_POST['envoie'])){

	$mdp = $_POST['mdp'];
	$login = $_POST['login'];
	$mdp_conf = $_POST['mdp_conf'];


	if(control_login($login,$table_inscris)) {
		if(control_mdp($mdp) && strcmp($mdp,$mdp_conf)===0)
		{

			//$n_mdp = password_hash($mdp, PASSWORD_DEFAULT);
			foreach($table_inscris as $key => $value)
			{
				if($key === $login)
				{
						if(password_hash($mdp, PASSWORD_DEFAULT))
						{
								echo $value['nom'];
						  //$value['mdp'] = '';// = $mdp;
							$value['nom'] = password_hash($mdp, PASSWORD_DEFAULT);
							echo $value['nom'];
							if(!file_put_contents($filename, '<?php $table_inscris = '.var_export($table_inscris, true).'; ?>', LOCK_EX)) echo "non ecris";
							print_r($table_inscris)."\n";
							//header('Location:inscription.php');
						}else echo "echec hash";
				}

			}
		}
		else
		{
			echo "mdp non correct";
		}
	}
	else{
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
    else return TRUE;
  }



?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
include 'header.php';
?>
  <main>
    <form action="" method="post">
      <div>
        <label for="">Nom d'utilisateur</label>
        <input type="text" name="login">
      </div>
      <div>
        <label for=""> Nouveau Mot de passe</label>
        <input type="password" name="mdp">
      </div>
      <div>
        <label for="">Confirmation du nouveau mot de passe</label>
        <input type="password" name="mdp_conf">
      </div>
      <div>
        <input type="submit" name="envoie" value="valider">
      </div>
    </form>
  </main>
</body>
</html>
