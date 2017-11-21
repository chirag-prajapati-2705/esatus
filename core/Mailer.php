<?php

    class Mailer {
        public $uses = array('Service');
        
    	static function contact($data) {
            
            $headers  = 'From:'.$data->name.'<'.$data->email.'>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Contact</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    '.nl2br($data->message).'
				                                                                    <br>
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            
            return mail('ddeletrez@icloud.com','Esatus : Contact',$html,$headers);

        }

        static function account($data) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Création de compte</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour,<br>
				                                                                    <br>
				                                                                    Veuillez trouver ci-dessous les informations de connexion à votre espace client :&nbsp;<br>
				                                                                    <br>
				                                                                    - email : '.$data->email.'<br>
				                                                                    - mot de passe : '.$data->password.'<br>
                                                                                                    - <a href="'.Router::url("profiles/confirmation/id:$data->id").'">Confirmer votre inscription</a><br>
				                                                                    <br>
				                                                                    Veuillez à la confidentialité de ces informations et conservez-les précieusement pour accéder à votre espace.&nbsp;Nous vous rappelons que les communications électroniques seront envoyées à l’adresse mail que vous nous avez communiquée.<br>
				                                                                    <br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';

            $html2 = '<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%"><tr>
<td align="center" style="padding: 37px 0; background-color: #eeeeee;" bgcolor="#eeeeee">
			      <!-- #nl_container -->
			      <table cellpadding="0" cellspacing="0" border="0" style="margin: 0; border: 1px solid #dddddd; color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; " width="600"><tr>
<td>
			            
			            <!-- #nl_header -->
			            <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
<td>
			                <a href="http://www.esatus.fr" style="border: none; display: block;border: none;"><img width="600" alt="" style="display: block; width: 600px;border: none;" src="http://www.esatus.fr/bin/images/Fotolia_45400357_S.jpg"></a>
			                </td>
			              </tr></table>
<!-- #nl_content --><table cellpadding="0" cellspacing="0" border="0" style="margin: 0; border-collapse: collapse;" width="100%"><tr>
<td style="color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff;  padding: 5px 0;" align="left">
<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><tr>
<td width="10px"></td>
<td width="580" style="vertical-align: top; padding: 5px 0; ">
      <table cellpadding="0" cellspacing="0" border="0" width="100%" style="color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><tr>
<td style="vertical-align: top; padding: 5px; text-align: center;" width="284"><a href="http://www.esatus.fr" style="border: none;"><img alt="" width="273" height="94" style="border: none;" src="http://1k64.mjt.lu/img/1k64/sohjy/xr9xz.png"></a></td>
          <td width="10"></td>
          <td style="vertical-align: top; padding: 5px;"></td>
        </tr></table>
</td>
</tr></table>
<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><tr>
<td width="10px"></td>
<td width="580" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:565px;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; " width="565"><tr><td style="padding:5px 0 5px 5px;line-height:normal;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; ">
      <p style="margin: 0 0 10px;line-height: 1.3em;">
      Comme nos 6000 Fans, nous vous remercions pour votre inscription sur <a href="http://www.esatus.fr"> www.Esatus.fr</a><br><br>

Afin de bénéficier de <a href="http://www.esatus.fr/experts/astro/mediums-voyants/david-val--1"> votre première consultation gratuite avec David Val</a>, il ne vous reste plus qu\'à enregistrer votre carte bleu.<br><br>
En effet afin de répondre à la plus grande exigence de nos membres, ne pas obstruer les lignes téléphoniques de nos Voyants &Médium sélectionnés avec rigueur, proposer et maintenir les prix les plus attractifs…<br><br>
Ce sont les raisons pour lesquelles que seul les membres bénéficiant d’une carte bleu qui ont d’un pouvoir d’achat futur peuvent consulter nos Voyants &Médium gratuitement pour leurs premières consultations.<br><br>

<a href="http://www.esatus.fr/experts/astro/mediums-voyants/david-val--1">Nous vous souhaitons une très bonne consultation gratuite avec David Val</a> ou un autre voyant de votre choix et nous vous remercions pour votre confiance. 
<br><br>
Votre Service Expérience Membre Esatus. 
</p>
</td></tr></table></td>
</tr></table>

    <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; ">
      <tr>
        <td width="10px"></td>
        <td width="580" style="vertical-align: top; padding: 5px 0; ">
      <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:565px;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; " width="565"><tr><td style="padding:5px 0 5px 5px;line-height:normal;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; ">
                  <a href="http://www.esatus.fr" style="border: none; display: block;border: none;"><img width="600" alt="" style="display: block; width: 600px;border: none;" src="http://www.esatus.fr/bin/images/footer.jpg"></a>
        </td>
      </tr>
    </table>
</td>
</tr>
    </table>
    
<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><tr>
<td width="10px"></td>
<td width="580" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:565px;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; " width="565"><tr><td style="padding:5px 0 5px 5px;line-height:normal;"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td><table cellpadding="0" cellspacing="0" border="0" align="left"><tr>
<td><table cellpadding="0" cellspacing="0" style="border-collapse: collapse; align: left" align="left"><tr>
<td style="padding: 2px;margin: 0; vertical-align: top;"><a target="_blank" href="http://www.facebook.com/sharer.php?u=http://1k64.mjt.lu/nl/1k64/sohjy.html" style="display: block; border: none; text-decoration: none;border: none;"><img alt="Facebook" style="vertical-align: top; border: none;border: none;" src="http://www.mailjet.com/images/theme/v1/icons/ico_social_facebook.png"></a></td>
<td style="padding: 2px;margin: 0; vertical-align: top;"><a target="_blank" href="http://twitter.com/share?url=http://1k64.mjt.lu/nl/1k64/sohjy.html" style="display: block; border: none; text-decoration: none;border: none;"><img alt="Twitter" style="vertical-align: top; border: none;border: none;" src="http://www.mailjet.com/images/theme/v1/icons/ico_social_twitter.png"></a></td>
<td style="padding: 2px;margin: 0; vertical-align: top;"><a target="_blank" href="https://m.google.com/app/plus/x/?v=compose&amp;content=http://1k64.mjt.lu/nl/1k64/sohjy.html" style="display: block; border: none; text-decoration: none;border: none;"><img alt="Google" style="vertical-align: top; border: none;border: none;" src="http://www.mailjet.com/images/theme/v1/icons/ico_social_google.png"></a></td>
<td style="padding: 2px;margin: 0; vertical-align: top;"><a target="_blank" href="http://www.linkedin.com/shareArticle?url=http://1k64.mjt.lu/nl/1k64/sohjy.html" style="display: block; border: none; text-decoration: none;border: none;"><img alt="Linkedin" style="vertical-align: top; border: none;border: none;" src="http://www.mailjet.com/images/theme/v1/icons/ico_social_linkedin.png"></a></td>
<td style="padding: 2px;margin: 0; vertical-align: top;"><a target="_blank" href="http://www.viadeo.com/?&amp;url=http://1k64.mjt.lu/nl/1k64/sohjy.html" style="display: block; border: none; text-decoration: none;border: none;"><img alt="Viadeo" style="vertical-align: top; border: none;border: none;" src="http://www.mailjet.com/images/theme/v1/icons/ico_social_viadeo.png"></a></td>
<td style="padding: 2px;margin: 0; vertical-align: top;"><a target="_blank" href="https://www.facebook.com/EsatusOfficiel" style="display: block; border: none; text-decoration: none;border: none;"><img alt="Flickr" style="vertical-align: top; border: none;border: none;" src="http://www.mailjet.com/images/theme/v1/icons/ico_social_flickr.png"></a></td>
<td style="padding: 2px;margin: 0; vertical-align: top;"><a target="_blank" href="https://www.facebook.com/EsatusOfficiel" style="display: block; border: none; text-decoration: none;border: none;"><img alt="Pinterest" style="vertical-align: top; border: none;border: none;" src="http://www.mailjet.com/images/theme/v1/icons/ico_social_pinterest.png"></a></td>
</tr></table></td>
      </tr></table></td></tr></table></td></tr></table></td>
</tr></table>
</td>
			              </tr></table>
</td>
			        </tr></table>
<table cellpadding="0" cellspacing="0" border="0" height="10" style="height: 10px;border-collapse: collapse;font-size: 1px;"><tr><td height="10" style="height:10px; border-spacing: 0;font-size: 1px;"> </td></tr></table>
<table cellpadding="10" cellspacing="0" border="0" style="margin: 0; border-collapse: collapse;" width="600"><tr>
<td style="color: #444444; background-color: #eeeeee; border-color: #eeeeee; align: left; font-family: arial; font-size: 11px; ">
			      					<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0; border-collapse: collapse;" width="100%"><tr>
<td align="left" valign="top" style="vertical-align: top; text-align: left; color: #444444; background-color: #eeeeee; border-color: #eeeeee; align: left; font-family: arial; font-size: 11px; ">
					<div id="nl_footer" style="display: block; text-align: left; margin: 0;">Cet email a été envoyé à <a href="mailto:ddeletrez@icloud.com" style="color:#000000;border: none;">ddeletrez@icloud.com</a>, <a href="http://1k64.mjt.lu/unsub?hl=fr&amp;a=bDqyMP&amp;b=eceb1fb3&amp;c=1k64&amp;d=fc2e2d7a&amp;e=b466599e&amp;email=ddeletrez%40icloud.com" style="color:#000000;border: none;">cliquez ici pour vous désabonner</a>.</div>
					
				</td>
				<td align="right" valign="top" style="vertical-align: top; text-align: right">
					
				</td>
		    	
			      						</tr>
                                                                        </table>
</td>
							</tr>
                                                        </table>
</td>
			  </tr>
                          </table>
';
            
            //mail($data->email,'Esatus : Promo de bienvenue',$html2, $headers);
            return mail($data->email,'Esatus : Création de compte',$html, $headers);
        }

        static function accountlanding($data) {
            
            $headers  = 'From:Esatus<ddeletrez@icloud.com>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
							<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Question '.$data->category.'</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				                                                                    <br>
				                                                                    - pseudo : '.$data->pseudo.'<br>
				                                                                    - email : '.$data->email.'<br>
				                                                                    - question : '.$data->question.'<br>
				                                                                    - lien profil : <a href="http://www.esatus.fr/administration/clients/--'.$data->id.'" alt="">http://www.esatus.fr/administration/clients/--'.$data->id.'</a><br>
				                                                                    <br>
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            
            //mail($data->email,'Esatus : Promo de bienvenue',$html2, $headers);
            return mail('contact@esatus.fr','Esatus : Poser vos questions',$html, $headers);
        }

        static function password($data) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Création de compte</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour,<br>
				                                                                    <br>
				                                                                    Veuillez <a href="'.Router::url("profiles/reset/id:".$data->id).'" target="_blank">cliquer ici</a> afin de réinitialiser de votre mot de passe.
				                                                                    <br>
				                                                                    <br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            return mail($data->email,'Esatus : Mot de passe oublié',$html,$headers);
        }

        static function failed($data) {
            
            /*$services = $this->Service->findBy(array('conditions' => array('category_id' => $data->categorieId, 'validated' => 1), 'limit' => 3));
            print_r($services);
                        die();*/
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Service "'.$data->service.'" indisponible</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour ' . $data->name . ',
				                                                                    <br>
				                                                                    <br>
																					Vous avez souhaité entrer en contact avec "' . $data->title . '".
																					<br>Votre expert ne semble pas disponible pour le moment.<br>
																					<br>
																					Vous pouvez sélectionner un autre expert disponible dans <a href="' . $data->link . '">la même catégorie</a>.<br>
																					<br>
                                                                                                                                                                        Voir nos propostions ci-dessous.
                                                                                                                                                                        
																					Merci d\'avoir choisi Esatus et à bientôt !<br>
																					<br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            mail('ddeletrez@icloud.com','Esatus : Service indisponible',$html,$headers);
            return mail('samoud.mohamed@gmail.com','Le service '.$title.' est indisponible',$html,$headers);
        }

        static function success($user,$service,$call) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 

            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Résumé de votre appel</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour '.$user->first_name.',
				                                                                    <br><br>
																					vous avez appelé le service "'.$service->title.'".
																					<br><br>
																					Retrouvez ci-dessous les informations concernant votre appel :
																					<br><br>
																					<table width="100%"  border="0" style="text-align:center;">
																						<thead style="background: #4AB4E4; color: #fff;">
																							<th style="font-weight:normal; padding:0.4em 0;">Date</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Heure</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Tarif</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Durée de l\'appel</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Total TTC</th>
																						</thead>
																						<tbody>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->date.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->hour.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->cost.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->duration.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->amount.'</td>
																						</tbody>
																					</table>
																					<br><br>
																					Merci d\'avoir choisi Esatus et à bientôt !<br>
																					<br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            return mail($user->email,'Esatus : Résumé de votre appel',$html,$headers);

            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Résumé de votre appel</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour,
				                                                                    <br><br>
																					vous avez reçu un appel de "'.$user->first_name.' '.$user->last_name.'" sur votre service "'.$service->title.'".
																					<br><br>
																					Retrouvez ci-dessous les informations concernant votre appel :
																					<br><br>
																					<table width="100%"  border="0" style="text-align:center;">
																						<thead style="background: #4AB4E4; color: #fff;">
																							<th style="font-weight:normal; padding:0.4em 0;">Date</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Heure</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Tarif</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Durée de l\'appel</th>
																							<th style="font-weight:normal; padding:0.4em 0;">Total TTC</th>
																						</thead>
																						<tbody>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->date.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->hour.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->cost.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->duration.'</td>
																							<td style="font-weight:normal; padding:0.4em 0;">'.$call->amount.'</td>
																						</tbody>
																					</table>
																					<br><br>
																					Merci d\'avoir choisi Esatus et à bientôt !<br>
																					<br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            return mail($service->email,'Esatus : Résumé de votre appel',$html,$headers);


        }
        static function preinscription($email) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
<!DOCTYPE HTML>
<html lang="fr">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Suite à votre prê-inscription avec notre partenaire offrez vous 25 EUROS de Voyance gratuite</title>
<link rel="image_src" href="http://1k64.mj.am/nlt/1k64/s73t2.png">
<style type="text/css">
					a { border: none; }
					img { border: none; }
					p { margin: 0; line-height: 1.3em; }
					#footer-msg a { color: #F3A836; }
					h1,h2,h3,h4,h5,h6 {font-size:100%;margin:0;}
				</style>
</head>
<body style="margin: 0; padding: 0; background-color: #eeeeee" bgcolor="#eeeeee">
				
				<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%"><tr>
<td align="center" style="padding: 37px 0; background-color: #eeeeee;" bgcolor="#eeeeee">
<div style="padding: 0 0 10px"><a href="http://1k64.mj.am/nl/1k64/s73t2.html" style="line-height: 1;vertical-align: bottom;color: #000000; font-family: arial; font-size: 11px; ;border: none;">Voir la version en ligne</a></div>
			      <!-- #nl_container -->
			      <table cellpadding="0" cellspacing="0" border="0" style="margin: 0; border: 1px solid #dddddd; color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; " width="600"><tr>
<td>
			            
			            <!-- #nl_header -->
			            <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
<td>
			                <a href="http://www.esatus.fr/experts/voyance/mediums-voyants/david-val--1" style="border: none; display: block;border: none;"><img width="600" alt="" style="display: block; width: 600px;border: none;" src="http://1k64.mj.am/img/1k64/s73t2/0p5t6.jpg"></a>
			                </td>
			              </tr></table>
<!-- #nl_content --><table cellpadding="0" cellspacing="0" border="0" style="margin: 0; border-collapse: collapse;" width="100%"><tr>
<td style="color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff;  padding: 5px 0;" align="left">
<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><tr>
<td width="10px"></td>
<td width="580" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:565px;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; " width="565"><tr><td style="padding:5px 0 5px 5px;line-height:normal;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><p style="margin: 0 0 10px;line-height: 1.3em;">Bonjour vous avez demandé avec notre partenaire web M6 une pré-inscrition a l\'offre <span style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(0, 0, 255);"><u style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;">www.esatus.fr</u></span><br><br>Pour bénéficier de vos 25 euros de consultation gratuite, finalisez votre inscription sur <a href="http://www.esatus.fr" style="color: #0033cc; ;border: none;">www.esatus.fr</a><br><br>Faite le point sur <strong style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;">votre Avenir</strong> et choisissez votre Expert grâce aux notes d\'appréciation laissées par nos clients.<br><br><span style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(255, 140, 0);"><em style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;">Esatus, pour en Savoir Plus.....</em></span></p></td></tr></table></td>
</tr></table>
<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><tr>
<td width="10px"></td>
<td width="580" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:565px;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; " width="565"><tr><td style="padding:5px 0 5px 5px;line-height:normal;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; ">
      
      
      
      
      
      <h1 style="font-size: 2em;margin: 0 0 10px;margin-bottom: 30px; padding: 0px; font-family: Raleway, sans-serif; color: rgb(54, 169, 225); font-size: 39px; text-align: center; background-color: rgb(255, 255, 255); font-weight: 200 !important;">Vous avez une question urgente<br><span style="color: rgb(127, 127, 127); font-size: 24px; line-height: 1.3em;">Esatus regroupe des Experts spécialisés afin de trouver des solutions rapides à vos questions sans rdv de chez vous au meilleur Tarif 24/24 7j7</span>
</h1>        
              
              
              
              
              
      </td></tr></table></td>
</tr></table>
<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;color: #444444; font-family: arial; font-size: 12px; border-color: #dddddd; background-color: #ffffff; "><tr>
<td width="10px"></td>
<td width="145" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align: center; width: 100% "><tr><td><img alt="" width="125" height="96" style="border: none;" src="http://1k64.mjt.lu/img/1k64/suvvo/x8vjx.jpg"></td></tr></table></td>
<td width="145" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align: center; width: 100% "><tr><td><img alt="" width="125" height="95" style="border: none;" src="http://1k64.mjt.lu/img/1k64/suvvo/x8vjs.jpg"></td></tr></table></td>
<td width="145" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align: center; width: 100% "><tr><td><img alt="" width="125" height="99" style="border: none;" src="http://1k64.mjt.lu/img/1k64/suvvo/x8vjp.jpg"></td></tr></table></td>
<td width="145" style="vertical-align: top; padding: 5px 0; "><table cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align: center; width: 100% "><tr><td><img alt="" width="125" height="96" style="border: none;" src="http://1k64.mjt.lu/img/1k64/suvvo/x8vju.jpg"></td></tr></table></td>
</tr></table>
</td>
			              </tr></table>
</td>
			        </tr></table>
<table cellpadding="0" cellspacing="0" border="0" height="10" style="height: 10px;border-collapse: collapse;font-size: 1px;"><tr><td height="10" style="height:10px; border-spacing: 0;font-size: 1px;"> </td></tr></table>
<table cellpadding="10" cellspacing="0" border="0" style="margin: 0; border-collapse: collapse;" width="600"><tr>
<td style="color: #444444; background-color: #eeeeee; border-color: #eeeeee; align: left; font-family: arial; font-size: 11px; ">
			      					<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0; border-collapse: collapse;" width="100%"><tr>
<td align="left" valign="top" style="vertical-align: top; text-align: left; color: #444444; background-color: #eeeeee; border-color: #eeeeee; align: left; font-family: arial; font-size: 11px; ">
					<a href="http://www.mailjet.com" style="color:#000000;border: none;">Mailjet.com</a>
					
				</td>
				<td align="right" valign="top" style="vertical-align: top; text-align: right">
					<a href="http://www.mailjet.com" style="border: none;border: none;"><img class="nl_footer_logo" alt="" style="border: none;" src="http://www.mailjet.com/images/theme/v1/logos/nl_logo_new.png"></a>
				</td>
		    	
			      						</tr></table>
</td>
							</tr></table>
</td>
			  </tr></table>
</body>
</html>
';
            return mail($email,'Rejoindre Esatus',$html,$headers);
        }
        
        static function failedAutorisation($id, $flash) {
            
            $headers  = 'From:Esatus<ddeletrez@icloud.com>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
							<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	Transaction non abouti.	
                                                                                                <a href="http://www.esatus.fr/administration/clients/--'.$id.'">ID Client : '.$id.'</a>
                                                                                                <br>Motif : '.$flash.'
                                                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            return mail('samoud.mohamed@gmail.com','Esatus : transaction non abouti',$html, $headers);
            return mail('ddeletrez@icloud.com','Esatus : transaction non abouti',$html, $headers);
        }
        
        static function infowebmaster($data, $dataUser) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Création de compte</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour,<br>
				                                                                    <br>
				                                                                    Veuillez trouver ci-dessous les informations de client inscri<br>
				                                                                    <br>
                                                                                                    - Id Profile : <a href="http://www.esatus.fr/administration/clients/--'.$dataUser->profile_id.'">'.$dataUser->profile_id.'</a><br>
                                                                                                    - Pseudo : '.$dataUser->pseudo.'<br>
                                                                                                    - TéLéphone : '.$dataUser->phone.'<br>
                                                                                                    - Date de naissance : '.$dataUser->birth_date.'<br>
				                                                                    - email : '.$data->email.'<br>
				                                                                    <br>
				                                                                    
				                                                                    <br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            mail('samoud.mohamed@gmail.com','Esatus : Création de compte',$html, $headers);
            return mail('ddeletrez@icloud.com','Esatus : Création de compte',$html, $headers);
        }
        
        static function ribInfo($data) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Création de compte</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour,<br>
				                                                                    <br>
				                                                                    Veuillez trouver ci-dessous les informations de client inscri<br>
				                                                                    <br>
                                                                                                    - Id Profile : <a href="http://www.esatus.fr/administration/clients/--'.$data->profile_id.'">'.$data->profile_id.'</a><br>
                                                                                                    - Banque : '.$data->banque.'<br>
                                                                                                    - IBAN : '.$data->iban.'<br>
                                                                                                    - BIC : '.$data->bic.'<br>
				                                                                    - Prelevement : '.$data->prelevement.'<br>
				                                                                    <br>
				                                                                    
				                                                                    <br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            mail('samoud.mohamed@gmail.com','Esatus : enregistrement RIB',$html, $headers);
            return mail('ddeletrez@icloud.com','Esatus : enregistrement RIB',$html, $headers);
        }
        
        static function ServiceInfo($data) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Création de compte</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
				             														<br>
				                                                                    Bonjour,<br>
				                                                                    <br>
				                                                                    Veuillez trouver ci-dessous les informations de client inscri<br>
				                                                                    <br>
                                                                                                    - Id Profile : <a href="http://www.esatus.fr/administration/clients/--'.$data->profile_id.'">'.$data->profile_id.'</a><br>
                                                                                                    - Titre : '.$data->title.'<br>
                                                                                                    - Pix/appel : '.$data->cost_per_call.'<br>
				                                                                    - Prix/minute : '.$data->cost_per_minute.'<br>
				                                                                    <br>
				                                                                    
				                                                                    <br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
															                </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            mail('samoud.mohamed@gmail.com','Esatus : Création de service',$html, $headers);
            return mail('ddeletrez@icloud.com','Esatus : Création de service',$html, $headers);
        }
        
        static function failedInfo($data) {
            
            $headers  = 'From:Esatus<contact@esatus.fr>'."\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'; 
            $html = '
            	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#fafafa;min-height:100%!important;width:100%!important">
					<tbody>
				        <tr>
				    	    <td align="center" valign="top" style="border-collapse:collapse">
				                <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fafafa">
				                    <tbody>
				                        <tr>
				                            <td valign="top" style="border-collapse:collapse">
				                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                	<tbody>
				                                        <tr>
				                                        	<td valign="top" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				            								<td valign="top" width="190" style="border-collapse:collapse">
				                                            	<div style="color:#505050;font-family:Arial;font-size:9px;line-height:100%;text-align:left">
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>				                
				        	    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd;background-color:#ffffff">
				            	    <tbody>
				                        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-bottom:0">
				                                    <tbody>
				                                        <tr>
				                                            <td style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
				                                	            <div style="text-align:center">
				                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:underline" target="_blank">
				                                                        <img src="'.IMAGE.'email/logo.jpg" alt="logo esatus" border="0" width="325" height="90">
				                                                    </a>
				                                                </div>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="0" cellspacing="0" width="600">
				                        	        <tbody>
				                                        <tr>
				                                            <td valign="top" style="border-collapse:collapse;background-color:#ffffff">
				                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td valign="top" style="border-collapse:collapse">
				                                                            	<div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:center">
				                                                        			<br>
				                                                                    <h1 style="color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">
				                                                                        <span style="font-family:lucida sans unicode,lucida grande,sans-serif"><span style="color:rgb(74,180,228)">Service "'.$data->service.'" indisponible</span></span>
				                                                                    </h1>
				                                                                    <br>
				                                                        		</div>
				                                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                                                    <br>
				                                                                    Bonjour,
				                                                                    <br>
				                                                                    <br>
                                                                                                    Le service "'.$data->service.'". n\'a pas repondu a l\'appel de '.$data->name.'
                                                                                                    
                                                                                                    <br>
				                                                                    Cordialement.<br>
				                                                                    <br>
				                                                                    L\'équipe d\'Esatus.
				                                                                </div>
                                                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				            	        <tr>
				                	        <td align="center" valign="top" style="border-collapse:collapse">
				                    	        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:#fba449;border-top:0">
				                        	        <tbody>
				                                        <tr>
				                            	            <td valign="top" style="border-collapse:collapse">
				                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
				                                                    <tbody>
				                                                        <tr>
				                                                            <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:#fba449;border:0">
				                                                                <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
				                                                                    <a href="'.Router::url("pages/index").'" style="color:#336699;font-weight:normal;text-decoration:none" target="_blank"><span style="color:#ffffff">Accéder au site</span></a>
				                                                                </div>
				                                                            </td>
				                                                        </tr>
				                                                    </tbody>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <br>
				            </td>
				        </tr>
				    </tbody>
				</table>
            ';
            mail('ddeletrez@icloud.com','Esatus : Service indisponible',$html,$headers);
            return mail($data->email,'Esatus : Service indisponible',$html,$headers);
        }
    }
            
?>