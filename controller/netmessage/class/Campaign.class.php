<?php

include_once("DeliverySms.class.php");
//include_once("DeliveryVoice.class.php");
//include_once("DeliveryFax.class.php");
require_once("DeliveryMail.class.php");
include_once("SmsMessage.class.php");
include_once("SentResult.class.php");


/**
  *Class de creation de campagne ds le cadre de l'appli test EnvoiSms
  *
  *
  *
  */
class Campaign{


	
/** @var string */
public $Name;

/** @var string  */
public $EntryTime;


/** @var DeliverySms */
public $DeliverySms;


/** @var DeliveryVoice */
public $DeliveryVoice;

/** @var DeliveryFax */
public $DeliveryFax;

/** @var DeliveryMail */
public $DeliveryMail;


/** @var int */
public $ExistingOpeKey;

/** @var string */
public $ExistingOpeServer;

/** @var int */
private $timeToLive;

function __construct()
{
	
	$this->DeliverySms=new DeliverySms();
	$this->DeliveryVoice="";//new DeliveryVoice();
	$this->DeliveryFax="";//new DeliveryFax();
	$this->DeliveryMail=new DeliveryMail();
	$this->ExistingOpeKey=0;
	$this->ExistingOpeServer="";
	$this->Name="";
	$this->timeToLive=0;
	return $this;
	
}





}
?>