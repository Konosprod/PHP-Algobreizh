<?php
include_once '../Twig/Autoloader.php';
include_once '../Classes/SPDO.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/../Templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('produits.twig');

echo $template->render(array());



?>