<?php
require_once("ResultMessage.class.php");
class FaxDocumentResult extends ResultMessage
{
	
	/** @var string[] */
	public $FaxContent;
	
	/** @var string */
	public $Name;
	
	/** @var string */
	public $DocNumber;
	
	/** @var string */
	public $DocServer;
	
	/** @var string */
	public $RequestStatus;
	
	
	
	function __construct()
	{
		$this->FaxContent="";
		$this->Name="";
		$this->DocNumber="";
		$this->DocServer="";
		$this->RequestStatus="KO";
		
		
		parent::__construct();
		
		
	}
	
	
}




?>