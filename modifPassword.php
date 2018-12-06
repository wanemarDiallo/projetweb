<?php session_start();


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
  <title></title>
  <style>
	body{
		margin: 0;
		padding: 0;
	}
	main{
		height:100%;
		border: 1px solid red;
	}
	</style>
</head>
<body>
  <main id="mod_mdp">
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
