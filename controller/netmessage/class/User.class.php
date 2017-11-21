<?php
include_once("UserInfos.class.php");
/**
 * User créateur de campagne
 */
class User extends UserInfos
{
/** @var string */
	public $SenderId;
/** @var string */
	public $Password;

	function __construct($ui="")
	{
		if($ui!="")
		{
			$this->AccountKey=$ui->AccountKey;
			$this->AccountName=$ui->AccountName;
			$this->Username=$ui->Username;
			$this->SenderId="";
			$this->UserKey=$ui->UserKey;
			
			parent::__construct();
			
			
		}
		
	}
	
}



?>