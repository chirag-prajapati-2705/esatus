<?php
/**
  *
  *Class de creation de delivery SMS dans le cadre de l'appli test d'envoi SMS
  *
  *
  */
//include_once("Delivery.class.php");
class DeliverySms extends Delivery{




/** @var string[] */
public $SMSList;

/** @var SmsMessage */
public $Message;

/** @var string */
public $Sms;

function __construct()
{
	
	parent::__construct();
  $this->Sms="";
	return $this;
}



}
?>