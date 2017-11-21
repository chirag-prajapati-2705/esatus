<?php

/*
 * EmailTest class
 *
 * @author    Gilles Manouvrier
 * @package   LitmusAPI classe wrapper depuis Litmus pour Webservices
 * @version   1.0
 * @access    public
 */
class EmailTestResult
{
    /** @var string */
    public $Html;

    /** @var string */
    public $ID;

    /** @var string */
    public $InboxGUID;

    /** @var EmailTestClient[] */
    public $Results;

    /** @var string */
    public $Sandbox;

    /** @var string */
    public $Source;

    /** @var string */
    public $State;

    /** @var string */
    public $Subject;

    /** @var string */
    public $TestType;

    /** @var string */
    public $UserGuid;

    /** @var string */
    public $ZipFile;

    /** @var string */
    public $ErrorMessage;
    
   function __construct()
   {
   		$this->Html="";
   		$this->ID="";
   		$this->InboxGUID="";
   		$this->Results=array();
   		$this->Sandbox="";
   		$this->Source="";
   		$this->State="";
   		$this->Subject="";
   		$this->TestType="";
   		$this->UserGuid="";
   		$this->ZipFile="";
   		$this->ErrorMessage="OK";
   	
   	
   }
}

?>