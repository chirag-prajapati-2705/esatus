<?php

	error_reporting(E_ALL ^ E_DEPRECATED);
	
	require 'define.php';
	require CORE.DS.'includes.php';
	
	new Dispatcher();
?>