<?php
/**
 * 
 * Compte de production Sms
 *
 */
class EmailProductionAccount
{
	/** @var string */
	public $EmailKeyAccount;
	/** @var string */
	public $EmailNameAccount;
  /** @var string */
  public $UserKey1;
  /** @var string */
  public $UserKey2;
  
	/**
	 * 
	 * @param string name
	 * @param string key
	 * @return void
	 */
	function __construct($name,$key,$userKey1,$userKey2)
	{
			$this->EmailNameAccount=$name;
			$this->EmailKeyAccount=$key;
			$this->UserKey1=$userKey1;
      $this->UserKey2=$userKey2;
      
		
	}
}
?>