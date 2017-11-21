<?php
require 'library/Twilio/autoload.php';
use \Twilio\Twiml;
$queryArgs = array();
parse_str($_SERVER['QUERY_STRING'], $queryArgs);
$salesPhone = $queryArgs['sales_phone'];
$twiml = new Twiml();
/*$twiml->say('Welcome to Spidrontech LLC. Thanks for contacting our sales department. Our next available
representative will take your call');*/
$gather = $twiml->gather(array('numDigits' =>1,'finishOnKey'=>'#'));
$gather->play('http://139.59.68.192/esatus/call_recod.mp3');
$gather->dial($salesPhone);

print_r((string)$twiml);
