<?php

class ServicesController extends Controller {

    public $uses = array('User', 'Service', 'Category', 'Subcategory', 'Card', 'Call', 'Callprogress', 'Rating', 'Availability', 'Rib');

    /**
     * Request Action.
     */
    public function test() {
        return $this->Service->findBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));
    }

//////
    public function connect() {
        $conf = Conf::database();
        try {
            $pdo = new PDO('mysql:host=' . $conf['host'] . ';dbname=' . $conf['database'] . ';', $conf['login'], $conf['password']);
            $this->db = $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function MonStatus($id) {
        $this->connect();

        $q = ' SELECT flag FROM availabilities WHERE service_id =  "' . $id . '"  ';
        $req = $this->db->query($q);
        $req->setFetchMode(PDO::FETCH_OBJ);
        while ($res = $req->fetch()) {
            $resultat = $res->flag;
        }
        return $resultat;
    }

    public function MonStatusAvance($id) {
        $this->connect();

        $q = 'SELECT flag, date_update FROM availabilities WHERE service_id =  "' . $id . '"  ';
        $req = $this->db->query($q);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $resultat = 3;
        while ($res = $req->fetch()) {
            //$resultat = $res->flag;
            $now = date('Y-m-d') . "";
            if ($res->date_update == $now)
                $resultat = $res->flag;
            else
                $resultat = 3;
        }
        return $resultat;
    }

//////

    /**
     * Pages.
     */
    public function create() {

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
        //     $this->redirect('users/index');
        //     die();
        // } 

        if ($this->request->data) {

            $rules = $this->Service->rules;
            $data = $this->request->data;

            if ($this->Service->validate($rules, $data)) {

                if ($this->request->files) {

                    $files = current($this->request->files);

                    if (strpos($files['type'], 'image') !== false) {

                        $data->profile_id = $this->Session->profile('id');
                        $data->title = ucfirst(strtolower($data->title));

                        if ($data->cost_per_call == 0 || $data->cost_per_call == '') {
                            $data->cost_per_call = '0.0';
                        }

                        if ($data->cost_per_minute == 0 || $data->cost_per_minute == '') {
                            $data->cost_per_minute = ($data->cost_per_call != '0.0') ? '0.00' : '1.00';
                        }

                        $data->cost_per_minute = number_format(floatval(str_replace(',', '.', $data->cost_per_minute)), 2);
                        $data->cost_per_call = number_format(floatval(str_replace(',', '.', $data->cost_per_call)), 2);

                        if ($this->Service->save($data)) {

                            Mailer::ServiceInfo($data);
                            require_once CORE . '/images/ImageWorkshop.php';

                            $name = $user->User->last_name . '-' . $user->User->first_name;
                            $name = clean($name);

                            $data->id = $this->Service->id;
                            $data->img = $name . '-' . $data->id . '.jpg';
                            $this->Service->save($data);

                            $params = getimagesize($files['tmp_name']);
                            $width = $params[0];
                            $height = $params[1];
                            $dir = '../bin/images/services/';

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
                            $layer->save($dir, $data->img, false, null, 80);

                            $availabilities = new stdClass();
                            $availabilities->service_id = $this->Service->id;
                            $availabilities->monday = '0:1;1:2;2:3;3:4;4:5;5:6;6:7;7:8;8:9;9:10;10:11;11:12;12:13;13:14;14:15;15:16;16:17;17:18;18:19;19:20;20:21;21:22;22:23;23:24';
                            $availabilities->tuesday = '0:1;1:2;2:3;3:4;4:5;5:6;6:7;7:8;8:9;9:10;10:11;11:12;12:13;13:14;14:15;15:16;16:17;17:18;18:19;19:20;20:21;21:22;22:23;23:24';
                            $availabilities->wednesday = '0:1;1:2;2:3;3:4;4:5;5:6;6:7;7:8;8:9;9:10;10:11;11:12;12:13;13:14;14:15;15:16;16:17;17:18;18:19;19:20;20:21;21:22;22:23;23:24';
                            $availabilities->thursday = '0:1;1:2;2:3;3:4;4:5;5:6;6:7;7:8;8:9;9:10;10:11;11:12;12:13;13:14;14:15;15:16;16:17;17:18;18:19;19:20;20:21;21:22;22:23;23:24';
                            $availabilities->friday = '0:1;1:2;2:3;3:4;4:5;5:6;6:7;7:8;8:9;9:10;10:11;11:12;12:13;13:14;14:15;15:16;16:17;17:18;18:19;19:20;20:21;21:22;22:23;23:24';
                            $availabilities->saturday = '0:1;1:2;2:3;3:4;4:5;5:6;6:7;7:8;8:9;9:10;10:11;11:12;12:13;13:14;14:15;15:16;16:17;17:18;18:19;19:20;20:21;21:22;22:23;23:24';
                            $availabilities->sunday = '0:1;1:2;2:3;3:4;4:5;5:6;6:7;7:8;8:9;9:10;10:11;11:12;12:13;13:14;14:15;15:16;16:17;17:18;18:19;19:20;20:21;21:22;22:23;23:24';
                            $this->Availability->save($availabilities);

                            $this->redirect('services/index');
                            die();
                        } else {
                            $this->Session->setFlash('Une erreur est survenue.');
                        }
                    } else {
                        $this->Session->setFlash('Le fichier doit être une image.');
                    }
                } else {
                    $this->Session->setFlash('Veuillez fournir une image de votre service.');
                }
            } else {
                $this->Session->setFlash('Des informations sont manquantes.');
            }
        }

        $d['title_for_layout'] = 'Espace expert > Créer un service';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('service');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => 'Créer un service',
                'type' => 'current'
            )
        );

        $d['categories'] = $this->Category->findAll();
        $d['subcategories'] = $this->Subcategory->findBy(array('conditions' => array('category_id' => 15)));
        $d['user'] = current($user);

        $this->layout = 'user';
        $this->set($d);
    }

    public function index() {

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
        //     $this->redirect('users/index');
        //     die();
        // }

        $d['title_for_layout'] = 'Espace expert';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'current'
            )
        );
        $d['services'] = $this->Service->findBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$d['services']) {
            $this->redirect('users/index');
            die();
        }

        foreach ($d['services'] as $k => $v) {
            $today = strtolower(date('l'));
            $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $v->Service->id))));
            $params = explode(':', $availabilities->$today);
            $now = date('G');
            $category = current($this->Category->findOneBy(array('conditions' => array('id' => $v->Service->category_id))));
            $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Service->subcategory_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $slug = explode('.', $v->Service->img);
            $rating = current($this->Rating->average('rate', 'service_id = ' . $v->Service->id));

            $username = ($v->Service->username == '') ? $user->last_name . '-' . $user->first_name : $v->Service->username;

            $v->Service->url = 'slug:' . clean($username) . '/id:' . $v->Service->id;
            $v->Service->category = $category->slug;
            $v->Service->subcategory = $subcategory->slug;
            $v->Service->user = $user;
            
            $available = 0;
            //added by andru
            $net_available = $this->MonStatusAvance($v->Service->id);
            if($net_available == 3)
            {
                $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $v->Service->id))));
                $today = strtolower(date('l'));
                $params = explode(';', $availabilities->$today);
                $now = date('G');

                foreach ($params as $val) {
                    $hour = explode(':', $val);
                    if ($now >= $hour[0] && $now < $hour[0] + 1) {
                        $available = 1;
                        break;
                    }
                }
            }
            else
                $available = $net_available;
            
            $v->Service->available = $available;
            $v->Service->rating = ($rating->average == '') ? 'non noté' : number_format($rating->average, 2) . '<sub> / 10</sub>';
        }

        $this->layout = 'user';
        $this->set($d);
    }

    public function service($id) {

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
        //     $this->redirect('users/index');
        //     die();
        // }

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('services/index');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'profile_id' => $this->Session->profile('id'))));

        if (!$d['service']) {
            $this->redirect('services/index');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $rib = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$rib) {
            $this->redirect('services/bdi/id:' . $d['service']->id);
            die();
        }

        $d['title_for_layout'] = 'Espace expert > ' . $d['service']->title;
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => $d['service']->title,
                'type' => 'current'
            )
        );

        $this->layout = 'user';
        $this->set($d);
    }

    public function clients() {
        $this->loadModel('Affectation');
        $user = $this->User->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        if (!$user) {
            $this->redirect('users/create');
            die();
        }
        $d['title_for_layout'] = 'Espace expert > Mes informations';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => 'Vos clients',
                'type' => 'current'
            )
        );

        $d['user'] = current($user);
        $d['Affectation'] = $this->Affectation->findBy(array(
            'conditions' => 'expert_id = ' . $user->User->id,
            'order' => 'id DESC'
        ));
        foreach ($d['Affectation'] as $k => $v) {
            // Le client
            $user = current($this->User->find($v->Affectation->client_id));
            $v->Affectation->customer = $user->last_name . ' ' . $user->first_name;
        }


        $this->layout = 'user';
        $this->set($d);
    }

    public function edit($id) {

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
        //     $this->redirect('users/index');
        //     die();
        // }

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('services/index');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'profile_id' => $this->Session->profile('id'))));

        if (!$d['service']) {
            $this->redirect('services/index');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $rib = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$rib) {
            $this->redirect('services/bdi/id:' . $d['service']->id);
            die();
        }

        if ($this->request->files) {

            $files = current($this->request->files);

            if ($files['error'] != 4) {

                if (strpos($files['type'], 'image') !== false) {

                    require_once CORE . '/images/ImageWorkshop.php';

                    $dir = '../bin/images/services';

                    $name = $user->User->pseudo;
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
                $data->profile_id = $this->Session->profile('id');
                $data->title = ucfirst(strtolower($data->title));
                
                if ($this->Service->save($data)) {
                    $this->Session->setFlash('Vos informations ont été enregistrés.', 'info');
                    $this->redirect('services/edit/id:' . $d['service']->id);
                    die();
                } else {
                    $this->Session->setFlash('Une erreur est survenue.');
                }
            } else {
                $this->Session->setFlash('Des informations sont erronées.');
            }
        }

        $d['title_for_layout'] = 'Espace expert > ' . $d['service']->title . ' > Mes informations';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('service');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => $d['service']->title,
                'type' => 'url',
                'url' => Router::url('services/service/id:' . $d['service']->id)
            ),
            array(
                'title' => 'Mes informations',
                'type' => 'current'
            )
        );

        $d['categories'] = $this->Category->findAll();
        $d['subcategories'] = $this->Subcategory->findBy(array('conditions' => array('category_id' => $d['service']->category_id)));
        $d['user'] = current($user);

        $this->layout = 'user';
        $this->set($d);
    }

    public function availabilities($id) {

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
        //     $this->redirect('users/index');
        //     die();
        // } 

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('services/index');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'profile_id' => $this->Session->profile('id'))));

        if (!$d['service']) {
            $this->redirect('services/index');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $rib = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$rib) {
            $this->redirect('services/bdi/id:' . $d['service']->id);
            die();
        }

        $d['title_for_layout'] = 'Espace expert > ' . $d['service']->title . ' > Mes disponibilités';
        $d['description_for_layout'] = "";
        $d['scripts'] = array('availabilities');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => $d['service']->title,
                'type' => 'url',
                'url' => Router::url('services/service/id:' . $d['service']->id)
            ),
            array(
                'title' => 'Mes disponibilités',
                'type' => 'current'
            )
        );

        $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $d['service']->id))));

        if ($this->request->data) {

            $data = $this->request->data;

            $slots = range(0, 23);
            $hours = '';
            if ($data->status == 'available') {
                foreach ($slots as $slot) {
                    if ($slot >= $data->from && $slot < $data->to) {
                        $hours .= ($slot) . ':' . ($slot + 1) . ';';
                    }
                }
            } else {
                foreach ($slots as $slot) {
                    if ($slot < $data->from || $slot > $data->to) {
                        $hours .= ($slot) . ':' . ($slot + 1) . ';';
                    }
                }
            }
            $hours = substr($hours, 0, -1);

            if ($data->slot != 'all' && $data->slot != 'week') {
                $day = $data->slot;
                $availabilities->$day = $hours;
            } else {
                $availabilities->monday = $hours;
                $availabilities->tuesday = $hours;
                $availabilities->wednesday = $hours;
                $availabilities->thursday = $hours;
                $availabilities->friday = $hours;
                if ($data->slot == 'all') {
                    $availabilities->saturday = $hours;
                    $availabilities->sunday = $hours;
                }
            }

            $this->Availability->save($availabilities);
            $this->Session->setFlash('Vos disponibilités ont été enregistrés.', 'info');
            $this->redirect('services/availabilities/id:' . $d['service']->id);
            die();
        }

        $d['service']->availabilities = array(
            'monday' => $availabilities->monday,
            'tuesday' => $availabilities->tuesday,
            'wednesday' => $availabilities->wednesday,
            'thursday' => $availabilities->thursday,
            'friday' => $availabilities->friday,
            'saturday' => $availabilities->saturday,
            'sunday' => $availabilities->sunday,
        );
        $d['user'] = current($user);

        $this->layout = 'user';
        $this->set($d);
    }

    public function calls($id) {

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
        //     $this->redirect('users/index');
        //     die();
        // } 

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('services/index');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'profile_id' => $this->Session->profile('id'))));

        if (!$d['service']) {
            $this->redirect('services/index');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $rib = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$rib) {
            $this->redirect('services/bdi/id:' . $d['service']->id);
            die();
        }

        $d['title_for_layout'] = 'Espace expert > ' . $d['service']->title . ' > Mes appels';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => $d['service']->title,
                'type' => 'url',
                'url' => Router::url('services/service/id:' . $d['service']->id)
            ),
            array(
                'title' => 'Mes appels',
                'type' => 'current'
            )
        );

        $d['calls'] = $this->Call->findBy(array(
            'conditions' => 'service_id = ' . $d['service']->id . ' AND (status = 310 OR status = 330 OR status = 350) AND session_id != \'\'',
            'order' => 'id DESC'
        ));

        foreach ($d['calls'] as $k => $v) {
            // Le client
            $user = current($this->User->find($v->Call->user_id));
            $v->Call->customer = $user->pseudo;
            // La durée de la communication
            $v->Call->duration = elapsedTime($v->Call->start, $v->Call->end);
            // La date de la communication
            $date = substr($v->Call->start, 0, 10);
            $date = explode('-', $date);
            $v->Call->date = $date[2] . '/' . $date[1] . '/' . $date[0];
            // La note de l'appel
            $rating = $this->Rating->findOneBy(array('conditions' => array('session_id' => $v->Call->session_id)));
            $v->Call->rating = ($rating) ? $rating->Rating->rate . '/10' : 'non noté';
            // Le coût de l'appel
            $v->Call->benefit = number_format($v->Call->cost, 2) . ' €';
            $pourcentage = '.' . $d['service']->pourcentage;
            $v->Call->reel = number_format((($v->Call->benefit / 1.2) * $pourcentage), 2) . ' €';
        }


        $d['user'] = current($user);

        $this->layout = 'user';
        $this->set($d);
    }

    public function comments($id, $cid) {

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
        //     $this->redirect('users/index');
        //     die();
        // } 

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('services/index');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'profile_id' => $this->Session->profile('id'))));

        if (!$d['service']) {
            $this->redirect('services/index');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $rib = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$rib) {
            $this->redirect('services/bdi/id:' . $d['service']->id);
            die();
        }

        $d['customer'] = $this->User->find($cid);

        if (!$d['customer']) {
            $this->redirect('services/calls/id:' . $id);
            die();
        } else {
            $d['customer'] = current($d['customer']);
        }

        $this->loadModel('Comment');

        if ($this->request->data) {

            $data = $this->request->data;

            if (trim($data->comment) != '') {

                $data->service_id = $d['service']->id;
                $data->user_id = $d['customer']->id;
                $data->date = date('Y-m-d H:i:s');

                if ($this->Comment->save($data)) {
                    $this->redirect('services/comments/id:' . $id . '/cid:' . $cid);
                } else {
                    $this->setFlash('Une erreur est survenue.', 'warning');
                }
            }
        }

        $d['title_for_layout'] = 'Espace expert > ' . $d['service']->title . ' > Mes appels > ' . $d['customer']->last_name . ' ' . $d['customer']->first_name . ' > Commentaires';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => $d['service']->title,
                'type' => 'url',
                'url' => Router::url('services/service/id:' . $d['service']->id)
            ),
            array(
                'title' => 'Mes appels',
                'type' => 'url',
                'url' => Router::url('services/calls/id:' . $d['service']->id)
            ),
            array(
                'title' => 'Commentaires > ' . $d['customer']->first_name,
                'type' => 'current'
            )
        );



        $d['comments'] = $this->Comment->findBy(array(
            'conditions' => array('service_id' => $id, 'user_id' => $cid),
            'order' => 'id DESC'
        ));

        $d['user'] = current($user);

        $this->layout = 'user';
        $this->set($d);
    }

    public function repayments($id) {

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
        //     $this->redirect('users/index');
        //     die();
        // } 

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('services/index');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'profile_id' => $this->Session->profile('id'))));

        if (!$d['service']) {
            $this->redirect('services/index');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $rib = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$rib) {
            $this->redirect('services/bdi/id:' . $d['service']->id);
            die();
        }

        $this->loadModel('Balance');
        $d['balance'] = $this->Balance->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));

        if (!$d['balance']) {
            $this->redirect('services/service/id:' . $d['service']->id);
            die();
        } else {
            $d['balance'] = current($d['balance']);
        }

        $d['title_for_layout'] = 'Espace expert > ' . $d['service']->title . ' > Mes gains';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => $d['service']->title,
                'type' => 'url',
                'url' => Router::url('services/service/id:' . $d['service']->id)
            ),
            array(
                'title' => 'Mes gains',
                'type' => 'current'
            )
        );

        $d['years'] = array();

        $years = range(2013, date('Y'));
        $years = array_reverse($years);
        foreach ($years as $year) {
            $d['years'][$year] = array();
            $months = ($year != date('Y')) ? range(1, 12) : range(1, date('m'));
            $months = array_reverse($months);
            foreach ($months as $month) {
                $conditions = "start >= '$year-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01 00:00:00' AND start <= '$year-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-31 23:59:59' AND service_id = $id AND (status = 310 OR status = 330 OR status = 350)";
                $calls = $this->Call->findBy(array(
                    'conditions' => $conditions,
                    'order' => 'id DESC'
                ));
                $benefit = 0;
                foreach ($calls as $k => $v) {
                    if ($v->Call->payment == 1) {
                        $benefit += $v->Call->cost;
                    }
                }

                if ($calls) {
                    $d['years'][$year][$month] = new stdClass();
                    $d['years'][$year][$month]->date = month($month) . ' ' . $year;
                    $d['years'][$year][$month]->count = count($calls);
                    $d['years'][$year][$month]->benefit = number_format($benefit, 2) . ' €';
                    $pourcentage = '.' . $d['service']->pourcentage;
                    $d['years'][$year][$month]->reel = number_format((($benefit / 1.2) * $pourcentage), 2) . ' €';
                }
            }
        }

        $d['user'] = current($user);
        $d['id'] = $id;

        $this->loadModel('Repayment');
        $d['repayments'] = $this->Repayment->findBy(array('conditions' => array('service_id' => $id), 'order' => 'id DESC'));
        foreach ($d['repayments'] as $k => $v) {
            $date = explode('-', $v->Repayment->date);
            $v->Repayment->date = $date[2] . '/' . $date[1] . '/' . $date[0];
        }

        $this->layout = 'user';
        $this->set($d);
    }

    public function bdi($id) {

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
        //     $this->redirect('users/index');
        //     die();
        // } 

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('services/index');
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id, 'profile_id' => $this->Session->profile('id'))));

        if (!$d['service']) {
            $this->redirect('services/index');
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $this->loadModel('Rib');
        $rib = $this->Rib->findOneBy(array('conditions' => array('service_id' => $d['service']->id)));
        if (!$rib) {
            $d['rib'] = new stdClass();
            $d['rib']->banque = '';
            $d['rib']->guichet = '';
            $d['rib']->compte = '';
            $d['rib']->cle = '';
            $d['rib']->domiciliation = '';
            $d['rib']->iban = '';
            $d['rib']->bic = '';
        } else {
            $d['rib'] = current($rib);
        }

        if ($this->request->data) {

            $rules = $this->Rib->rules;
            $data = $this->request->data;

            if ($this->Rib->validate($rules, $data)) {

                if ($rib) {
                    $data->id = $d['rib']->id;
                }

                $data->service_id = $d['service']->id;

                if ($this->Rib->save($data)) {
                    $this->Session->setFlash('Vos coordonnées bancaires ont été enregistrés.', 'info');
                    $this->redirect('services/bdi/id:' . $d['service']->id);
                    die();
                } else {
                    $this->Session->setFlash('Une erreur est survenue.');
                }
            } else {
                $this->Session->setFlash('Des informations sont erronées.');
            }
        }

        $d['title_for_layout'] = 'Espace expert > ' . $d['service']->title . ' > Mes coordonées bancaires';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Espace expert',
                'type' => 'url',
                'url' => Router::url('services/index')
            ),
            array(
                'title' => $d['service']->title,
                'type' => 'url',
                'url' => Router::url('services/service/id:' . $d['service']->id)
            ),
            array(
                'title' => 'Mes coordonées bancaires',
                'type' => 'current'
            )
        );

        $d['user'] = current($user);

        $this->layout = 'user';
        $this->set($d);
    }

    //boosting occupe_view
    public function occupe_view_all() {
        $services = $_POST['servicesid'];

        $disponibilites = array();
        foreach ($services as $key => $value) {
            $temp_dispo = $this->MonStatusAvance($value);
            if ($temp_dispo == 3) {
                $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $value))));
                $today = strtolower(date('l'));

                $params = explode(';', $availabilities->$today);
                $now = date('G');

                foreach ($params as $val) {
                    $hour = explode(':', $val);
                    if ($now >= $hour[0] && $now < $hour[0] + 1) {
                        $temp_dispo = 1;
                        break;
                    } else {
                        $temp_dispo = 0;
                        //break;
                    }
                }
            }

            $disponibilites[$value] = $temp_dispo;
        }

        echo json_encode($disponibilites);
        die;
    }

    //new occupe_view by andru
    public function occupe_view() {
        $service_id = $_POST['serviceid'];

        $status = $this->MonStatus($service_id);
        if ($status == 1)
            echo "CALLEND";
        if ($status == 2)
            echo "RINGING";
        if ($status == 0)
            echo "INDISPONIBLE";
        die;
    }

    //added by andru _ deactivated (old)
    public function old_occupe_view() {
        $service_id = $_POST['serviceid'];
        //$taken = $this->Call->findOneBy(array('conditions'=>array('service_id'=>$d['service']->id,'status'=>200)));
        $taken = $this->Callprogress->findCallprogress(array('conditions' => array('SERVICEID' => $service_id)));
        $taken = end($taken);

        if ($taken) {

            if ($taken->Callprogress->EXPERT == 'RINGING') {
                echo "RINGING";
                die;
                //$available = 2;
            } else {
                if ($taken->Callprogress->EXPERT == 'OKOK') {
                    $on_communication = $this->Call->findOneBy(array('conditions' => array('service_id' => $taken->Callprogress->SERVICEID, 'session_id' => $taken->Callprogress->SESID)));

                    if ($on_communication) {
                        echo "CALLEND";
                        die;
                        //$available = 1;
                    } else {
                        echo "ENCOMMUNICATION";
                        die;
                        //$available = 2;
                    }
                }
                if ($taken->Callprogress->EXPERT == 'HANGUP') {
                    echo "HANGUP";
                    die;
                }
            }
        } else {
            echo "NOCALL";
            die;
            //$available = 1;
        }

        die;
    }

    public function view($cat, $subcat, $slug, $id) {

        $this->loadModel('Affecter');
        $this->loadModel('Campagne');

        if (!isset($cat) && !isset($subcat)) {
            $this->redirect('categories/index');
            die();
        }

        $d['category'] = $this->Category->findOneBy(array('conditions' => array('slug' => $cat), 'limit' => 1));

        if (!$d['category']) {
            $this->redirect('categories/index');
            die();
        } else {
            $d['category'] = current($d['category']);
        }

        $d['subcategory'] = $this->Subcategory->findOneBy(array('conditions' => array('slug' => $subcat), 'limit' => 1));

        if (!$d['subcategory']) {
            $this->redirect('categories/category/slug:' . $d['category']->slug);
            die();
        } else {
            $d['subcategory'] = current($d['subcategory']);
        }

        if (!isset($id) || !is_numeric($id)) {
            $this->redirect('categories/subcategory/cat:' . $d['category']->slug . '/subcat:' . $d['subcategory']->slug);
            die();
        }

        $d['service'] = $this->Service->findOneBy(array('conditions' => array('id' => $id), 'limit' => 1));

        if (!$d['service']) {
            $this->redirect('categories/subcategory/cat:' . $d['category']->slug . '/subcat:' . $d['subcategory']->slug);
            die();
        } else {
            $d['service'] = current($d['service']);
        }

        $d['user'] = $this->User->findOneBy(array('conditions' => array('profile_id' => $d['service']->profile_id)));

        if (!$d['user']) {
            $this->redirect('categories/subcategory/cat:' . $d['category']->slug . '/subcat:' . $d['subcategory']->slug);
            die();
        } else {
            $d['user'] = current($d['user']);
        }

        $username = ($d['service']->username == '') ? $d['user']->last_name . '-' . $d['user']->first_name : $d['service']->username;

        $d['service']->url = 'slug:' . clean($username) . '/id:' . $d['service']->id;

        $d['title_for_layout'] = $username . ' experts en ' . $d['category']->title . ' ' . $d['subcategory']->title . ' repond à vos questions par téléphone.';
        $d['description_for_layout'] = $username . ' experts en ' . $d['category']->title . ' ' . $d['subcategory']->title . ' - ' . substr($d['service']->description, 0, 100);
        $d['scripts'] = array('view');
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Experts',
                'type' => 'url',
                'url' => Router::url('categories/index')
            ),
            array(
                'title' => $d['category']->title,
                'type' => 'url',
                'url' => Router::url('categories/category/slug:' . $d['category']->slug)
            ),
            array(
                'title' => $d['subcategory']->title,
                'type' => 'url',
                'url' => Router::url('categories/subcategory/cat:' . $d['category']->slug . '/subcat:' . $d['subcategory']->slug)
            ),
            array(
                'title' => ($d['service']->username == '') ? $d['user']->first_name . ' ' . $d['user']->last_name : utf8_decode($d['service']->username),
                'type' => 'current',
            ),
        );

        $calls = $this->Call->findBy(array(
            'conditions' => 'service_id = ' . $d['service']->id . ' AND (status = 310 OR status = 330 OR status = 350)',
            'order' => 'id DESC'
        ));
        $rating = current($this->Rating->average('rate', 'service_id = ' . $d['service']->id));
        $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $d['service']->id))));

        $promo = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $d['service']->id)));

        if ($promo) {
            $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => $promo->Affecter->id_campagne)));
            $d['service']->promo = $campagne->Campagne->libelle;
        }

        $today = strtolower(date('l'));
        $params = explode(';', $availabilities->$today);
        $now = date('G');
        $available = false;
        foreach ($params as $val) {
            $hour = explode(':', $val);
            if ($now >= $hour[0] && $now < $hour[0] + 1) {
                $available = true;
                break;
            }
        }

        if ($available == 1) {
            $taken = $this->Call->findOneBy(array('conditions' => array('service_id' => $d['service']->id, 'status' => 200)));
            $available = ($taken) ? 2 : 1;
        }

        $d['service']->available = $available;
        $d['service']->count = count($calls);
        $d['service']->average = ($rating->average == '') ? 'non noté' : number_format($rating->average, 2);
        $d['service']->availabilities = array(
            $availabilities->monday,
            $availabilities->tuesday,
            $availabilities->wednesday,
            $availabilities->thursday,
            $availabilities->friday,
            $availabilities->saturday,
            $availabilities->sunday,
        );
        $d['reviews'] = array();
        foreach ($calls as $k => $v) {
            $rating = $this->Rating->findOneBy(array('conditions' => array('session_id' => $v->Call->session_id)));
            if ($rating) {
                $user = current($this->User->findOneBy(array('conditions' => array('id' => $v->Call->user_id))));
                $rating->Rating->name = $user->first_name;
                $d['reviews'][] = $rating;
            }
        }
        
        $d['page_canonical'] = 'experts/'.$d['category']->slug.'/'.$d['subcategory']->slug.'/'.clean($username).'-'.$d['service']->id;
        $this->set($d);
    }

    public function get_calling_status()
    {
        $call_id = $_POST['call_id'];
        if (!empty($call_id)) {
            $call_data = $this->Call->findOneBy(array('conditions' => array('call_id' => $call_id)));
            $available = 0;
            if (!empty($call_data->Call->service_id)) {
                $available = $this->MonStatusAvance($call_data->Call->service_id);
            }
            $status = ($available != 0) ? true : false;
            echo json_encode(array('success' => $status));
        }
        die();
    }
}

?>