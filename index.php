<?php
include_once 'Twig/Autoloader.php';
include_once 'Classes/SPDO.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('index.twig');

$images = array(array('src' => "Images/carroussel/carroussel1.png"),
				array('src' => "Images/carroussel/carroussel2.png"),
				array('src' => "Images/carroussel/carroussel3.png"));

echo $template->render(array('images'=>$images
	
));


?>