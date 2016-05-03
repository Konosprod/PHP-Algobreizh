<?php
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';


Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('erreur.twig');

// images carroussel
$images = array(array('src' => "../Images/images_famille/famille_poudre.png"),
		array('src' => "../Images/images_famille/famille_pate.png"),
		array('src' => "../Images/images_famille/famille_seche.png"),
		array('src' => "../Images/images_famille/famille_conserve.png"));

$erreur = "";

if(isset($_GET["e"]))
{
	switch($_GET["e"])
	{
		case 1:
			$erreur = "Erreur de login. Mauvais mot de passe ou code client.";
		break;
	}
}


echo $template->render(array("images"=>$images, "erreur"=>$erreur));
?>