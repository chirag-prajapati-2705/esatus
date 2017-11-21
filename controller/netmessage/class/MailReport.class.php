<?php
require_once("MailEvent.class.php");
class MailReport
{
	/** @var string */
	public $Recipient;
	
	/** @var string */
	public $StatusName;
	
	/** @var int */
	public $StatusCode;
	
	/** @var MailEvent[] */
	public $Events;
	
	/** @var boolean */
	public $OneClick;
	
	function __construct()
	{
		$this->Recipient="";
		$this->StatusCode=0;
		$this->StatusName="";
		$this->Events=array();
		$this->OneClick=false;
	}
}	



?>