<?php
require_once("ResultMessage.class.php");
/**
  * Class de retour de résultat sur envoi dans le cadre de l'appli test d'envoi SMS
  */
class SentResult extends ResultMessage{

/** @var string */
 public $DeliveryType;

/** @var string */
 public $Server;

/** @var string */
 public $Status;

/** @var string */
  public $ErrorTrace;

/** @var JobInfos */
  public $JobInfos;
  

  
  


function __construct($log)
{
	$this->DeliveryType="";
	$this->Server="";
	$this->Status="KO";
	$this->OpKey="";
	$this->UserName="";
	$this->AccountRef="";
	$this->ErrorTrace="";
	$this->JobInfos=new JobInfos();
	$this->JobInfos->CustomerListNumber="";
	$this->JobInfos->JobNumber="";
	$this->JobInfos->OpeNumber="";
	$this->JobInfos->OrderRouter="";
	$this->JobInfos->RecipientListNumber="";
	
	parent::__construct($log);
}


}


?>