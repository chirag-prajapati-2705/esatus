<?php
/**
 * Definition des infos d'un user
 */
 class UserInfos
 {
 
/** @var string */
 	public $Username;
/** @var string */
 	public $AccountKey;
/** @var string */
 	public $AccountName;
/** @var string */
 	public $UserKey;
/** @var string */
 	public $Server;
	function __construct()
	{
		$this->Username="";
		$this->AccountKey="";
		$this->AccountName="";	
		$this->UserKey="";
		$this->Server="";		
	}
 
 
 
 }

?>