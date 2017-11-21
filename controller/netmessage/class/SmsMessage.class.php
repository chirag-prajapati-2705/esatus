<?php
include_once("Personalisation.class.php");

interface ISetter{
	
public function SetMessage($message,$encoding);	
	
}
/**
  * Message de type SMS
  */
class SmsMessage extends  Personalisation{

	
/** @var string */
  public $Encoding;
/** @var string */
  public $Message;
/** @var string */
  public $OpeNumber;
/** @var string */
  public $CharCount;


  
 private $persoOffset;
protected $iniMessage;



 function __construct($messageNumber="")
 {
 	$this->MessageNumber=$messageNumber;
 	
 	return $this;
 }

}

//debug
//$obj=new SmsMessage();
//$obj->setMessage("test","c");
//echo $obj->GetLenght();



?>