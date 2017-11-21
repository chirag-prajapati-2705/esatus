<?php

/**
 * Classe Alerte, pour envois multimedia
 */
class Alerte{
	
	/** @var string */
	public $Reference;
	/** @var string */
	public $Destinataire;
	/** @var int */
	public $IdNotification;
	/** @var string[] */
	public $Persos;
	/** @var int */
	public $TimeToLeaveOffset;
	
	
	function __construct()
	{
		$this->Reference="";
		$this->Destinataire="";
		$this->IdNotification=0;
		$this->Persos=array();
		$this->TimeToLeaveOffset=24 * 60; //24 heures
		
		
	}
	
	
}


?>