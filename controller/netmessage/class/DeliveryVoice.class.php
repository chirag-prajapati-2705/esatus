<?php
include_once("ScriptScenario.class.php");
include_once("WavScenario.class.php");
include_once("Delivery.class.php");
/**
 * Classe dédié au delivery vocal
 * 
 *
 */
class DeliveryVoice extends Delivery
{
	
	/** @var WavScenario */
	public $WavScenario;
	
	/** @var ScriptScenario */
	public $ScriptScenario;
	
	function __construct()
	{
		$this->WavScenario=new WavScenario();
		$this->ScriptScenario=new ScriptScenario();
		
		parent::__construct();
		return $this;
		
	}
	
	
	
}
?>