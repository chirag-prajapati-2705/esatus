<?php
$rep="./";
require($rep . "NetmessageClient.class.php");

define("URL_WSDL","http://webservices.netmessage.com/PROD01/webservices/wsdl/NetMessage.wsdl");
$tbOptions=array();

//$obj=new NetMessage($tbOptions,$url_wsdl);


function send_sms_p2p()
{
	//echo "Entree de fonction<br>";
  $tbOptions=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
	$auth=new Authenticate();
	
	$auth->Username="ABSI01";
	$auth->Password="888505774";
	$auth->SenderId="";
	$auth->AccountKey="907356067";
	$auth->AccountName="";
	$auth->Server="ABSI01";
	
	$ret=$obj->SendSms("0666452676","message test p2p unitaire ok",$auth,"testGM 1.5");
	

	// print_r($ret);
	 return $ret;
	
}


function send_sms_liste()
{
  $tbOptions=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
	$auth=new Authenticate();
	
	$auth->Username="ABSI01";
	$auth->Password="888505774";
	$auth->SenderId="gilles";
	$auth->AccountKey="907356067";
	$auth->AccountName="";
	$auth->Server="ABSI01";
	
  
  
  $contents=base64_encode("sms;prenom;nom\r\n0666452676;gilles;manouvrier");
	$objList=new RecipientsList();
	$objList->Name="maliste";
	$objList->Format="csv";
	$objList->EncodingMethod="base64";//pour Ã©viter les problÃ¨mes de gestion de caratÃ¨res spÃ©ciaux lors du transport HTTP
	$objList->MediaType="sms";
  $objList->Charset="ISO";
	//$objList->Stored=TRUE;
	
	
	$objList->Content=$contents;
	
		$campagne=new Campaign();
		$campagne->Name="test_unitaire_liste_sms";
    $camapgne->BillingCode="";
		$deliverySms=new DeliverySms();
		$deliverySms->RecipientsCustomerList=$objList;
		$deliverySms->Sms='message test pour $$[record]prenom$$ $$[record]nom$$';
		$deliverySms->DeliveryMustStopSchedule="2014-11-08 13:15:00"; //facultatif, date d'arret imperatif de l'operation (YYYY-MM-DD HH:MM:SS)ex : 2014-04-30 10:00:00
		$deliverySms->DeliverySchedule="2014-11-07 13:15:00"; //facultatif date de programmation de la campagne (YYYY-MM-DD HH:MM:SS)ex : 2014-04-30 10:00:00
		
    //Vous pouvez dÃ©finir une ou plusieurs tranche horraire de diffusion
		//TRANCHE_H $df=new TimeSlot();
		//TRANCHE_H $df->TimeStart="@@TIME_START_LISTE_SMS@@";
		//TRANCHE_H $df->TimeEnd="@@TIME_STOP_LISTE_SMS@@";
		//TRANCHE_H $deliverySms->DiffusionPeriod[]=$df;
		
		$campagne->DeliverySms=$deliverySms;
		//$campagne->ActivateDedup=1;
		$campagne->BillingCode="";//facultatif, il s'agit d'une rÃ©fÃ©rence libre qui sera prÃ©sente dans le rapport(si vous souhaitez faire de la refacturation)
		
		$ret=$obj->SendSmsMailling($campagne,$auth);
		
	  //print_r($ret);
	  // print_r($ret);
	   return $ret;
	
	
	
}
function send_email_liste()
{
  $tbOptions=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
	$auth=new Authenticate();
	
	$auth->Username="ABSI01";
	$auth->Password="888505774";
	$auth->AccountKey="907358064";
	$auth->AccountName="";
	$auth->Server="ABSI01";

  $ctHTML=file_get_contents("./body_html/test_images_inside.html");
  
	# PrÃ©paration des images
	 $ctImg1=base64_encode(file_get_contents("./body_html/test_images_inside.zip"));
	 $image1=new MailImage();
	 $image1->Name="test_images_inside.zip";
	 $image1->Content=$ctImg1;
   $tbImg[]=$image1;
	
	
	# PrÃ©paration de la liste
	
  $contents = base64_encode("email;nom;prenom;villes\r\ngmanouvrier@netmessage.com;Manouvrier;Gilles;Paris");
	$objList=new RecipientsList();
	$objList->Name="maliste";
	$objList->Format="csv";
	$objList->EncodingMethod="base64";//pour Ã©viter les problÃ¨mes de gestion de caratÃ¨res spÃ©ciaux lors du transport HTTP
	$objList->MediaType="email";
	$objList->Content=$contents;
	$objList->Stored=false;
  $objList->Charset="";//"windows-1258"

 
	  
	

	#Construction header
	$header=new MailHeader();
	$header->FromMail="test.unitaire@netmessage.com";
	$header->Object=utf8_encode("test unitaire email sur liste");
	
	#Construction du doc
	$document=new MailDoc();
	$document->HtmlBody=$ctHTML;
	$document->TextBody="./body_text/text1.txt";
	 $document->Images=$tbImg;
	$document->OpenTracking="1";
	$document->UnsubscribeModel ="unsub_nm.html"; //"unsub_nm.html";

	 $att=new MailAttachment();
	 $att->Name="location2010.pdf";
	 $att->Content=base64_encode(file_get_contents("./attachments/location2010.pdf"));
   $document->Attachments[]=$att;
	
	$campagne=new Campaign();
	#Creation du delivery Mail
	$delivery=new DeliveryMail();
	$delivery->Header=$header;
	$delivery->MailDoc=$document;
	$delivery->RecipientsCustomerList=$objList;
	#affectation du delivery Ã  la campagne
	$delivery->DeliveryMustStopSchedule="";
	$delivery->DeliverySchedule="";
	
  
  //Vous pouvez dÃ©finir une ou plusieurs tranche horraire de diffusion
		//TRANCHE_H $df=new TimeSlot();
		//TRANCHE_H $df->TimeStart="@@TIME_START_LISTE_EMAIL@@";
		//TRANCHE_H $df->TimeEnd="@@TIME_STOP_LISTE_EMAIL@@";
		//TRANCHE_H $delivery->DiffusionPeriod[]=$df;
  
  
  $campagne->DeliveryMail=$delivery;
	$campagne->ActivateDedup=1;
  $campagne->BillingCode="";
  
	$campagne->Name="test_email_liste";
	
	
	$ret=$obj->SendMailling($campagne,$auth);
	
//	print_r($ret);
	// print_r($ret);
	 return $ret;
	
	
}
function send_email_p2p()
{
 $tbOptions=array();
 $tbPerso=array();
	$obj=new NetMessage($tbOptions,URL_WSDL);
	$auth=new Authenticate();
	
	$auth->Username="ABSI01";
	$auth->Password="888505774";
	$auth->AccountKey="907358064";
	$auth->AccountName="";
	$auth->Server="ABSI01";

  $ctHTML=file_get_contents("./body_html/test_images_inside.html");
		# PrÃ©paration des images
	 $ctImg1=base64_encode(file_get_contents("./body_html/test_images_inside.zip"));
	 $image1=new MailImage();
	 $image1->Name="test_images_inside.zip";
	 $image1->Content=$ctImg1;
   $tbImg[]=$image1;
	
	#PrÃ©paration des persos
  //DEMO_PERS	$perso=new CustomField();
	//DEMO_PERS $perso->Label="nom";
	//DEMO_PERS $perso->Content="gilles";
	//DEMO_PERS $tbPerso[]=$perso;
  
	//PERSOS_EMAIL                          

#Construction header
	$header=new MailHeader();
	$header->FromMail="test.unitaire@netmessage.com";
	$header->Object=utf8_encode("test unitaire email point Ã  point");
	
	#Construction du doc
	$document=new MailDoc();
	$document->HtmlBody=$ctHTML;
	$document->TextBody="./body_text/text1.txt";
	 $document->Images=$tbImg;
	$document->OpenTracking="1";
	$document->UnsubscribeModel =""; //"unsub_nm.html";
	//PERSO $document->Persos=$tbPerso;
	$document->OpenTracking="1";
	$ret=$obj->SendMail('gmanouvrier@netmessage.com',$document,$header,$auth,'test_email_pap');
	

	//	print_r($ret);
	// print_r($ret);
	 return $ret;
	
	
}









function uploadWav($path)
{

	
	$auth=new Authenticate();
	$auth->Username="ABSI01";
	$auth->Password="888505774";
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
	$auth->Username="ABSI01";
	$auth->Password="888505774";
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
	$auth->Username="ABSI01";
	$auth->Password="888505774";
	$auth->AccountKey="906909397";
	$auth->AccountName="";
	$auth->Server="ABSI01";
	$auth->SenderId="";
	
	#Section dédiée à la liste d'envoi
  $contents=base64_encode("voice\r\n0666452676");
	$objList=new RecipientsList();
	$objList->Name="maliste";
	$objList->Format="csv";
	$objList->EncodingMethod="base64";//pour éviter les problèmes de gestion de caratères spéciaux lors du transport HTTP
	$objList->MediaType="voice";
	$objList->Content=$contents;
  //$objList->Stored=TRUE;
	
	
	#creation des objets message vocal
	
	
  $tbWav=uploadWav('./wav/lord.mp3');

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




$tbRetour[]=send_sms_p2p();

$tbRetour[count($tbRetour)-1]->Target="sms_p2p";
$tbRetour[count($tbRetour)-1]->Pwd="888505774";
$tbRetour[count($tbRetour)-1]->media="sms";


$tbRetour[]=send_sms_liste();

$tbRetour[count($tbRetour)-1]->Target="sms_liste";
$tbRetour[count($tbRetour)-1]->Pwd="888505774";
$tbRetour[count($tbRetour)-1]->media="sms";


$tbRetour[]=send_email_liste();

$tbRetour[count($tbRetour)-1]->Target="email_liste";
$tbRetour[count($tbRetour)-1]->Pwd="888505774";
$tbRetour[count($tbRetour)-1]->media="email";


$tbRetour[]=send_email_p2p();

$tbRetour[count($tbRetour)-1]->Target="email_p2p";
$tbRetour[count($tbRetour)-1]->Pwd="888505774";
$tbRetour[count($tbRetour)-1]->media="email";


$tbRetour[]=send_wav_liste();

$tbRetour[count($tbRetour)-1]->Target="voice_liste";
$tbRetour[count($tbRetour)-1]->WavMsg="";
$tbRetour[count($tbRetour)-1]->WavRep="";
$tbRetour[count($tbRetour)-1]->Pwd="888505774";
$tbRetour[count($tbRetour)-1]->media="voice";

echo json_encode($tbRetour);




?>