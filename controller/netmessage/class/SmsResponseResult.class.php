<?php
class SmsResponseResult extends ResultMessage
{
	
	/** @var string */
	public $SmsOriginating;
	/** @var string */
	public $SmsTransactionId;
	/** @var string */
	public $SmsDate;
	/** @var string */
	public $SmsData;
	/** @var string */
	public $SmsDestination;
	/** @var string */
	public $SmsReference;
	/** @var string */
	public $SmsKeyword;
	
	
	
	
	function __construct()
	{
		
		$this->SmsOriginating="";
		$this->SmsData="";
		$this->SmsDate="";
		$this->SmsDestination="";
		$this->SmsTransactionId="";
		$this->SmsKeyword="";
		$this->SmsReference="";
		
	}
	
	
	
}
?>