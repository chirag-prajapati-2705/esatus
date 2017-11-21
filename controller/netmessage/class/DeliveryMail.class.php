<?php
require_once("MailDoc.class.php");
require_once("MailHeader.class.php");
include_once("Delivery.class.php");

/**
 * 
 * Represente un objet délivery concernant le mail
 * 
 */
class DeliveryMail extends Delivery{

	/** @var MailHeader */
	public  $Header;

	/** @var MailDoc */
	public  $MailDoc;


	function __construct()
	{
		$this->Header=new MailHeader();
		$this->MailDoc=new MailDoc();
		parent::__construct();
	}
	
}
?>