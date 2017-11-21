<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('/var/www/vhosts/ns428114.ip-37-187-149.eu/httpdocs/esatus/controller/AvailabilitiesController.php');

class CallsController extends Controller {

    public $uses = array('Call', 'Profile', 'User', 'Service', 'Category', 'Subcategory', 'Issue', 'Card', 'Balance', 'Availability', 'Calldetail', 'Callprogress', 'Preautorisation');

    public function call($slug, $id) {
        //ob_start();	
        //ob_implicit_flush(true);
        if (!isset($slug)) {
            $this->redirect('categories/index');
            die();
        }

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('categories/index');
            die();
        }

        $service = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'validated' => 1)));

        if (!$service) {
            $this->redirect('categories/index');
            die();
        } else {
            $service = current($service);
        }

        $category = $this->Category->findOneBy(array('conditions' => array('id' => $service->category_id)));

        if (!$category) {
            $this->redirect('categories/index');
            die();
        } else {
            $category = current($category);
        }

        $subcategory = $this->Subcategory->findOneBy(array('conditions' => array('id' => $service->subcategory_id)));

        if (!$subcategory) {
            $this->redirect('categories/category/slug:' . $category->slug);
            die();
        } else {
            $subcategory = current($subcategory);
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id)));

        if (!$user) {
            $this->redirect('categories/subcategory/cat:' . $category->slug . '/subcat:' . $subcategory->slug);
            die();
        } else {
            $user = current($user);
        }

        $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $service->id))));
        $today = strtolower(date('l'));
        $params = explode(';', $availabilities->$today);
        $now = date('G');
        $available = false;
        foreach ($params as $val) {
            $hour = explode(':', $val);
            if ($now >= $hour[0] && $now < $hour[0] + 1) {
                $available = true;
                break;
            }
        }

        if (!$available) {
            $this->redirect('categories/subcategory/cat:' . $category->slug . '/subcat:' . $subcategory->slug);
            die();
        }

        $username = ($service->username == '') ? $user->first_name . ' ' . $user->last_name : $service->username;

        $d['title_for_layout'] = 'Experts > ' . $category->title . ' > ' . $subcategory->title . ' > ' . $username . ' > Appeler';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Experts',
                'type' => 'url',
                'url' => Router::url('categories/index')
            ),
            array(
                'title' => $category->title,
                'type' => 'url',
                'url' => Router::url('categories/category/slug:' . $category->slug)
            ),
            array(
                'title' => $subcategory->title,
                'type' => 'url',
                'url' => Router::url('categories/subcategory/cat:' . $category->slug . '/subcat:' . $subcategory->slug)
            ),
            array(
                'title' => $username,
                'type' => 'url',
                'url' => Router::url('services/view/cat:' . $category->slug . '/subcat:' . $subcategory->slug . '/slug:' . clean($username) . '/id:' . $service->id)
            ),
            array(
                'title' => 'Appeler',
                'type' => 'current',
            )
        );
        $d['body_classes_for_layout'] = "page-call";

        $d['url'] = 'calls/call/slug:' . clean($username) . '/id:' . $service->id;
        $d['service'] = $service;

        $calls = $this->Call->findBy(array(
            'conditions' => 'service_id = ' . $d['service']->id . ' AND (status = 310 OR status = 330 OR status = 350)',
            'order' => 'id DESC'
        ));
        $d['service']->count = count($calls);

        $this->loadModel('Rating');
        $rating = current($this->Rating->average('rate', 'service_id = ' . $d['service']->id));
        $d['service']->average = ($rating->average == '') ? 'non noté' : number_format($rating->average, 2);

        $d['user'] = $user;

        $services = $this->Service->findBy(array('conditions' => array('category_id' => $category->id, 'validated' => 1)));
        $availables = array();
        $unavailables = array();
        foreach ($services as $k => $v) {

            $category = current($this->Category->findOneBy(array('conditions' => array('id' => $v->Service->category_id))));
            $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Service->subcategory_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            //$mailexpert = current($this->Profile->findOneBy(array('conditions'=>array('id'=>$v->Service->profile_id))));
            $mailexpert = current($this->Profile->findOneBy(array('conditions' => array('id' => $d['service']->profile_id))));
            $slug = explode('.', $v->Service->img);
            $rating = current($this->Rating->average('rate', 'service_id = ' . $v->Service->id));
            $calls = $this->Call->findBy(array(
                'conditions' => 'service_id = ' . $v->Service->id . ' AND (status = 310 OR status = 330 OR status = 350)',
                'order' => 'id DESC'
            ));

            $username = ($v->Service->username == '') ? $user->last_name . '-' . $user->first_name : $v->Service->username;

            $v->Service->url = 'slug:' . clean($username) . '/id:' . $v->Service->id;
            $v->Service->category = $category->slug;
            $v->Service->subcategory = $subcategory->slug;
            $v->Service->user = $user;


            $available = false;
            $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $v->Service->id))));
            $today = strtolower(date('l'));
            $params = explode(';', $availabilities->$today);
            $now = date('G');

            foreach ($params as $val) {
                $hour = explode(':', $val);
                if ($now >= $hour[0] && $now < $hour[0] + 1) {
                    $available = true;
                    break;
                }
            }

            $v->Service->available = $available;
            $v->Service->rating = ($rating->average == '') ? 'non noté' : number_format($rating->average, 2) . ' / 10';
            $v->Service->calls = (!$calls) ? 'aucun appel' : count($calls) . ' appels';
            $v->Service->rateCount = ($rating->average == '') ? 0 : $rating->average;
            $v->Service->callCount = (!$calls) ? 0 : count($calls);

            if ($v->Service->available == 1 && $v->Service->id != $d['service']->id) {
                $taken = $this->Call->findOneBy(array('conditions' => array('service_id' => $v->Service->id, 'status' => 200)));
                if (!$taken) {
                    $availables[] = $v;
                }
            } else {
                $unavailables[] = $v;
            }
        }

        usort($availables, function($a, $b) {
            $key = 'callCount';
            $a = current($a);
            $b = current($b);
            return $b->$key - $a->$key;
        });

        array_splice($availables, 3);

        $d['services'] = $availables;
        $d['category'] = $category;

        if (!$this->Session->isLogged()) {

            if ($this->request->data) {

                $rules = $this->Profile->rules;
                $data = $this->request->data;

                if ($this->Profile->validate($rules, $data)) {
                    $email = $data->email;
                    $password = sha1($data->password);
                    $profile = $this->Profile->findOneBy(array('conditions' => array('email' => $email, 'password' => $password)));
                    if ($profile) {
                        $this->Session->write('profile', current($profile));
                        if ($this->requestAction(array('controller' => 'users', 'action' => 'test'))) {
                            $this->redirect($url);
                        } else {
                            $this->redirect('users/index');
                        }
                        die();
                    } else {
                        $profile = $this->Profile->findOneBy(array('conditions' => array('email' => $email)));
                        if ($profile) {
                            $this->Session->setFlash('Mauvaise combinaison entre votre email et votre mot de passe.');
                        } else {
                            $this->Session->setFlash('Aucun compte n\'est lié à cette adresse mail.');
                        }
                    }
                }
            }
        } else {

            // Verifie si une carte bancaire à été renseignée
            $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

            if (!$card) {
                // Pas de carte, redirection vers l'admin client page "ma carte"
                $this->Session->setFlash('Pour contacter nos experts, merci de renseigner une carte bancaire.');
                $this->redirect('espace-client/ma-carte-bancaire');
                die();
            }

            $me = current($this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));


            if ($this->request->data) {

                $rules = $this->User->check;
                $data = $this->request->data;

                // Vérification du numéro de téléphone choisi par l'appelant
                if ($this->User->validate($rules, $data)) {

                    // Format du numéro de téléphone OK
                    $phone = $data->phone;

                    // Vérification de la carte bancaire de l'appelant
                    // URL préproduction PAYBOX
                    $url = "https://ppps.paybox.com/PPPS.php";

                    // Numéro de la question
                    $issue = current($this->Issue->find(1));

                    // Numéro de la carte
                    $card = current($this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));

                    // Test rapide de la carte bancaire du client
                    if (substr($card->mark, 0, 3) == '000') {

                        // Ancienne YES card
                        // Renvoie le client vers sont admin pour renseigner une carte valide
                        $this->Session->setFlash('Votre carte semble invalide. Merci de vérifier.');
                        $this->redirect('espace-client/ma-carte-bancaire');
                        die();
                    } else {

                        // Carte valide
                        // Test de crédit sur carte bancaire client via paybox "autorisation"
                        // Référence Paybox manuel en francais V4_84.pdf - page 43 
                        $preautorisation = current($this->Preautorisation->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));

                        if (($preautorisation) && (date_add($preautorisation->date, date_interval_create_from_date_string('7 days')) < date('Y-m-d H:i:s'))) {
                            $response->codereponse = '00000';
                        } else {
                            $params = array(
                                'VERSION' => '00104',
                                'DATEQ' => date('dmYHis'),
                                'TYPE' => '00051',
                                'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                                'SITE' => '1101352',
                                'RANG' => '001',
                                'CLE' => 'luguwPBf',
                                'MONTANT' => '5000', // 50.00 €
                                'DEVISE' => '978',
                                'REFERENCE' => $service->profile_id . '-' . $me->id,
                                'REFABONNE' => $this->Session->profile('email'),
                                'PORTEUR' => $card->mark,
                                'DATEVAL' => $card->expiry_date,
                                'CVV' => $card->cryptogram,
                                'ACTIVITE' => '027'
                            );

                            $issue->number++;
                            $this->Issue->save($issue);

                            // Création de la requête POST
                            $post = '';
                            foreach ($params as $k => $v) {
                                $post .= $k . '=' . $v . '&';
                            }
                            $post = substr($post, 0, -1);

                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, $url);
                            if (preg_match('`^https://`i', $url)) {
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                            }
                            curl_setopt($curl, CURLOPT_HEADER, 0);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_POST, 1);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

                            // Execution de la requête POST
                            $data = curl_exec($curl);

                            $tmp = explode('&', $data);
                            $response = new stdClass();
                            foreach ($tmp as $value) {
                                $vars = explode('=', $value);
                                $vars[0] = strtolower($vars[0]);
                                $response->$vars[0] = $vars[1];
                            }

                            if (isset($response->codereponse) && $response->codereponse == '00000') {
                                $preAutorisationData->id = $preautorisation->id;
                                $preAutorisationData->profile_id = $this->Session->profile('id');
                                $preAutorisationData->date = date('Y-m-d H:i:s');
                                $this->Preautorisation->save($preAutorisationData);
                            }
                        }

                        //$this->Session->setFlash (var_dump($response->codereponse));
                        //$this->Session->setFlash ("confirmation carte" . var_dump($response));
                        if (isset($response->codereponse) && $response->codereponse == '00000') {

                            // Réponse de Paybox : OK
                            // Lancement de l'appel

                            $callPriceLimit = 50; // Appel limité à 50€
                            //$numfrom = '33'.substr($phone,1,10);
                            //$numto = '33'.substr($service->phone,1,10);

                            $numfrom = $phone;
                            $numto = $service->phone;

                            $duration = floor((($callPriceLimit - $service->cost_per_call) / $service->cost_per_minute) * 60);
                            if ($duration > 3600) {
                                $duration = 3600;
                            }

                            $result = 200;
                            $d['result'] = $result;

                            shell_exec("php /etc/asterisk/Originate.php " . $duration . " " . $mailexpert->email . " " . $numfrom . " " . $numto . " " . session_id() . " " . $me->id . " " . $service->id);
                            /*
                              $oSocket = fsockopen ("127.0.0.1", 5038, $errno, $errstr, 20);
                              stream_set_blocking ($oSocket , 0);
                              //socket_set_nonblock($oSocket);
                              if (!$oSocket)
                              {
                              echo "$errstr ($errno)<br>\n";
                              $result = 410;
                              $d['result'] = $result;
                              die();
                              }
                              else
                              {
                              $result = 200;
                              $d['result'] = $result;

                              fputs($oSocket, "Action: login\r\n");
                              fputs($oSocket, "Events: on\r\n");
                              fputs($oSocket, "Username: esaami\r\n");
                              fputs($oSocket, "Secret: 1nd3tec4ble\r\n\r\n");
                              sleep(2);

                              fputs($oSocket, "Action: Originate\r\n");
                              fputs($oSocket, "Channel: SIP/avecOVH28/00261340496506\r\n");
                              //fputs($oSocket, "Channel: SIP/avecOVH28/".$numto."\r\n");
                              fputs($oSocket, "ActionID: ".session_id()."\r\n");
                              //fputs($oSocket, "Channel: SIP/2050\r\n");
                              fputs($oSocket, "Context: clicktocall\r\n");
                              //fputs($oSocket, "Exten: 900261345055257\r\n");
                              //fputs($oSocket, "Exten: 92000\r\n");
                              //fputs($oSocket, "Variable: var1=".$duration."000,var2=".$mailexpert->email.",var3=".$numfrom.",var4=".$numto.",var5=".session_id()."\r\n");
                              fputs ( $oSocket, "Variable: var1=" . $duration . "000,var2=" . $mailexpert->email . ",var3=" . $numfrom . ",var4=" . $numto . ",var5=" . session_id () . ",var6=" . $me->id . ",var7=" . $service->id . "\r\n" );
                              //fputs($oSocket, "Exten: 9".$numfrom."\r\n");
                              fputs($oSocket, "Exten: 900261320518915\r\n");
                              fputs($oSocket, "Priority: 1\r\n");
                              fputs($oSocket, "CallerID: 0972411028\r\n");
                              //fputs($oSocket, "ActionID: 0972411028\r\n");
                              fputs($oSocket, "Timeout: 30000\r\n\r\n");
                              sleep(5);
                             */
                            $oldsession = session_id(); //Modifier par Tsiry
                            //session_regenerate_id();
                            //$_SESSION['id'] = session_id();

                            $calld = ''; // NULL;
                            $callp = ''; // NULL;
                            $cstate = "RINGING";
                            $stopt = strtotime("+120 seconds");
                            $ctime = strtotime("now");
                            //$this->Session->setFlash ( 'Ca sonne ...' );
                            //$result = 200;
                            //$d['result'] = $result;
                            //ob_start();
                            //ob_end_flush();
                            //ob_flush();
                            //flush();
                            //sleep(5);//$this->Session->setFlash ( 'Nous appelons votre Expert, merci de patienter ...' );
                            while ((!$callp ) && ($cstate == "RINGING")) {
                                //if ((!$callp ) && ($cstate == "RINGING"))
                                //sleep ( 5 );
                                //    $this->Session->setFlash ( 'Ca sonne ...' );
                                $callp = current($this->Callprogress->findCallprogress(array('conditions' => array('SESID' => $oldsession))));
                                if ($callp) {

                                    //if(($callp->Callprogress->EXPERT=="HANGUP") || ($stopt<strtotime("now")))
                                    if ($callp->Callprogress->EXPERT == "HANGUP") {
                                        $cstate == "HANGUP";
                                        $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $service->id))));
                                        $ac = new AvailabilitiesController();
                                        $ac->ajax_empty($availabilities->id);
                                        shell_exec("php /etc/asterisk/SendSMS.php" . $numto . "Bonjour un client a souhaité vous joindre sur www.esatus.fr,vous n'avez pas répondu,nous avons temporairement mis en indisponible votre compte Esatus. Nous vous laissons le soin de mettre à jour vos disponibilités Réel sur votre Espace Personnel.Votre service Esatus.");

                                        shell_exec("php /etc/asterisk/SendMail.php" . $mailexpert->email . "Appel manqué d'un client");
                                        //$result = $client->createCallKIE($request);
                                        $result = 410;
                                        $d['result'] = $result;
                                        //$this->set($d);
//$this->redirect('categories/subcategory/cat:'.$category->slug.'/subcat:'.$subcategory->slug);
                                        die();
                                    }
                                    if ($callp->Callprogress->EXPERT == "ANSWERED") {
                                        $cstate == "ANSWERED";
                                        //$result = 200;
                                        //$d['result'] = $result;
                                        //$this->set($d);
                                    }
                                }
                                /* 			if($stopt<strtotime("now"))
                                  {
                                  $availabilities = current($this->Availability->findOneBy(array('conditions'=>array('service_id'=>$service->id))));
                                  $ac = new AvailabilitiesController();
                                  $ac->ajax_empty($availabilities->id);

                                  shell_exec("php /etc/asterisk/SendSMS.php" .$numto. "Bonjour un client a souhaité vous joindre sur www.esatus.fr,vous n'avez pas répondu,nous avons temporairement mis en indisponible votre compte Esatus. Nous vous laissons le soin de mettre à jour vos disponibilités Réel sur votre Espace Personnel.Votre service Esatus.");

                                  shell_exec("php /etc/asterisk/SendMail.php". $mailexpert->email . "Appel manqué d'un client");

                                  //$this->redirect('categories/subcategory/cat:'.$category->slug.'/subcat:'.$subcategory->slug);
                                  $result = 410;
                                  $d['result'] = $result;

                                  die();

                                  } */
                            }

                            //ob_flush();
                            //flush();
                            //ob_flush();
                            //flush();

                            while ((!$calld ) && ($cstate != "HANGUP")) {
                                //if((!$calld )&&($cstate != "HANGUP")) 
                                //sleep ( 5 );
                                //    $this->Session->setFlash ( 'Ca sonne ...' );
                                $calld = current($this->Calldetail->findCalldetail(array('conditions' => array('actionid' => $oldsession))));
                            }
                            $callp = current($this->Callprogress->findCallprogress(array('conditions' => array('SESID' => $oldsession))));
                            //$this->Session->setFlash (var_dump($callp));
                            if ($callp) {
                                if ($callp->Callprogress->EXPERT == "OKOK") {
                                    $result = 201;
                                    $d['result'] = $result;
                                }
                            }
                            //$this->Session->setFlash (var_dump(current($calld)));
                            //$this->Session->setFlash (var_dump(current($calld)->Calldetail->disposition));
                            $calld = current($this->Calldetail->findCalldetail(array('conditions' => array('actionid' => $oldsession))));
                            if (($calld ) && ($cstate != "HANGUP")) {
                                $this->server_response($oldsession, $me->id, $service->id, $calld->Calldetail->disposition, $calld->Calldetail->disposition2, $calld->Calldetail->billsec, $calld->Calldetail->answer, $calld->Calldetail->end, $calld->Calldetail->dst);
                            }
//$cc->server_response($oldsession, $me->id, $service->id, "ANSWERED", "ANSWERED", "60", "2014-11-14 01:02:00", "2014-11-14 01:03:00", '#');
                            // ITY LE ELSE                   }                                
                            // Debug
                            // $msg  = '$phone = '.$phone.'<br/>';
                            // $msg .= '$numfrom = '.$numfrom.'<br/>';
                            // $msg .= '$numto = '.$numto.'<br/>';
                            // $msg .= '$duration = '.$duration.'<br/>';
                            // $msg .= '$notificationURL = '.Router::url('server/calls/response').'<br/>';
                            // mail('contact@jonathanfidi.com', 'Esatus phone : '.$phone, $msg);

                            /*
                              $wsdl = "https://webservice.lecompteachats.com/wsC2K/services/Click2CallKIE?wsdl";
                              $client = new SoapClient($wsdl);
                              $request = array(
                              'numfrom'         => $numto,
                              'numto'           => $numfrom,
                              'login'           => 'u4uco178',
                              'mdp'             => 'u38vijg2',
                              'sessionid'       => $this->Session->read('id').'-'.$me->id.'-'.$service->id,
                              'optionnalParams' => array(
                              'callConfirmation'=> 'false',
                              'labelfrom'       => '4444',
                              'labelto'         => '4444', // 591129
                              'private'         => 'false',
                              'maxduration'     => $duration,
                              'lang'            => 'FR',
                              'notificationURL' => Router::url('server/calls/response'),
                              'audioURL'        => 'http://esatus.fr/bin/audio/messages/message-accueil-expert-international-light.wav'
                              )
                              );

                              $result = $client->createCallKIE($request);
                              $d['result'] = current($result);
                             */
                            session_regenerate_id();
                            $_SESSION['id'] = session_id();
                        } else {
                            //$this->Session->setFlash('Vos informations bancaires semblent erronées. Merci de renseigner une carte bancaire valide.');
                            $this->redirect('users/card');
                            die();
                        }
                    }
                } else {

                    $this->Session->setFlash('Votre numéro de téléphone semble incorrect, merci de vérifier.');
                }
            }

            $d['me'] = $me;
        }

        $this->set($d);
    }

    /**
     * Pages.
     */
    public function server_response($oldsession, $userid, $serviceid, $disposition, $disposition2, $billsec, $callstart, $callend, $dst) {
        //public function server_response() {

        $this->loadModel('Affecter');
        $this->loadModel('Campagne');
        $this->loadModel('Users_promo');
        $this->loadModel('Preautorisation');
        

        // Si la réponse est correctement formatée
// BIG IF   if(isset($_GET['session_id']) && isset($_GET['call_id']) && isset($_GET['code']))
//            {
        /*                $params = explode('-',$_GET['session_id']);

          $call = $this->Call->findOneBy(array('conditions'=>array('session_id'=>$params[0])));

          //                if (!$call)
          //                {
          if($_GET['code']==200)
          {

          $call->status = $_GET['code'];

          $call->start = $_GET['call_start_date'];

          $call->end = $_GET['call_end_date'];

          $this->Call->save($call);
          die();
          }
          $data = new stdClass();
          $data->call_id = $_GET['call_id'];
          $data->session_id = $params[0];
          $data->user_id = $params[1];
          $data->service_id = $params[2];
          $data->status = $_GET['code'];
          $data->cost = 0;
          $data->payment = 0;

          if (isset($_GET['call_start_date'])) {
          $data->start = str_replace('T',' ',$_GET['call_start_date']);
          } else {
          $data->start = date('Y-m-d').' 00:00:00';
          }

          if (isset($_GET['call_end_date'])) {
          $data->end = str_replace('T',' ',$_GET['call_end_date']);
          } else {
          $data->end = date('Y-m-d').' 00:00:00';
          }

          $this->Call->save($data);
         */

        $data = new stdClass ();
        // $data->call_id = $_GET['call_id'];
        $data->call_id = $oldsession;
        $data->session_id = $oldsession;
        $data->user_id = $userid;
        $data->service_id = $serviceid;
        // $data->status = $_GET['code'];
        $data->status = $disposition;
        $data->cost = 0;
        $data->payment = 0;

        $data->start = $callstart;
        $data->end = $callend;
        //     			$data->end = $callstart;
        //if (isset($_GET['call_start_date'])) { $data->start = str_replace('T',' ',$_GET['call_start_date']); } else { $data->start = date('Y-m-d').' 00:00:00'; } if (isset($_GET['call_end_date'])) { $data->end = str_replace('T',' ',$_GET['call_end_date']); } else { $data->end = date('Y-m-d').' 00:00:00'; }

        $this->Call->save($data);
        $call = $this->Call->findOneBy(array('conditions' => array('session_id' => $oldsession)));


        if ($call) {

//if kel                } 
//                else 
//                {

            $call = current($call);
            /*
              if ($call->status != $_GET['code']) {
              $call->status = $_GET['code'];
              }

              if (isset($_GET['call_start_date'])) {
              $call->start = str_replace('T',' ',$_GET['call_start_date']);
              } else {
              $data->start = date('Y-m-d').' 00:00:00';
              }

              if (isset($_GET['call_end_date'])) {
              $call->end = str_replace('T',' ',$_GET['call_end_date']);
              } else {
              $data->end = date('Y-m-d').' 00:00:00';
              }

              if($call->payment == 1){
              // Protection contre le double paiement
              // Si appel déjà enregistré comme payé, on s'arrête là.
              // Envoi d'un mail d'alerte à l'admin
              $msg  = '$call->payment = '.$call->payment.'<br/>';
              $msg .= '$call->status = '.$call->status.'<br/>';
              $msg .= '$call->start = '.$call->start.'<br/>';
              $msg .= '$call->end = '.$call->end.'<br/>';
              mail('contact@jonathanfidi.com', 'Esatus call payment '.$call->payment, $msg);
              die();
              }
             */

            //if ($call->status != $_GET['code']) { $call->status = $_GET['code']; }
            $call->status = $disposition;
            // if (isset($_GET['call_start_date'])) {
            if ($callstart) {
                $call->start = $callstart;
            } else {
                $data->start = date('Y-m-d') . ' 00:00:00';
            }
            if ($callend) {
                $call->end = $callend;
            } else {
                $data->end = date('Y-m-d') . ' 00:00:00';
            }
            if ($call->payment == 1) {
                // Protection contre le double paiement
                // Si appel déjà enregistré comme payé, on s'arrête là.
                // Envoi d'un mail d'alerte à l'admin
                $msg = '$call->payment = ' . $call->payment . '<br/>';
                $msg .= '$call->status = ' . $call->status . '<br/>';
                $msg .= '$call->start = ' . $call->start . '<br/>';
                $msg .= '$call->end = ' . $call->end . '<br/>';
                // mail('contact@jonathanfidi.com', 'Esatus call payment '.$call->payment, $msg);
                mail('vkasinfo@gmail.com', 'Esatus call payment ' . $call->payment, $msg);
                die();
            }

            // Appel refusé
            //if ($_GET['code'] == 432) 
            if (($dst == '#') && ($disposition == "NO ANSWER")) {

                $user = current($this->User->findOneBy(array('conditions' => array('id' => $userid))));
                $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $user->profile_id))));
                $service = current($this->Service->findOneBy(array('conditions' => array('id' => $serviceid))));
                $category = current($this->Category->findOneBy(array('conditions' => array('id' => $service->category_id))));
                $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $service->subcategory_id))));

                $mail = new stdClass();
                //$mail->email = $profile->email;
                $mail->email = 'andritiana@setex.mg';
                $mail->name = $user->first_name;
                $mail->service = $service->title;
                $mail->link = Router::url('categories/subcategory/cat:' . $category->slug . '/subcat:' . $subcategory->slug);

                // Envoi du mail
                Mailer::failed($mail);
            }

            // Appel réussi
//                    if ($_GET['code'] == 310 || $_GET['code'] == 330 || $_GET['code'] == 350) {
            if ($dst == '#' && $disposition == "ANSWERED") {
                //if (($dst == '#') && ($disposition == "NO ANSWER"))
                $service = current($this->Service->findOneBy(array('conditions' => array('id' => $serviceid))));
                $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $service->profile_id))));
                $service->email = $profile->email;

                // On détermine le coût de l'appel
                /* $a = strtotime($call->end); 
                  $b = strtotime($call->start);
                  $c = $a-$b; */
                $c = $billsec;

                // On recherche l'utilisateur
                $user = current($this->User->findOneBy(array('conditions' => array('id' => $userid))));
                $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $user->profile_id))));
                $user->email = $profile->email;

                // On recherche si le service est inscrit dans une promo
                $promo = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $service->id)));

                // On recherche si l'utilisateur a utiliser une promo
                $userPromo = $this->Users_promo->findOneBy(array('conditions' => array('id_profile' => $profile->id)));

                // Si le service est en promotion et l'utilisateur n'a pas consommé
                if (($promo) && (!$userPromo)) {
                    $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => $promo->Affecter->id_campagne)));
                    $type = $campagne->Campagne->type;
                    $valeur = $campagne->Campagne->valeur;
                    switch ($type) {
                        case "Pourcentage" :
                            $cost = ((($c / 60) * $service->cost_per_minute) / 100) * ( 100 - $valeur ) + $service->cost_per_call;
                            break;
                        case "Minutes" :
                            $cost = ((($c / 60) - $valeur) * $service->cost_per_minute) + $service->cost_per_call;
                            break;
                        case "Somme" :
                            $cost = (($c / 60) * $service->cost_per_minute) + $service->cost_per_call - $valeur;
                            break;
                    }

                    $users_promo->id_profile = $profile->id;
                    $users_promo->id_service = $service->id;
                    //$users_promo->id_call = $_GET['call_id'];
                    $users_promo->id_call = $oldsession;
                    $this->Users_promo->save($users_promo);
                } else {
                    $cost = (($c / 60) * $service->cost_per_minute) + $service->cost_per_call;
                }

                if ($cost < 0) {
                    $cost = 0;
                }

                $call->cost = number_format($cost, 2);

                // Envoi du mail (Client/Expert)

                $info = new stdClass();
                //$date = substr($v->Call->start,0,10);
                $date = $callstart;
                $date = explode('-', $date);
                $info->date = $date[2] . '/' . $date[1] . '/' . $date[0];
                //$info->hour = substr($v->Call->start,11);
                $info->hour = substr($callstart, 11);
                $info->cost = number_format($service->cost_per_call, 2) . '€/appel + ' . number_format($service->cost_per_minute, 2) . '€/min';
                $info->duration = elapsedTime($call->start, $call->end);
                $info->amount = number_format($cost, 2) . ' €';

                Mailer::success($user, $service, $info);


                // URL préproduction
                $url = "https://ppps.paybox.com/PPPS.php";

                // Numéro de la question
                $issue = current($this->Issue->find(1));

                // Numéro de la carte
                $card = current($this->Card->findOneBy(array('conditions' => array('profile_id' => $user->profile_id))));

                // Référence Paybox manuel en francais V4_84.pdf - page 43 
                $params = array(
                    'VERSION' => '00104',
                    'DATEQ' => date('dmYHis'),
                    'TYPE' => '00053', // ?? 52
                    'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                    'SITE' => '1101352',
                    'RANG' => '001',
                    'CLE' => 'luguwPBf',
                    'MONTANT' => number_format($cost, 2) * 100,
                    'DEVISE' => '978',
                    'REFERENCE' => $service->profile_id . '-' . $user->id,
                    'REFABONNE' => $profile->email,
                    'PORTEUR' => $card->mark,
                    'DATEVAL' => $card->expiry_date,
                    'CVV' => $card->cryptogram,
                    'ACTIVITE' => '027'
                );

                $issue->number++;
                $this->Issue->save($issue);

                // Création de la requête POST
                $post = '';
                foreach ($params as $k => $v) {
                    $post .= $k . '=' . $v . '&';
                }
                $post = substr($post, 0, -1);

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                if (preg_match('`^https://`i', $url)) {
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                }
                curl_setopt($curl, CURLOPT_HEADER, 0);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                $data = curl_exec($curl);

                $tmp = explode('&', $data);
                $response = new stdClass();
                foreach ($tmp as $value) {
                    $vars = explode('=', $value);
                    $vars[0] = strtolower($vars[0]);
                    $response->$vars[0] = $vars[1];
                }

                if (isset($response->codereponse) && $response->codereponse == '00000') {
                    $preautorisation = current($this->Preautorisation->findOneBy(array('conditions' => array('profile_id' => $profile->id))));
                    $this->Preautorisation->delete($preautorisation->Preautorisation->id);
                    $call->payment = 1;
                    $balance = $this->Balance->findOneBy(array('conditions' => array('service_id' => $call->service_id)));
                    $pourcentage = '.' . $service->pourcentage;
                    $gain = number_format((($cost / 1.196) * $pourcentage), 2);
                    if (!$balance) {
                        $balance = new stdClass();
                        $balance->service_id = $call->service_id;
                        $balance->gain = $gain;
                    } else {
                        $balance = current($balance);
                        $balance->gain = $balance->gain + $gain;
                    }
                    $this->Balance->save($balance);
                    $this->Session->setFlash('payement OK, Gain = ' . $balance->gain . ' Cout = ' . number_format($cost, 2) * 100);
                } else {
                    $call->payment = 0;
                    $this->Session->setFlash('c pa bon');
                }
            }

            $this->Call->save($call);
        }
    }
}

?>
