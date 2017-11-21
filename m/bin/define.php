<?php 
	define('BIN',dirname(__file__));
	define('ROOT',dirname(BIN));
	define('DS','/');
	define('CORE',ROOT.DS.'core');
	// define('URL','http://'.$_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['SCRIPT_NAME'])));
	define('URL','http://'.$_SERVER['HTTP_HOST']).''; 
	define('IMAGE',URL.DS.'bin'.DS.'images'.DS);
	define('FONT',URL.DS.'bin'.DS.'fonts'.DS);
	define('JS',URL.DS.'bin'.DS.'js'.DS);
	define('CSS',URL.DS.'bin'.DS.'css'.DS);
        define('HTML',URL.DS.'bin'.DS.'html'.DS);
        define('css_admin',URL.DS.'bin'.DS.'css'.DS.'admin'.DS);
?>