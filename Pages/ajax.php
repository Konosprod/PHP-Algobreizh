<?php
/**
 * Permet de gérer le panier via AJAX
 * afin de ne pas surcharger le client
 * de rafraichissement inutiles.
 */
include_once '../Classes/Panier.php';
include_once '../Classes/SPDO.php';

if(!isset($_SESSION))
{
	session_start();
}

if (isset($_POST['idProduit']))
{
	$panier = unserialize($_SESSION['panier']);
	$panier->ajouterproduits($_POST['idProduit']);
	$_SESSION['panier'] = serialize($panier);
	
	die(json_encode(array("status"=>true)));
}

if(isset($_POST['removeProduit']))
{
	$panier = unserialize($_SESSION['panier']);
	$panier->supprimerProduit($_POST['removeProduit']);
	$_SESSION['panier'] = serialize($panier);
	
	die(json_encode(array("status"=>true)));
}

if(isset($_POST['panier']))
{
	$pdo = SPDO::getInstance();
	$items = $_POST['panier'];
	$total = $_POST['total'];
	
	/*Récupère l'id de l'utilisateur*/
	$sql = "select idUtilisateur from utilisateurs where codeClient = '".$_SESSION["code"]."'";
	$stmt = $pdo->query($sql);
	$idUser = $stmt->fetch(PDO::FETCH_ASSOC)["idUtilisateur"];
	
	/*Insère la commande */
	$sql = "INSERT INTO commandes (`montant`, `dateCommande`, `codeClient`, `valide`,`idUtilisateur`) ".
			"VALUES ('".$total."','".date("Y-m-d H:i:s")."','".$_SESSION["code"]."','0','".$idUser."')";
	
	$pdo->query($sql);
	
	$commandeId = $pdo->lastInsertId();
	
	/*Insère les détails de la commande*/
	foreach($items as $item)
	{
		$sql = "SELECT * FROM articles WHERE idArticle='".$item["idProduit"]."'";
		$stmt = $pdo->query($sql);
		$produit = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$sql = "INSERT INTO `details`(`codeArticle`, `qteArticle`, `montant`, `idCommande`, `idArticle`) ".
				"VALUES ('".$produit["codeArticle"]."','".$item["nbObjet"]."','".($produit["prix"]*$item["nbObjet"])."','".$commandeId."','".$item["idProduit"]."')";
		$pdo->query($sql);
	}
	
	/*Vide le panier*/
	$panier = unserialize($_SESSION['panier']);
	$panier->viderPanier();
	$_SESSION['panier'] = serialize($panier);

	die(json_encode(array("status"=>true)));
	
}





?>