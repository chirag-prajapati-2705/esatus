<?php
/**
 * 
 * Resultat d'une ligne de recherche des accusés reception
 * 
 */

class EmailTemplateResult extends ResultMessage{



	/** @var string */
	public $Status;
	
  /** @var string */
	public $TemplateId;
	
  /** @var string */
	public $Name;
	
  
	function __construct()
	{
	
		$this->Status="KO";
	  $this->TemplateId="";
    $this->Name="";
    
		parent::__construct();
		
	}
}
?>