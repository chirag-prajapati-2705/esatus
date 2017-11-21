<?php

require_once("MailReport.class.php");
require_once("ResultMessage.class.php");
class InterimMailReport extends ResultMessage
{
	/** @var string */
	public $Server;
	
	/** @var MailReport[] */
	public $MailReports;
	
	/** @var string */
	public $CsvReport;
	
  /** @var string */
  public $CsvStats;
  
	/** @var string */
	public $CsvEvent;
	
	/** @var string */
	public $Status;
	
	
	function __construct()
	{
		$this->MailReports=array();
		$this->Server="";
		$this->CsvEvent="";
		$this->CsvReport="";
    $this->CsvStats="pas de stats";
		$this->Status="KO";
		parent::__construct();
	}
}		

	
	
	
	
	
