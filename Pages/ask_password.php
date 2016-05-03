<?php
/**
 * Permet à un client de faire une demande de 
 * mot de passe. Celui-ci lui sera envoyé
 * par mail.
 */
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('ask_password.twig');

echo $template->render(array());

$Id = rand(10000, 99999);
$mdp = base_convert($Id, 20, 36);
$hash = hash('sha256', $mdp);

print_r($_POST);

if (isset ($_POST["codeClient"]) && isset ($_POST["mailClient"]))
{
	$pdo = SPDO::getInstance();
	
	$request = "SELECT codeClient, email FROM utilisateurs WHERE codeClient = '".$_POST['codeClient']. "' AND email = '".$_POST['mailClient']."'";
	
	$stmt = $pdo->query($request);
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	print_r($res);
	
	if ($res != NULL)
	{
		echo $mdp;
	}
}

?>