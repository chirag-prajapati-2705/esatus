<?php
/**
 * Objet wav relatif aux script vocaux
 * 
 *
 */
class WavObject
{
	
	
	/** @var int */
	public $WavNumber;
	
	/** @var string */
	public $WavName;
	
	/** @var string */
	public $WavServer;
	
	/** @var string */
	public $WavType;
	
	function __construct()
	{
		
		$this->WavServer="";
		$this->WavNumber=0;
		$this->WavName="";
		$this->WavType="WAV";
		
	}
	
	
}
?>