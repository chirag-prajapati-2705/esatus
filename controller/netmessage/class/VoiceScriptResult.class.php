<?php
require_once("ResultMessage.class.php");
class VoiceScriptResult extends ResultMessage
{
	/** @var string */
	public $RequestStatus;
	
	/** @var int */
	public $ScriptNumber;
	
	/** @var string */
	public $ScriptServer;
	
	/** @var string */
	public $ScriptName;
	
	/** @var WavObject[] */
	public $WavObjects;
	
	function __construct()
	{
		parent::__construct();
		$this->RequestStatus="KO";
		$this->ScriptServer="";
		$this->ScriptNumber=0;
		$this->ScriptName="";
		
		$this->WavObjects=array();
		
	}
	
}




?>