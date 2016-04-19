<?php
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';
include_once '../Classes/Panier.php';

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

$template = $twig->loadTemplate('panier.twig');

$images = array(array('src' => "../Images/images_famille/famille_poudre.png"),
		array('src' => "../Images/images_famille/famille_pate.png"),
		array('src' => "../Images/images_famille/famille_seche.png"),
		array('src' => "../Images/images_famille/famille_conserve.png"));

$pdo = SPDO::getInstance();
$sql = "SELECT * FROM familles";
$stmt = $pdo->query($sql);

$familles = $stmt->fetchAll(PDO::FETCH_ASSOC);


//Récupération des objets du panier pour les passer au template twig
$panier = unserialize($_SESSION['panier']);
$items = $panier->recupereItems();
$items_panier = array();

foreach($items as $item)
{
	$sql = "SELECT * FROM articles WHERE idArticle='".$item."'";
	$stmtitem = $pdo->query($sql);
	$vars = $stmtitem->fetch(PDO::FETCH_ASSOC);
	$items_panier[] = array("img"=>$vars["path"], "prix"=>$vars["prix"],"nom"=>$vars["libelleArticle"]);
}

echo $template->render(array("familles"=>$familles, "images"=>$images, "panier"=>$items_panier));

?>
