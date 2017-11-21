<?php
include_once("InterimReport.class.php");

class InterimSmsReport extends InterimReport
{
	
	
    
	
	/** @var int */
	public $Delivered;
	
	/** @var int */
	public $Acked;
	
	/** @var int */
	public $IncorrectFrom;
	
	/** @var int */
	public $IncorrectSms;
	
	/** @var int */
	public $TooLongMessage;
	
	/** @var int */
	public $InvalidCar;
	
	/** @var int */
	public $RejectedSmsNumber;
	
	
	
	/** @var int */
	public $InvalidSmsNumber;
	
	
	/** @var int */
	public $VosStopSms;
	
	
	
	
	function __construct()
	{
		$this->Delivered=0;
		
		$this->Acked=0;
		$this->IncorrectFrom=0;
		$this->IncorrectSms=0;
		$this->InvalidCar=0;
		$this->RejectedSmsNumber=0;
		$this->TooLongMessage=0;
		$this->InvalidSmsNumber=0;
		$this->VosStopSms=0;
		parent::__construct();
		
		
	}
	
	
}
?>