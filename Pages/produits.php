<?php
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('produits.twig');

$pdo = SPDO::getInstance();
$sqlfamille = "SELECT * FROM familles";
$stmtfamille = $pdo->query($sqlfamille);
$famille = $stmtfamille->fetchAll(PDO::FETCH_ASSOC);

$sqlproduit = "SELECT * FROM articles WHERE idFamille ='".$_GET['f']."'";
$stmtproduit = $pdo->query($sqlproduit);
$produit = $stmtproduit->fetchAll(PDO::FETCH_ASSOC);


$images = array(array('src' => "../Images/images_famille/famille_pate.png"));

echo $template->render(array('familles'=>$famille, 'produits'=>$produit, 'images'=>$images
	
));





?>