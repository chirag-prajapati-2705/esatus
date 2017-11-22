<?php
define('BIN',dirname(__file__));
define('ROOT',dirname(BIN));
define('DS','/');
define('CORE',ROOT.DS.'core');
// define('URL','http://'.$_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['SCRIPT_NAME'])));
//define('URL','http://'.$_SERVER['HTTP_HOST'].'/esatus_live_15_11/bin').'index.php/';
define('URL','http://'.$_SERVER['HTTP_HOST'].'/esatus/bin').'index.php/';
define('ROOT_URL','https://'.$_SERVER['HTTP_HOST'].'/esatus_live_15_11');
define('IMAGE',URL.DS.'images'.DS);
define('FONT',URL.DS.'fonts'.DS);
define('JS',URL.DS.'js'.DS);
define('CSS',URL.DS.'css'.DS);
define('HTML',URL.DS.'html'.DS);
define('css_admin',URL.DS.'css'.DS.'admin'.DS);
define('IS_TEST',TRUE);

define('CONSUMER_KEY', 'kqKWt3pfabA8RVjL7Lrp9PinX'); // YOUR CONSUMER KEY
define('CONSUMER_SECRET', '5ynlWQXoLuc0uCJQq9QmgqUfhEWaLQPdKNyazjy8SvQWt7Z0uZ'); //YOUR CONSUMER SECRET KEY
define('OAUTH_CALLBACK', 'http://localhost/esatus_live_15_11/bin/index.php/twitter-login');  // Redirect URL
//define('OAUTH_CALLBACK', 'http://localhost/example/login_with_twitter_using_php/index.php');  // Redirect URL

define('APP_ID', '146961899265476'); // YOUR CONSUMER KEY
define('SECRET_KEY', '5ynlWQXoLuc0uCJQq9QmgqUfhEWaLQPdKNyazjy8SvQWt7Z0uZ'); //YOUR CONSUMER SECRET KEY
define('REDIRECT_URL', 'http://localhost/esatus_live_15_11/bin/index.php/facebook-login'); //YOUR CONSUMER SECRET KEY


?>