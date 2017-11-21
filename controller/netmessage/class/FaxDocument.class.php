<?php
require_once("AdditionalContent.class.php");
class FaxDocument
{
	
	/** @var FaxTemplateResult[] */
	public $TemplateObject;
	
	/** @var string */
	public $FaxDocumentExtension;
	
	/** @var int */
	public $Orientation;
	
	/** @var AdditionalContent */
	public $Additional;
	
	/** @var string */
	public $FaxContent;
	
	/** @var string */
	public $Name;
	
	function __construct()
	{
		$this->TemplateObject=array();
		$this->Orientation="portrait";
		$this->FaxDocumentExtension="";
		$this->AdditionalsContents=new AdditionalContent;
		$this->Name="";
		$this->TemplateObject=array();
	}
	
	
}



?>