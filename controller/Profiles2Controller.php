<?php

class Profiles2Controller extends Controller {

    public $uses = array('Profile');

    public function signin2($email, $nom, $prenom) {

        if ($this->request->data) {

            $this->loadModel('User');
            $this->loadModel('Source');
            
            $rules = array_merge($this->Profile->rules, $this->User->rules);

            $data = $this->request->data;

            if ($this->Profile->validate($rules, $data)) {

                // Les données soumises respectent les règles du formulaire
                // Création du nouveau profil
                $std = new stdClass();
                $std->email = $data->email;
                $std->password = $data->password;
                $std->validated = 0;
                $std->affiliation = $data->affiliation;
                
                $email = $data->email;
                $password = $data->password;
                $password_crypted = sha1($data->password);
                $data->birth_date = $data->jj . '-' . $data->mm . '-' . $data->aa;
                // Vérification de l'existence du profil en base (email doit être unique)
                $profile = $this->Profile->findOneBy(array('conditions' => array('email' => $email)));

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
                            $timestamp = strtotime($data->birth_date);
                            $birth_date = date("Y-m-d H:i:s", $timestamp);

                            // Création d'un nouvel utilisateur
                            $stdUser = new stdClass();
                            $stdUser->profile_id = $this->Profile->id;
                            
                            $stdUser->first_name = '';
                            $stdUser->last_name = '';
                            $stdUser->phone = $data->phone;
                            $stdUser->pseudo = $data->pseudo;
                            $stdUser->birth_date = $birth_date;
                            $stdUser->date_inscription = date('Y-m-d H:i:s');
                            $this->User->save($stdUser);
                            
                            //Source visite
                            $stdSource = new stdClass();
                            $stdSource->id_profile = $this->Profile->id;
                            $stdSource->source = $_SESSION['source'];
                            $this->Source->save($stdSource);
                            unset($_SESSION['source']);
                            
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

        if ($this->Session->isLogged()) {

            $this->redirect('categories/index');
            die();
        }

        $d['title_for_layout'] = 'Poser vos questions  sur Esatus, nos experts vous répondent par téléphone et email';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Nous rejoindre',
                'type' => 'current',
            )
        );
        
        $d['email'] = $email;
        $this->layout = 'none';
        $this->set($d);
    }

    public function signout() {
        
    }

    public function login() {

        if ($this->request->data) {
            $rules = $this->Profile->rules;
            $data = $this->request->data;
            if ($this->Profile->validate($rules, $data)) {
                $email = $data->email;
                $password = sha1($data->password);
                $profile = $this->Profile->findOneBy(array('conditions' => array('email' => $email, 'password' => $password)));
                if ($profile) {
                    $this->Session->write('profile', current($profile));
                    $this->loadModel('Service');
                    $this->loadModel('Availability');
                    $services = $this->Service->findBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
                    foreach ($services as $k => $v) {
                        $v = current($v);
                        $availabilities = $this->Availability->findOneBy(array('conditions' => array('service_id' => $v->id)));
                        if ($availabilities) {
                            $availabilities = current($availabilities);
                            $availabilities->status = 1;
                            $this->Availability->save($availabilities);
                        }
                    }
                } else {
                    $profile = $this->Profile->findOneBy(array('conditions' => array('email' => $email)));
                    if ($profile) {
                        $this->Session->setFlash('Le couple email / mot de passe est erroné.');
                    } else {
                        $this->Session->setFlash('Aucun compte n\'est lié à cette adresse mail.');
                    }
                }
            }
        }

        if ($this->Session->isLogged()) {
            $this->redirect('users/index');
            die();
        }

        $d['title_for_layout'] = 'Connexion';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Connexion',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function logout() {

        $this->loadModel('Service');
        $this->loadModel('Availability');
        $services = $this->Service->findBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
        foreach ($services as $k => $v) {
            $v = current($v);
            $availabilities = $this->Availability->findOneBy(array('conditions' => array('service_id' => $v->id)));
            if ($availabilities) {
                $availabilities = current($availabilities);
                $availabilities->status = 0;
                $this->Availability->save($availabilities);
            }
        }

        unset($_SESSION['profile']);
        $this->redirect('pages/index');
        die();
    }

    public function password() {

        if ($this->request->data) {
            $rules = $this->Profile->rules;
            $data = $this->request->data;
            if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
                $email = $data->email;
                $profile = $this->Profile->findOneBy(array('conditions' => array('email' => $email)));
                if ($profile) {
                    $data->id = $this->Session->read('id') . '-' . $profile->Profile->id;
                    Mailer::password($data);
                    $this->Session->setFlash('Vous allez recevoir un mail contenant les instructions à suivre dans quelques instants.', 'info');
                } else {
                    $this->Session->setFlash('Aucun compte n\'est lié à cette adresse mail.');
                }
            }
        }

        if ($this->Session->isLogged()) {
            $this->redirect('users/index');
            die();
        }

        $d['title_for_layout'] = 'Mot de passe oublié';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Mot de passe oublié',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function reset($id) {

        if (!isset($id)) {
            $this->redirect('profiles/password');
            die();
        }

        $params = explode('-', $id);

        if ($params[0] != $this->Session->read('id')) {
            $this->redirect('profiles/password');
            die();
        }

        if ($this->request->data) {
            $rules = $this->Profile->rules;
            $data = $this->request->data;
            if ($data->password != '') {
                $data->id = $params[1];
                $data->password = sha1($data->password);
                if ($this->Profile->save($data)) {
                    $profile = $this->Profile->find($this->Profile->id);
                    $this->Session->write('profile', current($profile));
                    $this->redirect('users/index');
                    die();
                } else {
                    $this->Session->setFlash('Une erreur est survenue.');
                }
            }
        }

        $d['title_for_layout'] = 'Changement de mot de passe';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Changement de mot de passe',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

}

?>