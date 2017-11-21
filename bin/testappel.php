<?php
//include ('lib/nusoap.php');
 function test() {

            $wsdl = "https://webservice.lecompteachats.com/wsC2K/services/Click2CallKIE?wsdl";
            $client = new SoapClient($wsdl);
            $request = array(
                'numfrom'         => '33982323527', //users
                'numto'           => '33658046982', //service
                'login'           => 'u4uco178',
                'mdp'             => 'u38vijg2',
                'sessionid'       => 'test',
                'optionnalParams' => array(
                    'callConfirmation'=> 'false',
                    'labelfrom'       => '33982323527',
                    'labelto'         => '33658046982',
                    'private'         => 'false',
                    'maxduration'     => '600',
                    'lang'            => 'FR',
                    'notificationURL' => 'http://213.186.33.17/~esatus/orange/reponse' 
                )
            );
			
			 //$client = new SoapClient($wsdl,$request);  
 $result = $client->createCallKIE($request);
           // $result = $client->call('createCallKIE',$request);
			var_dump($result);
			//print_r($client->__getFunctions()); 

           //debug($result); die();

        }
		
		
	$resultat = test();

    echo $resultat;	
?>