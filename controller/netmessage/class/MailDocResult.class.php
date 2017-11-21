<?php
require_once("MailDoc.class.php");

/**
 * 
 * Resultat d'une ligne de recherche des accusés reception
 * 
 */

class MailDocResult extends ResultMessage{



	/** @var string */
	public $Status;
	
  /** @var MailDoc */
	public $MailDoc;
	
  /** @var string */
  public $name;	
  
	function __construct()
	{
	
		$this->Status="KO";
	  $this->TemplateId="";
    $this->Name="";
    
		parent::__construct();
		
	}
}
?>