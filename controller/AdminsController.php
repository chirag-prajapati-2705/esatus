<?php

class AdminsController extends Controller {

    // Connexion / Déconnexion
    public function login() {

        $this->loadModel('Admin');

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

            if ($this->Admin->validate($rules, $data)) {
                $email = $data->email;
                $password = sha1($data->password);
                $admin = $this->Admin->findOneBy(array('conditions' => array('email' => $email, 'password' => $password)));
                if ($admin) {
                    $this->Session->write('admin', current($admin));
                } else {
                    $admin = $this->Admin->findOneBy(array('conditions' => array('email' => $email)));
                    if ($admin) {
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

        if (isset($_SESSION['admin'])) {
            $this->redirect('admin/admins/index');
            die();
        }

        $d['title_for_layout'] = 'Administration > Connexion';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Connexion',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function logout() {
        unset($_SESSION['admin']);
        $this->redirect('pages/index');
        die();
    }

    // Dashboard
    public function admin_index() {


        $this->loadModel('Call');
        
        $d['years'] = array();
        $d['total'] = array();

        $years = range(2013, date('Y'));
        $years = array_reverse($years);

        foreach ($years as $year) {

            $d['years'][$year] = array();
            $d['total'][$year] = 0;

            $months = ($year != date('Y')) ? range(1, 12) : range(1, 12);
            $months = array_reverse($months);

            foreach ($months as $month) {
                $benefit = 0;
                $reel = 0;
                $unpaids = 0;

                $conditions = "start >= '$year-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01 00:00:00' AND start <= '$year-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-31 23:59:59' AND (status = 310 OR status = 330 OR status = 350)";
                $calls = $this->Call->findBy(array(
                    'conditions' => $conditions,
                    'order' => 'id DESC'
                ));

                foreach ($calls as $k => $v) {
                    if ($v->Call->payment == 1) {
                        $benefit += $v->Call->cost;
                    } else {
                        $unpaids++;
                    }
                }

                $d['caTotal'][$year][$month] += $benefit;
                $pourcentage = .55;
                $reel += $benefit - (($benefit / 1.2) * $pourcentage);

                $d['years'][$year][$month] = new stdClass();
                $d['years'][$year][$month]->date = month($month) . ' ' . $year;
                $d['years'][$year][$month]->count = (!$calls) ? 0 : count($calls);
                $d['years'][$year][$month]->reel = number_format($reel, 2) . ' €';
                $d['years'][$year][$month]->unpaids = $unpaids;

                $d['total'][$year] += $reel;
            }
        }

        $d['title_for_layout'] = 'Administration > Tableau de bord';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Tableau de bord',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Clients
    public function admin_users() {

        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Service');
        $this->loadModel('Card');
        $this->loadModel('Source');
        $this->loadModel('Question');
        
        $d['users'] = array_reverse($this->User->findBy(array('order' => 'id DESC', 'limit' => 200)));
        krsort($d['users']);
        foreach ($d['users'] as $k => $v) {

            $v->User->slug = clean($v->User->last_name . ' ' . $v->User->first_name);

            // On récupère l'email
            $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $v->User->profile_id))));
            $v->User->email = $profile->email;
            $v->User->idProfile = $profile->id;
            $v->User->validated = $profile->validated;
            // On récupère les infos liées aux appels
            $conditions = 'user_id = ' . $v->User->id . ' AND (status = 310 OR status = 330 OR status = 350)';
            $calls = $this->Call->findBy(array(
                'conditions' => $conditions,
                'order' => 'id DESC'
            ));

            $amount = 0;
            foreach ($calls as $sk => $sv) {
                $amount += $sv->Call->cost;
            }
            $v->User->count = (!$calls) ? 0 : count($calls);
            $v->User->amount = number_format($amount, 2) . ' €';

            // On récupère les services
            $services = $this->Service->findBy(array('conditions' => array('profile_id' => $profile->id)));
            $v->User->service = ($services) ? 'Oui' : 'Non';

            $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $v->User->profile_id)));
            $v->User->color = ($card) ? '#34495e' : '#ff0000';
            
            // On récupère les questions
            $Question = current($this->Question->findOneBy(array('conditions' => array('profile_id' => $profile->id))));
            if($Question) {
                $v->User->Question = $Question->question;
            }
            
            // source
            $source = current($this->Source->findOneBy(array('conditions' => array('id_profile' => $profile->id))));

            $v->User->source = $source->source;
            
        }
        $d['count'] = count($d['users']);

        $d['title_for_layout'] = 'Administration > Clients';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Clients',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    //RIB : added by andru
    public function admin_ribs() {
        $this->loadModel('RibClient');
        $this->loadModel('Call');
        $this->loadModel('User');
        $this->loadModel('Service');

        $d['ribs'] = array_reverse($this->RibClient->findBy(array('order' => 'id ASC')));

        foreach ($d['ribs'] as $k => $v) {
            // On récupère le client
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Ribclient->profile_id))));
            $v->Ribclient->userid = $user->id;
            if ($user->pseudo) {
                $v->Ribclient->user = $user->pseudo;
            } else {
                $v->Ribclient->user = $user->last_name . ' ' . $user->first_name;
            }

            //slug
            $v->Ribclient->slug = clean($v->Ribclient->user);
        }

        $d['count'] = count($d['ribs']);

        $d['title_for_layout'] = 'Administration > RIBs';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'RIBs',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Client
    public function admin_user($slug, $id) {

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
        $d['title_for_layout'] = 'Administration > Clients > ' . $d['user']->first_name . ' ' . $d['user']->last_name;
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
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

    // Experts
    public function admin_services() {

        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Service');

        $d['services'] = array_reverse($this->Service->findAll());
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

        $d['title_for_layout'] = 'Administration > Experts';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Experts',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Service details
    public function admin_service($slug, $id) {
        $this->loadModel('Call');
        $this->loadModel('Service');
        $this->loadModel('Rib');
        $this->loadModel('User');

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/users');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id)));

        if (!$d['service']) {
            $this->redirect('admin/admins/services');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        if ($this->request->files) {

            $files = current($this->request->files);

            if ($files['error'] != 4) {

                if (strpos($files['type'], 'image') !== false) {

                    require_once CORE . '/images/ImageWorkshop.php';

                    $dir = '../bin/images/services/';

                    $this->loadModel('User');
                    $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $d['service']->profile_id)));

                    $name = $user->User->last_name . '-' . $user->User->first_name;
                    $name = clean($name);
                    $name = '--' . $id . '.jpg';

                    $params = getimagesize($files['tmp_name']);
                    $width = $params[0];
                    $height = $params[1];

                    $layer = ImageWorkshop::initFromPath($files['tmp_name']);

                    switch (true) {
                        case ($width > $height):
                            $layer->resizeInPixel(null, 150, true);
                            break;
                        case ($height > $width):
                            $layer->resizeInPixel(150, null, true);
                            break;
                        case ($width == $height):
                            $layer->resizeInPixel(150, 150, true);
                            break;
                    }

                    $layer->cropInPixel(150, 150, 0, 0, 'LT');
                    $layer->save($dir, $name, false, null, 80);
                } else {
                    $this->Session->setFlash('Le fichier doit être une image.');
                }
            }
        }

        if ($this->request->data) {

            $rules = $this->Service->rules;
            $data = $this->request->data;

            if (isset($data->service)) {

                unset($data->service);

                if ($data->cost_per_call == 0 || $data->cost_per_call == '') {
                    $data->cost_per_call = '0.0';
                }

                if ($data->cost_per_minute == 0 || $data->cost_per_minute == '') {
                    $data->cost_per_minute = ($data->cost_per_call != '0.0') ? '0.00' : '1.00';
                }

                $data->cost_per_minute = number_format(floatval(str_replace(',', '.', $data->cost_per_minute)), 2);
                $data->cost_per_call = number_format(floatval(str_replace(',', '.', $data->cost_per_call)), 2);

                if ($this->Service->validate($rules, $data)) {

                    $data->id = $id;
                    $data->title = ucfirst(strtolower($data->title));

                    if ($this->Service->save($data)) {
                        $this->Session->setFlash('Vos informations ont été enregistrés. ', 'info');
                        $this->redirect('admin/admins/service/slug:' . $slug . '/id:' . $id);
                        die();
                    } else {
                        $this->Session->setFlash('Une erreur est survenue.');
                    }
                } else {
                    $this->Session->setFlash('Des informations sont erronées.');
                }
            }

            if (isset($data->bdi)) {

                unset($data->bdi);

                $rules = $this->Rib->rules;
                $data = $this->request->data;

                if ($this->Rib->validate($rules, $data)) {

                    $data->id = $id;
                    $data->service_id = $d['service']->id;

                    if ($this->Rib->save($data)) {
                        $this->Session->setFlash('Vos coordonnées bancaires ont été enregistrés.', 'info');
                        $this->redirect('admin/admins/service/slug:' . $slug . '/id:' . $id);
                        die();
                    } else {
                        $this->Session->setFlash('Une erreur est survenue.');
                    }
                } else {
                    $this->Session->setFlash('Des informations sont erronées.');
                }
            }
        }



        $d['user'] = $this->User->findOneBy(array('conditions' => array('profile_id' => $d['service']->profile_id)));

        if (!$d['user']) {
            $this->redirect('admin/admins/services');
            die();
        } else {
            $d['user'] = current($d['user']);
            $d['user']->slug = clean($d['user']->last_name . ' ' . $d['user']->first_name);
        }

        $this->loadModel('Category');
        $this->loadModel('Subcategory');

        $d['categories'] = $this->Category->findAll();
        $d['subcategories'] = $this->Subcategory->findBy(array('conditions' => array('category_id' => $d['service']->category_id)));

        $d['rib'] = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$d['rib']) {
            $d['rib'] = new stdClass();
            $d['rib']->banque = '';
            $d['rib']->guichet = '';
            $d['rib']->compte = '';
            $d['rib']->cle = '';
            $d['rib']->domiciliation = '';
            $d['rib']->iban = '';
            $d['rib']->bic = '';
        } else {
            $d['rib'] = current($d['rib']);
        }

        $services = $this->Service->findBy(array('conditions' => array('profile_id' => $d['service']->profile_id)));
        $d['services'] = array();

        foreach ($services as $k => $v) {
            if ($v->Service->id != $d['service']->id) {
                $username = ($v->Service->username == '') ? $d['user']->last_name . '-' . $d['user']->first_name : $v->Service->username;
                $v->Service->slug = clean($username);
                $d['services'][] = $v;
            }
        }

        $conditions = 'service_id = ' . $d['service']->id . ' AND (status = 310 OR status = 330 OR status = 350)';
        $calls = $this->Call->findBy(array('conditions' => $conditions, 'order' => 'id DESC'));

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

            $reel = ($v->Call->cost - ($v->Call->cost * 0.2)) * ($d['service']->pourcentage / 100);

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
        $d['slug'] = $slug;
        $d['id'] = $id;

        $d['title_for_layout'] = 'Administration > Experts > ' . $d['service']->title;
        $d['description_for_layout'] = "";
        $d['scripts'] = array('service');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Experts',
                'type' => 'url',
                'url' => Router::url('admin/admins/services')
            ),
            array(
                'title' => $d['service']->title . ' (' . $d['user']->first_name . ' ' . $d['user']->last_name . ')',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function admin_toggle($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/services');
            die();
        }

        $this->loadModel('Service');

        $service = $this->Service->findOneBy(array('conditions' => array('id' => $id)));

        if (!$service) {
            $this->redirect('admin/admins/services');
            die();
        } else {
            $service = current($service);
        }

        $service->validated = ($service->validated == 1) ? 0 : 1;
        $service->title = utf8_decode($service->title);
        $service->description = utf8_decode($service->description);
        $service->presentation = utf8_decode($service->presentation);
        $service->reference = utf8_decode($service->reference);
        $this->Service->save($service);

        $this->redirect('admin/admins/services');
        die();
    }

    // Virements
    public function admin_repayments() {

        $this->loadModel('Repayment');
        $this->loadModel('Rib');
        $this->loadModel('Service');
        $this->loadModel('User');

        $d['repayments'] = array_reverse($this->Repayment->findAll());
        foreach ($d['repayments'] as $k => $v) {

            // Les infos du service
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Repayment->service_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id))));
            $v->Repayment->service = $service->title . ' (' . $user->last_name . ' ' . $user->first_name . ')';

            // La date de la demande
            $date = explode('-', $v->Repayment->date);
            $v->Repayment->date = $date[2] . '/' . $date[1] . '/' . $date[0];

            // RIB
            $rib = current($this->Rib->findOneBy(array('conditions' => array('service_id' => $service->id))));
            $v->Repayment->rib = $rib;
        }
        $d['count'] = count($d['repayments']);

        $d['title_for_layout'] = 'Administration > Virements';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Virements',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    public function admin_bdi($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/repayments');
            die();
        }

        $this->loadModel('Rib');

        $d['rib'] = $this->Rib->findOneBy(array('conditions' => array('id' => $id)));

        if (!$d['rib']) {
            $this->redirect('admin/admins/repayments');
            die();
        } else {
            $d['rib'] = current($d['rib']);
        }

        $d['title_for_layout'] = 'Administration > Virements > RIB';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Virements',
                'type' => 'url',
                'url' => Router::url('admin/admins/repayments')
            ),
            array(
                'title' => 'RIB',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function admin_transfer($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/repayments');
            die();
        }

        $this->loadModel('Repayment');

        $repayment = $this->Repayment->findOneBy(array('conditions' => array('id' => $id)));

        if (!$repayment) {
            $this->redirect('admin/admins/repayments');
            die();
        } else {
            $repayment = current($repayment);
        }

        $repayment->status = ($repayment->status == 1) ? 0 : 1;
        $this->Repayment->save($repayment);

        $this->redirect('admin/admins/repayments');
        die();
    }

    //added by andru
    public function admin_calls_rib() {
        $this->loadModel('Call');
        $this->loadModel('User');
        $this->loadModel('Service');

        $d['calls'] = array_reverse($this->Call->findBy(array('order' => 'id ASC', 'conditions' => array('rib' => '1'))));
        foreach ($d['calls'] as $k => $v) {

            // On récupère le client
            $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Call->user_id))));
            if ($user->pseudo) {
                $v->Call->user = $user->pseudo;
            } else {
                $v->Call->user = $user->last_name . ' ' . $user->first_name;
            }

            //added by andru
            //on récupère le cumul
            $v->Call->cumul = current($this->Call->cumul_unpaid($user->id))->Call->cumul;
            $v->Call->cumul = number_format($v->Call->cumul - (($v->Call->cumul / 1.2) * .55), 2) . ' €';


            // On récupère le service
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Call->service_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id))));
            $username = ($service->username == '') ? $user->pseudo : $service->username;

            $v->Call->slugUsername = Router::url('admin/admins/service/slug:' . clean($username) . '/id:' . $v->Call->service_id);
            //commented by andru
            //$v->Call->service = $service->title . '(<a href="' . $v->Call->slugUsername . '">' . $username . '</a>)';
            $v->Call->service = '(<a href="' . $v->Call->slugUsername . '">' . $username . '</a>)';
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
                $v->Call->payment = (($v->Call->payment == 1) ? '' : '<a href="' . Router::url('admin/admins/repay/id:' . $v->Call->id) . '"><i class="icon-refresh"></i></a><br>') . '<span class="label label-' . (($v->Call->payment == 1) ? 'success' : 'warning') . '">' . (($v->Call->payment == 1) ? 'payé' : 'impayé') . '</span>';
            } else {
                $v->Call->payment = '<span class="label label-success">payé</span>';
            }
        }
        $d['count'] = count($d['calls']);

        $d['title_for_layout'] = 'Administration > Appels (RIB)';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Appels (RIB)',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Appels
    public function admin_calls() {

        $this->loadModel('Call');
        $this->loadModel('User');
        $this->loadModel('Service');

        $d['calls'] = array_reverse($this->Call->findBy(array('conditions' => 'session_id != \'\'', 'order' => 'id ASC')));
        foreach ($d['calls'] as $k => $v) {

            // On récupère le client
            $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Call->user_id))));
            if ($user->pseudo) {
                $v->Call->user = $user->pseudo;
            } else {
                $v->Call->user = $user->last_name . ' ' . $user->first_name;
            }


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
            $pourcentageEsatus = 100 - $service->pourcentage;
            $reel = ($v->Call->cost * 0.8) * ($pourcentageEsatus / 100);

            // La commission sur l'appel
            $v->Call->commission = number_format($reel, 2) . ' €';

            // Statut de l'appel
            $status = $v->Call->status;
            $v->Call->status = ($status == 310 || $status == 330 || $status == 350) ? 'Appel reçu' : 'Appel non reçu';

            // Etat du paiement    
            if ($status == 310 || $status == 330 || $status == 350) {
                $v->Call->payment = (($v->Call->payment == 1) ? '' : '<a href="' . Router::url('admin/admins/repay/id:' . $v->Call->id) . '"><i class="icon-refresh"></i></a><br>') . '<span class="label label-' . (($v->Call->payment == 1) ? 'success' : 'warning') . '">' . (($v->Call->payment == 1) ? 'payé' : 'impayé') . '</span>';
            } else {
                $v->Call->payment = '<span class="label label-success">payé</span>';
            }
        }
        $d['count'] = count($d['calls']);

        $d['title_for_layout'] = 'Administration > Appels';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Appels',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Appels for  months
    public function admin_callsmonths($year, $month) {

        $this->loadModel('Call');
        $this->loadModel('User');
        $this->loadModel('Service');

        $conditions = "start >= '$year-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01 00:00:00' AND start <= '$year-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-31 23:59:59' AND (status = 310 OR status = 330 OR status = 350)";
        $calls = $this->Call->findBy(array(
            'conditions' => $conditions,
            'order' => 'id ASC'
        ));

        $d['calls'] = array_reverse($calls);
        foreach ($d['calls'] as $k => $v) {

            // On récupère le client
            $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Call->user_id))));
            $v->Call->profile_id = $user->profile_id;
            if ($user->pseudo) {
                $v->Call->user = $user->pseudo;
            } else {
                $v->Call->user = $user->last_name . ' ' . $user->first_name;
            }


            // On récupère le service
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Call->service_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id))));
            $v->Call->profile_id_service = $service->profile_id;
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
            $pourcentageEsatus = 100 - $service->pourcentage;
            $reel = ($v->Call->cost * 0.8) * ($pourcentageEsatus / 100);

            // La commission sur l'appel
            $v->Call->commission = number_format($reel, 2) . ' €';

            // Statut de l'appel
            $status = $v->Call->status;
            $v->Call->status = ($status == 310 || $status == 330 || $status == 350) ? 'Appel reçu' : 'Appel non reçu';

            // Etat du paiement    
            if ($status == 310 || $status == 330 || $status == 350) {
                $v->Call->payment = (($v->Call->payment == 1) ? '' : '<a href="' . Router::url('admin/admins/repay/id:' . $v->Call->id) . '"><i class="icon-refresh"></i></a><br>') . '<span class="label label-' . (($v->Call->payment == 1) ? 'success' : 'warning') . '">' . (($v->Call->payment == 1) ? 'payé' : 'impayé') . '</span>';
            } else {
                $v->Call->payment = '<span class="label label-success">payé</span>';
            }
        }
        $d['count'] = count($d['calls']);

        $d['title_for_layout'] = 'Administration > Appels';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Appels',
                'type' => 'current',
            )
        );

        $d['year'] = $year;
        $d['month'] = $month;

        $this->set($d);
    }

    //added by andru
    public function admin_rswitch($id) {
        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/ribs');
            die;
        }

        $this->loadModel('RibClient');

        $rib = $this->RibClient->findOneBy(array('conditions' => array('id' => $id)));

        if (!$rib) {
            $this->redirect('admin/admins/ribs');
            die;
        } else {
            $rib = current($rib);
        }

        $rib->status = ($rib->status == 1) ? 2 : 1;
        $this->RibClient->save($rib);

        $this->redirect('admin/admins/ribs');
        die;
    }

    public function admin_switch($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/calls');
            die();
        }

        $this->loadModel('Call');

        $call = $this->Call->findOneBy(array('conditions' => array('id' => $id)));

        if (!$call) {
            $this->redirect('admin/admins/calls');
            die();
        } else {
            $call = current($call);
        }

        $call->payment = ($call->payment == 0) ? 1 : 0;
        $this->Call->save($call);

        $this->redirect('admin/admins/calls');
        die();
    }

    //added by andru
    public function admin_rcswitch($id) {


        if (!isset($id) || !is_numeric($id)) {
            //$this->redirect('admin/admins/calls_rib');
            die();
        }

        $this->loadModel('Call');

        $call = $this->Call->findOneBy(array('conditions' => array('id' => $id)));

        if (!$call) {
            //$this->redirect('admin/admins/calls_rib');
            die();
        } else {
            $call = current($call);
        }

        $call->payment = ($call->payment == 0) ? 1 : 0;
        $this->Call->save($call);

        $this->redirect('admin/admins/calls_rib');
        die();
    }

    public function admin_switchcallmonth($id, $year, $month) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/callsmonths/' . $year . '/' . $month);
            die();
        }

        $this->loadModel('Call');

        $call = $this->Call->findOneBy(array('conditions' => array('id' => $id)));

        if (!$call) {
            $this->redirect('admin/admins/callsmonths/' . $year . '/' . $month);
            die();
        } else {
            $call = current($call);
        }

        $call->payment = ($call->payment == 0) ? 1 : 0;
        $this->Call->save($call);

        $this->redirect('admin/admins/callsmonths/' . $year . '/' . $month);
        die();
    }

    // Impayés
    public function admin_unpaids() {

        $this->loadModel('Call');
        $this->loadModel('User');
        $this->loadModel('Service');

        $calls = $this->Call->findBy(array(
            'conditions' => 'status = 310 OR status = 330 OR status = 350',
            'order' => 'id DESC'
        ));
        $d['calls'] = array();
        foreach ($calls as $k => $v) {

            if ($v->Call->payment == 0) {

                // On récupère le client
                $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Call->user_id))));
                $v->Call->user = $user->last_name . ' ' . $user->first_name;

                // On récupère le service
                $service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Call->service_id))));
                $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id))));
                $username = ($service->username == '') ? $user->last_name . ' ' . $user->first_name : $service->username;
                $v->Call->slugUsername = Router::url('admin/admins/service/slug:' . clean($username) . '/id:' . $v->Call->service_id);
                $v->Call->service = $service->title . '(<a href="' . $v->Call->slugUsername . '">' . $username . '</a>)';

                // Pour construire URL client
                $v->Call->slug = clean($v->Call->user);
                // La durée de la communication
                $v->Call->duration = elapsedTime($v->Call->start, $v->Call->end);

                // La date de la communication
                $date = substr($v->Call->start, 0, 10);
                $date = explode('-', $date);
                $v->Call->date = $date[2] . '/' . $date[1] . '/' . $date[0];

                $reel = $v->Call->cost - (($v->Call->cost / 1.2) * .55);

                // La commission sur l'appel
                $v->Call->commission = number_format($reel, 2) . ' €';

                $d['calls'][] = $v;
            }
        }
        $d['count'] = count($d['calls']);

        $d['title_for_layout'] = 'Administration > Appels';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Appels',
                'type' => 'current',
            )
        );
        $this->set($d);

        $d['title_for_layout'] = 'Administration > Impayés';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Impayés',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    public function admin_regulation($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/unpaids');
            die();
        }

        $this->loadModel('Call');

        $call = $this->Call->findOneBy(array('conditions' => array('id' => $id)));

        if (!$call) {
            $this->redirect('admin/admins/unpaids');
            die();
        } else {
            $call = current($call);
        }

        $call->payment = 1;
        $this->Call->save($call);

        $this->redirect('admin/admins/unpaids');
        die();
    }

    // Catégories
    public function admin_categories() {

        $this->loadModel('Category');
        $this->loadModel('Subcategory');

        $d['categories'] = $this->Category->findAll();
        foreach ($d['categories'] as $k => $v) {
            $v->Category->subcategories = $this->Subcategory->findBy(array('conditions' => array('category_id' => $v->Category->id)));
        }

        $d['title_for_layout'] = 'Administration > Catégories';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Catégories',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    public function admin_add($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/categories');
            die();
        }

        $this->loadModel('Category');
        $this->loadModel('Subcategory');

        $d['category'] = $this->Category->findOneBy(array('conditions' => array('id' => $id)));

        if (!$d['category']) {
            $this->redirect('admin/admins/categories');
            die();
        } else {
            $d['category'] = current($d['category']);
        }

        if ($this->request->data) {
            $data = $this->request->data;
            $rules = $this->Subcategory->rules;
            if ($this->Subcategory->validate($rules, $data)) {
                $data->category_id = $id;
                $data->slug = slugify($data->title);
                $this->Subcategory->save($data);
                $this->redirect('admin/admins/categories');
                die();
            }
        }

        $d['title_for_layout'] = 'Administration > Catégories > ' . $d['category']->title . ' > Nouvelle sous-catégorie';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Catégories',
                'type' => 'url',
                'url' => Router::url('admin/admins/categories')
            ),
            array(
                'title' => $d['category']->title . ' › Nouvelle sous-catégorie',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    public function admin_edit($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/categories');
            die();
        }

        $this->loadModel('Subcategory');

        $d['subcategory'] = $this->Subcategory->findOneBy(array('conditions' => array('id' => $id)));

        if (!$d['subcategory']) {
            $this->redirect('admin/admins/categories');
            die();
        } else {
            $d['subcategory'] = current($d['subcategory']);
        }

        if ($this->request->data) {
            $data = $this->request->data;
            $rules = $this->Subcategory->rules;
            if ($this->Subcategory->validate($rules, $data)) {
                $data->id = $d['subcategory']->id;
                $data->slug = slugify($data->title);
                $this->Subcategory->save($data);
                $this->redirect('admin/admins/categories');
                die();
            }
        }

        $d['title_for_layout'] = 'Administration > Catégories > ' . $d['subcategory']->title . ' > Modifier';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Catégories',
                'type' => 'url',
                'url' => Router::url('admin/admins/categories')
            ),
            array(
                'title' => $d['subcategory']->title . ' › Modifier',
                'type' => 'current',
            )
        );
        $this->set($d);
    }
    
    public function admin_catedit($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/categories');
            die();
        }

        $this->loadModel('Category');

        $d['Category'] = $this->Category->findOneBy(array('conditions' => array('id' => $id)));

        if (!$d['Category']) {
            $this->redirect('admin/admins/categories');
            die();
        } else {
            $d['Category'] = current($d['Category']);
        }

        if ($this->request->data) {
            $data = $this->request->data;
            
            $rules = $this->Subcategory->rules;
            if ($this->Subcategory->validate($rules, $data)) {
                $data->id = $d['Category']->id;
                $data->slug = slugify($data->title);
                $this->Category->save($data);
                $this->redirect('admin/admins/categories');
                die();
            }
        }

        $d['title_for_layout'] = 'Administration > Catégories > ' . $d['Category']->title . ' > Modifier';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Catégories',
                'type' => 'url',
                'url' => Router::url('admin/admins/categories')
            ),
            array(
                'title' => $d['Category']->title . ' › Modifier',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Inscris
    public function admin_inscris() {

        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Preinscription');

        $d['Preinscription'] = array_reverse($this->Preinscription->findAll());
        foreach ($d['Preinscription'] as $k => $v) {
          // On verifie si le client a terminer sont inscription
          $user = $this->Profile->findBy(array('conditions' => array('email' => $v->Preinscription->email)));
          $v->Preinscription->color = ($user) ? '#34495e' : '#ff0000';
        } 

        $d['count'] = count($d['Preinscription']);

        $d['title_for_layout'] = 'Administration > Clients';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Inscriptions',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Export contact list
    public function admin_export() {
        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: attachment; filename=\"users.csv\"");

        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Card');
        $this->loadModel('Service');

        $d['profiles'] = array();
        $d['Allprofiles'] = array_reverse($this->Profile->findAll());
        $array = $d['Allprofiles'];

        $csv = "Id;Login;Email;Date de naissance;Telephone;Date d'inscription;Mark;Date d'expiration;Cryptogram;Expert;Nom;Prenom\n";
        // construction de chaque ligne 
        foreach ($d['Allprofiles'] as $k => $v) {
            // On récupère les services
            $users = $this->User->findBy(array('conditions' => array('profile_id' => $v->Profile->id)));
            foreach ($users as $m => $n) {
                $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $n->User->profile_id)));
                $services = $this->Service->findBy(array('conditions' => array('profile_id' => $n->User->profile_id)));
                $n->User->service = ($services) ? 'Oui' : 'Non';
                $n->User->card = $card;
            }

            $csv .= $v->Profile->id . ';' . $n->User->pseudo . ';' . $v->Profile->email . ';' . $n->User->birth_date . ';' . $n->User->phone . ';' . $n->User->date_inscription . ';' . $n->User->card->Card->mark . ';' . $n->User->card->Card->expiry_date . ';' . $n->User->card->Card->cryptogram . ';' . $n->User->service . ';' . $n->User->last_name . ';' . $n->User->first_name . "\n"; // le \n final entre " "
            $n->User->last_name = '';
            $n->User->first_name = '';
        }

        echo $csv;
        exit();
    }

    // Compagne de promotion
    public function admin_promo() {

        $this->loadModel('Campagne');

        $d['campagne'] = $this->Campagne->findBy(array('conditions' => array('bienvenue' => 0)));
        $d['CampagneBienvenue'] = $this->Campagne->findOneBy(array('conditions' => array('bienvenue' => 1)));

        $d['count'] = count($d['campagne']);

        $d['title_for_layout'] = 'Administration > Campagnes';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Campagnes',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    public function admin_editPromo($id) {

        $this->loadModel('Campagne');
        $d['campagne'] = $this->Campagne->findOneBy(array('conditions' => array('id' => $id)));
        if ($this->request->data) {
            $data = $this->request->data;
            $data->id = $id;
            $this->Campagne->save($data);
            $this->redirect('administration/editPromo/' . $id);
            die();
        }

        $d['title_for_layout'] = 'Administration > Campagnes > Modofier campagne';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Campagnes',
                'type' => 'url',
                'url' => Router::url('admin/admins/promo')
            ),
            array(
                'title' => 'Modofier campagne',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    public function admin_toggleCampagne($id) {

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/promo');
            die();
        }

        $this->loadModel('Campagne');

        $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => $id)));

        if (!$campagne) {
            $this->redirect('admin/admins/promo');
            die();
        } else {
            $campagne = current($campagne);
        }

        $campagne->validated = ($campagne->validated == 1) ? 0 : 1;
        $campagne->libelle = utf8_decode($campagne->libelle);
        $campagne->type = utf8_decode($campagne->type);
        $campagne->valeur = utf8_decode($campagne->valeur);
        $campagne->date_debut = utf8_decode($campagne->date_debut);
        $campagne->date_fin = utf8_decode($campagne->date_fin);
        $this->Campagne->save($campagne);

        $this->redirect('admin/admins/promo');
        die();
    }

    public function admin_addPromo() {

        $this->loadModel('Campagne');

        if ($this->request->data) {
            $data = $this->request->data;
            //$rules = $this->Subcategory->rules;
            $this->Campagne->save($data);
            $this->redirect('admin/admins/promo');
            die();
        }

        $d['title_for_layout'] = 'Administration > Campagnes > Nouvelle campagne';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Campagnes',
                'type' => 'url',
                'url' => Router::url('admin/admins/promo')
            ),
            array(
                'title' => 'Nouvelle campagne',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    public function admin_affect($id) {

        $this->loadModel('Service');
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Affecter');
        $this->loadModel('Campagnebienvenue');
        $this->loadModel('Campagne');

        $d['idcompagne'] = $id;
        $d['services'] = array_reverse($this->Service->findBy(array('conditions' => array('validated' => '1'))));


        if ($this->request->data) {
            $data = $this->request->data;
            if ($id == 1) {
                $this->Campagnebienvenue->deletAll();
                foreach ($data as $c) {
                    $Campagnebienvenue->id_service = $c;
                    $this->Campagnebienvenue->save($Campagnebienvenue);
                }
            } else {

                reset($data);
                while (list($key, $value) = each($data)) {
                    //echo "Clé : $key; Valeur : $value<br />\n";
                    $affectation = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $key)));
                    $Campagne->id = $affectation->Affecter->id;
                    $Campagne->id_campagne = $value;
                    $Campagne->id_service = $key;
                    $this->Affecter->save($Campagne);
                }
            }
        }

        foreach ($d['services'] as $k => $v) {

            // On récupère le nom et date d'inscription
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $v->Service->user = $user->last_name . ' ' . $user->first_name;
            $v->Service->date = $user->date_inscription;

            $username = ($v->Service->username == '') ? $user->last_name . '-' . $user->first_name : $v->Service->username;
            $v->Service->slug = clean($username);

            // if campagne de bienvenue
            if ($id == 1) {
                $affectationBienvenue = $this->Campagnebienvenue->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));
                if ($affectationBienvenue) {
                    $v->Service->checked = 'selected';
                } else {
                    $v->Service->checked = '';
                }
            } else {
                $affectation = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));

                if ($affectation) {
                    $v->Service->id_campagne = $affectation->Affecter->id_campagne;
                    
                } else {
                    $v->Service->id_campagne = 0;
                }
            }
        }
        $d['Campagne'] = $this->Campagne->findBy(array('conditions' => array('validated' => 1)));
        $d['count'] = count($d['services']);

        $d['title_for_layout'] = 'Administration > Campagnes > Affectation des experts';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Campagnes',
                'type' => 'url',
                'url' => Router::url('admin/admins/promo')
            ),
            array(
                'title' => 'Affectation des experts',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function admin_toggleAffecter($id1, $id) {


        $this->loadModel('Affecter');
        $this->loadModel('Service');

        $exist = $this->Affecter->findOneBy(array('conditions' => array('id_campagne' => $id1, 'id_service' => $id)));
        if (!$exist) {
            $Affecter->id_campagne = $id1;
            $Affecter->id_service = $id;
            $this->Affecter->save($Affecter);
        } else {
            $this->Affecter->delete($exist->Affecter->id);
        }


        $this->redirect('administration/affect/' . $id1);
        die();
    }

    public function admin_toggleDeleteAll($id) {


        $this->loadModel('Affecter');

        $expert = $this->Affecter->findBy(array('conditions' => array('id_campagne' => $id)));
        foreach ($expert as $k => $v) {
            $this->Affecter->delete($v->Affecter->id);
        }

        $this->redirect('administration/affect/' . $id);
        die();
    }

    public function admin_toggleAddAll($id2) {
        $this->loadModel('Affecter');
        $this->loadModel('Service');

        $services = array_reverse($this->Service->findBy(array('conditions' => array('validated' => '1'))));

        foreach ($services as $k => $v) {
            $Affecter->id_campagne = $id2;
            $Affecter->id_service = $v->Service->id;
            $this->Affecter->save($Affecter);
        }

        $this->redirect('administration/affect/' . $id2);
        die();
    }

    public function admin_repay($id) {

        $this->loadModel('Call');
        $this->loadModel('Card');
        $this->loadModel('Profile');
        $this->loadModel('User');
        $this->loadModel('Issue');
        $this->loadModel('Preautorisation');

        $url = "https://ppps.paybox.com/PPPS.php";

        // L'appel non paye
        $call = $this->Call->findOneBy(array('conditions' => array('id' => $id)));

        //User
        $user = $this->User->findOneBy(array('conditions' => array('id' => $call->Call->user_id)));

        // Profile
        $profile = $this->Profile->findOneBy(array('conditions' => array('id' => $user->User->profile_id)));

        // Numéro de la carte
        $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $profile->Profile->id)));

        // Numéro de la question
        $issue = current($this->Issue->find(1));

        //autorisation
        $preautorisation = current($this->Preautorisation->findOneBy(array('conditions' => array('profile_id' => $profile->Profile->id))));

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
                'MONTANT' => '10000', // 50.00 €
                'DEVISE' => '978',
                'REFERENCE' => 'A'.-$call->Call->service_id . '-' . $profile->Profile->id,
                'REFABONNE' => $profile->Profile->email,
                'PORTEUR' => $card->Card->mark,
                'DATEVAL' => $card->Card->expiry_date,
                'CVV' => $card->Card->cryptogram,
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
                $preAutorisationData->profile_id = $profile->Profile->id;
                $preAutorisationData->date = date('Y-m-d H:i:s');
                $preAutorisationData->numtrans = $response->numtrans;
                $preAutorisationData->numappel = $response->numappel;
                $this->Preautorisation->save($preAutorisationData);

                $preautorisation = current($this->Preautorisation->findOneBy(array('conditions' => array('profile_id' => $call->Call->user_id))));
            }
        }

        if (isset($response->codereponse) && $response->codereponse == '00000') {

            // Référence Paybox manuel en francais V4_84.pdf - page 43 

            $params = array(
                'VERSION' => '00104',
                'DATEQ' => date('dmYHis'),
                'TYPE' => '00052', // ?? 52
                'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
                'SITE' => '1101352',
                'RANG' => '001',
                'CLE' => 'luguwPBf',
                'MONTANT' => number_format($call->Call->cost, 2) * 100,
                'DEVISE' => '978',
                'REFERENCE' => 'A-'.$call->Call->service_id . '-' . $profile->Profile->id,
                'REFABONNE' => $profile->Profile->email,
                'PORTEUR' => $card->Card->mark,
                'DATEVAL' => $card->Card->expiry_date,
                'CVV' => $card->Card->cryptogram,
                'ACTIVITE' => '027',
                'NUMTRANS' => $preautorisation->numtrans,
                'NUMAPPEL' => $preautorisation->numappel,
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
                $this->Preautorisation->delete($preautorisation->id);

                $Call->id = $call->Call->id;
                $Call->payment = 1;
                $this->Call->save($Call);
                $this->redirect('admin/admins/calls');
                die();
            }
        }
    }
    
    public function admin_affectcategorie($id) {
        $this->loadModel('Category');
        $this->loadModel('Affecter');
        $this->loadModel('Campagne');
        $this->loadModel('Service');


        if ($this->request->data) {
            $data = $this->request->data;

            reset($data);
            while (list($key, $value) = each($data)) {
                if ($value != 0) {
                    $services = array_reverse($this->Service->findBy(array('conditions' => array('category_id' => $key))));
                    //echo $key.' - '.$value;
                    foreach ($services as $services) {
                        $affectation = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $services->Service->id)));

                        $Campagne->id = $affectation->Affecter->id;
                        $Campagne->id_campagne = $value;
                        $Campagne->id_service = $services->Service->id;
                        $this->Affecter->save($Campagne);
                    }
                }
            }
        }
        $d['title_for_layout'] = 'Administration > Campagnes > Affectation des experts';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Campagnes',
                'type' => 'url',
                'url' => Router::url('admin/admins/promo')
            ),
            array(
                'title' => 'Affectation des experts',
                'type' => 'current',
            )
        );
        $d['categories'] = $this->Category->findAll();
        $d['Campagne'] = $this->Campagne->findBy(array('conditions' => array('validated' => 1)));
        $this->set($d);
    }
    
    public function admin_videocalls() {

        $this->loadModel('User');
        $this->loadModel('Service');
        $this->loadModel('VideoCallDetail');

        $d['videoCallDetail'] = array_reverse($this->VideoCallDetail->findBy(array('order' => 'id DESC')));
        
        foreach ($d['videoCallDetail'] as $k => $v) {

            // On récupère le client
            $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Videocalldetail->user_id))));
            
            if ($user->pseudo) {
                $v->Videocalldetail->user = $user->pseudo;
            } else {
                $v->Videocalldetail->user = $user->last_name . ' ' . $user->first_name;
            }

            
            // On récupère le service
            $service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Videocalldetail->service_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $service->profile_id))));
            $username = ($service->username == '') ? $user->pseudo : $service->username;

            $v->Videocalldetail->slugUsername = Router::url('admin/admins/service/slug:' . clean($username) . '/id:' . $v->Videocalldetail->service_id);
            $v->Videocalldetail->service = $service->title . '(<a href="' . $v->Videocalldetail->slugUsername . '">' . $username . '</a>)';
            // Pour construire URL client
            $v->Videocalldetail->slug = clean($v->VideoVideoCallDetailDetail->user);


            // La durée de la communication
            $v->Videocalldetail->duration = elapsedTime($v->Videocalldetail->debut, $v->Videocalldetail->fin);

            // La date de la communication
            $date = substr($v->Videocalldetail->start, 0, 10);
            $heure = substr($v->Videocalldetail->start, 11, 8);
            $date = explode('-', $date);
            $v->Videocalldetail->date = $date[2] . '/' . $date[1] . '/' . $date[0] . ' ' . $heure;
            $pourcentageEsatus = 100 - $service->pourcentage;
            $reel = ($v->Videocalldetail->cost * 0.8) * ($pourcentageEsatus / 100);

            // La commission sur l'appel
            $v->Videocalldetail->commission = number_format($reel, 2) . ' €';

            // Statut de l'appel
            $status = $v->Videocalldetail->status;
            $v->Videocalldetail->status = ($status == 310 || $status == 330 || $status == 350) ? 'Appel reçu' : 'Appel non reçu';
            
            
            
            // Etat du paiement    
            if ($status == 310 || $status == 330 || $status == 350) {
                $v->Videocalldetail->payment = (($v->Videocalldetail->payment == 1) ? '' : '<a href="' . Router::url('admin/admins/repay/id:' . $v->Videocalldetail->id) . '"><i class="icon-refresh"></i></a><br>') . '<span class="label label-' . (($v->Videocalldetail->payment == 1) ? 'success' : 'warning') . '">' . (($v->Videocalldetail->payment == 1) ? 'payé' : 'impayé') . '</span>';
            } else {
                $v->Videocalldetail->payment = '<span class="label label-success">payé</span>';
            }
            
            
            
        }
        $d['count'] = count($d['videoCallDetail']);

        $d['title_for_layout'] = 'Administration > Appels video';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Appels vidéo',
                'type' => 'current',
            )
        );
        $this->set($d);
    }
    
    // Inscris
    public function admin_partner() {

        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Partner');
        
        $d['Partner'] = array_reverse($this->Partner->findAll());
        $d['count'] = count($d['Partner']);

        $d['title_for_layout'] = 'Administration > Partenaires';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Partenaires',
                'type' => 'current',
            )
        );
        $this->set($d);
    }
    
    public function admin_addpartner() {

        $this->loadModel('Partner');

        if ($this->request->data) {
            $data = $this->request->data;
            if ($this->Partner->validate($rules, $data)) {
                $std = new stdClass();
                $std->raison = $data->raison;
                $std->email = $data->email;
                $std->password = sha1($data->password);
                $std->level = '';
                $Partner = $this->Partner->findOneBy(array('conditions' => array('email' => $data->email)));
                
                if (!$Partner) {
                    print_r($std);
                     $this->Partner->save($std);
                } else {
                    echo 2;die();
                    $this->Session->setFlash('Email existe');
                }
            }
        }

        $d['title_for_layout'] = 'Administration > Partenaires';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Partenaires',
                'type' => 'current',
            )
        );
        $this->set($d);
    }
    
    public function admin_clientpartnerliste($id) {
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Service');
        $this->loadModel('Card');
        $this->loadModel('Source');
        $this->loadModel('Question');
        $conditionsListe = 'affiliation = ' . $id . ' AND 1=1';

        $d['profiles'] = array_reverse($this->Profile->findBy(array('conditions' => $conditionsListe, 'order' => 'id DESC', 'limit' => 200)));
        krsort($d['profiles']);
        foreach ($d['profiles'] as $k => $v) {
            // On récupère l'email
            $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Profile->profile_id))));
            $v->Profile->pseudo = clean($user->pseudo);
            $v->Profile->email = $v->Profile->email;
            $v->Profile->idProfile = $user->id;
            $v->Profile->validated = $user->validated;
            $v->Profile->date_inscription = $user->date_inscription;
            
            // On récupère les infos liées aux appels
            $conditions = 'user_id = ' . $v->User->id . ' AND (status = 310 OR status = 330 OR status = 350)';
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
            $services = $this->Service->findBy(array('conditions' => array('profile_id' => $user->id)));
            $v->Profile->service = ($services) ? 'Oui' : 'Non';

            $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $v->User->profile_id)));
            $v->Profile->color = ($card) ? '#34495e' : '#ff0000';
            
            // On récupère les questions
            $Question = current($this->Question->findOneBy(array('conditions' => array('profile_id' => $profile->id))));
            if($Question) {
                $v->Profile->Question = $Question->question;
            }
            
            // source
            $source = current($this->Source->findOneBy(array('conditions' => array('id_profile' => $profile->id))));

            $v->Profile->source = $source->source;
            
        }
        $d['count'] = count($d['profiles']);

        $d['title_for_layout'] = 'Administration > Clients';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Clients',
                'type' => 'current',
            )
        );
        $this->set($d);
    }
    
    public function admin_appelspartnerliste($id) {
        $d['title_for_layout'] = 'Administration > Clients';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('tablesorter');
        $d['scripts'] = array('tablesorter');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Administration',
                'type' => 'url',
                'url' => Router::url('admin/admins/index')
            ),
            array(
                'title' => 'Appels',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

}

?>