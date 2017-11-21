<?php
/**
 * Definition de l'objet List pour les envois Mailling
 */
 
class RecipientsList
{
	
	/** @var string */
	public $Name;
	/** @var string */
	public $Format;
	/** @var string */
	public $EncodingMethod;
	/** @var string */
	public $MediaType;
	/** @var boolean */
	public $Stored;
	/** @var string */
	public $Content;
	/** @var string */
  public $Charset;
	function __construct()
	{
		$this->Content="";
		$this->Format="";
		$this->MediaType="";
		$this->Name="";
		$this->Charset="";
    $this->Stored=FALSE;
	}
	
	
	
} 

?>