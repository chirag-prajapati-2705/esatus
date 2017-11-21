<?php

    class Mailer {

    	static function contact($data) {
            
            $headers  = 'From:'.$data->name.'<'.$data->email.'>'."\n";
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
            return mail('contact@esatus.fr','Esatus : Contact',$html,$headers);
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
				                                                                    <br>
                                                                                                    <a href="http://www.esatus.fr/connexion">Pour recevoir vos cadeaux et vos promo terminer rapidement votre inscription</a>
                                                                                                    <br>
				                                                                    Veillez à la confidentialité de ces informations et conservez-les précieusement pour accéder à votre espace.&nbsp;Nous vous rappelons que les communications électroniques seront envoyées à l’adresse mail que vous nous avez communiquée.<br>
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
            return mail($data->email,'Esatus : Création de compte',$html,$headers);
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
				                                                                    Bonjour '.$data->name.',
				                                                                    <br>
				                                                                    <br>
																					vous avez souhaité joindre le service "'.$data->service.'".
																					<br>Votre expert ne semble pas disponible pour le moment.<br>
																					<br>
																					Vous pouvez sélectionner un autre expert disponible dans <a href="'.$data->link.'">la même catégorie</a>.<br>
																					<br>
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
            return mail($data->email,'Esatus : Service indisponible',$html,$headers);
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

    }
            
?>