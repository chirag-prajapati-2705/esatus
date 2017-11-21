<?php
/**
 * Retour  fonction de test des webservices
 * @author gilles manouvrier
 *
 */
class CheckResult extends ResultMessage
{
	
	/** @var string */
	public $CheckUser;
	/** @var string */
	public $CheckDatabases;
	/** @var string */
	public $CheckInjectionFolders;
	/** @var string */
	public $Status;
	
	function __construct()
	{
		$this->CheckUser="";
		$this->CheckDatabases="";
		$this->CheckInjectionFolders="";
		$this->Status="";
		
		parent::__construct();
		
		
	}
	
	
}
?>