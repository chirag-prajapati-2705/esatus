<?php
class UsersController extends Controller {

    public $uses = array('User', 'Card', 'RibClient', 'Call', 'Service', 'Category', 'Subcategory', 'Rating', 'Profile', 'Preinscription');

    /**
     * Pages.
     */
    public function create() {

        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if ($user) {
            $this->redirect('users/index');
            die();
        }

        if ($this->request->data) {

            $rules = $this->User->rules;
            $data = $this->request->data;

            $birth_date = $data->year . '-' . $data->month . '-' . $data->day;
            unset($data->year);
            unset($data->month);
            unset($data->day);

            if ($data->cgu == 'on') {

                unset($data->cgu);

                if ($this->User->validate($rules, $data)) {

                    $data->profile_id = $this->Session->profile('id');
                    $data->last_name = strtoupper($data->last_name);
                    $data->first_name = ucfirst(strtolower($data->first_name));
                    $data->birth_date = $birth_date;
                    $data->date_inscription = date('Y-m-d H:i:s');

                    if ($this->User->save($data)) {

                        $this->redirect('users/index');
                        die();
                    } else {

                        $d['result'] = array(
                            'status' => 'super-error',
                            'message' => 'Une erreur est survenue.'
                        );
                    }
                }
            } else {

                $d['check'] = 'Veuillez lire et accepter les conditions générales d\'utilisation.';
            }
        }

        $year = range(date('Y') - 100, date('Y') - 18);
        $d['years'] = array_reverse($year);
        $d['months'] = array("01" => "janvier", "02" => "février", "03" => "mars", "04" => "avril", "05" => "mai", "06" => "juin", "07" => "juillet", "08" => "août", "09" => "septembre", "10" => "octobre", "11" => "novembre", "12" => "décembre");
        $d['days'] = range(1, 31);

        $d['title_for_layout'] = 'Mon compte > Mes informations';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Mes informations',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    //added by andru
    public function verify_rib() {
        
        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            $this->redirect('users/create');
            die();
        }

        $this->loadModel('RibClient');
        $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if ($rib) {
            $rib = current($rib);
            //$this->redirect('users/index');
            //die();
        }

        if ($this->request->data) {

            $data = $this->request->data;

            if (!$rib)
                $rib = new stdClass();

            $rib->profile_id = $this->Session->profile('id');
            $rib->banque = $data->banque;
            $rib->iban = $data->iban;
            $rib->bic = $data->bic;
            $rib->prelevement = $data->prelevement;
            //$rib->periodicite = $data->periodicite;

            if ($this->RibClient->save($rib)) {
                $rib = current($this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));
                $this->Session->setFlash('Vos informations ont été enregistrées.', 'info');
                Mailer::ribInfo($rib);
            } else {
                $this->Session->setFlash('Une erreur est survenue. Verifiez vos informations');
            }
        }


        $d['rib'] = $rib;
        $d['years'] = range(date('Y'), date('Y') + 15);
        $d['months'] = array("01" => "janvier", "02" => "f&eacute;vrier", "03" => "mars", "04" => "avril", "05" => "mai", "06" => "juin", "07" => "juillet", "08" => "août", "09" => "septembre", "10" => "octobre", "11" => "novembre", "12" => "d&eacute;cembre");
        $d['days'] = array(5, 10, 15);

        $d['title_for_layout'] = 'Mon compte > Votre RIB';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Votre RIB',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function verify() {

        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            $this->redirect('users/create');
            die();
        }

        $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if ($card) {
            $this->redirect('users/index');
            die();
        }

        if ($this->request->data) {

            $data = $this->request->data;
            $porteur = str_replace(' ', '', $data->numero);
            $dateval = $data->month . substr($data->year, 2, 2);
            $cvv = $data->crypto;

            // if ($porteur != '0000' && $cvv != '000') {
            // URL préproduction
            $url = "https://ppps.paybox.com/PPPS.php";

            // Numéro de la question
            $this->loadModel('Issue');
            $issue = current($this->Issue->find(1));

            // Référence Paybox manuel en francais V4_84.pdf - page 43 
            $params = array(
                'VERSION' => '00104',
                'DATEQ' => date('dmYHis'),
                'TYPE' => '00056',
                'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                'SITE' => '1101352',
                'RANG' => '001',
                'CLE' => 'luguwPBf',
                'MONTANT' => '100', // 1.00 €
                'DEVISE' => '978',
                'REFERENCE' => 'B-' . $this->Session->profile('id'),
                'REFABONNE' => $this->Session->profile('email'),
                'PORTEUR' => $porteur,
                'DATEVAL' => $dateval,
                'CVV' => $cvv,
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

            if ((isset($response->codereponse) && $response->codereponse == '00000')) {

                $card = new stdClass();
                $card->profile_id = $this->Session->profile('id');
                $card->mark = $response->porteur;
                $card->expiry_date = $dateval;
                $card->cryptogram = $cvv;

                if ($this->Card->save($card)) {
                    $this->Session->setFlash('Vos informations ont été enregistrées.', 'info');
                } else {
                    $this->Session->setFlash('Une erreur est survenue.');
                }
            } else {
                $d['carte'] = 'non';
                switch ($response->codereponse) {
                    
                    case '00001':
                        $flash = 'Désolé la connexion au centre d’autorisation a échoué. Veuillez réessayer plus tard';
                        break;
                    case '00003':
                        $flash = 'Erreur Paybox.';
                        break;
                    case '00004':
                        $flash = 'Numéro de porteur ou cryptogramme visuel invalide.';
                        break;
                    case '00006':
                        $flash = 'Accès refusé ou site/rang/identifiant incorrect.';
                        break;
                    case '00008':
                        $flash = 'Date de fin de validité incorrecte.';
                        break;
                    case '00009':
                        $flash = 'Erreur de création d’un abonnement.';
                        break;
                    case '00010':
                        $flash = 'Devise inconnue.';
                        break;
                    case '00011':
                        $flash = 'Montant incorrect.';
                        break;
                    case '00013':
                        $flash = 'Montant invalide';
                        break;
                    case '00015':
                        $flash = 'Paiement déjà effectué.';
                        break;
                    case '00016':
                        $flash = 'Abonné déjà existant (inscription nouvel abonné). Valeur ‘U’ de la variable PBX_RETOUR.';
                        break;
                    case '00021':
                        $flash = 'Carte non autorisée.';
                        break;
                    case '00029':
                        $flash = 'Carte non conforme. Code erreur renvoyé lors de la documentation de la variable « PBX_EMPREINTE ».';
                        break;
                    case '00030':
                        $flash = 'Temps d’attente > 15 mn par l’internaute/acheteur au niveau de la page de paiements.';
                        break;
                    case '00031':
                        $flash = 'Réservé';
                        break;
                    case '00031':
                        $flash = 'Réservé';
                        break;
                    case '00032':
                        $flash = 'Réservé';
                        break;
                    case '00033':
                        $flash = 'Code pays de l’adresse IP du navigateur de l’acheteur non autorisé.';
                        break;
                    case '00040':
                        $flash = 'Opération sans authentification 3DSecure, bloquée par le filtre.';
                        break;
                    case '00105':
                        $flash = 'contacter l’émetteur de carte.';
                        break;
                    case '00102':
                        $flash = 'contacter l’émetteur de carte.';
                        break;
                    case '00114':
                        $flash = 'Numéro de porteur visuel invalide';
                        break;
                    case '00161':
                        $flash = 'Dépasse la limite du montant de retrait';
                        break;
                    case '00104':
                        $flash = 'Erreur de numéro de carte';
                        break;
                    case '00104':
                        $flash = 'Erreur de numéro de carte';
                        break;
                    case '00157':
                        $flash = 'Transaction non permise à ce porteur';
                        break;
                    case '00151':
                        $flash = 'Provision insuffisante ou crédit dépassé';
                        break;
                    default:
                        $flash = 'Transaction non permise';
                        break;
                }
                Mailer::failedAutorisation($user->User->id, $flash);
                $this->Session->setFlash($flash);
            }

            // } else {
            //     $card = new stdClass();
            //     $card->profile_id = $this->Session->profile('id');
            //     $card->mark = $porteur;
            //     $card->expiry_date = $dateval;
            //     $card->cryptogram = $cvv;
            //     if ($this->Card->save($card)) {
            //         $this->redirect('users/index');
            //         die();
            //     } else {
            //         $this->Session->setFlash('Une erreur est survenue.');
            //     } 
            // }

            curl_close($curl);
        }

        $d['years'] = range(date('Y'), date('Y') + 15);
        $d['months'] = array("01" => "janvier", "02" => "février", "03" => "mars", "04" => "avril", "05" => "mai", "06" => "juin", "07" => "juillet", "08" => "août", "09" => "septembre", "10" => "octobre", "11" => "novembre", "12" => "décembre");

        $d['title_for_layout'] = 'Mon compte > Ma carte';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Ma carte',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function index() {

        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            // L'utilisateur n'existe pas
            // Redirection vers la page de création d'un utilisateur
            $this->redirect('users/create');
            die();
        }
        //echo "<iframe src=\"https://www.wtrackssl01.fr/tr/tracklead.php?idcpart=12869&email=".$this->Session->profile('email')."&idr=".$this->Session->profile('id')."\" width=\"0\" height=\"0\" frameborder=\"0\" scrolling=\"no\" ></iframe>";
        // modified by andru
        $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
        if (!$card) {
            $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
            if ($rib) {
                $d['rib'] = current($rib);
            }
        } else {
            $d['card'] = current($card);
        }

        $email = $this->Profile->findOneBy(array('conditions' => array('id' => $this->Session->profile('id'))));
        $user->User->email = $email->Profile->email;
        // if (!$card) {
        //     $this->redirect('users/verify');
        //     die();
        // }

        $d['title_for_layout'] = 'Espace client';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace client',
                'type' => 'current',
            )
        );

        $d['user'] = current($user);
        $this->layout = 'user';
        $this->set($d);
    }

    public function questions() {

        $this->loadModel('Question');

        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            $this->redirect('users/create');
            die();
        }

        $questions = $this->Question->findBy(array(
            'conditions' => 'profile_id = ' . $this->Session->profile('id'),
            'order' => 'id DESC'
        ));

        $d['title_for_layout'] = 'Espace client > Mes Questions';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace client',
                'type' => 'url',
                'url' => Router::url('users/index')
            ),
            array(
                'title' => 'Mes Questions',
                'type' => 'current'
            )
        );
        $d['user'] = current($user);
        $d['questions'] = current($questions);
        $this->layout = 'user';
        $this->set($d);
    }

    public function datas() {

        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            $this->redirect('users/create');
            die();
        }

        // $card = $this->Card->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
        // if (!$card) {
        //     $this->redirect('users/verify');
        //     die();
        // }

        if ($this->request->data) {
            $rules = $this->User->rules;
            $data = $this->request->data;

            $birth_date = $data->year . '-' . $data->month . '-' . $data->day;
            unset($data->year);
            unset($data->month);
            unset($data->day);

            if ($this->User->validate($rules, $data)) {

                $data->id = $user->User->id;
                $data->profile_id = $this->Session->profile('id');
                $data->last_name = strtoupper($data->last_name);
                $data->first_name = ucfirst(strtolower($data->first_name));
                $data->pseudo = strtoupper($data->pseudo);
                $data->birth_date = $birth_date;

                // Get all services from this user
                $services = $this->Service->findBy(array(
                    'conditions' => 'profile_id = ' . $this->Session->profile('id'),
                    'order' => 'id DESC'
                ));
                // Update image name for each services
                foreach ($services as $k => $v) {
                    $service = new stdClass;
                    $service->id = $v->Service->id;
                    $img_oldname = $v->Service->img; // old image name
                    $img_newname = strtolower($data->last_name . '-' . $data->first_name . '-' . $v->Service->id . '.jpg'); // new iamge name
                    if (rename(BIN . '/images/services/' . $img_oldname, BIN . '/images/services/' . $img_newname) === true) { // Rename the image file
                        $service->img = $img_newname; // Save new image name in the service
                        $this->Service->save($service); // Save the service in db  
                    };
                }

                if ($this->User->save($data)) {

                    $this->Session->setFlash('Vos informations ont été enregistrées.', 'info');
                    $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
                } else {
                    $this->Session->setFlash('Une erreur est survenue.');
                }
            } else {
                //echo 'not valited';die();
            }
        }

        $year = range(date('Y') - 100, date('Y') - 18);
        $d['years'] = array_reverse($year);
        $d['months'] = array("01" => "janvier", "02" => "février", "03" => "mars", "04" => "avril", "05" => "mai", "06" => "juin", "07" => "juillet", "08" => "août", "09" => "septembre", "10" => "octobre", "11" => "novembre", "12" => "décembre");
        $d['days'] = range(1, 31);

        $b = split('-', $user->User->birth_date);
        $d['y'] = $b[0];
        $d['m'] = $b[1];
        $d['d'] = $b[2];

        $d['title_for_layout'] = 'Espace client > Mes informations';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace client',
                'type' => 'url',
                'url' => Router::url('users/index')
            ),
            array(
                'title' => 'Mes informations',
                'type' => 'current'
            )
        );
        $d['user'] = current($user);

        $this->layout = 'user';
        $this->set($d);
    }

    public function calls() {

        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            $this->redirect('users/create');
            die();
        }

        $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        // if (!$card) {
        //     $this->redirect('users/verify');
        //     die();
        // }

        $d['title_for_layout'] = 'Espace client > Mes appels';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace client',
                'type' => 'url',
                'url' => Router::url('users/index')
            ),
            array(
                'title' => 'Mes appels',
                'type' => 'current'
            )
        );
        $d['user'] = current($user);
        $d['calls'] = $this->Call->findBy(array(
            'conditions' => 'user_id = ' . $user->User->id . ' AND (status = 310 OR status = 330 OR status = 350) AND session_id != \'\'',
            'order' => 'id DESC'
        ));
        foreach ($d['calls'] as $k => $v) {
            // L'expert
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Call->service_id))));
            $category = current($this->Category->findOneBy(array('conditions' => array('id' => $service->category_id))));
            $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $service->subcategory_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id))));
            $v->Call->url = Router::url('services/view/cat:' . $category->slug . '/subcat:' . $subcategory->slug . '/slug:' . clean($user->last_name . '-' . $user->first_name) . '/id:' . $service->id);
            $expert = ($service->username == '') ? $user->last_name . ' ' . $user->first_name : $service->username;
            $v->Call->expert = $expert;
            // La durée de la communication
            $v->Call->duration = elapsedTime($v->Call->start, $v->Call->end);
            // La date de la communication
            $date = substr($v->Call->start, 0, 10);
            $date = explode('-', $date);
            $v->Call->date = $date[2] . '/' . $date[1] . '/' . $date[0];
            // La note de l'appel
            $rating = $this->Rating->findOneBy(array('conditions' => array('session_id' => $v->Call->session_id)));
            $href = Router::url('ratings/rate/id:' . $v->Call->session_id);
            $v->Call->rating = ($rating) ? $rating->Rating->rate . '/10' : '<a class="label label-info" href="' . $href . '">Noter</a>';
        }

        $this->layout = 'user';
        $this->set($d);
    }

    //added by andru
    public function rib() {
        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            // L'utilisateur n'existe pas
            // Redirection vers la page de cr&eacute;ation d'un utilisateur
            $this->redirect('users/create');
            die();
        }

        $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$rib) {
            $this->redirect('users/verify_rib');
            die();
        }

        if ($this->request->data) {

            $this->loadModel('RibClient');
            $data = $this->request->data;
            //$profile = $this->Profile->findOneBy(array('conditions'=>array('id'=>$this->Session->profile('id'))));

            $rib = current($rib);

            $rib->banque = $data->banque;
            $rib->iban = $data->iban;
            $rib->bic = $data->bic;
            $rib->prelevement = $data->prelevement;
            //$rib->periodicite = $data->periodicite;
            //echo $this->RibClient->save($rib);die;

            if ($this->RibClient->save($rib)) {
                //$rib = $this->RibClient->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
                $this->Session->setFlash('Vos informations ont &eacute;t&eacute; enregistr&eacute;es.', 'info');
                
            } else {
                $this->Session->setFlash('Une erreur est survenue. Verifiez vos informations');
            }
        }

        $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        $d['title_for_layout'] = 'Espace client > Ma RIB';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace client',
                'type' => 'url',
                'url' => Router::url('users/index')
            ),
            array(
                'title' => 'Ma RIB',
                'type' => 'current'
            )
        );


        $d['rib'] = current($rib);
        //$d['years'] = range(date('Y'),date('Y')+15);
        //$d['y'] = substr($d['card']->expiry_date,2,2);
        //$d['months'] = array("01"=>"janvier", "02"=>"f&eacute;vrier", "03"=>"mars", "04"=>"avril", "05"=>"mai", "06"=>"juin", "07"=>"juillet", "08"=>"août", "09"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"d&eacute;cembre");
        $d['days'] = array(5, 10, 15);
        //$d['m'] = substr($d['rib']->expiry_date,0,2);
        $d['pr'] = current($rib)->prelevement;

        $this->layout = 'user';
        $this->set($d);
    }

    public function card() {

        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            // L'utilisateur n'existe pas
            // Redirection vers la page de création d'un utilisateur
            $this->redirect('users/create');
            die();
        }

        $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$card) {
            $this->redirect('users/verify');
            die();
        }

        if ($this->request->data) {

            $data = $this->request->data;
            $profile = $this->Profile->findOneBy(array('conditions' => array('id' => $this->Session->profile('id'))));

            $porteur = str_replace(' ', '', $data->numero);
            $dateval = $data->month . substr($data->year, 2, 2);
            $cvv = $data->crypto;

            // if ($porteur != '0000' && $cvv != '000') {
            // URL préproduction
            $url = "https://ppps.paybox.com/PPPS.php";

            // Numéro de la question
            $this->loadModel('Issue');
            $issue = current($this->Issue->find(1));

            // Référence Paybox manuel en francais V4_84.pdf - page 43 
            $params = array(
                'VERSION' => '00104',
                'DATEQ' => date('dmYHis'),
                'TYPE' => '00057',
                'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                'SITE' => '1101352',
                'RANG' => '001',
                'CLE' => 'luguwPBf',
                'MONTANT' => '100', // 1.00 €
                'DEVISE' => '978',
                'REFERENCE' => 'B-' . $this->Session->profile('id'),
                'REFABONNE' => $this->Session->profile('email'),
                'PORTEUR' => $porteur,
                'DATEVAL' => $dateval,
                'CVV' => $cvv,
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
            echo 'code :' . $response->codereponse;
            echo ' ' . $porteur;
            if (isset($response->codereponse) && $response->codereponse == '00000') {

                $id = $card->Card->id;

                $card = new stdClass();
                $card->id = $id;
                $card->profile_id = $this->Session->profile('id');
                $card->mark = $response->porteur;
                $card->expiry_date = $dateval;
                $card->cryptogram = $cvv;

                if ($this->Card->save($card)) {

                    $this->Session->setFlash('Votre nouvelle carte a été enregistré.', 'info');
                    $this->redirect('users/card');
                    die();
                } else {
                    $this->Session->setFlash('Une erreur est survenue.');
                }
            } else {
                $this->Session->setFlash('Les informations de votre nouvelle carte sont invalides.');
            }

            curl_close($curl);

            // } else {
            //     $id = $card->Card->id;
            //     $card = new stdClass();
            //     $card->id = $id;
            //     $card->profile_id = $this->Session->profile('id');
            //     $card->mark = $porteur;
            //     $card->expiry_date = $dateval;
            //     $card->cryptogram = $cvv;
            //     if ($this->Card->save($card)) {
            //         $this->redirect('users/card');
            //         die();
            //     } else {
            //         $this->Session->setFlash('Une erreur est survenue.');
            //     } 
            // }
        }

        $d['title_for_layout'] = 'Espace client > Ma carte bancaire';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace client',
                'type' => 'url',
                'url' => Router::url('users/index')
            ),
            array(
                'title' => 'Ma carte bancaire',
                'type' => 'current'
            )
        );


        $d['card'] = current($card);
        $d['years'] = range(date('Y'), date('Y') + 15);
        $d['y'] = substr($d['card']->expiry_date, 2, 2);
        $d['months'] = array("01" => "janvier", "02" => "février", "03" => "mars", "04" => "avril", "05" => "mai", "06" => "juin", "07" => "juillet", "08" => "août", "09" => "septembre", "10" => "octobre", "11" => "novembre", "12" => "décembre");
        $d['m'] = substr($d['card']->expiry_date, 0, 2);

        $this->layout = 'user';
        $this->set($d);
    }

    /**
     * Request Action
     */
    public function test() {
        $return = true;
        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
        if (!$user) {
            $return = false;
        }
        $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
        if (!$card) {
            //added by andru
            $this->loadModel('RibClient');
            $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
            if (!$rib) {
                $return = false;
            }
        }
        return $return;
    }

    // check if user existe
    public function check($cv, $email, $nom, $prenom, $naissance) {

        $user = $this->Profile->findOneBy(array('conditions' => array('email' => $email)));
        $checkPreinscription = $this->Preinscription->findOneBy(array('conditions' => array('email' => $email)));

        if ((!$user) && (!$checkPreinscription)) {
            echo 'Not existe';
            $preinscription = new stdClass();
            $preinscription->cv = $cv;
            $preinscription->nom = $nom;
            $preinscription->prenom = $prenom;
            $preinscription->email = $email;
            $preinscription->date_naissance = $naissance;

            $this->Preinscription->save($preinscription);
            Mailer::preinscription($email);
        } else {
            echo 'existe';
        }

        $d['title_for_layout'] = '';
        $d['description_for_layout'] = "";
        $this->layout = 'none';
        $this->set($d);
    }
    
    public function erase() {
        $card = current($this->Card->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));
        
        if ($card) {
            $url = "https://ppps.paybox.com/PPPS.php";
            $this->loadModel('Issue');
            $issue = current($this->Issue->find(1));

            // Référence Paybox manuel en francais V4_84.pdf - page 43 
           
            $params = array(
                'VERSION' => '00104',
                'DATEQ' => date('dmYHis'),
                'TYPE' => '00058',
                'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                'SITE' => '1101352',
                'RANG' => '001',
                'CLE' => 'luguwPBf',
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
            //echo $this->Session->profile('email');echo '<br>';
            //echo $response->codereponse;die();
            if ($response->codereponse == '00000') {
                $this->Card->delete($card->id);
                $this->redirect('users/index');
                die();
            } else {
                $this->redirect('users/card');
                die();
            }
        }
    }

    public function eraseRib() {
    $RibClient = current($this->RibClient->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id')))));
         if ($RibClient) {
             
             $this->RibClient->delete($RibClient->id);
             $this->redirect('users/index');
             die();
         }
    }
    
    public function thanks() {
        if (!$this->Session->isLogged()) {
            $this->redirect('pages/index');
            die();
        }

        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            // L'utilisateur n'existe pas
            // Redirection vers la page de création d'un utilisateur
            $this->redirect('users/create');
            die();
        }
        //echo "<iframe src=\"https://www.wtrackssl01.fr/tr/tracklead.php?idcpart=12869&email=".$this->Session->profile('email')."&idr=".$this->Session->profile('id')."\" width=\"0\" height=\"0\" frameborder=\"0\" scrolling=\"no\" ></iframe>";
        

        $email = $this->Profile->findOneBy(array('conditions' => array('id' => $this->Session->profile('id'))));
        $user->User->email = $email->Profile->email;

        $d['title_for_layout'] = 'Creation de compte avec succès';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace client',
                'type' => 'current',
            )
        );

        $d['user'] = current($user);
        $this->layout = 'user';
        $this->set($d);
    }

}

?>