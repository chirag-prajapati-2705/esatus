<?php

class MailElement extends MailImage
{
	
	/** @var string */
	public $RelPath;
	/** @var string */
	public $WindowsPath;
	
	/** @var string */
	public $Key1;
	
	/** @var string */
	public $Key2;
	
	
	
	function  __construct()
	{
		$this->RelPath="";
		$this->WindowsPath="";
		$this->Key1="";
		$this->Key2="";
		parent::__construct();
	}
	
	
	
	
	
}





?>