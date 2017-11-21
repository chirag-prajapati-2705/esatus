<?php

    class RatingsController extends Controller {

        public $uses = array('Card','Call','User','Service','Rating');

        public function rate($id) {   

        	if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if (!$user) {
                $this->redirect('users/create');
                die();
            }

            sleep(2);

            $card = $this->Card->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            //modified by andru
            if (!$card) {
                $this->loadModel('RibClient');
                $rib = $this->RibClient->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
                if(!$rib)
                {
                    $this->redirect('users/verify');
                    die();
                }
            }

            if (!isset($id)) {
            	$this->redirect('users/calls');
                die();
            }

            $rating = $this->Rating->findOneBy(array('conditions'=>array('session_id'=>$id)));

            if ($rating) {
            	$this->redirect('users/calls');
                die();
            }

            $call = $this->Call->findOneBy(array('conditions'=>array('session_id'=>$id,'user_id'=>$user->User->id)));

            if (!$call) {
            	$this->redirect('users/calls');
                die();
            }

            $service = $this->Service->findOneBy(array('conditions'=>array('id'=>$call->Call->service_id)));

            if (!$service) {
            	$this->redirect('users/calls');
                die();
            }

            $infos = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$service->Service->profile_id)));

            if (!$infos) {
            	$this->redirect('users/calls');
                die();
            }

            $service->Service->user = current($infos);

            if ($this->request->data) {
                $rules = $this->Rating->rules;
                $data = $this->request->data;

                if ($this->Rating->validate($rules,$data)) {
                    
                    $data->session_id = $id;
                    $data->profile_id = $this->Session->profile('id');
                    $data->service_id = $service->Service->id;
                    $data->date = date('Y-m-d');

                    if ($this->Rating->save($data)) {
                        $this->redirect('users/calls');
                        die();
                    } else {
                        $this->Session->setFlash('Une erreur est survenue.');
                    } 
                    
                } 
            }

            $d['title_for_layout'] = 'Espace client > Mes appels > Noter';
            $d['description_for_layout'] = "";
            $d['breadcrumb_for_layout'] = array(
                array(
                    'title' => 'Espace client',
                    'type'  => 'url',
                    'url'   => Router::url('users/index')
                ),
                array(
                    'title' => 'Mes appels',
                    'type'  => 'url',
                    'url'   => Router::url('users/calls')
                ),
                array(
                    'title' => 'Noter',
                    'type'  => 'current'
                )
            );
            $date = $call->Call->start;
            $day = explode('-',substr($date,0,10));
            $hour = substr($date,11,5);

            $d['date'] = 'Appel du '.$day[2].'/'.$day[1].'/'.$day[0].' à '.$hour;
            $d['service'] = current($service);
            $d['id'] = $id;

            $this->layout = 'user';
            $this->set($d);
            
        }
        
    }

?>