<?php
include_once("VoiceMessage.class.php");
include_once("AnswerPhoneMessage.class.php");

/**
 * Class de scenario voice
 */
 
class WavScenario
{
	
	/** @var VoiceMessage */
	public $VoiceMessage;
	
	/** @var AnswerPhoneMessage */
	public $AnswerPhone;
	
	/**
	 * 
	 * @return void
	 */
	function __construct()
	{
		$this->VoiceMessage=new VoiceMessage();
		$this->AnswerPhone=new AnswerPhoneMessage();
		
		
		
	}
} 

?>