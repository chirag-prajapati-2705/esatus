<?php
require_once("FaxDocument.class.php");
/**
 * Delivery dédié aux fax
 * @author gilles manouvrier
 *
 */
class DeliveryFax extends Delivery
{
	/** @var int */
	public $QualityType;
	
	/** @var FaxDocument[] */
	public $FaxDocument;
	
	/** @var int */
	CONST STANDARD=100;
	
	/** @var int */
	CONST FINE=200;
	
	
	function __construct()
	{
		$this->QualityType=100;
		$this->FaxDocument=array();		
		parent::__construct();
	}
	
	
	
	
	
}
?>