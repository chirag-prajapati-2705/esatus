<?php
class InterimVoiceReport extends InterimReport
{
	

	
	/** @var integer */
	public $MissingWav;
	
	/** @var integer */
	public $IncorrectWav;
	
	/** @var integer */
	public $OkPartial;
	
	/** @var integer */
	public $OkComplet;
	
	/** @var integer */
	public $OkAnswerPhone;
	
	/** @var integer */
	public $OkDTMF;
	
	/** @var integer */
	public $OkDTMF_Ec;
	
	/** @var integer */
	public $OkDTMF_AnswerPhone;
	
	/** @var integer */
	public $OkDTMF_AnswerPhone_Ec;
	
	/** @var int */
	public $VosStopVoix;
	
	/** @var int */
	public $BloqueVoix;
	
	 /** @var int */
	public $NeDecrochePas;
	
	/** @var int */
	public $Occupe;
	
	
	
	/** @var int */
	public $PasDeTonalite;
	
	/** @var int */
	public $AppelRejete;
	
	/** @var int */
	public $Congestion;
	
	
	function __construct()
	{
		$this->MissingWav=0;
		$this->IncorrectWav=0;
		$this->OkPartial;
		$this->OkComplet=0;
		$this->OkAnswerPhone=0;
		$this->OkDTMF=0;
		$this->OkDTMF_Ec=0;
		$this->OkDTMF_AnswerPhone=0;
		$this->OkDTMF_AnswerPhone_Ec=0;
		$this->VosStopVoix=0;
	    $this->BloqueVoix=0;
	    
	    $this->NeDecrochePas=0;
		$this->Occupe=0;
		
		$this->PasDeTonalite=0;
		$this->AppelRejete=0;
		$this->Congestion=0;
	    
	    	
		parent::__construct();
		
	}
	
	
}