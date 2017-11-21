<?php
/**
 * 
 * Pagination pour l'affichage des requetes operations, ar
 * 
 */

class Pagination {

	/** @var int */
	public  $From;

	/** @var int */
	public  $Size;

	function __construct($from,$size)
	{
		$this->From=$from;
		$this->Size=$size;
		
	}
	
	
}
?>