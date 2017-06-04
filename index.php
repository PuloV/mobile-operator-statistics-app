<?php
	function renderHome()
	{
		var_dump('renderMe');
	}
	require 'app/libs/altoRouter/AltoRouter.php';

	$router = new AltoRouter();
	$router->setBasePath('/personal-projects/mobile-operator-statistics-app/');
	$router->map( 'GET|POST', '', 'renderHome', 'renderHome' );
	var_dump($router->match());
?>