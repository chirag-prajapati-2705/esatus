<?php
include_once("Personalisation.class.php");
/**
 * Message TTS
 * 
 *
 */
class TTSMessage extends Personalisation
{
	/** @var string */
	public $Content;
	
	/** @var string */
	public $VoiceName;
	
	
	function __construct()
	{
		$this->Content="";
		$this->VoiceName="Juliette";
		parent::__construct();
		
	}

	/**
	 * Affecte un Message TTS
	 * @param sting
	 * @param string
	 * @return TTSMessage
	 */
 public function SetMessage($message,$encoding)
 {
 	
 	$this->Encoding=$encoding;
 	//$message="[--message_" . $this->MessageNumber . "--[\r\n" . $message . "\r\n]--message_" . $this->MessageNumber . "--]";
 	$this->extractPerso($message);
 	
 	
 	$this->CharCount=strlen($this->withoutPersoMessage);
 	//if(strlen($this->withoutPersoMessage)<=)
 		$this->Content=$message;
 	
 	return $this;
 	
 }
 /**
  * 
  * @return string
  */
 public function GetMessage()
 {
 	return $this->Content;
 	
 }
}
?>