<?php

require_once('/var/www/vhosts/ns428114.ip-37-187-149.eu/httpdocs/esatus_asterisk/controller/AvailabilitiesController.php');

class CallsController extends Controller {

    public $uses = array('Call', 'Profile', 'User', 'Service', 'Category', 'Subcategory', 'Issue', 'Card', 'Balance', 'Availability', 'Calldetail', 'Callprogress', 'Preautorisation');

    public function call($slug, $id) {
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

        //modified by andru [main availability]
        $available = 0;

        $net_available = $this->MonStatusAvance($service->id);

        if($net_available == 3)
        {
            $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $service->id))));
            $today = strtolower(date('l'));
            $params = explode(';', $availabilities->$today);
            $now = date('G');
            $available = false;
            foreach ($params as $val) {
                $hour = explode(':', $val);
                if ($now >= $hour[0] && $now < $hour[0] + 1) {
                    $available = 1;
                    break;
                }
            }
        }
        else
        {
            $available = $net_available;
        }

        if ($available == 0) {
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


            //added by andru [availability]
            $available = 0;

            $net_available = $this->MonStatusAvance($v->Service->id);

            if($net_available == 3)
            {
                $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $v->Service->id))));
                $today = strtolower(date('l'));
                $params = explode(';', $availabilities->$today);
                $now = date('G');

                foreach ($params as $val) {
                    $hour = explode(':', $val);
                    if ($now >= $hour[0] && $now < $hour[0] + 1) {
                        $available = 1;
                        break;
                    }
                }
            }
            else
            {
                $available = $net_available;
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

            //disabled
            //redisabled by andru
            // if (!$card) {
            // // Pas de carte, redirection vers l'admin client page "ma carte"
            //     $this->Session->setFlash('Pour contacter nos experts, merci de renseigner une carte bancaire.');
            //     $this->redirect('espace-client/ma-carte-bancaire');
            //     die();
            // }

            $me = current($this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));

            $allow_rib_call = false;
            if ($card) {
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
                            if (($preautorisation) && (date("Y-m-d H:i:s", strtotime("$preautorisation->date +7 day")) > date('Y-m-d H:i:s'))) {
                                $response->codereponse = '00000';
                            } else {
                                // Test de crédit sur carte bancaire client via paybox "autorisation"
                                // Référence Paybox manuel en francais V4_84.pdf - page 43 
                                $params = array(
                                    'VERSION' => '00104',
                                    'DATEQ' => date('dmYHis'),
                                    'TYPE' => '00051',
                                    'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                                    'SITE' => '1101352',
                                    'RANG' => '001',
                                    'CLE' => 'luguwPBf',
                                    'MONTANT' => '8000', // 80.00 €
                                    'DEVISE' => '978',
                                    'REFERENCE' => $service->profile_id . '-' . $this->Session->profile('id'),
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

                                if ($response->codereponse == '00000') {
                                    $preAutorisationData->profile_id = $this->Session->profile('id');
                                    $preAutorisationData->date = date('Y-m-d H:i:s');
                                    $preAutorisationData->numtrans = $response->numtrans;
                                    $preAutorisationData->numappel = $response->numappel;
                                    $this->Preautorisation->save($preAutorisationData);
                                }
                            }
                        }
                    } else {
                        $this->Session->setFlash('Votre num�ro de t�l�phone semble incorrect, merci de v�rifier.');
                    }
                }
            } else {
                //no card was found
                //check if activated user
                $this->loadModel('RibClient');

                $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
                if ($rib) {
                    $rib = current($rib);
                    if ($rib->status == 1) {
                        $allow_rib_call = true;

                        //preautorisation
                        $this->loadModel('Preautorisation');
                        $preAutorisationData = new stdClass();
                        $preAutorisationData->profile_id = $this->Session->profile('id');
                        $preAutorisationData->date = date('Y-m-d H:i:s');
                        //$preAutorisationData->numtrans = 0;
                        //$preAutorisationData->numappel = 0;
                        $this->Preautorisation->save($preAutorisationData);
                    } else {
                        if ($rib->status == 0) {
                            $this->Session->setFlash('Votre RIB est en attente de validation. Veuillez patienter');
                        } else {
                            $this->Session->setFlash('Votre compte a été désactivé. Verifiez vos information');
                        }
                        $this->redirect('users/verify_rib');
                        die;
                    }
                } else {
                    $this->Session->setFlash('Veuillez creer votre RIB');
                    $this->redirect('users/rib');
                    die;
                }

                if ($this->request->data) {

                    $rules = $this->User->check;
                    $data = $this->request->data;

                    // Vérification du numéro de téléphone choisi par l'appelant
                    if ($this->User->validate($rules, $data)) {
                        // Format du numéro de téléphone OK
                        $phone = $data->phone;

                        // Numéro de la question
                        $issue = current($this->Issue->find(1));
                    } else {
                        $this->Session->setFlash('Votre num�ro de t�l�phone semble incorrect, merci de v�rifier.');
                    }
                }
            }


            ////created by andru
            if ($this->request->data) {
                if (isset($response->codereponse) && $response->codereponse == '00000' || $allow_rib_call) {

                    // Réponse de Paybox : OK
                    // Lancement de l'appel

                    $callPriceLimit = 70; // Appel limité à 50€
                    $numfrom = '33' . substr($phone, 1, 10); //
                    $numto = '33' . substr($service->phone, 1, 10);

                    $numfrom = $phone;
                    $numto = $service->phone;

                    $duration = floor((($callPriceLimit - $service->cost_per_call) / $service->cost_per_minute) * 60);
                    if ($duration > 3600) {
                        $duration = 3600;
                    }

                    $result = 200;
                    $d['result'] = $result;

                    shell_exec("php /etc/asterisk/Originate.php " . $duration . " " . $mailexpert->email . " " . $numfrom . " " . $numto . " " . session_id() . " " . $me->id . " " . $service->id);




                    $d['the_session'] = session_id();
                    $d['service_id'] = $service->id;
                    $d['me_id'] = $me->id;

                    session_regenerate_id();
                    $_SESSION['id'] = session_id();
                } else {

                    $this->redirect('users/card');
                    die();
                }
            }

            $d['me'] = $me;
        }

        $this->set($d);
    }

    public function flashmessage() {
        $flash = $this->Session->flash();
        if ($flash == "")
            echo "ABORT";
        else
            echo $flash;
        die;
    }

    public function check_ring() {
        $oldsession = $_POST['oldsession'];
        $serviceid = $_POST['serviceid'];
        $meid = $_POST['meid'];



        $cstate = "RINGING";


        $callp = current($this->Callprogress->findCallprogress(array('conditions' => array('SESID' => $oldsession))));


        if ($callp->Callprogress->EXPERT == "OKOK") {
            $cstate = "ANSWERED";
        }

        echo $cstate;
        die;
    }

    public function connect() {
        $conf = Conf::database();
        try {
            $pdo = new PDO('mysql:host=' . $conf['host'] . ';dbname=' . $conf['database'] . ';', $conf['login'], $conf['password']);
            $this->db = $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function MonStatusAvance($id){
        $this->connect();

        $q = 'SELECT flag, date_update FROM availabilities WHERE service_id =  "' . $id . '"  ';
        $req = $this->db->query($q);
        $req->setFetchMode(PDO::FETCH_OBJ);
        while ($res = $req->fetch()) {
            //$resultat = $res->flag;
            $now = date('Y-m-d')."";
            if($res->date_update == $now)
                $resultat = $res->flag;
            else
                $resultat = 3;
        }
        return $resultat;
    }

    public function check_launch() {

        $oldsession = $_POST['oldsession'];
        $serviceid = $_POST['serviceid'];
        $meid = $_POST['meid'];

        $cstate = "EMPTY";


        $callp = current($this->Callprogress->findCallprogress(array('conditions' => array('SESID' => $oldsession))));
        if (!$callp) {
            
        } else {
            $cstate = $callp->Callprogress->EXPERT;
        }



        if ($cstate == "OKOK")
            $cstate = "RINGING";

        echo $cstate;

        die;
    }

    public function check_call() {
        $oldsession = $_POST['oldsession'];
        $serviceid = $_POST['serviceid'];
        $meid = $_POST['meid'];

        $calld = current($this->Calldetail->findCalldetail(array('conditions' => array('actionid' => $oldsession))));

        if ($calld) {
            //$this->server_response($oldsession, $meid, $serviceid, $calld->Calldetail->disposition, $calld->Calldetail->disposition2, $calld->Calldetail->billsec, $calld->Calldetail->answer, $calld->Calldetail->end, $calld->Calldetail->dst);
            echo "CALLENDED";
            die;
        } else {
            echo "INCOMMUNICATION";
            die;
        }
    }

    public function check_end()
    {
        $oldsession = $_POST['oldsession'];
        $serviceid = $_POST['serviceid'];
        $meid = $_POST['meid'];

        session_start();
        session_write_close();

        for ($i=0; $i < 99999999; $i++)
        { 
            $calld = current($this->Calldetail->findCalldetail(array('conditions' => array('actionid' => $oldsession))));
            sleep(10);
            if ($calld) {
                $this->server_response($oldsession, $meid, $serviceid, $calld->Calldetail->disposition, $calld->Calldetail->disposition2, $calld->Calldetail->billsec, $calld->Calldetail->answer, $calld->Calldetail->end, $calld->Calldetail->dst);
                break;
            }
        }
    }

    /**
     * Pages.
     */
    public function server_response($oldsession, $userid, $serviceid, $disposition, $disposition2, $billsec, $callstart, $callend, $dst) {

        $this->loadModel('Affecter');
        $this->loadModel('Campagne');
        $this->loadModel('Users_promo');
        $this->loadModel('Preautorisation');

        // Si la réponse est correctement formatée
        $info = new stdClass();
        $info->promo = '';
        $call = new stdClass ();

        $call->call_id = $oldsession;
        $call->session_id = $oldsession;
        $call->user_id = $userid;
        $call->service_id = $serviceid;
        $call->status = $disposition;
        $call->cost = 0;
        $call->payment = 0;
        $call->start = $callstart;
        $call->end = $callend;

        if ($callstart) {
            $call->start = $callstart;
        } else {
            $call->start = date('Y-m-d') . ' 00:00:00';
        }
        if ($callend) {
            $call->end = $callend;
        } else {
            $call->end = date('Y-m-d') . ' 00:00:00';
        }


        // Appel refusé
        if (($dst == '#') && ($disposition == "NO ANSWER")) {

            $user = current($this->User->findOneBy(array('conditions' => array('id' => $userid))));
            $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $user->profile_id))));
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $serviceid))));
            $category = current($this->Category->findOneBy(array('conditions' => array('id' => $service->category_id))));
            $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $service->subcategory_id))));

            $mail = new stdClass();
            $mail->email = $profile->email;
            $mail->name = $user->first_name;
            $mail->service = $service->title;
            $mail->link = Router::url('categories/subcategory/cat:' . $category->slug . '/subcat:' . $subcategory->slug);

            // Envoi du mail
            Mailer::failed($mail);
        }

        // Appel réussi
        if ($dst == '#' && $disposition == "ANSWERED") {
            $call->status = 310;
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $serviceid))));
            $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $service->profile_id))));
            $service->email = $profile->email;

            // On détermine le coût de l'appel
            $c = $billsec;

            // On recherche l'utilisateur
            $user = current($this->User->findOneBy(array('conditions' => array('id' => $userid))));
            $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $user->profile_id))));
            $user->email = $profile->email;

            // On recherche si le service est inscrit dans une promo
            // On recherche si le service est inscrit dans une promo
            $promo = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $service->id)));

            // On recherche si l'utilisateur a utiliser une promo
            $userPromo = $this->Users_promo->findOneBy(array('conditions' => array('id_profile' => $profile->id)));

            // Si le service est en promotion et l'utilisateur n'a pas consommé
            if (!$userPromo) 
            {
                $cost = (($c / 60) * $service->cost_per_minute) + $service->cost_per_call - 25;

                $users_promo->id_profile = $profile->id;
                $users_promo->id_service = $service->id;
                $users_promo->id_call = $oldsession;
                $this->Users_promo->save($users_promo);
                
                $info->promo = 'Vous avez beneficiez d\'une promotion jusqu\'à 25€ offert sur votre premier consultation.';
            } else {
                if ($promo) {
                    $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => 2)));
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
                        default:
                            $cost = (($c / 60) * $service->cost_per_minute) + $service->cost_per_call;
                            break;
                    }
                    $info->amount = number_format($cost, 2) . ' €';
                    
                } else {
                    $cost = (($c / 60) * $service->cost_per_minute) + $service->cost_per_call;
                }
            }
            

            if ($cost < 0) {
                $cost = 0;
            }

            $call->cost = number_format($cost, 2);

            // Envoi du mail (Client/Expert)

            
            $date = $callstart;
            $date = explode('-', $date);
            $info->date = $date[2] . '/' . $date[1] . '/' . $date[0];
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
            //$card = current($this->Card->findOneBy(array('conditions' => array('profile_id' => $user->profile_id))));
            $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $user->profile_id)));
            if ($card) {
                $card = current($card);
            }

            // Autorisation
            //$preautorisation = current($this->Preautorisation->findOneBy(array('conditions' => array('profile_id' => $user->profile_id))));
            $preautorisation = current($this->Preautorisation->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));

            //added by andru for client using RIB
            if ($card) {
                // Référence Paybox manuel en francais V4_84.pdf - page 43 
                $params = array(
                    'VERSION' => '00104',
                    'DATEQ' => date('dmYHis'),
                    'TYPE' => '00052', // ?? 52
                    'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                    'SITE' => '1101352',
                    'RANG' => '001',
                    'CLE' => 'luguwPBf',
                    'MONTANT' => number_format($cost, 2) * 100,
                    'DEVISE' => '978',
                    'REFERENCE' => $service->profile_id . '-' . $user->profile_id,
                    'REFABONNE' => $profile->email,
                    'PORTEUR' => $card->mark,
                    'DATEVAL' => $card->expiry_date,
                    'CVV' => $card->cryptogram,
                    'ACTIVITE' => '027',
                    'NUMTRANS' => $preautorisation->numtrans,
                    'NUMAPPEL' => $preautorisation->numappel
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
                    
                    $this->Preautorisation->delete($preautorisation->id);
                    $this->Session->setFlash('OK');
                    $this->Balance->save($balance);
                } else {
                    $call->payment = 0;
                    $this->Session->setFlash('PAS OK');
                }
            } else {
                $this->loadModel('RibClient');
                $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $user->profile_id)));
                if ($rib) {
                    $rib = current($rib);

                    $call->status = 310;
                    $call->rib = 1;
                } else {
                    $this->redirect("users/card");
                }
            }
        }

        $this->Call->save($call);
    }

}

?>
