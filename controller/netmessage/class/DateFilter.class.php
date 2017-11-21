<?php
/**
 * Filtre de date pour les recherches de job, listes, etc...
 * @author gilles manouvrier
 *
 */
class DateFilter
{
	/** @var string */
	public $DateMin;
	
	/** @var string */
	public $DateMax;
	
	function __construct()
	{
	$this->DateMin="";
	$this->DateMax="";	
		
	}
}
?>