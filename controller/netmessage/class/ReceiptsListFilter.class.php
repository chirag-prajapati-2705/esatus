<?php
/**
 * 
 * Filtre de recuperation des Accuses receptions
 * 
 */
require_once("ListFilter.class.php");

class ReceiptsListFilter extends ListFilter {

	/** @var boolean */
	public $HasReceiptKeyFilter;
	
	/** @var boolean */
	public $HasProcessedFilter;
	
	
	/** @var boolean */
	public  $HasUserNameFilter;

	/** @var boolean */
	public  $HasStatusFilter;

	/** @var boolean */
	public  $HasDeliveryTypeFilter;

	/** @var string */
	public  $UserNameFilter;

	/** @var string */
	public  $StatusFilter;

	/** @var int */
	public  $DeliveryTypeFilter;

	/** @var string */
	public $ReceiptKeyFilter;
	
	/** @var boolean */
	public $ProcessedFilter;
	
	function __construct()
	{
		$this->HasReceiptKeyFilter=false;
		$this->HasUserNameFilter=false;
		$this->HasStatusFilter=false;
		$this->HasDeliveryTypeFilter=false;
		$this->HasProcessedFilter=false;
		$this->UserNameFilter="";
		$this->StatusFilter="";
		$this->DeliveryTypeFilter=0;
		$this->ReceiptKeyFilter="";
		$this->ProcessedFilter=true;
		parent::__construct();
		
		
		
	}
	
	
	
}
?>