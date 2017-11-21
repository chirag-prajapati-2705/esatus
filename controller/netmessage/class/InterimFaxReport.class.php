<?php
class InterimFaxReport extends InterimReport
{

    /** @var int */
	public $EnvoiOK;
	
    /** @var int */
	public $NeDecrochePas;
	
	/** @var int */
	public $Occupe;
	
	/** @var int */
	public $NonAttribue;
	
	/** @var int */
	public $PasDeTonalite;
	
	/** @var int */
	public $AppelRejete;
	
	/** @var int */
	public $Congestion;
	
	
	/** @var int */
	public $ErreurTrans;
	
	/** @var int */
	public $ErreurFinTrans;
	
	/** @var int */
	public $Voix;
	
	/** @var int */
	public $NonFax;
	
	
	/** @var int */
	public $ConnectError;
	
	/** @var int */
	public $SpaceCache;
	
	/** @var int */
	public $TimeOut;
	
	/** @var int */
	public $BloqueEcofax;
	
	/** @var int */
	public $VosStopFax;
	
	
	function __construct($log)
	{
		$this->NeDecrochePas=0;
		$this->Occupe=0;
		$this->NonAttribue=0;
		$this->PasDeTonalite=0;
		$this->AppelRejete=0;
		$this->Congestion=0;
		$this->ErreurFinTrans=0;
		$this->ErreurTrans=0;
		$this->Voix=0;
		$this->NonFax=0;
		$this->EnvoiOK=0;
		$this->ConnectError=0;
		$this->SpaceCache=0;
		$this->TimeOut=0;
		
		
		$this->BloqueEcofax=0;
		$this->VosStopFax=0;
		parent::__construct();
		
	}
	
}
