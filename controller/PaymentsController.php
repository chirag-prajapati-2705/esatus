<?php

    class PaymentsController extends Controller {

        public $uses = array('User');

        /**
         * Pages.
         */
        public function buy() {

            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profil_id'=>$this->Session->profile('id'))));

            if (!$user) {
                $this->redirect('users/create');
                die();
            }

            if (!$this->request->data) {
                $this->redirect('users/credits');
                die();
            }

            $data = $this->request->data;

            $d['title_for_layout'] = 'Mon compte > Mes crédits > Recharger';
            $d['description_for_layout'] = "";
            $d['breadcrumb_for_layout'] = array(
                array(
                    'title' => 'Mon compte',
                    'type'  => 'url',
                    'url'   => Router::url('users/index')
                ),
                array(
                    'title' => 'Mes crédits',
                    'type'  => 'url',
                    'url'   => Router::url('users/credits')
                ),
                array(
                    'title' => 'Recharger',
                    'type'  => 'current'
                )
            );
            $d['scripts'] = array('paiement');
            $d['index'] = 4;
            $d['user'] = current($user);


            // Préparation des variables avant envoie.

            $d['site'] = '1999888';
            $d['rank'] = '32';
            $d['id'] = '1686319';
            $d['amount'] = $data->amount * 100;
            $d['currency'] = 978;
            $d['payment'] = 'CARTE';
            $d['cmd'] = $this->Session->read('id').'-'.$this->Session->profile('id'); 
            $d['email'] = $this->Session->profile('email');
            $d['return'] = 'auto:A;amount:M;ident:R;trans:T;handle:U;erreur:E';
            $d['perform'] = Router::url('payments/thanks');
            $d['refuse'] = Router::url('payments/refuse');
            $d['cancel'] = Router::url('users/credits');
            $d['server'] = Router::url('server/payments/response');
            $d['hash'] = 'SHA512';
            $d['datetime'] = date("c"); 

            $msg =  "PBX_SITE=".$d['site'].
                    "&PBX_RANG=".$d['rank'].
                    "&PBX_IDENTIFIANT=".$d['id'].
                    "&PBX_TOTAL=".$d['amount'].
                    "&PBX_TYPEPAIEMENT=".$d['payment'].
                    "&PBX_DEVISE=".$d['currency'].
                    "&PBX_REFABONNE=".$d['email'].
                    "&PBX_CMD=".$d['cmd'].
                    "&PBX_PORTEUR=".$d['email'].
                    "&PBX_RETOUR=".$d['return'].
                    "&PBX_EFFECTUE=".$d['perform'].
                    "&PBX_REFUSE=".$d['refuse'].
                    "&PBX_ANNULE=".$d['cancel'].
                    "&PBX_REPONDRE_A=".$d['server'].
                    "&PBX_HASH=".$d['hash'].
                    "&PBX_TIME=".$d['datetime'];

            $key = pack("H*",'0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF');

            $d['hmac'] = strtoupper(hash_hmac('sha512',$msg,$key));

            $this->layout = 'user';
            $this->set($d);

        }

        public function refuse() {

            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profil_id'=>$this->Session->profile('id'))));

            if (!$user) {
                $this->redirect('users/create');
                die();
            }

            $d['title_for_layout'] = 'Mon compte > Mes crédits > Recharger > Paiement Refusé';
            $d['description_for_layout'] = '';
            $d['index'] = 4;
            $d['user'] = current($user);

            $this->layout = 'user';
            $this->set($d);
        }

        public function thanks() {

            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profil_id'=>$this->Session->profile('id'))));

            if (!$user) {
                $this->redirect('users/create');
                die();
            }

            session_regenerate_id();
            $_SESSION['id'] = session_id();

            $d['title_for_layout'] = 'Mon compte > Mes crédits > Recharger > Paiement accepté';
            $d['description_for_layout'] = '';
            $d['index'] = 4;
            $d['user'] = current($user);

            $this->layout = 'user';
            $this->set($d);
            
        }

        public function server_response() {

            if (isset($_GET['auto'])) {

                // Hack qui me permet de contouner le problème des identifiants de session à longueur variable.
                $params = explode('-',$_GET['ident']);
                // On récupère l'id de session du client...    
                $session_id = $params[0];
                // ... puis son id de profil    
                $id = $params[1];

                $credit = $_GET['amount']/100;

                $handle = $_GET['handle'];

                // On charge le profil
                $this->loadModel('Profile');
                $profil = current($this->Profile->findOneBy(array('conditions'=>array('id'=>$id))));
                $profil->credit += $credit;
                $profil->handle = urldecode($handle);
                $this->Profile->save($profil);

                // On enregistre la transaction
                $this->loadModel('Transaction');
                $transaction = new stdClass();
                $transaction->session_id = $session_id;
                $transaction->profil_id = $id;
                $transaction->amount = $credit;
                $transaction->date = date('Y-m-d');
                $this->Transaction->save($transaction);

                // Envoi d'un mail de confirmation d'achat au client.
                $data = new stdClass();
                $data->email = $profil->email;
                $data->amount = $credit;
                $data->session_id = $session_id;
                $data->url = Router::url("pdf/bills/credits/id:".$session_id);

                Mailer::transaction($data);

            }

        }
        
    }

?>