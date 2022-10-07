<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(dirname(__FILE__) . '/../templates');
	$twig = new Environment($loader);
	echo $twig->render("echo.html");
?>
