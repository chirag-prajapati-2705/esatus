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

                $pourcentage = .55;
                $reel += $benefit - (($benefit/1.196)* $pourcentage);

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

        $d['users'] = array_reverse($this->User->findAll());
        foreach ($d['users'] as $k => $v) {

            $v->User->slug = clean($v->User->last_name . ' ' . $v->User->first_name);

            // On récupère l'email
            $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $v->User->profile_id))));
            $v->User->email = $profile->email;

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
            $v->User->card = ($card) ? '#34495e' : '#ff0000';
        }
        $d['count'] = count($d['users']);

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
                'title' => 'Clients',
                'type' => 'current',
            )
        );
        $this->set($d);
    }

    // Client
    public function admin_user($slug, $id) {

        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Call');
        $this->loadModel('Affectation');
        $this->loadModel('Service');
        
        if ($this->request->data) 
        {
            $rules = $this->User->rules;
            $data = $this->request->data;

            $birth_date = $data->year . '-' . $data->month . '-'. $data->day;
            unset($data->year);
            unset($data->month);
            unset($data->day);
            $affec = $data->affecter;
            unset($data->affecter);
            
            if ($this->User->validate($rules, $data)) {

                $data->id = $id;
                $data->last_name = strtoupper($data->last_name);
                $data->first_name = ucfirst(strtolower($data->first_name));
                $data->birth_date = $birth_date;

                //
                // Mise à jour du nom des images des services de ce client
                //

                $user = $this->User->findOneBy(array('conditions' => array('id' => $id)));
                $profile_id = $user->User->profile_id;

                // Récupération des services du client
                $services = $this->Service->findBy(array(
                    'conditions'=>'profile_id = '.$profile_id,
                    'order'=>'id DESC'
                ));

                // Mise à jour des noms des images des services avec le nouveau nom du client
                foreach ($services as $k => $v) {
                    $service = new stdClass;
                    $service->id = $v->Service->id;
                    $img_oldname = $v->Service->img; // ancien nom d'image
                    $img_newname = strtolower($data->last_name.'-'.$data->first_name.'-'.$v->Service->id.'.jpg'); // nouveau nom d'image
                    if(rename (BIN.'/images/services/'.$img_oldname,  BIN.'/images/services/'.$img_newname) === true){ // Renommage du fichier image
                        $service->img = $img_newname; // Sauvegarde du nom de l'image dans le service
                        $this->Service->save($service); // Mise à jour du service en base
                    };
                }
                
                // Mise à jour des données client en base                
                if ($this->User->save($data)) {
                    
                    $idAffectation = $this->Affectation->findOneBy(array('conditions' => array('client_id' => $data->id)));
                    
                    if(($idAffectation->Affectation->id) !='NULL')
                    {
                        $Affectation->id = $idAffectation->Affectation->id;
                    }
                       
                    $Affectation->client_id = $data->id;
                    $Affectation->expert_id = $affec;
                    
                    if($this->Affectation->save($Affectation))
                    {
                        $this->Session->setFlash('Vos informations ont été enregistrés.', 'info');
                        $this->redirect('admin/admins/user/slug:' . clean($data->last_name . ' ' . $data->first_name) . '/id:' . $id);
                        die();
                    }
                    else
                    {
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
        foreach ($d['AllServices'] as $k => $v) 
        {
           // On récupère le nom
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            // On récupère le nom
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $v->Service->user = $user->last_name.' '.$user->first_name;
            
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

            $reel = $v->Service->benefit - (($v->Service->benefit / 1.196) * .55);

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

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('admin/admins/users');
            die();
        }

        $this->loadModel('Service');
        $this->loadModel('Rib');

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
                    $name = $name . '-' . $id . '.jpg';

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

        $this->loadModel('User');

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

    // Appels
    public function admin_calls() {

        $this->loadModel('Call');
        $this->loadModel('User');
        $this->loadModel('Service');

        $d['calls'] = array_reverse($this->Call->findAll());
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
            $v->Call->date = $date[2] . '/' . $date[1] . '/' . $date[0].' '.$heure;

            $reel = $v->Call->cost - (($v->Call->cost / 1.196) * .55);

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

                $reel = $v->Call->cost - (($v->Call->cost / 1.196) * .55);

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
    
    // Inscris
    public function admin_inscris() {

        $this->loadModel('User');
        $this->loadModel('Profile');
        $d['profiles'] = array();
        $d['Allprofiles'] = array_reverse($this->Profile->findAll());
        foreach ($d['Allprofiles'] as $k => $v) 
        {
            // On récupère les services
           $user = $this->User->findBy(array('conditions' => array('profile_id' => $v->Profile->id)));
           if(!$user)
           {
               array_push ($d['profiles'],$v);
           }
        }
        
        $d['count'] = count($d['profiles']);

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
    public function admin_export() 
    {
        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: attachment; filename=\"users.csv\"");
        
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Card');
        $this->loadModel('Service');
        
        $d['profiles'] = array();
        $d['Allprofiles'] = array_reverse($this->Profile->findAll());
        $array = $d['Allprofiles'];
        
        $csv = "Id;Email;Nom;Prenom;Date de naissance;Telephone;Date d'inscription;Mark;Date d'expiration;Cryptogram;Expert\n";
        // construction de chaque ligne 
        foreach ($d['Allprofiles'] as $k => $v) 
        {
            // On récupère les services
           $users = $this->User->findBy(array('conditions' => array('profile_id' => $v->Profile->id)));
           foreach ($users as $m => $n) 
           {
                $card = $this->Card->findOneBy(array('conditions' => array('profile_id' => $n->User->profile_id)));
                $services = $this->Service->findBy(array('conditions' => array('profile_id' => $n->User->profile_id)));
                $n->User->service = ($services) ? 'Oui' : 'Non';
                $n->User->card = $card;  
           }
           
           $csv .= $v->Profile->id . ';' . $v->Profile->email . ';' . $n->User->last_name . ';' . $n->User->first_name. ';' . $n->User->birth_date. ';' . $n->User->phone. ';' . $n->User->date_inscription. ';' . $n->User->card->Card->mark. ';' . $n->User->card->Card->expiry_date. ';' . $n->User->card->Card->cryptogram. ';'.$n->User->service ."\n"; // le \n final entre " "
        }

        echo $csv;
        exit();
    }
    
    // Compagne de promotion
    public function admin_promo() {
        
        $this->loadModel('Campagne');

        $d['campagne'] = $this->Campagne->findAll();
        
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
        
        
        $d['idcompagne'] = $id;
        $d['services'] = array_reverse($this->Service->findAll());
        foreach ($d['services'] as $k => $v) {

            // On récupère le nom et date d'inscription
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $v->Service->user = $user->last_name . ' ' . $user->first_name;
            $v->Service->date = $user->date_inscription;
            
            $username = ($v->Service->username == '') ? $user->last_name . '-' . $user->first_name : $v->Service->username;
            $v->Service->slug = clean($username);
            
            $affectation = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));
            if($affectation)
            {
                if($affectation->Affecter->id_campagne == $id)
                {
                    $v->Service->affectation = 1;
                }
                else
                {
                    $v->Service->affectation = -1;
                }
                
            }
            else
            {
                $v->Service->affectation = 0;
            }
            
            
        }
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
        
        $exist = $this->Affecter->findOneBy(array('conditions' => array('id_campagne' => $id1, 'id_service' => $id)));
        if(!$exist)
        {
            $Affecter->id_campagne = $id1;
            $Affecter->id_service = $id;
            $this->Affecter->save($Affecter);
        }
        else
        {
            $this->Affecter->delete($exist->Affecter->id);
        }
        

        $this->redirect('administration/affect/' . $id1);
        die();
    }
}

?>