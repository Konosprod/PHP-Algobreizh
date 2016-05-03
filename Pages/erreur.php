<?php
/**
 * Page de gestion des erreurs. Une erreur
 * sera affichée en fonction d'un id afin
 * de rendre l'erreur compréhensible par
 * l'utilisateur
 */
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

//On regarde si le paramètre e est définis dans le get
if(isset($_GET["e"]))
{
	switch($_GET["e"])
	{
		//Si il est à 1, c'est une erreur de login
		case 1:
			$erreur = "Erreur de login. Mauvais mot de passe ou code client.";
		break;
	}
}


echo $template->render(array("images"=>$images, "erreur"=>$erreur));
?>