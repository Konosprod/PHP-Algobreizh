<?php

if (isset ($_POST["code"]) && isset ($_POST["password"]))
{
	$hash = hash('sha256', $_POST['password']);
	$request = "SELECT * FROM utilisateurs WHERE codeClient = '".$_POST["code"]."' AND motDePasse = '".$hash."'";
	
	$pdo = SPDO::getInstance();
	$stmt = $pdo->query($request);
	
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($res != NULL)
	{
		header("Location: accueil.php");
		die();
	}
	
	
}

?>
