<?php

include_once '../Classes/Panier.php';

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
?>