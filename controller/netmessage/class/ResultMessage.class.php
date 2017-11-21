<?php
require_once("UserInfos.class.php");
/**
 * 
 * Base de retour de message
 *
 */
class ResultMessage
{
	
/** @var LogTrace[] */
	public $LogTrace;

/** @var UserInfos */
  public $UserInfos;
  
private $logPath;  
/**
 * 
 * @param string
 * @param string
 * @return void
 */
public function addTrace($code,$innerException="",$level="")
{
	$trace=new LogTrace($code);
	$trace->InnerException=utf8_encode($innerException);
	if($level!="")$trace->Level=$level;
	$trace->Message= utf8_encode($trace->Message);
	$this->LogTrace[count($this->LogTrace)]=$trace;
	if($this->logPath!="")
	{
		$hdl=fopen($this->logPath,"a");
		fwrite($hdl,"LOG TRACE LIVE DEV :" . Date("Y-d-m H:m:s")   . "\r\n\t");
			fwrite($hdl,$code . "\r\n\t");
			fwrite($hdl,$trace->Message . "\r\n\t");
			fwrite($hdl,$innerException . "\r\n");
			fwrite($hdl,"---------------------------------------------------------------------\r\n");
			
		fclose($hdl);
	}
	
		
}
	
function __construct($log="./MyDebug.txt")
{
	$this->logPath=$log;
	$this->LogTrace=array();
	$this->UserInfos=new UserInfos();
	$this->UserInfos->AccountKey="";
	$this->UserInfos->AccountName="";
	$this->UserInfos->Username="";
}	
	
	
}
?>