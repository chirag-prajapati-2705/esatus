<?php
include_once("WavMessage.class.php");
include_once("TTSMessage.class.php");
/**
 * Voice Message
 * 
 *
 */
class VoiceMessage
{

	/** @var WavMessage */
	public $Wav;
	/** @var TTSMessage */
	public $TTS;
	
	/**
	 * 
	 * @return void
	 */
	function __construct()
	{
		$this->TTS=new TTSMessage();
		$this->Wav=new WavMessage();
		
	}
}
?>