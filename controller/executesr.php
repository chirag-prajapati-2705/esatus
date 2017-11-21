<?php

$PAR = $_SERVER['argv'];
$oldsession = $PAR[1];
$userid = $PAR[2];
$serviceid = $PAR[3];
$disposition = $PAR[3];
$disposition2 = $PAR[4];
$billsec = $PAR[5];
$callstart = $PAR[6];
$callend = $PAR[7];

$sr = new CallsController();

$sr->server_response($oldsession, $userid, $serviceid, $disposition, $disposition2, $billsec, $callstart, $callend);
?>
