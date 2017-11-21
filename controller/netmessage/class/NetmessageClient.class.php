<?php
$rep_base=".";
# Ensemble des classes invoquées
require_once("$rep_base/class/ResultMessage.class.php");
require_once("$rep_base/class/Delivery.class.php");
require_once("$rep_base/class/Campaign.class.php");
require_once("$rep_base/class/AdditionalContent.class.php");

require_once("$rep_base/class/DeliverySms.class.php");
require_once("$rep_base/class/DeliveryVoice.class.php");
require_once("$rep_base/class/DeliveryMail.class.php");
require_once("$rep_base/class/DeliveryFax.class.php");
require_once("$rep_base/class/MailDoc.class.php");
require_once("$rep_base/class/EmailTemplateResult.class.php");

require_once("$rep_base/class/DateFilter.class.php");
require_once("$rep_base/class/MailImage.class.php");
require_once("$rep_base/class/MailEvent.class.php");
require_once("$rep_base/class/MailHeader.class.php");
require_once("$rep_base/class/MailAttachment.class.php");
require_once("$rep_base/class/CustomField.class.php");



require_once("$rep_base/class/ScriptScenario.class.php");
require_once("$rep_base/class/RecipientsList.class.php");
require_once("$rep_base/class/User.class.php");
require_once("$rep_base/class/UserInfos.class.php");
require_once("$rep_base/class/Authenticate.class.php");
require_once("$rep_base/class/DateFilter.class.php");
require_once("$rep_base/class/Pagination.class.php");
require_once("$rep_base/class/ReceiptsListFilter.class.php");
require_once("$rep_base/class/SentInfo.class.php");
require_once("$rep_base/class/ResultCollection.class.php");
require_once("$rep_base/class/WavListResultCollection.class.php");
require_once("$rep_base/class/WavMessage.class.php");
require_once("$rep_base/class/WavObject.class.php");
require_once("$rep_base/class/WavResult.class.php");
require_once("$rep_base/class/WavScenario.class.php");
require_once("$rep_base/class/VoiceMessage.class.php");
require_once("$rep_base/class/WavContentResult.class.php");
require_once("$rep_base/class/AnswerPhoneMessage.class.php");
require_once("$rep_base/class/TimeSlot.class.php");
require_once("$rep_base/class/TTSMessage.class.php");
require_once("$rep_base/class/Personalisation.class.php");
require_once("$rep_base/class/ResultCollection.class.php");
require_once("$rep_base/class/Alerte.class.php");
require_once("$rep_base/class/CheckResult.class.php");

require_once("$rep_base/class/Sms2WaysFilter.class.php");
require_once("$rep_base/class/SmsResponseResult.class.php");
require_once("$rep_base/class/SmsResponseResultCollection.class.php");

require_once("$rep_base/class/EmailTestClient.class.php");
require_once("$rep_base/class/EmailTest.class.php");


# creation de la classe qui hérite du module PHP SOAP
class NetMessage extends SoapClient
{

  /**
   * 
   * @var array $classmap The defined classes
   * @access private
   */
  private static $classmap = array();
  private $proxy=array();
  /**
   * 
   * @param array $config A array of config values
   * @param string $wsdl The wsdl file to use
   * @access public
   */
  # en cas d'utilisation de proxy, appliqué ce tableau au lieu du array() ci dessous
  //array $options = array('proxy_host'    => "10.128.1.62",		 'proxy_port'    => 8080), 
  public function __construct(array $options = array(),$wsdl = "")
  {
  
  	
    foreach(self::$classmap as $key => $value)
    {
	    if(!isset($options['classmap'][$key]))
	    {
	      $options['classmap'][$key] = $value;
	    }
    }
  
    parent::__construct($wsdl, $options);
  }

  /**
   * Récuperation d'un rapport SMS : Attention, vous pouvez renseigner au choix le opeKey(clef d'operation) ou le rcpKey(clef d'accusé reception)
   * @param string $opeKey
   * @param string $server
   * @param Authenticate $auth
   * @access public
   */
  public function GetInterimSmsReport($opeKey, $server, $auth,$rcpKey)
  {
    return $this->__soapCall('GetInterimSmsReport', array($opeKey, $server, $auth,$rcpKey));
  }
 public function GetInterimMailReport($opeKey, $server, $auth,$rcpKey)
  {
    return $this->__soapCall('GetInterimMailReport', array($opeKey, $server, $auth));
  }
   public function CheckWebservices($auth)
  {
    return $this->__soapCall('CheckWebservices', array($auth));
  }
   /**
   * Récuperation d'un rapport voice : Attention, vous pouvez renseigner au choix le opeKey(clef d'operation) ou le rcpKey(clef d'accusé reception)
   * @param string $opeKey
   * @param string $server
   * @param Authenticate $auth
   * @access public
   */
  public function GetInterimVoiceReport($opeKey, $server, $auth,$rcpKey)
  {
    return $this->__soapCall('GetInterimVoiceReport', array($opeKey, $server, $auth,$rcpKey));
  }
   public function GetInterimFaxReport($opeKey, $server, $auth,$rcpKey)
  {
    return $this->__soapCall('GetInterimFaxReport', array($opeKey, $server, $auth,$rcpKey));
  }
  public function SendMail($dest,$doc,$header,$auth,$nom="test")
  {
  	return $this->__soapCall('SendMail', array($dest,$doc,$header,$auth,$nom));
  }
 public function SendFax($faxNumber,$delivery,$auth,$opeName="WS_FAX_P2P")
  {
  	return $this->__soapCall('SendFax', array($faxNumber,$delivery,$auth,$opeName));
  }
public function SendMailTest($doc,$header,$auth,$nom="tes mail")
  {
  	return $this->__soapCall('SendMailTest', array($doc,$header,$auth,$nom));
  }
  public function GetEmailTest($id,$auth)
  {
  	return $this->__soapCall('GetEmailTest', array($id,$auth));
  }
  
  public function GetEmailTestClients($auth)
  {
  	return $this->__soapCall('GetEmailTestClients', array($auth));
  }
  public function SendMultiMedias($alerte,$auth)
  {
  	return $this->__soapCall('SendMultiMedias', array($alerte,$auth));
  }
  public function SendMailling($cp,$auth)
  {
  	return $this->__soapCall('SendMailling', array($cp,$auth));
  }
  public function SendFaxMailling($cp,$auth)
  {
  	return $this->__soapCall('SendFaxMailling', array($cp,$auth));
  }
  public function GetFaxTemplateById($id,$auth)
  {
  	return $this->__soapCall('GetFaxTemplateById', array($id,$auth));
  }
  public function GetFaxTemplates($auth)
  {
  	return $this->__soapCall('GetFaxTemplateById', array($auth));
  }
  public function SendScript($id, $scenario,$auth,$ope_name)
  {
  	return $this->__soapCall('SendScript', array($id,$scenario,$auth,$ope_name));
  }
  //
  public function GetVoicesScriptsLists($auth)
  {
  	return $this->__soapCall('GetVoicesScriptsList', array($auth));
  }
  public function GetWavsObjectsList($auth)
  {
  	return $this->__soapCall('GetWavsObjectsList', array($auth));
  }
  public function GetVoiceScriptById($id, $auth)
  {
  	return $this->__soapCall('GetVoiceScriptById', array($id,$auth));
  }
  public function GetSmsResponseList($flt,$auth)
  {
  	return $this->__soapCall('GetSmsResponseList', array($$flt,$auth));
  }
  public function GetReceiptList($flt,$auth)
  {
  	return $this->__soapCall('GetReceiptList', array($flt,$auth));
  }
  public function StoreEmailTemplate($name,$mailDoc,$auth)
  {
      return $this->__soapCall('StoreEmailTemplate', array($name,$mailDoc,$auth));
  
  }
  public function GetEmailTemplates($auth)
  {
  
      return $this->__soapCall('GetEmailTemplates', array($auth));
  }
  public function GetEmailTemplateById($id,$auth)
  {
  
      return $this->__soapCall('GetEmailTemplateById', array($id,$auth));
  }
  public function GetEmailTemplateByName($name,$auth)
  {
  
      return $this->__soapCall('GetEmailTemplateByName', array($name,$auth));
  }
   public function UploadWav($auth,$nom,$content)
  {
  	
  	return $this->__soapCall("UploadWav", array($auth,$nom,$content));
  	
  	
  }
 /**
   * 
   * @param string $message
   * @param string $encoding
   * @access public
   */
  public function SetSmsMessage($message, $encoding)
  {
    return $this->__soapCall('SetSmsMessage', array($message, $encoding));
  }
  
  
  
 /**
   * 
   * @param Campaign $campagne
   * @param Authenticate $auth
   * @access public
   */
  public function SendSmsMailling($campagne, $auth)
  {
    return $this->__soapCall('SendSmsMailling', array($campagne, $auth));
  }
  
  public function SendWav($simpleRecipient,$wavScenario,$auth,$opeName)
  {
  	
  	return $this->__soapCall("SendWav", array($simpleRecipient,$wavScenario,$auth,$opeName));
  	
  	
  }
 /**
   * 
   * @param Campaign $campagne
   * @param Authenticate $auth
   * @access public
   */
  public function SendWavMailling($campagne, $auth)
  {
    return $this->__soapCall('SendWavMailling', array($campagne, $auth));
  }
  
  
  /**
   * 
   * @param string $user
   * @param string $pwd
   * @param string $accp
   * @param string $accp_name
   * @param string $userServer
   * @access public
   */
  public function IsUser($user, $pwd, $accp, $accp_name, $userServer)
  {
    return $this->__soapCall('IsUser', array($user, $pwd, $accp, $accp_name, $userServer));
  }
	/**
	   * 
	   * @param string $from
	   * @param string $to
	   * @param string $regroup
	   * @param string $emailTo
	   * @param Authenticate $auth 
	   * @access public
	   */
  public function GetReportsFromDates($from,$to,$regroup,$emailTo,$auth)
  {
  	
    return $this->__soapCall('GetReportsFromDates', array($from,$to,$regroup,$emailTo,$auth));
  }
  /**
   * 
   * @param RecipientsList $liste
   * @param Authenticate $auth
   * @access public
   */
  public function SendRecipientsList($liste, $auth)
  {
    return $this->__soapCall('SendRecipientsList', array($liste, $auth));
  }

  /**
   * 
   * @param string $smsNumber
   * @param string $message
   * @param Authenticate $auth
   * @param string $opeName
   * @access public
   */
  public function SendSms($smsNumber, $message, $auth, $opeName)
  {
    return $this->__soapCall('SendSms', array($smsNumber, $message, $auth, $opeName));
  }
  public function SendSmsBillingCode($smsNumber, $message, $auth,$billingCode, $opeName)
  {
    return $this->__soapCall('SendSmsBillingCode', array($smsNumber, $message, $auth,$billingCode, $opeName));
  }
  public function SendSmsPrepared($smsNumber, $message, $auth, $opeName,$dateStart="")
  {
    return $this->__soapCall('SendSmsPrepared', array($smsNumber, $message, $auth, $opeName,$dateStart));
  } 
  public function CancelOperation($OpeKey, $OpeServer,$auth)
  {
  	
  	return $this->__soapCall('CancelOperation',array($OpeKey,$OpeServer,$auth));
  	
  }
  

}





?>