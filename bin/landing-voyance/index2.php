<?php
/* Header("Cache-Control: must-revalidate");
 $offset = 60 * 60 * 24 * 3;
 $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
 Header($ExpStr); */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Cache-control" content="max-age=2592000, public">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="www.pi-2r.com">
		<link rel="icon" href="./img/favicon.png">
		<title>Esatus Voyance</title>
		<!-- Bootstrap core CSS -->
		<link href="./bootstrap_3/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="./css/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="social_networks">
		  <div class="container">
				<div class="pull-right">
					<a href="#"><img  src="./img/fb.png"  alt="facebook"  title="facebook"  /></a><span>|</span>
					<a href="#"><img  src="./img/tw.png"  alt="facebook"  title="facebook"  /></a><span>|</span>
					<a href="#"><img  src="./img/gp.png"  alt="facebook"  title="facebook"  /></a><span>|</span>
					<a href="#"><img  src="./img/in.png"  alt="facebook"  title="facebook"  /></a><span>|</span>
					<a href="#"><img  src="./img/lg.png"  alt="facebook"  title="facebook"  /></a>
				</div>
		  </div>
		</div>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron bloc_1">
		  <div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="row">
						<p class="text-center">
							<a href=""><img  src="./img/logo_esatus.png"  alt="Esatus" title="Esatus" /></a>
						</p>
					</div>
					
					<div class="row bloc_1_2">
						<p class="p_1">Vous vous posez des questions sur votre avenir, votre vie amoureuse, votre vie familiale ou amicale, ou votre carrière ?</p>
						<p class="hesitez_pas">N’hésitez pas …</p>
					</div>				
					<div class="row bloc_1_3">
						<p class="experts">Nos EXPERTS</p>
						<p class="ecoute">sont à l’écoute !</p>
					</div>
					<div class="row bloc_1_4">
						<img  src="./img/phone.png"  alt=""  /><img  src="./img/cam.png"  alt=""  /><img  src="./img/chat.png"  alt=""  />
					</div>
				</div>
				<div class="col-md-7">
					<div class="row">
					<p>
						<img class="img-responsive" src="./img/profitez.png" alt="profitez des 25€ offerts lors de votre 1er appel" title="profitez des 25€ offerts lors de votre 1er appel">
					</p>
					</div>
        <!--Email Sending Script -->

        <?php 
	
			$name="";
			$from="";
			$message="";
       
	   if(isset($_POST['submit'])){

            $envoayer = "oui";
			
        	$name=$_POST['nom'];
        	$prenom=$_POST['prenom'];
			
			
			
			$from=$_POST['email'];
			
			//$code=$_SESSION['captcha'];
			$inlineRadioOptions=$_POST['inlineRadioOptions'];
			$captchaimg=$_POST['captchaimg'];
			$message=$_POST['comments'];

			$message = "Nature du question : ".$inlineRadioOptions." \n".$message ;
			
			if ($name == "" || $prenom == "" || $from == ""  || $message == "" ) { $envoayer = "non"; }
				
			
			
        	$to="fdjebbi@pi-2r.com"; // Add your e-mail here
        	//echo $_SESSION['captcha'];
			
			if($envoayer == "non"){
			
				echo " - Veuillez remplir tous les champs !";
			
			}else{    
				   // connexion à la base
				$db = mysql_connect('localhost', 'esatus_bdd_user', 'zFan08*6-xyz1258@')  or die('Erreur de connexion '.mysql_error());
				// sélection de la base  

				mysql_select_db('esatus',$db)  or die('Erreur de selection '.mysql_error()); 
				 
				// on écrit la requête sql 
				
				$sql = "INSERT INTO `esatus`.`profiles` (`id`, `email`, `password`, `validated`, `affiliation`) VALUES (NULL, '".$from."', '".sha1($_POST['password'])."', '0', '0')"; 
				
				// on insère les informations du formulaire dans la table 
				mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
                                
                                $id_profile = mysql_insert_id();
                                $sql2 = "INSERT INTO `esatus`.`users` (`id`, `profile_id`, `last_name`, `first_name`, `pseudo`, `birth_date`, `phone`, `date_inscription`) VALUES (NULL, '".$id_profile."', '".$name."', '".$prenom."', '', '', '".$_POST['telephone']."', '".date('Y-m-d H:i:s')."')"; 
				
				// on insère les informations du formulaire dans la table 
				mysql_query($sql2) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
                                
                                $sql3 = "INSERT INTO `esatus`.`questions` (`id`, `question`, `profile_id`) VALUES (NULL, '".$_POST['comments']."', '".$id_profile."')"; 
				
				// on insère les informations du formulaire dans la table 
				mysql_query($sql3) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
				// on affiche le résultat pour le visiteur 
				

				mysql_close();  // on ferme la connexion 
     	
				$headers = 'From:'.$from. "\r\n" .
				'Reply-To: fdjebbi@pi-2r.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

				$subject="Question";
				$messageMail="Nom :" .$nom. "\n";
				$messageMail.="Mail :" .$from."\n\n";
				$messageMail.=$message."\n\n";
		
				mail($to,$subject,$messageMail,$headers);
				
				echo 'Vos infos on été ajoutées.'; 
				
			}

        //Isset finishes here	
        }
        ?>


        <!-- Email Sending Script-->					
					<div class="row bloc_2_1">
						<form class="form-horizontal" action="" method="post">
							<h3 class="form-title">Vos données personnelles</h3>
							<div class="form-group">
								<label for="nom" class="col-sm-4 control-label form-label">Votre Nom:</label>
								<div class="col-sm-8">
										<input type="text" class="form-control" id="nom" name="nom">
								</div>
							</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-4 control-label form-label"required>Votre Prénom:</label>
								<div class="col-sm-8">
										<input type="text" class="form-control" id="prenom" name="prenom"required>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-4 control-label form-label">Votre Email:</label>
								<div class="col-sm-8">
										<input type="email" class="form-control" id="email" name="email"required>
								</div>
							</div>
                                                        <div class="form-group">
								<label for="telephone" class="col-sm-4 control-label form-label">Votre Téléphone:</label>
								<div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="email" name="telephone"required>
								</div>
							</div>
                                                        <div class="form-group">
								<label for="password" class="col-sm-4 control-label form-label">Votre mot de passe:</label>
								<div class="col-sm-8">
										<input type="password" class="form-control" id="email" name="password"required>
								</div>
							</div>
							<h3 class="form-title">Choisissez le thème de votre question</h3>
							<div class="row text-left bloc_radio">
								<label class="  col-md-4 col-sm-4  col-xs-12 ">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="travail"> Travail
								</label>
								<label class="  col-md-4 col-sm-4 col-xs-12 ">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="finances"> Finances
								</label>
								<label class="  col-md-4 col-sm-4 col-xs-12 ">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="chance"> Chance
								</label>
								<label class="  col-md-4 col-sm-4 col-xs-12 ">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="famille"> Famille
								</label>
								<label class="  col-md-4 col-sm-4 col-xs-12 ">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="amour_couple"> Amour <sub>(Couple)</sub>
								</label>
								<label class="  col-md-4 col-sm-4 col-xs-12 ">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="amour_rencontre"> Amour <sub>(rencontre)</sub>
								</label>
							</div>
							<h3 class="form-title">Posez votre question</h3>
							<p class="text_notif">Attention : expliquez bien votre situation et posez une question complète et précise afin de recevoir  une réponse de qualité.
									<textarea class="form-control" rows="3" id="comments" name ="comments" ></textarea>
							</p>							
							<!--<p class="text_notif">
									<img src="captcha.php"/>
									<input type="text" name="captchaimg" id="captchaimg" placeholder="captcha"required>     
							</p>-->
						  <p class="sender_container">
							  <button type="submit" name="submit" id="submit" class="btn_1"></button>
						  </p>
						</form>
					</div>
			   </div>
		  </div>
		  </div>
		</div>
		<div class="jumbotron bloc_mid">
			<div class="container yellow_container">
				<div class="col-md-3 col-sm-12  col-xs-12 text-center"><a href="#"><img  src="./img/click_here.png"   alt="cliquez ici"  /></a></div>
				<div class="col-md-9  col-sm-12  col-xs-12">
					<h2>pour découvrir ce que vous cache l’avenir !</h2>
					<p>
					Profitez de nos services de voyance sérieuse par téléphone et de voyance sans attente.<br/>Les consultations sont personnalisées et anonymes. 
					</p>
				</div>
			</div>
		</div>
		<div class="jumbotron bloc_experts">
			<div class="container">
			  <!-- Example row of columns -->
			  <div class="row text-center experts_intro">
				<h1>DÉCOUVREZ NOS EXPERTS</h1>
				<h3>Voyant, Medium, Tarologue, Magnétiseur</h3>
				<p>
					Notre équipe d’experts en voyance par téléphone et en astrologie est à votre écoute 24h/24 et 7j/7. Sélectionnés et régulièrement évalués par des clients témoins, nos spécialistes vous viennent en aide et vous apportent des réponses rapides à toutes vos questions sur votre avenir, tant dans le domaine professionnel qu’affectif.
				</p>
			  </div>
			  <div class="row">
			  <hr/>
				<div class="person">
				  <div class="left_side"><img src="./img/person/david_val.png" ></div>
				  <div class="right_side">
					<div class="infos">9.58<sub> /10</sub></div>
					<div class="infos">3871 &#128222;</div>
					<div class="infos">3.5 €/min</div>
				  </div>
				  <h3>David Val <img src="./img/info.png" alt="infos" /></h3>
				  <p>Je vois ce que les autres ne voient pas</p>
				  <p><a href="#"><img src="./img/call.png" alt="infos" /></a></p>
				</div>
				<div class="person">
				  <div class="left_side"><img src="./img/person/eddie_medium.png" ></div>
				  <div class="right_side">
					<div class="infos">9.58<sub> /10</sub></div>
					<div class="infos">3871 &#128222;</div>
					<div class="infos">3.5 €/min</div>
				  </div>
				  <h3>Eddy Medium <img src="./img/info.png" alt="infos" /></h3>
				  <p>Médium voyant auditif spirit flash</p>
				  <p><a href="#"><img src="./img/call.png" alt="infos" /></a></p>
				</div>					
				<div class="person">
				  <div class="left_side"><img src="./img/person/sylvie.png" ></div>
				  <div class="right_side">
					<div class="infos">9.58<sub> /10</sub></div>
					<div class="infos">3871 &#128222;</div>
					<div class="infos">3.5 €/min</div>
				  </div>
				  <h3>Sylvie <img src="./img/info.png" alt="infos" /></h3>
				  <p>Meduim auditif</p>
				  <p><a href="#"><img src="./img/call.png" alt="infos" /></a></p>
				</div>					
				<div class="person">
				  <div class="left_side"><img src="./img/person/thierry.png" ></div>
				  <div class="right_side">
					<div class="infos">9.58<sub> /10</sub></div>
					<div class="infos">3871 &#128222;</div>
					<div class="infos">3.5 €/min</div>
				  </div>
				  <h3>Thierry <img src="./img/info.png" alt="infos" /></h3>
				  <p>Parapsychologue</p>
				  <p><a href="#"><img src="./img/call.png" alt="infos" /></a></p>
				</div>					
				<div class="person">
				  <div class="left_side"><img src="./img/person/sandrine_ange.png" ></div>
				  <div class="right_side">
					<div class="infos">9.58<sub> /10</sub></div>
					<div class="infos">3871 &#128222;</div>
					<div class="infos">3.5 €/min</div>
				  </div>
				  <h3>Sandrine Ange <img src="./img/info.png" alt="infos" /></h3>
				  <p>Meduim spirit</p>
				  <p><a href="#"><img src="./img/call.png" alt="infos" /></a></p>
				</div>			
				<hr/>
			  </div>
			</div> <!-- /container -->
		</div>
		<footer>
		  <div class="container footer_1">
		  <div class="col-md-8">
			<p><a href="#"><img src="./img/footer_logo.png" alt="infos" /></a></p>
			<h4>Professionnel & Particulier Esatus un service pour tous</h4>
			<p>
			Le temps vous manque, Esatus facilitera votre quotidien, en faisant appel à des professionnels plébiscités par nos clients et sélectionnés par notre service Qualité. Diététicienne, Avocat, Coach, Fiscaliste, Astrologue et bien d’autres activités répondent à vos questions au meilleur prix en toute discrétion 24H/24 7 jours sur 7 !<br/><br/>Consultez nos professionnels, de chez vous ou en mode Nomade, Esatus est LA solution qui vous permet de gagner du temps et révolutionne votre quotidien.<br/><br/>Esatus c’est un gain de temps pour les uns... un gain de revenus complémentaires pour les autres, rejoignez-nous !
			</p>
			<p class="bloc_partenairs text-center">
				<img src="./img/orange.png" alt="orange" />
				<img src="./img/paybox.png" alt="paybox" />
				<img src="./img/conversant.png" alt="conversant" />
				<img src="./img/credit_agricole.png" alt="credit agricole" />
				<img src="./img/consulting.png" alt="consulting" />
			<p>
			</div>
		  <div class="col-md-4">
			<h3>A PROPOS</h3>
			<ul>
				<li>Site édité par la SARL 4U Consulting 29, Grand Rue 59100 ROUBAIX</li>
				<li>SIREN : 523 411 866</li>
				<li>TVA intracommunautaire : FR75 523 411 866</li>
				<li>Service client : 08 99 70 35 27</li>
				<li>Numéro surtaxé à 1,35 € TTC par appel + 0,34 € la minute</li>
			</ul>
			<p class="follow_us">	
					<span>Suivez nous sur : </span>
					<a href="#"><img  src="./img/fb.png"  alt="facebook"  title="facebook"  /></a>
					<a href="#"><img  src="./img/tw.png"  alt="twitter"  title="twitter"  /></a>
					<a href="#"><img  src="./img/gp.png"  alt="Google plus"  title="Google plus"  /></a>
					<a href="#"><img  src="./img/in.png"  alt="Linked In"  title="Linked In"  /></a>
					<a href="#"><img  src="./img/lg.png"  alt=""  title=""  /></a>
			</p>
		</div>
			</div>
		</footer>
		<div class="row footer_2">
			<div class="container">
				<span>&copy; Esatus copyright 2016</span>
				<a href="#" class="pull-right"><img src="./img/pin.png" alt="localisation" title="localisation"></a>
			</div>
		</div>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->

	</body>
</html>