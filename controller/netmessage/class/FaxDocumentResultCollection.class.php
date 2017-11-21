<?php
require_once("ResultCollection.class.php");
class FaxDocumentResultCollection extends ResultCollection
{
	
	/** @var FaxDocumentResult[]  */
	public $FaxDocumentResults;
	
	/** @var string */
	public $CustomerDocNumber;
	
	function __construct()
	{
		$this->CustomerDocNumber=0;
		$this->FaxDocumentResults=array();
		parent::__construct();
		
		
		
	}
	
	
	
	
	
	
}





?>