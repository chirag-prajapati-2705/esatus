<?php

class WavContentResult extends ResultMessage
{
	
	/** @var string */
	public $WavContent;
	
	/** @var string */
	public $RequestStatus;
	
	
	
	function __construct()
	{
		parent::__construct();
		$this->WavContent="";
		$this->RequestStatus="KO";
	}
	
	
	
}




?>