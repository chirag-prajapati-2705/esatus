<?php
include 'ResultCollection.class.php';
class SmsResponseResultCollection extends ResultCollection
{
	
	/** @var SmsResponseResult[] */
	public $SmsResponseResults;
	
	
	function __construct()
	{

		$this->SmsResponseResults=array();
		parent::__construct();
		
	}
	
}
?>