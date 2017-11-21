<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret

FacebookSession::setDefaultApplication( '146961899265476','540f51a7692f3526fbdaada6d51102a5' );
$helper = new FacebookRedirectLoginHelper('https://4ae4bc5e.ngrok.io/1353/fbconfig.php' );

try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  $graphObject = $response->getGraphObject();
  $facebook_id = $graphObject->getProperty('id');              // To Get Facebook ID
  $full_name = $graphObject->getProperty('name'); // To Get Facebook full name
  $email = $graphObject->getProperty('email');    // To Get Facebook email ID
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>