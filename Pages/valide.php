<?php
/**
 * Page qui gère la validation d'une commande
 * dans la base de données
 * 
 */
include_once '../Classes/SPDO.php';

if(!isset($_SESSION))
{
	session_start();
}

//Si on est pas admin, on retourne à la page de login 
if(!$_SESSION["admin"])
{
	header("Location: ..");
	die();
}

if(isset($_GET["id"]))
{
	$id = $_GET["id"];
	$pdo = SPDO::getInstance();
	
	//On passe la colonne valide à 1 pour la commande correspondant
	//à l'id passé en paramètre
	$sql = "UPDATE commandes SET valide = 1 WHERE idCommande ='".$id."'";
	$pdo->query($sql);
}

header("Location: admin.php");
die();

?>