<?php
class ResultCollection
{
/** @var int */
	public $From;
	
		
	/** @var int */
	public $Size;
	
	/** @var int */
	public $Count;
		
	/** @var string */
	public $RequestStatus;
	
	/** @var string */
	public $RequestErrorLog;
	
	function __construct()
	{
		$this->From=0;
		$this->Size=0;
		$this->RequestStatus="KO";
		$this->RequestErrorLog="";
	}
	
	
}
?>