<?php
/**
 * Page qui gère la partie administration du site
 * Elle permet de valider les commandes passées
 * par les clients
 */
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';

if(!isset($_SESSION))
{
	session_start();
}

if(!$_SESSION["log"] || !$_SESSION["admin"])
{
	header("Location: ..");
	die();
}

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('admin.twig');

$images = array(array('src' => "../Images/images_famille/famille_poudre.png"),
				array('src' => "../Images/images_famille/famille_pate.png"),
				array('src' => "../Images/images_famille/famille_seche.png"),
				array('src' => "../Images/images_famille/famille_conserve.png"));

$pdo = SPDO::getInstance();

$sql = "SELECT * FROM commandes WHERE valide = 0";
$stmt = $pdo->query($sql);
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$commandes = array();

// Gestion des details de commande
foreach($res as $commande)
{
	$commande["details"] = array();
	$sql = "SELECT * FROM details WHERE idCommande = '".$commande["idCommande"]."'";
	$stmt = $pdo->query($sql);
	$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$v = array();

	foreach($details as $item)
	{
		$nom = $pdo->query("SELECT libelleArticle FROM articles WHERE idArticle ='".$item["idArticle"]."'")->fetch(PDO::FETCH_ASSOC)["libelleArticle"];
		$var = array();

		$var["nom"] = $nom;
		$var["montant"] = $item["montant"];
		$var["qte"] = $item["qteArticle"];
		$var["total"] = $item["montant"] * $item["qteArticle"];
		$v[] = $var;
	}

	$commande["details"] = $v;
	$commandes[] = $commande;
}

echo $template->render(array('images'=>$images, 'commandes'=>$commandes));

?>

