<?php
/**
 * 
 * Classe de base relatives aux filtres de recuperation de list, ar, etc...
 * written by KDO kdo@zpmag.com
 */
include_once("DateFilter.class.php");
class ListFilter{

	/** @var boolean */
	public  $HasCreationDateFilter;

	/** @var DateFilter */
	public  $CreationDateFilter;

	/** @var Pagination */
	public  $PaginationFilter;

	/** @var string */
	public $RequestedServer;
	
	
	function __construct()
	{
		
		$this->CreationDateFilter=new DateFilter();
		$this->HasCreationDateFilter=false;
		$this->PaginationFilter=new Pagination(0,10);
		$this->RequestedServer=WSEngine;
		
		
		
	}
}
?>