<?php

class Delivery
{
	
	protected $orderRouter;	
/** @var string */
public $DeliverySchedule;

/** @var string */
public $DeliveryMustStopSchedule;


/** @var string */
public $CustomerListNumber;

/** @var string */
public $CustomerListServer;

/** @var RecipientList[] */
private $recipientsLists;

/** @var RecipientsList */
public $RecipientsCustomerList;

/** @var string */
public $SenderId;

/** @var TimeSlot[] */
public $DiffusionPeriod;

/** @var string */
public $CascadeNumber;

function __construct()
{
	//BlackOutPeriod
	$this->orderRouter="WSSI01";
	$this->JobNumber=array();
	$this->recipientsLists=array();
	$this->DiffusionPeriod=array();
	$this->SenderId="";
	$this->CustomerListServer="";
	
	return $this;
}
	
}
?>