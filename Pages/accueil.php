<?php
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('accueil.twig');

$images = array(array('src' => "../Images/images_famille/famille_poudre.png"),
				array('src' => "../Images/images_famille/famille_pate.png"),
				array('src' => "../Images/images_famille/famille_seche.png"),
				array('src' => "../Images/images_famille/famille_conserve.png"));

$pdo = SPDO::getInstance();
$sql = "SELECT * from familles";
$stmt = $pdo->query($sql);
$famille = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo $template->render(array('images'=>$images, 'familles'=>$famille
	
));



?>