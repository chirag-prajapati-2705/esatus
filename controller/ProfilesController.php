<?php

class ProfilesController extends Controller {

    public $uses = array('Call', 'Profile', 'User', 'Service', 'Category', 'Subcategory', 'Issue', 'Card', 'Balance', 'Availability', 'Calldetail', 'Callprogress', 'Preautorisation', 'Callstate');

    public function signin($affiliation) {


        $d['affiliation'] = $affiliation;
        
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
                $std->affiliation = $affiliation;
                
               
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
                            $stdSource->source = $_SESSION['source'];
                            $this->Source->save($stdSource);
                            unset($_SESSION['source']);
                            //envoie sms en utilsant netmessage
                            /*$sm = new sendsms();
                            //$sm -> send_sms_p2p($data->first_name,$data->last_name,$data->pseudo, $data->phone);
                            $sm->send_sms_p2p($data->pseudo, $data->phone);
                            $sm->send_sms_pub($data->phone);*/

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

        if ($this->Session->isLogged()) {
            $this->redirect('users/thanks');
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

        $this->set($d);
    }


    // Inscription landing page
    public function signinlanding($affiliation) {

        if ($this->request->data) {

            $this->loadModel('User');
            $this->loadModel('Source');
            $this->loadModel('Question');

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
                $d['affiliation'] = $affiliation;
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
                            $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Porfile->id)));
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

                            // Insertion question 
                            $stdQuestion = new stdClass();
                            $stdQuestion->question = $data->question;
                            $stdQuestion->profile_id = $this->Profile->id;
                            $this->Question->save($stdQuestion);

                            //Source visite
                            $stdSource = new stdClass();
                            $stdSource->id_profile = $this->Profile->id;
                            $stdSource->source = $_SESSION['source'];
                            $this->Source->save($stdSource);

                            //envoie sms en utilsant netmessage
                            /*$sm = new sendsms();
                            //$sm -> send_sms_p2p($data->first_name,$data->last_name,$data->pseudo, $data->phone);
                            $sm->send_sms_p2p($data->pseudo, $data->phone);
                            $sm->send_sms_pub($data->phone);*/

                            //insertion parainage mail user + mail sender
                            if ($sender == "") {
                                //nothing to do, simple inscription
                            } else {
                                $this->User->parainage($email, $sender);
                            }
                            ///////////////////////fin envoie message et mis a jour bade de donnee 
                            // Envoi de l'email de création de compte au client
                            $std->password = $password;
                            $std->id  = $this->User->id;
                            $std->pseudo = $data->pseudo;
                            $std->question = $data->question;
                            $std->category = $data->category;
                            Mailer::account($std);
                            Mailer::infowebmaster($std);
                            Mailer::accountlanding($std, $stdUser);
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

        $this->set($d);
    }
    
    //Confirmation Email Inscription
    public function confirmation($id) {
        $this->loadModel('Profile');
        $Profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $id))));
        
        $data->id = $Profile->id;
        $data->email = $Profile->email;
        $data->password = $Profile->password;
        $data->validated = 1;

        $this->Profile->save($data);
        if ($this->Session->isLogged()) {

            $this->redirect('users/index');
            die();
        } else {
            $this->redirect('profiles/login');
            die();
        }
    }
    
    public function signinExpert() {

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
                            $stdSource->source = $_SESSION['source'];
                            $this->Source->save($stdSource);

                            //envoie sms en utilsant netmessage
                            /*$sm = new sendsms();
                            //$sm -> send_sms_p2p($data->first_name,$data->last_name,$data->pseudo, $data->phone);
                            $sm->send_sms_p2p($data->pseudo, $data->phone);
                            $sm->send_sms_pub($data->phone);*/

                            //insertion parainage mail user + mail sender
                            if ($sender == "") {
                                //nothing to do, simple inscription
                            } else {
                                $this->User->parainage($email, $sender);
                            }
                            ///////////////////////fin envoie message et mis a jour bade de donnee 
                            // Envoi de l'email de création de compte au client
                            $std->password = $password;
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

            $this->redirect('users/index');
            die();
        }

        $d['title_for_layout'] = 'Compte expert';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Nous rejoindre',
                'type' => 'current',
            )
        );

        $this->set($d);
    }

    public function signin2() {

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

                            $jour = $data->jj;
                            $mois = $data->mm;
                            $annee = $data->aa;
                            $the_birth_date = "$jour-$mois-$annee";
                            $timestamp = strtotime($the_birth_date);


                            // Converti la date entrée par l'utilisteur en date mySql
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

                            // Source visite
                            $stdSource = new stdClass();
                            $stdSource->id_profile = $this->Profile->id;
                            $stdSource->source = $_SESSION['source'];
                            $this->Source->save($stdSource);

                            /*$sm = new sendsms();
                            if (!(str_starts_with($phone, "06")) || !(str_starts_with($phone, "07")) || !(str_starts_with($phone, "261"))) {
                                //$sm -> send_sms_p2p($data->first_name,$data->last_name,$data->pseudo, $data->phone);
                                $sm->send_sms_p2p($data->pseudo, $data->phone);
                                //publicite
                                $sm->send_sms_pub($data->phone);
                            } else {
                                $tbRetour[] = $sm->send_wav_inscription($phone);
                                $tbRetour[count($tbRetour) - 1]->Target = "voice_liste";
                                $tbRetour[count($tbRetour) - 1]->WavMsg = "message voice";
                                $tbRetour[count($tbRetour) - 1]->WavRep = "";
                                $tbRetour[count($tbRetour) - 1]->Pwd = "4UCONSULTING2014";
                                $tbRetour[count($tbRetour) - 1]->media = "voice";
                            }*/
                            //$sm = new sendsms();
                            //$sm -> send_sms_p2p($data->first_name,$data->last_name,$data->pseudo, $data->phone);
                            //insertion parainage mail user + mail sender
                            if ($sender == "") {
                                //nothing to do, simple inscription
                            } else {
                                $this->User->parainage($email, $sender);
                            }

                            // Envoi de l'email de création de compte au client
                            $std->password = $password;
                            Mailer::account($std);
                            Mailer::infowebmaster($std);
                            $this->redirect('users/index');
                            die();
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

        $this->set($d);
    }

    public function str_starts_with($haystack, $needle) {
        return strpos($haystack, $needle) === 0;
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
        //appel de popup        
        //$this->redirect('pages/popup');
        //die(); 



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

        //
        unset($_SESSION['profile']);
        //$this->redirect('pages/popup');

        $this->redirect('pages/index');
        //$this->redirect('pages/popup');
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

//inclusion classe pour l'envoie de sms, mail, etc
//include 'netmessage/NetmessageClient.class.php';
//include 'netmessage/class/Authenticate.class.php';
//define("URL_WSDL", "http://webservices.netmessage.com/PROD01/webservices/wsdl/NetMessage.wsdl");

///
class sendsms {

//public function send_sms_p2p($nom, $prenom, $pseudo, $phone)
    public function send_sms_p2p($pseudo, $phone) {

        //print (" called sending msg 2");
        $tbOptions = array();
        //print (" called sending msg ok array");

        $obj = new NetMessage($tbOptions, URL_WSDL);
        //print_r($obj);
        //print (" called sending ok instance netMessage");
        $auth = new Authenticate();
        //print_r($auth);
        //print (" called sending msg 3");
        $auth->Username = "DDELETREZ";
        $auth->Password = "4UCONSULTING2014";
        $auth->SenderId = "";
        $auth->AccountKey = "907356067";
        $auth->AccountName = "";
        $auth->Server = "ABSI01";
        //print "sending this msg...";
        $message = "Bonjour $pseudo , Merci pour votre inscription sur esatus.fr. Rendez-vous sur http://www.esatus.fr/connexion . Cordialement";
        $ret = $obj->SendSms($phone, $message, $auth, "testGM 1.5");


        // print_r($ret);
        return $ret;
    }

    public function send_sms_pub($phone) {

        //print (" called sending msg 2");
        $tbOptions = array();
        //print (" called sending msg ok array");

        $obj = new NetMessage($tbOptions, URL_WSDL);
        //print_r($obj);
        //print (" called sending ok instance netMessage");
        $auth = new Authenticate();
        //print_r($auth);
        //print (" called sending msg 3");
        $auth->Username = "DDELETREZ";
        $auth->Password = "4UCONSULTING2014";
        $auth->SenderId = "";
        $auth->AccountKey = "907356067";
        $auth->AccountName = "";
        $auth->Server = "ABSI01";
        //print "sending this msg...";
        $pub = "Suite a votre inscription sur www.esatus.fr consulte 1 de nos experts gagner 1 iphone 6 tirage tous les 100 appel,25 euro de consultation gratuite ?";
        $ret = $obj->SendSms($phone, $pub, $auth, "testGM 1.5");


        // print_r($ret);
        return $ret;
    }

    function uploadWav($path) {

        $auth = new Authenticate();
        $auth->Username = "DDELETREZ";
        $auth->Password = "4UCONSULTING2014";
        $auth->AccountKey = "906909397";
        $auth->AccountName = "";
        $auth->Server = "ABSI01";
        $auth->SenderId = "";


        $tbOptions = array();
        $obj = new NetMessage($tbOptions, URL_WSDL);

        if ($hdl = fopen($path, "r")) {
            $content = fread($hdl, filesize($path));
            $content = base64_encode($content);

            $monwav = $obj->UploadWav($auth, "testSonNM", $content);
        } else
            $tbR["WavError"] = "pas de lecture du fichier";
        $tbR["WavNumber"] = $monwav->WavNumber;
        $tbR["WavServer"] = $monwav->WavServer;

        return $tbR;
    }

    function GetWavs() {
        $auth = new Authenticate();
        $auth->Username = "DDELETREZ";
        $auth->Password = "4UCONSULTING2014";
        $auth->AccountKey = "906909397";
        $auth->AccountName = "";
        $auth->Server = "ABSI01";
        $auth->SenderId = "";
        $tbOptions = array();
        $obj = new NetMessage($tbOptions, URL_WSDL);
        $ret = $obj->GetWavsObjectsList($auth);
        return $ret;
    }

    function send_wav_inscription() {
        $tbOptions = array();
        $obj = new NetMessage($tbOptions, URL_WSDL);
        $auth = new Authenticate();
        $auth->Username = "DDELETREZ";
        $auth->Password = "4UCONSULTING2014";
        $auth->AccountKey = "906909397";
        $auth->AccountName = "";
        $auth->Server = "ABSI01";
        $auth->SenderId = "";
        echo "presending...";

        #Section d�di�e � la liste d'envoi
        $contents = base64_encode("voice\r\n0982323527");
        echo "sending0...";
        $objList = new RecipientsList();
        echo "sending0...";
        $objList->Name = "maliste";
        echo "sending1...";
        $objList->Format = "csv";
        echo "sending2...";
        $objList->EncodingMethod = "base64"; //pour �viter les probl�mes de gestion de carat�res sp�ciaux lors du transport HTTP
        echo "sending3...";
        $objList->MediaType = "voice";
        echo "sending4...";
        $objList->Content = $contents;
        //$objList->Stored=TRUE;
        echo "sending... ok";

        #creation des objets message vocal


        $tbWav = uploadWav('./netmessage/wav/inscription.mp3');

        $wavScenario = new WavScenario();
        $wavScenario->VoiceMessage = new VoiceMessage();
        $wavScenario->VoiceMessage->Wav = new WavMessage();
        $wavScenario->VoiceMessage->Wav->Key = $tbWav["WavNumber"]; //WavNumber
        $wavScenario->VoiceMessage->Wav->Server = $tbWav["WavServer"]; //Server de stockage du Wav

        $wavScenario->AnswerPhone = new AnswerPhoneMessage();
        $wavScenario->AnswerPhone->Wav = new WavMessage();
        $wavScenario->AnswerPhone->Wav->Key = $tbWav["WavNumber"]; //WavNumber
        $wavScenario->AnswerPhone->Wav->Server = $tbWav["WavServer"]; //Server de stockage du Wav

        $campagne = new Campaign();
        $campagne->Name = "test unitaire voix liste";
        $camapgne->BillingCode = "";
        $deliveryVoice = new DeliveryVoice();
        # affectation de l'objet liste � l'objet delivery
        $deliveryVoice->RecipientsCustomerList = $objList;

        # affectation de l'objet wav � l'objet delivery
        $deliveryVoice->WavScenario = $wavScenario;
        $deliveryVoice->DeliveryMustStopSchedule = ""; //facultatif, date d'arret imperatif de l'operation (YYYY-MM-DD HH:MM:SS)ex : 2014-04-30 10:00:00
        $deliveryVoice->DeliverySchedule = ""; //facultatif date de programmation de la campagne (YYYY-MM-DD HH:MM:SS)ex : 2014-04-30 10:00:00
        # creation d'une tranche horraire de diffusion

        $campagne->DeliveryVoice = $deliveryVoice;
        $ret = $obj->SendWavMailling($campagne, $auth);

        return $ret;
    }
}

?>