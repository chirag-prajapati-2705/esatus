<?php



class PartnerController extends Controller {

    public $uses = array('User', 'Card', 'RibClient', 'Call', 'Service', 'Category', 'Subcategory', 'Rating', 'Profile', 'Preinscription');
    // Connexion / Déconnexion
    public function login() {

        $this->loadModel('Partner');

        $Partner = $this->Partner->findAll();
        
        if ($this->request->data) {
            
            $rules = array(
                'email' => array(
                    'rule' => 'email',
                    'message' => 'Votre email est invalide.'
                ),
                'password' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Veuillez préciser votre mot de passe.'
                )
            );
            $data = $this->request->data;

            if ($this->Partner->validate($rules, $data)) {
                
                $email = $data->email;
                $password = sha1($data->password);
                $Partner = $this->Partner->findOneBy(array('conditions' => array('email' => $email, 'password' => $password)));
                
                if ($Partner) {
                    $this->Session->write('partner', current($Partner));
                } else {
                    
                    $Partner = $this->Partner->findOneBy(array('conditions' => array('email' => $email)));
                    
                    if ($Partner) {
                        $d['result'] = array(
                            'status' => 'super-error',
                            'message' => 'Mauvaise combinaison entre votre email et votre mot de passe.'
                        );
                    } else {
                        $d['result'] = array(
                            'status' => 'super-error',
                            'message' => 'Aucun compte n\'est lié à cette adresse mail.'
                        );
                    }
                }
            }
        }

        if (isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }

        $d['title_for_layout'] = 'Partenaire > Connexion';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            ),
            array(
                'title' => 'Connexion',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function logout() {
        
        unset($_SESSION['partner']);
        $this->redirect('partner/login');
        die();
    }

    // Dashboard
    public function index() {
        if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        $this->layout = 'partner';
        
        $d['title_for_layout'] = 'Partenaire > Tableau de bord';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            ),
            array(
                'title' => 'Connexion',
                'type' => 'current',
            )
        );
        
        $this->set($d);
    }
    
    // Dashboard
    public function users() {
         
        if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        session_start();
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Service');
        $this->loadModel('Card');
        $this->loadModel('Source');
        $this->loadModel('Question');
        $d['Profiles'] = array_reverse($this->Profile->findBy(array('conditions' => array('affiliation' => $_SESSION['partner']->id))));
        //krsort($d['Profiles']);
        
        foreach ($d['Profiles'] as $k => $v) {
            
            // On récupère l'email
            $User = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Profile->id))));
            
            $v->Profile->slug = $User->pseudo;
            $v->Profile->email = $v->Profile->email;
            $v->Profile->date_inscription = $User->date_inscription;
            $v->Profile->idProfile = $v->Profile->id;
            $v->Profile->validated = $v->Profile->validated;
            // On récupère les infos liées aux appels
            $conditions = 'user_id = ' . $v->Profile->id . ' AND (status = 310 OR status = 330 OR status = 350)';
            $calls = $this->Call->findBy(array(
                'conditions' => $conditions,
                'order' => 'id DESC'
            ));

            $amount = 0;
            foreach ($calls as $sk => $sv) {
                $amount += $sv->Call->cost;
            }
            $v->Profile->count = (!$calls) ? 0 : count($calls);
            $v->Profile->amount = number_format($amount, 2) . ' €';

            // On récupère les services
            $services = $this->Service->findBy(array('conditions' => array('profile_id' => $v->Profile->id)));
            $v->Profile->service = ($services) ? 'Oui' : 'Non';

            $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $User->profile_id)));
            $v->Profile->color = ($card) ? '#34495e' : '#ff0000';
            
            // On récupère les questions
            $Question = current($this->Question->findOneBy(array('conditions' => array('profile_id' => $v->Profile->id))));
            $v->Profile->Question = $Question->question;
            
            // source
            $source = current($this->Source->findOneBy(array('conditions' => array('id_profile' => $v->Profile->id))));

            $v->Profile->source = $source->source;
            
        }
        
        $d['count'] = count($d['Profiles']);

        $d['title_for_layout'] = 'Partenaire > Clients';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            ),
            array(
                'title' => 'Clients',
                'type' => 'current',
            )
        );
        
        $this->layout = 'partner';
        $this->set($d);
    }
    
    // Client
    public function user($slug, $id) {
         if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Affectation');
        $this->loadModel('Service');

        if ($this->request->data) {
            $rules = $this->User->rules;
            $data = $this->request->data;

            $birth_date = $data->year . '-' . $data->month . '-' . $data->day;
            unset($data->year);
            unset($data->month);
            unset($data->day);
            $affec = $data->affecter;
            unset($data->affecter);

            if ($this->User->validate($rules, $data)) {

                $data->id = $id;
                $data->last_name = strtoupper($data->last_name);
                $data->first_name = ucfirst(strtolower($data->first_name));
                $data->pseudo = ucfirst(strtolower($data->pseudo));
                $data->birth_date = $birth_date;

                //
                // Mise à jour du nom des images des services de ce client
                //

                $user = $this->User->findOneBy(array('conditions' => array('id' => $id)));
                $profile_id = $user->User->profile_id;

                // Récupération des services du client
                $services = $this->Service->findBy(array(
                    'conditions' => 'profile_id = ' . $profile_id,
                    'order' => 'id DESC'
                ));

                // Mise à jour des noms des images des services avec le nouveau nom du client
                foreach ($services as $k => $v) {
                    $service = new stdClass;
                    $service->id = $v->Service->id;
                    $img_oldname = $v->Service->img; // ancien nom d'image
                    $img_newname = strtolower($data->last_name . '-' . $data->first_name . '-' . $v->Service->id . '.jpg'); // nouveau nom d'image
                    if (rename(BIN . '/images/services/' . $img_oldname, BIN . '/images/services/' . $img_newname) === true) { // Renommage du fichier image
                        $service->img = $img_newname; // Sauvegarde du nom de l'image dans le service
                        $this->Service->save($service); // Mise à jour du service en base
                    };
                }

                // Mise à jour des données client en base                
                if ($this->User->save($data)) {

                    $idAffectation = $this->Affectation->findOneBy(array('conditions' => array('client_id' => $data->id)));

                    if (($idAffectation->Affectation->id) != 'NULL') {
                        $Affectation->id = $idAffectation->Affectation->id;
                    }

                    $Affectation->client_id = $data->id;
                    $Affectation->expert_id = $affec;

                    if ($this->Affectation->save($Affectation)) {
                        $this->Session->setFlash('Vos informations ont été enregistrés.', 'info');
                        $this->redirect('admin/admins/user/slug:' . clean($data->last_name . ' ' . $data->first_name) . '/id:' . $id);
                        die();
                    } else {
                        $this->Session->setFlash('Une erreur est survenue.');
                    }
                } else {
                    $this->Session->setFlash('Une erreur est survenue.');
                }
            }
        }

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/users');
            die();
        }

        // Informations sur l'utilisateur
        $d['user'] = $this->User->find($id);

        if ($d['user']) {
            $d['user'] = current($d['user']);
        }

        $year = range(date('Y') - 100, date('Y') - 18);
        $d['years'] = array_reverse($year);
        $d['months'] = array("01" => "janvier", "02" => "février", "03" => "mars", "04" => "avril", "05" => "mai", "06" => "juin", "07" => "juillet", "08" => "août", "09" => "septembre", "10" => "octobre", "11" => "novembre", "12" => "décembre");
        $d['days'] = range(1, 31);

        $b = split('-', $d['user']->birth_date);
        $d['y'] = $b[0];
        $d['m'] = $b[1];
        $d['d'] = $b[2];


        // Infos annexes
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Rating');

        $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $d['user']->profile_id))));
        $d['user']->email = $profile->email;

        $conditions = 'user_id = ' . $d['user']->id . ' AND (status = 310 OR status = 330 OR status = 350)';
        $calls = $this->Call->findBy(array(
            'conditions' => $conditions,
            'order' => 'id DESC'
        ));

        $d['calls'] = $calls;

        foreach ($d['calls'] as $k => $v) {

            // On récupère le client
            $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Call->user_id))));
            $v->Call->user = $user->pseudo;

            // On récupère le service
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Call->service_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id))));
            $username = ($service->username == '') ? $user->pseudo : $service->username;

            $v->Call->slugUsername = Router::url('admin/admins/service/slug:' . clean($username) . '/id:' . $v->Call->service_id);
            $v->Call->service = $service->title . '(<a href="' . $v->Call->slugUsername . '">' . $username . '</a>)';
            // Pour construire URL client
            $v->Call->slug = clean($v->Call->user);


            // La durée de la communication
            $v->Call->duration = elapsedTime($v->Call->start, $v->Call->end);

            // La date de la communication
            $date = substr($v->Call->start, 0, 10);
            $heure = substr($v->Call->start, 11, 8);
            $date = explode('-', $date);
            $v->Call->date = $date[2] . '/' . $date[1] . '/' . $date[0] . ' ' . $heure;

            $reel = $v->Call->cost - (($v->Call->cost / 1.2) * .55);

            // La commission sur l'appel
            $v->Call->commission = number_format($reel, 2) . ' €';

            // Statut de l'appel
            $status = $v->Call->status;
            $v->Call->status = ($status == 310 || $status == 330 || $status == 350) ? 'Appel reçu' : 'Appel non reçu';

            // Etat du paiement
            if ($status == 310 || $status == 330 || $status == 350) {
                $v->Call->payment = '<span class="label label-' . (($v->Call->payment == 1) ? 'success' : 'warning') . '">' . (($v->Call->payment == 1) ? 'payé' : 'impayé') . '</span>';
            } else {
                $v->Call->payment = '<span class="label label-success">payé</span>';
            }
        }

        $amount = 0;
        $unpaids = 0;
        foreach ($calls as $k => $v) {
            $amount += $v->Call->cost;
            $unpaids += ($v->Call->payment == 1) ? 0 : 1;
        }
        $d['user']->count = (!$calls) ? 0 : count($calls);
        $d['user']->amount = number_format($amount, 2) . ' €';

        $ratings = $this->Call->findBy(array('conditions' => array('profile_id' => $d['user']->profile_id)));
        $d['user']->comments = (!$ratings) ? 0 : count($ratings);

        if ($d['user']->count > 0) {
            $d['user']->lastCall = substr($calls[count($calls) - 1]->Call->end, 0, 10);
        }

        $d['user']->unpaids = $unpaids;

        // Services
        $this->loadModel('Service');

        $d['services'] = $this->Service->findBy(array('conditions' => array('profile_id' => $d['user']->profile_id)));

        $d['slug'] = $slug;
        $d['id'] = $id;
        $d['title_for_layout'] = 'Partenaire > Clients > ' . $d['user']->first_name . ' ' . $d['user']->last_name;
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Clients',
                'type' => 'url',
                'url' => Router::url('admin/admins/users')
            ),
            array(
                'title' => $d['user']->first_name . ' ' . $d['user']->last_name,
                'type' => 'current',
            )
        );

        $d['AllServices'] = array_reverse($this->Service->findBy(array('conditions' => array('validated' => '1'))));
        foreach ($d['AllServices'] as $k => $v) {
            // On récupère le nom
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            // On récupère le nom
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $v->Service->user = $user->last_name . ' ' . $user->first_name;
        }

        $this->set($d);
    }
    
    public function adduser() {
         if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        $this->layout = 'partner';
        
        if ($this->request->data) {
            
            $this->loadModel('User');
            $this->loadModel('Source');
            $this->loadModel('Profile');

            $rules = array_merge($this->Profile->rules, $this->User->rules);

            $data = $this->request->data;

            if ($this->Profile->validate($rules, $data)) {
                
                // Les données soumises respectent les règles du formulaire
                // Création du nouveau profil
                $std = new stdClass();
                $std->email = $data->email;
                $std->password = $data->password;
                $std->validated = 0;
                $std->affiliation = 1;
                
               
                $email = $data->email;
                $password = $data->password;
                $password_crypted = sha1($data->password);
                $data->birth_date = $data->jj . '-' . $data->mm . '-' . $data->aa;

                // Vérification de l'existence du profil en base (email doit être unique)
                $profile = $this->Profile->findOneBy(array('conditions' => array('email' => $email)));


                //recuperqtion de l envoyeur du lien modifier par vkaing
                $sender = $data->sender_link;
                //fin modif

                if (!$profile) {
                    
                    // Le profil n'existe pas encore
                    $phone = $this->User->findOneBy(array('conditions' => array('phone' => $data->phone)));

                    if (!$phone) {
                        
                        $std->password = $password_crypted; // mot de passe crypté

                        if ($this->Profile->save($std)) { // Enregistrement du profil
                            // Profil sauvegardé en base
                            // Mise en session du profil
                            $data->id = $this->Profile->id;
                            $this->Session->write('profile', $data);

                            // Converti la date entrée par l'utilisteur en date mySql
                            //debut recuperation valeur formulaire modifier par vkaing
                            $jour = $data->jj;
                            $mois = $data->mm;
                            $annee = $data->aa;
                            $the_birth_date = "$jour-$mois-$annee";
                            $timestamp = strtotime($the_birth_date);
                            //fin modifier

                            $timestamp = strtotime($data->birth_date);
                            $birth_date = date("Y-m-d H:i:s", $timestamp);

                            // Création d'un nouvel utilisateur
                            $stdUser = new stdClass();
                            $stdUser->profile_id = $this->Profile->id;
                            $stdUser->first_name = ' ';
                            $stdUser->last_name = ' ';
                            $stdUser->phone = $data->phone;
                            $stdUser->pseudo = $data->pseudo;
                            $stdUser->birth_date = $birth_date;
                            $stdUser->date_inscription = date('Y-m-d H:i:s');
                            $this->User->save($stdUser);

                            //Source visite
                            $stdSource = new stdClass();
                            $stdSource->id_profile = $this->Profile->id;
                            $stdSource->source = 'Partenaire';
                            $this->Source->save($stdSource);
                            unset($_SESSION['source']);
                            
                            $this->redirect('partner/users');
                            //envoie sms en utilsant netmessage
                            $sm = new sendsms();
                            //$sm -> send_sms_p2p($data->first_name,$data->last_name,$data->pseudo, $data->phone);
                            $sm->send_sms_p2p($data->pseudo, $data->phone);
                            $sm->send_sms_pub($data->phone);

                            //insertion parainage mail user + mail sender
                            if ($sender == "") {
                                //nothing to do, simple inscription
                            } else {
                                $this->User->parainage($email, $sender);
                            }
                            ///////////////////////fin envoie message et mis a jour bade de donnee 
                            // Envoi de l'email de création de compte au client
                            $std->password = $password;
                            $std->id  = $this->Profile->id;
                            Mailer::account($std);
                            Mailer::infowebmaster($std, $stdUser);
                            
                            
                            
                        } else {
                            $data->password = $password;
                            $this->Session->setFlash('Une erreur est survenue.');
                        }
                    } else {
                        // Le numero de téléphone existe déjà
                        $this->Session->setFlash('Un compte est déjà lié à ce numero de téléphone.');
                    }
                } else {
                    // Le profil existe déjà
                    $this->Session->setFlash('Un compte est déjà lié à cette adresse mail.');
                }
            }
        }
        
        $d['title_for_layout'] = 'Partnaire > Clients';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partnaire',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Clients',
                'type' => 'url',
                'url' => Router::url('admin/admins/users')
            )
        );
        
        $this->set($d);
       
    }
    
    public function services() {
         if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Service');
        $this->layout = 'partner';
        $d['services'] = array_reverse($this->Service->findBy(array('conditions' => array('affiliation' => $_SESSION['partner']->id))));
        
        foreach ($d['services'] as $k => $v) {

            // On récupère le nom et date d'inscription
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $v->Service->user = $user->last_name . ' ' . $user->first_name;
            $v->Service->date = $user->date_inscription;

            $username = ($v->Service->username == '') ? $user->last_name . '-' . $user->first_name : $v->Service->username;
            $v->Service->slug = clean($username);

            // On récupère l'email
            $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $v->Service->profile_id))));
            $v->Service->email = $profile->email;

            // On récupère les infos liées aux appels
            $conditions = 'service_id = ' . $v->Service->id . ' AND (status = 310 OR status = 330 OR status = 350)';
            $calls = $this->Call->findBy(array(
                'conditions' => $conditions,
                'order' => 'id DESC'
            ));
            $amount = 0;
            foreach ($calls as $sk => $sv) {
                $amount += $sv->Call->cost;
            }
            $v->Service->count = (!$calls) ? 0 : count($calls);
            $v->Service->benefit = number_format($amount, 2) . ' €';
            $pourcentage = $v->Service->pourcentage;
            $reel = ($v->Service->benefit * 0.8) * ($pourcentage / 100);

            $v->Service->reel = number_format($reel, 2) . ' €';
        }
        $d['count'] = count($d['services']);
        
        $d['title_for_layout'] = 'Partenaire > Experts';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            )
        );
        
        $this->set($d);
        
        
    }
    
    public function service($slug, $id) {
         if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        $d['title_for_layout'] = 'Partenaire > Expert';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            )
        );
        
        $this->set($d);
        
        $this->layout = 'partner';
    }
    
    public function addexpert () {
        
        $d['title_for_layout'] = 'Partnaire > Clients';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partnaire',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Services',
                'type' => 'url',
                'url' => Router::url('admin/admins/users')
            )
        );
        
        $this->set($d);
        $this->layout = 'partner';
    }
    public function cbb($id) {
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Service');
        $this->loadModel('Card');
        $this->loadModel('Source');
        $this->loadModel('Question');
        
        if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        if ($this->request->data) {

            $data = $this->request->data;
            $porteur = str_replace(' ', '', $data->numero);
            if($data->month < 10) {
                $dateval = '0'.$data->month . substr($data->year, 2, 2);
            } else {
                $dateval = $data->month . substr($data->year, 2, 2);
            }
            
            $cvv = $data->crypto;

            // if ($porteur != '0000' && $cvv != '000') {
            // URL préproduction
            $url = "https://ppps.paybox.com/PPPS.php";

            // Numéro de la question
            $this->loadModel('Issue');
            $issue = current($this->Issue->find(1));
            $Profile = $this->Profile->findOneBy(array('conditions' => array('id' => $id)));
            
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
                'REFERENCE' => 'B-' . $Profile->Profile->id,
                'REFABONNE' => $Profile->Profile->email,
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
            echo $response->codereponse;
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
                //Mailer::failedAutorisation($user->User->id, $flash);
                $this->Session->setFlash($flash);
            }

            curl_close($curl);
        }
        
        $d['title_for_layout'] = 'Partenaire > CBB';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            )
        );
        
        $this->set($d);
        
        $this->layout = 'partner';
    }
    
    public function rib($id) {
        if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        if ($this->request->data) {

            $this->loadModel('RibClient');
            $data = $this->request->data;

            $rib = $this->RibClient->findOneBy(array('conditions' => array('profile_id' => $id)));
            if (!$rib) {
                $rib->profile_id = $id;
                $rib->banque = $data->banque;
                $rib->iban = $data->iban;
                $rib->bic = $data->bic;
                $rib->prelevement = $data->prelevement;

                if ($this->RibClient->save($rib)) {
                    $rib = current($this->RibClient->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id')))));
                    $this->Session->setFlash('Vos informations ont été enregistrées.', 'info');
                    Mailer::ribInfo($rib);
                } else {
                    $this->Session->setFlash('Une erreur est survenue. Verifiez vos informations');
                }
            }
        }

        $d['title_for_layout'] = 'Partenaire > RIB';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            )
        );

        $this->set($d);

        $this->layout = 'partner';
    }

    public function calls() {
        
        if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        $calls;
        $d['title_for_layout'] = 'Partenaire > Appels';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            ),
            array(
                'title' => 'Connexion',
                'type' => 'current',
            )
        );
        
        $this->set($d);
        
        $this->layout = 'partner';
    }
    
    public function call($id) {
        if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        $d['title_for_layout'] = 'Partenaire > Appel';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Partenaire',
                'type' => 'url',
                'url' => Router::url('partner/index')
            ),
            array(
                'title' => 'Connexion',
                'type' => 'current',
            )
        );
        
        $this->set($d);
        
        $this->layout = 'partner';
    }
    
    public function promo() {
        if (!isset($_SESSION['partner'])) {
            $this->redirect('partner/index');
            die();
        }
        
        $d['title_for_layout'] = 'Partenaire > Promotion';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Promotion',
                'type' => 'url',
                'url' => Router::url('partner/index')
            ),
            array(
                'title' => 'Connexion',
                'type' => 'current',
            )
        );
        
        $this->set($d);
        
        $this->layout = 'partner';
    }
}
