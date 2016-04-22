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

$template = $twig->loadTemplate('contact.twig');

$pdo = SPDO::getInstance();
$sql = "SELECT * FROM familles";
$stmt = $pdo->query($sql);

$familles = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo $template->render(array("familles"=>$familles));
?>
