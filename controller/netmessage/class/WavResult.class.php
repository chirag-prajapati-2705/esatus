<?php
class WavResult extends ResultMessage
{
	/** @var int */
	public $WavNumber;
	
	/** @var string */
	public $WavServer;
	
	/** @var string */
	public $WavName;
	
	/** @var string */
	public $RequestStatus;
	
	
	
	function __construct()
	{
		parent::__construct();
		
		$this->WavNumber=0;
		$this->WavServer="";
	    $this->WavName="";
	    $this->RequestStatus="KO";
	    
		
	}
	
	
	
}
