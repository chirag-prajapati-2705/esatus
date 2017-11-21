<?php
class SentInfo extends ResultMessage
{
	/** @var string */
	public $ReceiptKey;
	/** @var string */
	public $ReceiptServer;
	/** @var string */
	public $OpeKey;
	/** @var int */
	public $DeliveryType;
	/** @var string */
	public $ReceiptStatus;
	
	function __construct($log)
	{
		$this->ReceiptKey="";
		$this->ReceiptServer="";
		$this->OpeKey="";
		$this->DeliveryType="";
		$this->ReceiptStatus="";
		
		
	}
	
}
?>