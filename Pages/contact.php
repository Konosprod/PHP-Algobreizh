<?php
/**
 * Affiche les informations de contact
 */
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

$template = $twig->loadTemplate('contact.twig');

$pdo = SPDO::getInstance();
$sql = "SELECT * FROM familles";
$stmt = $pdo->query($sql);

$familles = $stmt->fetchAll(PDO::FETCH_ASSOC);



$images = array(array('src' => "../Images/images_famille/famille_poudre.png"),
		array('src' => "../Images/images_famille/famille_pate.png"),
		array('src' => "../Images/images_famille/famille_seche.png"),
		array('src' => "../Images/images_famille/famille_conserve.png"));

echo $template->render(array("images"=>$images, "familles"=>$familles));
?>
