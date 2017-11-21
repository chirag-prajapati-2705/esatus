<?php
$rep="./";
require($rep . "netmessage/NetmessageClient.class.php");

define("URL_WSDL","http://webservices2.netmessage.com/PROD01/webservices/wsdl/NetMessage.wsdl");
$tbOptions=array();

//$obj=new NetMessage($tbOptions,$url_wsdl);


function send_sms_p2p()
{
	//echo "Entree de fonction<br>";
  $tbOptions=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
	$auth=new Authenticate();
	
	$auth->Username="DDELETREZ";
	$auth->Password="4UCONSULTING2014";
	$auth->SenderId="";
	$auth->AccountKey="907356067";
	$auth->AccountName="";
	$auth->Server="ABSI01";
	
	$ret=$obj->SendSms("261345055257","message test p2p unitaire ok",$auth,"testGM 1.5");
	

	// print_r($ret);
	 return $ret;
	
}
function uploadWav($path)
{

	
	$auth=new Authenticate();
	$auth->Username="DDELETREZ";
	$auth->Password="4UCONSULTING2014";
	$auth->AccountKey="906909397";
	$auth->AccountName="";
	$auth->Server="ABSI01";
	$auth->SenderId="";
	
	
  $tbOptions=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
        
        if($hdl=fopen($path,"r"))
        {
        $content=fread($hdl,filesize($path));
        $content=base64_encode($content);   
		   
        $monwav= $obj->UploadWav($auth,"testSonNM",$content);
		    
        }
        else
        	$tbR["WavError"] = "pas de lecture du fichier";
        $tbR["WavNumber"]=$monwav->WavNumber;
        $tbR["WavServer"]=$monwav->WavServer;
        
        return $tbR;
}

function GetWavs()
{
	$auth=new Authenticate();
	$auth->Username="DDELETREZ";
	$auth->Password="4UCONSULTING2014";
	$auth->AccountKey="906909397";
	$auth->AccountName="";
	$auth->Server="ABSI01";
	$auth->SenderId="";
	
	
	
   $tbOptions=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
  
	$ret=$obj->GetWavsObjectsList($auth);
	
	  //print_r($ret);
	  // print_r($ret);
    
   return $ret;
	
}

function send_wav_liste()
{
	$tbOptions=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
  
	$auth=new Authenticate();
	$auth->Username="DDELETREZ";
	$auth->Password="4UCONSULTING2014";
	$auth->AccountKey="906909397";
	$auth->AccountName="";
	$auth->Server="ABSI01";
	$auth->SenderId="";
	
	
	#Section dédiée à la liste d'envoi
  $contents=base64_encode("voice\r\n0982323527");
	$objList=new RecipientsList();
	$objList->Name="maliste";
	$objList->Format="csv";
	$objList->EncodingMethod="base64";//pour éviter les problèmes de gestion de caratères spéciaux lors du transport HTTP
	$objList->MediaType="voice";
	$objList->Content=$contents;
  //$objList->Stored=TRUE;
	
	
	#creation des objets message vocal
	
	
  $tbWav=uploadWav('./wav/inscription.mp3');

	$wavScenario=new WavScenario();
  //<
	$wavScenario->VoiceMessage=new VoiceMessage();
	$wavScenario->VoiceMessage->Wav=new WavMessage();
	$wavScenario->VoiceMessage->Wav->Key=$tbWav["WavNumber"];//WavNumber
	$wavScenario->VoiceMessage->Wav->Server=$tbWav["WavServer"];//Server de stockage du Wav
	
	$wavScenario->AnswerPhone=new AnswerPhoneMessage();
	$wavScenario->AnswerPhone->Wav=new WavMessage();
	$wavScenario->AnswerPhone->Wav->Key=$tbWav["WavNumber"];//WavNumber
	$wavScenario->AnswerPhone->Wav->Server=$tbWav["WavServer"];//Server de stockage du Wav
	//>
	
	$campagne=new Campaign();
	$campagne->Name="test unitaire voix liste";
    $camapgne->BillingCode="";
		$deliveryVoice=new DeliveryVoice();
		# affectation de l'objet liste à l'objet delivery
		$deliveryVoice->RecipientsCustomerList=$objList;
		
		# affectation de l'objet wav à l'objet delivery
		$deliveryVoice->WavScenario=$wavScenario; 
		$deliveryVoice->DeliveryMustStopSchedule=""; //facultatif, date d'arret imperatif de l'operation (YYYY-MM-DD HH:MM:SS)ex : 2014-04-30 10:00:00
		$deliveryVoice->DeliverySchedule=""; //facultatif date de programmation de la campagne (YYYY-MM-DD HH:MM:SS)ex : 2014-04-30 10:00:00
	
		# creation d'une tranche horraire de diffusion
	 //Vous pouvez définir une ou plusieurs tranche horraire de diffusion
		//TRANCHE_H $df=new TimeSlot();
		//TRANCHE_H $df->TimeStart="@@TIME_START_LISTE_VOICE@@";
		//TRANCHE_H $df->TimeEnd="@@TIME_STOP_LISTE_VOICE@@";
		//TRANCHE_H $deliveryVoice->DiffusionPeriod[]=$df;
		
		$campagne->DeliveryVoice=$deliveryVoice;
    
	
		
		$ret=$obj->SendWavMailling($campagne,$auth);
		
      //print_r($ret);
	  // print_r($ret);
	   return $ret;
	
	
	
	
	
}
$tbRetour[]=send_wav_liste();
$tbRetour[count($tbRetour)-1]->Target="voice_liste";
$tbRetour[count($tbRetour)-1]->WavMsg="message voice";
$tbRetour[count($tbRetour)-1]->WavRep="";
$tbRetour[count($tbRetour)-1]->Pwd="4UCONSULTING2014";
$tbRetour[count($tbRetour)-1]->media="voice";

//send_wav_liste();
//send_sms_p2p();





?>