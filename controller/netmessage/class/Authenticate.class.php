<?php
/**
 * 
 * Classe d'authentication sur les webservices
 *
 */ 
class Authenticate{
	
/** @var string */
	public $Username;
/** @var string */
	public $Password;
/** @var string */
	public $SenderId;
/** @var string */
	public $AccountName;
/** @var string */
	public $AccountKey;	
/** @var string */
	public $Server;
	
	function __construct()
	{
		$this->AccountKey="";
		$this->AccountName="";
		$this->Password="";
		$this->SenderId="";
		$this->Server="AASI01";
		$this->Username="";
		
		
		
	}
	
}

?>