<?php

include_once '../Classes/SPDO.php';
include_once '../Classes/Panier.php';

// création de session
if (!isset($_SESSION))
{
	session_start();
	$_SESSION["log"] = false;
}



// Recuperation du login et mot de passe
if (isset ($_POST["code"]) && isset ($_POST["password"]))
{
	// Hash du mot de passe
	$hash = hash('sha256', $_POST['password']);
	
	// requete de comparaison
	$request = "SELECT * FROM utilisateurs WHERE codeClient = '".$_POST["code"]."' AND motDePasse = '".$hash."'";
	$pdo = SPDO::getInstance();
	$stmt = $pdo->query($request);
	
	// resultat
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($res != NULL)
	{
		$panier = new Panier();
		
		$_SESSION['admin'] = false;
		$_SESSION["log"] = true;
		$_SESSION["panier"] = serialize($panier);
		$_SESSION["code"] = $res['codeClient'];
		
		
		if ( $res['teleprospecteur'] == 1)
		{
			$_SESSION['admin'] = true;
		}
		
		header("Location: accueil.php");
		die();
	}
	
	
}

if($_GET["logout"] == 1)
{
	$_SESSION["log"] = false;
	$_SESSION["panier"] = null;
	$_SESSION["code"] = 0;
	header("Location: ..");
	die();
}

?>
