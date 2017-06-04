<?php

	require 'app/utils/Server.php';
	$root_dir 		= __DIR__;
	$server_host 	= $_SERVER['HTTP_HOST'];
	$server 		= new Server($server_host, $root_dir);

	$server->executeRequest();
?>