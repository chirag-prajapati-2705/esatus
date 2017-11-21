<?php
class InterimReport extends ResultMessage
{
	/** @var int */
	public $TotalReported;
	
	/** @var int */
	public $TotalOperation;
	
	/** @var string */
	public $DateLastEvent;
	
	/** @var int */
	public $EnAttente;
	
	/** @var int */
	public $Annule;
	
	/** @var int */
	public $DateStop;
	
	/** @var int */
	public $BadTime;
	
	/** @var int */
	public $BlackList;
	
	/** @var int */
	public $Bloque;
	
	/** @var int */
	public $Spam;

	/** @var int */
	public $EnvoiOK;
	
	/** @var string */
	public $CsvReportDetailed;
	
	/** @var int */
	public $NonAttribue;
	
	/** @var int */
	public $NoReport;
	
	/** @var int */
	public $OperationStatus;
	
	/** @var int */
	public $NoDelivered;
	
	function __construct()
	{
		$this->EnAttente=0;
		$this->Annule=0;
		$this->DateStop=0;
		$this->BadTime=0;
		$this->EnvoiOK=0;
		$this->TotalReported=0;
		$this->TotalOperation=0;
		$this->EnAttente=0;
		$this->Annule=0;
		$this->DateStop=0;
		$this->BadTime=0;
		$this->BlackList=0;
		$this->Bloque=0;
		$this->Spam=0;
		$this->DateLastEvent="";
		$this->CsvReportDetailed="";
		$this->NonAttribue=0;
		$this->NoReport=0;
		$this->NoDelivered=0;
		$this->OperationStatus=0;
		parent::__construct();
		
	}
}