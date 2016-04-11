<?php

include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);


if (isset ($_POST["code"]) && isset ($_POST["password"]))
{
	$hash = hash('sha256', $_POST['password']);
	$request = "SELECT * FROM utilisateurs WHERE codeClient = '".$_POST["code"]."' AND motDePasse = '".$hash."'";
	
	$pdo = SPDO::getInstance();
	$stmt = $pdo->query($request);
	
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($res != NULL)
	{
		$template = $twig->loadTemplate('index.twig');
		echo $template->render(array());
	}
	
	
}


//echo $template->render(array());

?>
