<?php
//require_once ("MailImage.class.php");
//require_once ("CustomField.class.php");
require_once("Personalisation.class.php");

/**
 * 
 * Représente un document pour une campagne email
 * 
 */
//ActivateTracking par defaut
class MailDoc extends Personalisation{

	/** @var string */
	public $UnsubscribeModel;
	
	/** @var int */
	public  $OpenTracking;

	/** @var string[] */
	public  $ExceptUrlTracking;

	/** @var string */
	public  $HtmlBody;

	/** @var string */
	public  $TextBody;

	/** @var MailImage[] */
	public $Images;
	
	/** @var MailAttachment[] */
	public $Attachments;
	
	/** @var CustomField[] */
	public $Persos;
	
	
	
	function __construct()
	{
		
		
		
		$this->ExceptUrlTracking=array();
		$this->HtmlBody="";
		$this->TextBody="";
		$this->OpenTracking=1;
		$this->Images=array();
		$this->Attachments=array();
		$this->Persos=array();		
		$this->UnsubscribeModel="";
		
		
		
	}
}
?>