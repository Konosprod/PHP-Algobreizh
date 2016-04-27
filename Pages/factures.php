<?php
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';

if(!isset($_SESSION))
{
	session_start();
}

if(!$_SESSION["log"])
{
	header("Location: ..");
	die();
}

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('factures.twig');

$pdo = SPDO::getInstance();

$sql = "SELECT * FROM familles";
$stmt = $pdo->query($sql);
$familles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM commandes WHERE codeClient = '".$_SESSION['code']."' AND valide = 1";
$stmt = $pdo->query($sql);
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$commandes = array();

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

echo $template->render(array("factures"=>$commandes, "familles"=>$familles));
?>