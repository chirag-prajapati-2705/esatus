<?php
/**
 * 
 * Représentation d'un header de mail doc
 * 
 */

class MailHeader {

	/** @var string */
	public  $Object;

	/** @var string */
	public  $FromName;

	/** @var string */
	public  $FromMail;

	/** @var string */
	public  $Noreply;

	/** @var string */
	public  $ErrorTo;

	/** @var string */
	public  $Charset;

	/** @var string */
	public  $Encoding;

	/** @var string */
	public $ReplyTo;
	
	function __construct()
	{
		$this->Object="";
		$this->Charset="2";//default
		$this->Encoding="1";//default
		$this->ErrorTo="";
		$this->FromMail="";
		$this->FromName="";
		$this->Noreply="";
		$this->ReplyTo="";
		
		
	}
	
}
?>