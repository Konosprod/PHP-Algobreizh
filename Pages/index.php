<?php
/**
 * Page qui empêche le listing du dossier Pages/
 */
if(!isset($_SESSION))
{
	session_start();
}

if(!$_SESSION["log"])
{
	header("Location: accueil.php");
	die();
}

if($_SESSION["admin"])
{
	header("Location: admin.php");
	die();
}
else
{
	header("Location: accueil.php");
	die();
}
?>