<?php

class Profiles2Controller extends Controller {

    public $uses = array('Profile');

    
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
                            
                            $stdSource = new stdClass();
                            $stdSource->id_profile = $this->Profile->id;
                            $stdSource->source = $_SESSION['source'];
                            $this->Source->save($stdSource);
                            unset($_SESSION['source']);
                            // Envoi de l'email de création de compte au client
                            $std->password = $password;
                            Mailer::account($std);
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

        $d['title_for_layout'] = 'Poser vos questions  sur Esatus, nos experts vous répondent par téléphone et email';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Nous rejoindre',
                'type' => 'current',
            )
        );

        $this->layout = 'none';
        $this->set($d);
    }
    
}

?>