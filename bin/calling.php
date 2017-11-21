<?php
require '../library/Twilio/autoload.php';
use \Twilio\Twiml;
$queryArgs = array();
parse_str($_SERVER['QUERY_STRING'], $queryArgs);
$salesPhone = $queryArgs['sales_phone'];

// Use the Twilio PHP SDK to build an XML response
$response = new Twiml();
// If the user entered digits, process their request
//If user press
if (array_key_exists('Digits', $_POST)) {
    switch ($_POST['Digits']) {
        case 1:
            $response->dial($salesPhone);
            break;
        default:
            $response->say('Sorry, I don\'t understand that choice.');
    }
} else {
    $response->play('http://esatus.fr/call_recod.mp3');
    $gather = $response->gather(array('numDigits' => 1));
}
// Render the response as XML in reply to the webhook request
header('Content-Type: text/xml');
echo $response;