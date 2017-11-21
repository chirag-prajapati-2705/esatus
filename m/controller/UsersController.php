<?php

    class UsersController extends Controller {

        public $uses = array('User','Card','Call','Service','Category','Subcategory','Rating', 'Profile');

        /**
         * Pages.
         */
        public function create() {

            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if ($user) {
                $this->redirect('users/index');
                die();
            }

            if ($this->request->data) {
                
                $rules = $this->User->rules;
                $data = $this->request->data;

                $birth_date = $data->year.'-'.$data->month.'-'.$data->day;
                unset($data->year);
                unset($data->month);
                unset($data->day);

                if ($data->cgu == 'on') {

                    unset($data->cgu);

                    if ($this->User->validate($rules,$data)) {
                    
                        $data->profile_id = $this->Session->profile('id');
                        $data->last_name = strtoupper($data->last_name);
                        $data->first_name = ucfirst(strtolower($data->first_name));
                        $data->birth_date = $birth_date;
                        $data->date_inscription = date('Y-m-d H:i:s');

                        if ($this->User->save($data)) {

                            $this->redirect('users/verify');
                            die();

                        } else {

                            $d['result'] = array(
                                'status'  => 'super-error',
                                'message' => 'Une erreur est survenue.'   
                            );

                        } 
                        
                    } 

                } else {

                    $d['check'] = 'Veuillez lire et accepter les conditions g�n�rales d\'utilisation.';

                }
                
            }

            
            $year = range(date('Y')-100,date('Y')-18);
            $d['years'] = array_reverse($year);
            $d['months'] = array("01"=>"janvier", "02"=>"f�vrier", "03"=>"mars", "04"=>"avril", "05"=>"mai", "06"=>"juin", "07"=>"juillet", "08"=>"août", "09"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"d�cembre");
            $d['days'] = range(1,31);
            
            $d['title_for_layout'] = 'Mon compte > Mes informations';
            $d['description_for_layout'] = "";
            $d['breadcrumb_for_layout'] = array(
                array(
                    'title' => 'Mes informations',
                    'type'  => 'current',
                )
            );

            $this->set($d);

        }

        public function verify() {
            
            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if (!$user) {
                $this->redirect('users/create');
                die();
            }

            $card = $this->Card->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if ($card) {
                $this->redirect('users/index');
                die();
            }   

            if ($this->request->data) {
                
                $data = $this->request->data;

                $porteur = str_replace(' ','',$data->numero);
                $dateval = $data->month.substr($data->year,2,2);
                $cvv = $data->crypto;

                // if ($porteur != '0000' && $cvv != '000') {

                    // URL pr�production
                    $url = "https://ppps.paybox.com/PPPS.php";

                    // Num�ro de la question
                    $this->loadModel('Issue');
                    $issue = current($this->Issue->find(1));

                    // R�f�rence Paybox manuel en francais V4_84.pdf - page 43 
                    $params = array(
                        'VERSION' => '00104',
                        'DATEQ' => date('dmYHis'),
                        'TYPE' => '00056',
                        'NUMQUESTION' => str_pad($issue->number,10,"0",STR_PAD_LEFT),
                        'SITE' => '1101352',
                        'RANG' => '001',
                        'CLE' => 'luguwPBf',
                        'MONTANT' => '100', // 1.00 €
                        'DEVISE' => '978',
                        'REFERENCE' => 'M-'.$this->Session->profile('id'),
                        'REFABONNE' => $this->Session->profile('email'),
                        'PORTEUR' => $porteur,
                        'DATEVAL' => $dateval,
                        'CVV' => $cvv,
                        'ACTIVITE' => '027'
                    );

                    $issue->number++;
                    $this->Issue->save($issue);

                    // Cr�ation de la requête POST
                    $post = '';
                    foreach ($params as $k => $v) {
                        $post .= $k.'='.$v.'&';
                    }
                    $post = substr($post, 0, -1);
                      
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    if (preg_match('`^https://`i', $url))  { 
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
                        $vars    = explode('=',$value);
                        $vars[0] = strtolower($vars[0]);
                        $response->$vars[0] = $vars[1];
                    }

                    if (isset($response->codereponse) && $response->codereponse == '00000') {

                        $card = new stdClass();
                        $card->profile_id = $this->Session->profile('id');
                        $card->mark = $response->porteur;
                        $card->expiry_date = $dateval;
                        $card->cryptogram = $cvv;

                        if ($this->Card->save($card)) {

                            $this->redirect('users/index');
                            die();

                        } else {

                            $this->Session->setFlash('Une erreur est survenue.');

                        } 

                    } else {

                        $this->Session->setFlash('Votre carte semble invalide.');

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

            $d['years'] = range(date('Y'),date('Y')+15);
            $d['months'] = array("01"=>"janvier", "02"=>"f�vrier", "03"=>"mars", "04"=>"avril", "05"=>"mai", "06"=>"juin", "07"=>"juillet", "08"=>"août", "09"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"d�cembre");

            $d['title_for_layout'] = 'Mon compte > Ma carte';
            $d['description_for_layout'] = "";
            $d['breadcrumb_for_layout'] = array(
                array(
                    'title' => 'Ma carte',
                    'type'  => 'current',
                )
            );

            $this->set($d);

        }

        public function index() {

            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
            
            if (!$user) {
                // L'utilisateur n'existe pas
                // Redirection vers la page de cr�ation d'un utilisateur
                $this->redirect('users/create');
                die();
            }
            echo "<iframe src=\"https://www.wtrackssl01.fr/tr/tracklead.php?idcpart=12869&email=".$this->Session->profile('email')."&idr=".$this->Session->profile('id')."\" width=\"0\" height=\"0\" frameborder=\"0\" scrolling=\"no\" ></iframe>";

            //$card = $this->Card->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
            $email = $this->Profile->findOneBy(array('conditions'=>array('id'=>$this->Session->profile('id'))));
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
                    'type'  => 'current',
                )
            );
            
            $d['user'] = current($user);
            
            $this->layout = 'user';
            $this->set($d);

        }

        public function datas() {

            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

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

                $birth_date = $data->year.'-'.$data->month.'-'.$data->day;
                unset($data->year);
                unset($data->month);
                unset($data->day);

                if ($this->User->validate($rules,$data)) {
                    
                    $data->id = $user->User->id;
                    $data->profile_id = $this->Session->profile('id');
                    $data->last_name = strtoupper($data->last_name);
                    $data->first_name = ucfirst(strtolower($data->first_name));
                    $data->birth_date = $birth_date;

                    // Get all services from this user
                    $services = $this->Service->findBy(array(
                        'conditions'=>'profile_id = '.$this->Session->profile('id'),
                        'order'=>'id DESC'
                    ));
                    // Update image name for each services
                    foreach ($services as $k => $v) {
                        $service = new stdClass;
                        $service->id = $v->Service->id;
                        $img_oldname = $v->Service->img; // old image name
                        $img_newname = strtolower($data->last_name.'-'.$data->first_name.'-'.$v->Service->id.'.jpg'); // new iamge name
                        if(rename (BIN.'/images/services/'.$img_oldname,  BIN.'/images/services/'.$img_newname) === true){ // Rename the image file
                            $service->img = $img_newname; // Save new image name in the service
                            $this->Service->save($service); // Save the service in db  
                        };
                    }

                    if ($this->User->save($data)) {
                        
                        $this->Session->setFlash('Vos informations ont �t� enregistr�es.','info');
                        $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
                    } else {
                        $this->Session->setFlash('Une erreur est survenue.');
                    } 
                    
                } 
            }            

            $year = range(date('Y')-100,date('Y')-18);
            $d['years'] = array_reverse($year);
            $d['months'] = array("01"=>"janvier", "02"=>"f�vrier", "03"=>"mars", "04"=>"avril", "05"=>"mai", "06"=>"juin", "07"=>"juillet", "08"=>"août", "09"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"d�cembre");
            $d['days'] = range(1,31);

            $b = split('-',$user->User->birth_date);
            $d['y'] = $b[0];
            $d['m'] = $b[1];
            $d['d'] = $b[2];

            $d['title_for_layout'] = 'Espace client > Mes informations';
            $d['description_for_layout'] = "";
            $d['breadcrumb_for_layout'] = array(
                array(
                    'title' => 'Espace client',
                    'type'  => 'url',
                    'url'   => Router::url('users/index')
                ),
                array(
                    'title' => 'Mes informations',
                    'type'  => 'current'
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

            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if (!$user) {
                $this->redirect('users/create');
                die();
            }

            $card = $this->Card->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            // if (!$card) {
            //     $this->redirect('users/verify');
            //     die();
            // }

            $d['title_for_layout'] = 'Espace client > Mes appels';
            $d['description_for_layout'] = "";
            $d['breadcrumb_for_layout'] = array(
                array(
                    'title' => 'Espace client',
                    'type'  => 'url',
                    'url'   => Router::url('users/index')
                ),
                array(
                    'title' => 'Mes appels',
                    'type'  => 'current'
                )
            );
            $d['user'] = current($user);  
            $d['calls'] = $this->Call->findBy(array(
                'conditions'=>'user_id = '.$user->User->id.' AND (status = 310 OR status = 330 OR status = 350)',
                'order'=>'id DESC'
            )); 
            foreach ($d['calls'] as $k=>$v) {
                // L'expert
                $service = current($this->Service->findOneBy(array('conditions'=>array('id'=>$v->Call->service_id))));
                $category = current($this->Category->findOneBy(array('conditions'=>array('id'=>$service->category_id))));
                $subcategory = current($this->Subcategory->findOneBy(array('conditions'=>array('id'=>$service->subcategory_id))));
                $user = current($this->User->findOneBy(array('conditions'=>array('profile_id'=>$service->profile_id))));
                $v->Call->url = Router::url('services/view/cat:'.$category->slug.'/subcat:'.$subcategory->slug.'/slug:'.clean($user->last_name.'-'.$user->first_name).'/id:'.$service->id);
                $expert = ($service->username == '') ? $user->last_name.' '.$user->first_name:$service->username;
                $v->Call->expert = $expert;
                // La dur�e de la communication
                $v->Call->duration = elapsedTime($v->Call->start,$v->Call->end);
                // La date de la communication
                $date = substr($v->Call->start,0,10);
                $date = explode('-',$date);
                $v->Call->date = $date[2].'/'.$date[1].'/'.$date[0];
                // La note de l'appel
                $rating = $this->Rating->findOneBy(array('conditions'=>array('session_id'=>$v->Call->session_id)));
                $href = Router::url('ratings/rate/id:'.$v->Call->session_id);
                $v->Call->rating = ($rating) ? $rating->Rating->rate.'/10':'<a class="label label-info" href="'.$href.'">Noter</a>';
            }

            $this->layout = 'user';
            $this->set($d);

        }

        public function card() {

            if (!$this->Session->isLogged()) {
                $this->redirect('pages/index');
                die();
            }

            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if (!$user) {
                // L'utilisateur n'existe pas
                // Redirection vers la page de cr�ation d'un utilisateur
                $this->redirect('users/create');
                die();
            }

            $card = $this->Card->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if (!$card) {
                $this->redirect('users/verify');
                die();
            }

            if ($this->request->data) {
                
                $data = $this->request->data;
                $profile = $this->Profile->findOneBy(array('conditions'=>array('id'=>$this->Session->profile('id'))));
                
                $porteur = str_replace(' ','',$data->numero);
                $dateval = $data->month.substr($data->year,2,2);
                $cvv = $data->crypto;

                // if ($porteur != '0000' && $cvv != '000') {

                    // URL pr�production
                    $url = "https://ppps.paybox.com/PPPS.php";

                    // Num�ro de la question
                    $this->loadModel('Issue');
                    $issue = current($this->Issue->find(1));

                    // R�f�rence Paybox manuel en francais V4_84.pdf - page 43 
                    $params = array(
                        'VERSION' => '00104',
                        'DATEQ' => date('dmYHis'),
                        'TYPE' => '00057',
                        'NUMQUESTION' => str_pad($issue->number,10,"0",STR_PAD_LEFT),
                        'SITE' => '1101352',
                        'RANG' => '001',
                        'CLE' => 'luguwPBf',
                        'MONTANT' => '100', // 1.00 €
                        'DEVISE' => '978',
                        'REFERENCE' => 'M-'.$this->Session->profile('id'),
                        'REFABONNE' => $this->Session->profile('email'),
                        'PORTEUR' => $porteur,
                        'DATEVAL' => $dateval,
                        'CVV' => $cvv,
                        'ACTIVITE' => '027'
                    );

                    $issue->number++;
                    $this->Issue->save($issue);

                    // Cr�ation de la requête POST
                    $post = '';
                    foreach ($params as $k => $v) {
                        $post .= $k.'='.$v.'&';
                    }
                    $post = substr($post, 0, -1);
                      
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    if (preg_match('`^https://`i', $url))  { 
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
                        $vars    = explode('=',$value);
                        $vars[0] = strtolower($vars[0]);
                        $response->$vars[0] = $vars[1];
                    }

                    if (isset($response->codereponse) && $response->codereponse == '00000') {

                        $id = $card->Card->id;

                        $card = new stdClass();
                        $card->id = $id;
                        $card->profile_id = $this->Session->profile('id');
                        $card->mark = $response->porteur;
                        $card->expiry_date = $dateval;
                        $card->cryptogram = $cvv;

                        if ($this->Card->save($card)) {
                            
                            
                            echo '<iframe src="http://www.esatus.fr/affiliation/conversion.html?campaignID=16462&productID=24557&conversionType=lead&https={https}&transactionID='. $profile->id .'&transactionAmount=0&email='. $profile->email .'&descrMerchant={descrMerchant}&descrAffiliate={descrAffiliate}&currency={currency}" frameborder="0" scrolling="0" marginwidth="0" marginheight="0" width="1" height="1"></iframe>';
                                    
                            $this->Session->setFlash('Votre nouvelle carte a �t� enregistr�.','info');
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
                    'type'  => 'url',
                    'url'   => Router::url('users/index')
                ),
                array(
                    'title' => 'Ma carte bancaire',
                    'type'  => 'current'
                )
            );
            
            
            $d['card'] = current($card);
            $d['years'] = range(date('Y'),date('Y')+15);
            $d['y'] = substr($d['card']->expiry_date,2,2);
            $d['months'] = array("01"=>"janvier", "02"=>"f�vrier", "03"=>"mars", "04"=>"avril", "05"=>"mai", "06"=>"juin", "07"=>"juillet", "08"=>"août", "09"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"d�cembre");
            $d['m'] = substr($d['card']->expiry_date,0,2);

            $this->layout = 'user';
            $this->set($d);

        }

        /**
         * Request Action
         */
        public function test() {
            $return = true;
            $user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
            if (!$user) {
                $return = false;
            }
            $card = $this->Card->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));
            if (!$card) {
                $return = false;
            } 
            return $return;
        }
        
    }

?>