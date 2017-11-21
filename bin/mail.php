<?php
// EDIT THE 2 LINES BELOW AS REQUIRED
$email_to = "samoud.mohamed@gmail.com";
$email_from = "esatus-web";
$email_subject = "Devis";
 
/** Father data **/
$nom_pere = $_POST['name']; // required
$tel_pere = $_POST['telephone']; // required
$cellulaire_pere = $_POST['email']; // required
$courriel_pere = $_POST['courriel_pere']; // not required
$adresse_pere = $_POST['societe']; // required
$cp_pere = $_POST['website']; // not required
$ville_pere = $_POST['message']; // required

 
$email_message = "Details.\n\n";
 
function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}
 
$email_message .= "Nom : ".clean_string($nom_pere)."\n";
$email_message .= "Telephone : ".clean_string($tel_pere)."\n";
$email_message .= "Email : ".clean_string($cellulaire_pere)."\n";
$email_message .= "Societe : ".clean_string($adresse_pere)."\n";
$email_message .= "Site web : ".clean_string($cp_pere)."\n";
$email_message .= "Message : ".clean_string($ville_pere)."\n";



$headers = 'From: esatus'."\r\n".
'Reply-To: '.$cellulaire_pere."\r\n";
if(@mail($email_to, $email_subject, $email_message, $headers))
{
        //mail('ldcominvest@gmail.com', $email_subject, $email_message, $headers);
	header('Location: http://www.esatus-web.com/' ) ;
}
else 
{
	
}

?>