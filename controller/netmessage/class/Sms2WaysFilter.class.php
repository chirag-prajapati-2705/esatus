<?php
include '/var/www/vhosts/ns428114.ip-37-187-149.eu/httpdocs/esatus/controller/netmessage/class/ListFilter.class.php';

class Sms2WaysFilter extends ListFilter
{
	
	/** @var string */
	public $SmsDestination;
	/** @var string */
	public $Keyword;
	
	/** @var string */
	public $SmsData;
	
	
	
	function __construct()
	{
		$this->SmsDestination="";
		$this->Keyword="";
		$this->SmsData="";
		
		parent::__construct();
	}
	
	
	
	
	
}


?>