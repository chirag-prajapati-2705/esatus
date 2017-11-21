<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
		var id = '#dialog';
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
			//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
            
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 	
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});		
	
});
</script>
<style type="text/css">
body {
font-family:verdana;
font-size:15px;
}
a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
}
#boxes #dialog {
  width:775px; 
  height:542px;
  padding:10px;
  background-color:#ffffff;
  /*arrondir les coins en haut ‡ gauche et en bas ‡ droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px;
}
</style>
</head>
<div id="boxes">
<div style="top: 199.5px; left: 551.5px; display: none;" id="dialog" class="window">
<?php
header('Content-Type: text/html; charset="utf-8"');
class SendPartageMail{
function SendPartageViaMail($prenom, $contacts, $sender) {
$headers ="From:$sender \r\n";  
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$prenom = $_POST['prenom'];
$objet = "$prenom souhaite vous faire dÈcouvrir esatus";
$message = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>';
$message .='
<style type="text/css">
<!--
.Style3 {
	font-size: 18px;
	font-weight: bold;
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
.Style4 {
	color: #FFFFFF;
	font-size: 18px;
	font-family: Arial, Helvetica, sans-serif;
}
.Style6 {font-family: Arial, Helvetica, sans-serif}
.Style7 {font-size: 12px}
.Style8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Style9 {color: #FF3300}
.contenu{
				margin:0 auto;
				width:526px;
				padding:10px 0 16px 0;
				text-align:center;
				background-color:#ffffff;
			}
			.m_inscris{ 
				display:inline-block;
				width:177px;
				height:39px;
				background-color:#5DADE2;
				text-align:center;
				color:#ffffff;
				font-size:17px;
				font-weight:bold;
				font-family:arial;
				text-decoration:none;
				border-radius:5px;
				border:3px solid #ffffff;
				line-height:39px;
			}
-->
</style>
</head>';
$message .='
<table width="560" height="597" border="1" align="center" bgcolor="#CCCCCC">
  <tr bgcolor="#FFFFFF"> 
    <td width="550" height="591"><table width="549" border="0" align="center">
      <tr>
        <td width="541" height="66" align="center">';
             $message .= '<img src="http://demo.esatus.fr/bin/images/logo_esatus.png" alt="esatus" />';
             $message .= '</a></td>
      </tr>
    </table>';
    $message .= '
     <table width="550" border="0" bgcolor="#333333" align="center">
        <tr>
          <td width="541" height="23" align="center"><span class="Style3" style ="font-size: 18px;
	font-weight: bold;
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;">';
 $message .= 'Votre amie '.$prenom.' souhaite vous faire d&eacute;couvrir <a href="http://www.esatus.fr"> esatus</a></span></td>
        </tr>
      </table>';
$message .= '
    <table width="550" border="0" align="center">
        <tr>
          <td width="541">'; 
          $message .= '<img src="http://demo.esatus.fr/bin/images/tranquilite_assure.jpeg" alt="tranquilite assure" width="550" heigth="150" />';
          $message .= '
          </td>
        </tr>
      </table>';
     
         // $message .= $prenom. ' souhaite vous faire d&eacute;couvrir <a href="http://www.esatus.fr"> esatus</a></span></td>
        //</tr>
      //</table>
    // ';
     //$message .= $sender.'the sender is '.$sender;
    $message .= '
     <table width="550" border="0" bgcolor="#333333" align="center">
        <tr>
          <td width="541" align="center"><form id="form1" name="form1" method="post" action="">
            <label>
            <div class="contenu" style = "margin:0 auto; width:526px; padding:10px 0 16px 0;text-align:center; background-color:#ffffff;">
            <a href="http://www.esatus.fr/creer-un-compte?invited_by='.$sender.'" class = "m_inscris" style="display:inline-block; width:177px; height:39px;	background-color:#5DADE2;	text-align:center;	color:#ffffff;	font-size:17px; font-weight:bold; font-family:arial;	text-decoration:none;	border-radius:5px;	border:3px solid #ffffff; line-height:39px;" >Je m\'inscris</a>
            </div>
              </label>
          </form>          </td>
        </tr>
      </table>
      <table width="550" border="0" bgcolor="#333333" align="center">
        <tr>
          <td width="540" align="center"><p class="Style4" color: #FFFFFF;
	style ="color: #FFFFFF; 
	font-size: 18px;
	font-family: Arial, Helvetica, sans-serif;">Inscrivez-vous d&eacute;s maintenant !<br />
          Gr&acirc;ce &agrave; votre filleul recevez 25 euro de consultation  offerte.</p></td>
        </tr></table>';
        $message .= '<table align="center">
      <p class="Style7" style ="font-size: 12px"><span class="Style6" style ="font-family: Arial, Helvetica, sans-serif color: #000000;" >Bonjour,<br />
        Rejoins-moi sur <a href="http://www.esatus.fr/">esatus</a>,  le premier site d&rsquo;expert en France. Gr&acirc;ce &agrave; ';
        $message .='</a>,  j\'ai acc&egrave;s &agrave; des Experts de grandes notori&eacute;t&eacute; sans rdv 24&nbsp;/24 7j7de chez  moi ou en mode Nomade sur un simple appel &agrave; des prix avantageux les Exepers  r&eacute;ponde a tous es questions sans attendre Astro,  M&eacute;duim,Psycho,Avocat,Dieteticienne tous y est ! Il t&rsquo;offre 25 euro&nbsp;!!! sur  ta 1ere consultations a &nbsp;tout de suite  sur esatus !</span></p></table>
      ';     

$message .='<p class="Style8" style ="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
$message .= $prenom .'</p>
    <p class="Style8" style ="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">&nbsp;</p>
    ';
$message .= '
        <p align="center" class="Style8" style ="font-family: Arial, Helvetica, sans-serif; font-size: 12px;"><a href="http://www.esatus.fr" >Fonctionnement du site </a></p></td>
  </tr>
</table>
</body>
</html>
        ';
    
$message .='
</body>
</html>';
$contact_single = explode ("," , $contacts);
$nombre_contact = count($contact_single);
if ($nombre_contact == "1") {
$retval = mail($contacts,$objet,$message,$headers);


	   if( $retval == true )  
	       {

	      }
	   else
	       {

	      }  
     }
else
     {
        //echo "size >1 \n"; 
        $size = 0;
              for ($size = 0 ; $size <= $nombre_contact -1 ; $size++)
                  {
                         $retval = mail($contact_single[$size],$objet,$message,$headers);
                                 if( $retval == true )  
	                                   {

                                    }
                                 else
	                                   {

                                    }  
                  }
     }
  }


function mail_attachment($filename, $content, $mailto, $from_mail, $from_name, $replyto, $subject, $message,$nom_vcard,$prenom_vcard,$phone_vcard,$contacts) {
//$nom_vcard = $user->first_name;
//$prenom_vcard = $user->last_name;
$societe_vcard = "ESATUS";
//$phone_vcard = $user->phone;
//$fixe_vcard = $user->phone;
$link_vcard = "http://www.esatus.fr";

$content = "BEGIN:VCARD\r\n";
$content .= "VERSION:3.0\r\n";
$content .= "CLASS:PUBLIC\r\n";
$content .= "FN:$nom_vcard $prenom_vcard\r\n";
$content .= "N:$prenom_vcard;$nom_vcard ;;;\r\n";
$content .= "TITLE:$societe_vcard\r\n";
$content .= "ORG:$societe_vcard\r\n";
$content .= "ADR;TYPE=work:29;Grand Rue;59100;ROUBAIX;\r\n";
$content .= "EMAIL;TYPE=internet,pref:$from_mail\r\n";
$content .= "TEL;TYPE=work,voice:$phone_vcard\r\n";
$content .= "TEL;TYPE=HOME,voice:$phone_vcard\r\n";
$content .= "URL:$link_vcard\r\n";
$content .= "END:VCARD\r\n";

        $fileatt_type = "application/octet-stream";

        $headers = "FROM: ".$from_mail;

        $data = chunk_split(base64_encode($content));

        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        $headers .= "\nMIME-Version: 1.0\n" .
        "Content-Type: multipart/mixed;\n" .
        " boundary=\"{$mime_boundary}\"";

        $message .= "This is a multi-part message in MIME format.\n\n" .
        "--{$mime_boundary}\n" .
        "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" .
        $message . "\n\n";
        $message .= "--{$mime_boundary}\n" .
        "Content-Type: {$fileatt_type};\n" .
        " name=\"{$filename}\"\n" .
        "Content-Transfer-Encoding: base64\n\n" .
        $data . "\n\n" .
        "--{$mime_boundary}--\n";
        //echo "sending message";
$contact_single = explode ("," , $contacts);
$nombre_contact = count($contact_single);
if ($nombre_contact == "1") {
$retval = mail($contacts, $subject, $message, $headers);


	   if( $retval == true )  
	       {

	      }
	   else
	       {

	      }  
     }
else
     {
        //echo "size >1 \n"; 
        $size = 0;
              for ($size = 0 ; $size <= $nombre_contact -1 ; $size++)
                  {

                         mail($contact_single[$size], $subject, $message, $headers);
                                 if( $retval == true )  
	                                   {

                                    }
                                 else
	                                   {

                                    }  
                  }
     } 
        
        
}
}



if (isset($_POST['partager'])){
$prenom = $_POST['prenom'];
$contacts = $_POST['contact'];
$smp = new SendPartageMail();
$smp -> SendPartageViaMail($_POST['prenom'], $_POST['contact'], $user->email);

$smp -> mail_attachment($_POST['prenom'].".vcf", $content, $user->email, $user->email, $_POST['prenom']."", $user->email, $_POST['prenom']."'s Contact Info", "", $user->first_name, $user->last_name, $user->phone,$_POST['contact'] );
}
?>


<div class="demo-headline">
<div align="left">
<img src="http://demo.esatus.fr/bin/images/esatus-logo-final.png" alt="esatus" width="150" heigth="25"> </div>
<h3 class="demo-logo">
<small><font color="#f39c12" size="3" >Parrainez vos Amis ! <br>
Faites-leur profiter des meilleurs Experts a des prix avantageux.Pour chaque  Amis inscrit et premiere consultation effectuer 10 euro de credits offerts pour vous et 25 euro offert pour votre Amie sur son 1ere Appel, profitez en !!!!!!. <h3> </font> 
</div></small>
<?php 
$stdUser = new stdClass();
//echo "email_sender_or_firstname = ",   $user->email;
 ?> 
<form action="#" method="post">
        <fieldset>
          <legend> Inviter des amis par e-mail </legend>
          <div class="form-group">
            <label for="name">Votre Prenom</label>
            <input type="text" class="form-control input-block" id="name" name="prenom" placeholder="Votre Pr&eacute;nom">
          </div>
          <div class="form-group">
            <label for="email">Pour envoyer &agrave; plusieurs e-mails , s&eacute;parez chaque adresse mail par une virgule:</label>
            <textarea rows="4" class="form-control input-block" name="contact" id="contact" placeholder="Pour envoy&eacute; &agrave; plusieurs e-mail , s&eacute;parez chaque adresse mail par une virgule."></textarea>
          </div>
          <input type="submit" class="btn btn-primary btn-large btn-block" name = "partager" value="Partager par email" >
        </fieldset>
      </form>
<!--- <fieldset><label>Publication sur le profil de esatus</label>
<table align="center">
       <tr>
           <td><img src="<?= IMAGE; ?>fb.jpg" width="122" height="122" /></td>
           <td width="84">&nbsp;</td>
           <td><img src="<?= IMAGE; ?>tw.jpg" width="142" height="144" /><td>
           </tr>
</table>
</fieldset>
--->
<a href="#" class="close">Fermer</a>
</div>
<!-- Mask to cover the whole screen -->
<div style="width: 1478px; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
</div>


<iframe src="http://www.weedoit.fr/tracking/tracklead.php?idcpart=4957&idr=<?= $user->profile_id; ?>&email=<?= $user->email; ?>" height="1" width="1" frameborder="0"></iframe>
<!-- Google Code for Cr&eacute;ation de compte Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 991320576;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "PchyCJ-Iw1YQgLTZ2AM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/991320576/?label=PchyCJ-Iw1YQgLTZ2AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<iframe src="https://secure.img-cdn.mediaplex.com/0/27977/universal.html?page_name=mct-esatus-lead-secure&Lead=1&mpuid=<?= $user->profile_id; ?>" HEIGHT=1 WIDTH=1 FRAMEBORDER=0></iframe>
<div class="container masterhead">
	<div class="demo-headline">
		<h1 class="demo-logo">Bienvenue <?= $user->pseudo; ?>,<br><small>Voici votre espace priv√©. Quelle page voulez-vous consulter   ?</small></h1>
	</div>
</div>
<div class="container">

    <div class="alert alert-info text-center flash"><h5>Pour appeler nos experts Esatus dans les meilleures conditions,<br/>merci de tenir √† jour vos informations personnelles et v√©rifier la validit√© de votre carte bancaire.</h5></div>
    <div class="row demo-tiles">
      	<div class="span3">
            <a href="<?= Router::url('users/datas'); ?>">
              	<div class="tile">
                	<i class="icon-user"></i>
                	<h3 class="tile-title">Vos informations</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('users/calls'); ?>">
              	<div class="tile">
	                <i class="icon-phone"></i>
	                <h3 class="tile-title">Vos appels</h3>
              	</div>
            </a>
      	</div>
      	<div class="span3">
            <a href="<?= Router::url('users/card'); ?>">
              	<div class="tile">
	                <i class="icon-lock"></i>
	                <h3 class="tile-title">Votre carte bancaire</h3>
              	</div>
            </a>
      	</div>
        <div class="span3">
            <?php if ($this->requestAction(array('controller'=>'services','action'=>'test'))): ?>
            <a href="<?= Router::url('services/index'); ?>">
                <div class="tile">
                  <i class="icon-group"></i>
                  <h3 class="tile-title">Espace expert</h3>
                </div>
            </a>
            <?php else: ?>
            <a href="<?= Router::url('services/create'); ?>">
              	<div class="tile">
                	<i class="icon-group"></i>
                	<h3 class="tile-title">Devenir expert !</h3>
              	</div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>