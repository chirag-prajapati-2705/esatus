<?php

class CategoriesController extends Controller {

    public $uses = array('User', 'Category', 'Subcategory', 'Service', 'Availability', 'Rating', 'Call', 'Users_promo');

    /**
     * Pages.
     */
    public function index() {

        $d['title_for_layout'] = 'Voyance par téléphone sérieuse | Esatus';
        $d['description_for_layout'] = "Vous cherchez un spécialiste en voyance joignable par téléphone. Esatus réunit les professionnels de nombreux secteurs pour répondre à vos questions.";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Experts',
                'type' => 'current',
            )
        );
        
        if ($this->Session->isLogged()) { 
            echo "<iframe src=\"https://www.wtrackssl01.fr/tr/tracklead.php?idcpart=12869&email=".$this->Session->profile('email')."&idr=".$this->Session->profile('id')."\" width=\"0\" height=\"0\" frameborder=\"0\" scrolling=\"no\" ></iframe>";
        }
        $d['categories'] = $this->Category->findAll();

        $this->set($d);
    }
    
    public function categorylanding($cat) {
        $this->layout = 'landing';

        $this->category($cat);
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

    public function MonStatusAvance($id){
        $this->connect();

        $q = 'SELECT flag, date_update FROM availabilities WHERE service_id =  "' . $id . '"  ';
        $req = $this->db->query($q);
        $req->setFetchMode(PDO::FETCH_OBJ);
        while ($res = $req->fetch()) {
            //$resultat = $res->flag;
            $now = date('Y-m-d')."";
            if($res->date_update == $now)
                $resultat = $res->flag;
            else
                $resultat = 3;
        }
        return $resultat;
    }

    public function category($cat) {
        
        $this->loadModel('Affecter');
        $this->loadModel('Campagne');
        $this->loadModel('Campagne');
        $this->loadModel('Campagnebienvenue');
        if (!isset($cat) || !is_string($cat)) {
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

        if ($this->request->data) {
            $this->Session->write('sortBy', $this->request->data->sort);
        } else {
            $this->Session->write('sortBy', 'callCount');
        }

        switch ($d['category']->title):

            case 'Business':
                $d['titre_for_layout'] = 'Création d\'entreprise, comptabilité, RH : votre business';
                $d['titre_h2'] = 'Création et gestion d’entreprise, fiscalité et RH : vous êtes accompagné à chaque';
                $d['page_canonical'] = 'experts/business';
                break;
            case 'Santé':
                $d['titre_for_layout'] = 'Bénéficiez des conseils de professionnels de santé';
                $d['titre_h2'] = 'Profitez des conseils avisés de véritables experts santé';
                $d['page_canonical'] = 'experts/business';
                break;
            case 'Juridique':
                $d['titre_for_layout'] = 'Droit : les réponses à toutes vos questions';
                $d['titre_h2'] = 'Obtenez des réponses à toutes vos questions';
                $d['page_canonical'] = 'experts/business';
                break;
            case 'Informatique':
                $d['titre_for_layout'] = 'Nos spécialistes de l\'informatique à votre service';
                $d['titre_h2'] = 'Obtenez les conseils de nos experts en informatique';
                $d['page_canonical'] = 'experts/informatique';
                break;
            case 'Service':
                $d['titre_for_layout'] = 'Des services à la personne pour toute la famille';
                $d['titre_h2'] = 'Un service à domicile adapté à vos besoins';
                $d['page_canonical'] = 'experts/services';
                break;
            case 'Enseignement':
                $d['titre_for_layout'] = 'Cours à distance pour tous';
                $d['titre_h2'] = 'Apprendre en ligne grâce à un accompagnement personnalisé';
                $d['page_canonical'] = 'experts/enseignement';
                break;
            case 'Voyance':
                $d['titre_for_layout'] = 'Consultez un voyant par téléphone';
                $d['titre_h2'] = 'Consultations sérieuses de voyance par téléphone';
                $d['page_canonical'] = 'experts/voyance';
                
                break;
            case 'Psychologie':
                $d['titre_for_layout'] = 'Consultez nos psychologues par téléphone, 7 jours sur 7';
                $d['titre_h2'] = 'Une psychologue pour répondre à vos besoins';
                $d['page_canonical'] = 'experts/psychologie';
                break;
            default :
                $d['description_for_layout'] = $d['category']->title;
                $d['title_for_layout'] = '';
                $d['text_for_layout'] = '';
                $d['h1'] = 'Esatus';
                $d['titre_strong'] = '';
                $d['titre_h2'] = '';
                $d['page_canonical'] = '';
                break;
        endswitch;

        $d['scripts'] = array("sort");
         $d['description_for_layout'] = $d['category']->description;
        $d['title_for_layout'] = $d['category']->title_layout;
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Experts',
                'type' => 'url',
                'url' => Router::url('categories/index')
            ),
            array(
                'title' => $d['category']->title,
                'type' => 'current'
            )
        );
        $d['categories'] = $this->Category->findAll();
        $availables = array();
        $unavailables = array();
        $services = $this->Service->findBy(array('conditions' => array('category_id' => $d['category']->id, 'validated' => 1)));
        // debug(count($services));
        foreach ($services as $k => $v) {

            $category = current($this->Category->findOneBy(array('conditions' => array('id' => $v->Service->category_id))));
            $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Service->subcategory_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $slug = explode('.', $v->Service->img);
            $rating = current($this->Rating->average('rate', 'service_id = ' . $v->Service->id));
            $calls = $this->Call->findBy(array(
                'conditions' => 'service_id = ' . $v->Service->id . ' AND (status = 310 OR status = 330 OR status = 350)',
                'order' => 'id DESC'
            ));
            
            if (!$this->Session->isLogged()) {
                $promoBienvenue = $this->Campagnebienvenue->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));

                if ($promoBienvenue) {
                    $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => 1, 'validated' => 1, 'bienvenue' => 1)));
                    if ($campagne->Campagne->libelle) {
                        $v->Service->promoBienvenue = $campagne->Campagne->libelle;
                    }
                }
            } else {
                // On recherche si l'utilisateur a utiliser une promo
                $userPromo = $this->Users_promo->findOneBy(array('conditions' => array('id_profile' => $this->Session->profile('id'))));
                if (!$userPromo) {
                    $promoBienvenue = $this->Campagnebienvenue->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));

                    if ($promoBienvenue) {
                        $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => 1, 'validated' => 1, 'bienvenue' => 1)));
                        if ($campagne->Campagne->libelle) {
                            $v->Service->promoBienvenue = $campagne->Campagne->libelle;
                        }
                    }
                } else {
                    $promo = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));

                    if ($promo) {
                        $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => $promo->Affecter->id_campagne, 'validated' => 1)));
                        if ($campagne->Campagne->libelle) {
                            $v->Service->promoBienvenue = $campagne->Campagne->libelle;
                        }
                    }
                }
            }

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
            $v->Service->calls = (!$calls) ? 'aucun appel' : count($calls) . ' appels';
            $v->Service->rateCount = ($rating->average == '') ? 0 : $rating->average;
            $v->Service->callCount = (!$calls) ? 0 : count($calls);
            //wrapped by andru
            //if($v->Service->available){
            //ajjouter par jean yves randrianiaina pour recuperer le statut de l expert
            //$v->Service->available = $this->MonStatus($v->Service->id);
            //end
          /*  
       $temp_state = $this->MonStatus($d['service']->id);
       $true_state = $v->Service->available;
       
       if ($temp_state == 1 && $true_state == 1) 
       {
       $true_state = 1;
       }
       else if ($temp_state == 2 && $true_state == 1)
       {
       $true_state = 2;
       }
       else if ($temp_state == 0 && $true_state == 1)
       {
       $true_state = 1;
       }
       else if ($temp_state == 0 && $true_state == 2)
       {
       $true_state = 2;
       }
       else if ($temp_state == 0 && $true_state == 0)
       {
       $true_state = 0;
       }
       else {
       $true_state = 0;
       }
       $v->Service->available = $true_state;
       //////// 
       */
            if ($v->Service->available == 1) {
                $taken = $this->Call->findOneBy(array('conditions' => array('service_id' => $v->Service->id, 'status' => 200)));
                $v->Service->available = ($taken) ? 2 : 1;
                $availables[] = $v;
            } else {
                $availables[] = $v;
                //$unavailables[] = $v;
            }
            //}
            // else
            // {
            //     $v->Service->available = 0;
            //     $this->Availability->ajax_indisponible_($v->Service->id);
            // }
            // $unavailables[] = $v;
        }

        usort($availables, function($a, $b) {
            $key = $_SESSION['sortBy'];
            $a = current($a);
            $b = current($b);
            return $b->$key - $a->$key;
        });

        $d['services'] = array_merge($availables, $unavailables);

        $this->set($d);
    }

    public function subcategorylanding($cat, $subcat) {
        $this->layout = 'landing';
        $this->subcategory($cat, $subcat);
    }   


    public function subcategory($cat, $subcat) {
        
        $this->loadModel('Affecter');
        $this->loadModel('Campagne');
        $this->loadModel('Campagnebienvenue');

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
            $this->redirect('categories/category/slug:' . $d['category']->Category->slug);
            die();
        } else {
            $d['subcategory'] = current($d['subcategory']);
        }

        if ($this->request->data) {
            $this->Session->write('sortBy', $this->request->data->sort);
        } else {
            $this->Session->write('sortBy', 'callCount');
        }
        $d['title_for_layout'] = $d['subcategory']->title_layout;
        $d['description_for_layout'] = $d['subcategory']->description;
        switch ($d['category']->title):

            case 'Business':
                $d['h1'] = 'Conseil entreprise : ' . $d['subcategory']->title;
                break;
            case 'Santé':
                $d['h1'] = 'Santé : ' . $d['subcategory']->title;
                break;
            case 'Juridique':
                $d['h1'] = 'Juridique : ' . $d['subcategory']->title;
                break;
            case 'Informatique':
                $d['h1'] = 'Informatique : ' . $d['subcategory']->title;
                break;
            case 'Service':
                $d['h1'] = 'Services : ' . $d['subcategory']->title;
                break;
            case 'Enseignement':
                $d['h1'] = 'Enseignement : ' . $d['subcategory']->title;
                break;
            case 'Voyance':
                $d['h1'] = 'Voyance : ' . $d['subcategory']->title;
                break;
            case 'Psychologie':
                $d['h1'] = 'Psychologie : ' . $d['subcategory']->title;
                break;
            default :
                $d['description_for_layout'] = $d['category']->title;
                $d['title_for_layout'] = '';
                $d['text_for_layout'] = '';
                $d['h1'] = 'Esatus';
                break;
        endswitch;


        $d['scripts'] = array("sort");

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
                'type' => 'current'
            )
        );
        $d['subindex'] = $d['subcategory']->id;
        $d['subtext'] = $d['subcategory']->text;
        $d['categories'] = $this->Category->findAll();
        $availables = array();
        $unavailables = array();
        $services = $this->Service->findBy(array('conditions' => array('category_id' => $d['subcategory']->category_id, 'subcategory_id' => $d['subcategory']->id, 'validated' => 1)));
        foreach ($services as $k => $v) {
            
            $category = current($this->Category->findOneBy(array('conditions' => array('id' => $v->Service->category_id))));
            $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Service->subcategory_id))));
            $user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Service->profile_id))));
            $slug = explode('.', $v->Service->img);
            $rating = current($this->Rating->average('rate', 'service_id = ' . $v->Service->id));
            $calls = $this->Call->findBy(array(
                'conditions' => 'service_id = ' . $v->Service->id . ' AND (status = 310 OR status = 330 OR status = 350)',
                'order' => 'id DESC'
            ));

            if (!$this->Session->isLogged()) {
                $promoBienvenue = $this->Campagnebienvenue->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));

                if ($promoBienvenue) {
                    $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => 1, 'validated' => 1, 'bienvenue' => 1)));
                    if ($campagne->Campagne->libelle) {
                        $v->Service->promoBienvenue = $campagne->Campagne->libelle;
                    }
                }
            } else {
                // On recherche si l'utilisateur a utiliser une promo
                $userPromo = $this->Users_promo->findOneBy(array('conditions' => array('id_profile' => $this->Session->profile('id'))));
                if (!$userPromo) {
                    $promoBienvenue = $this->Campagnebienvenue->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));

                    if ($promoBienvenue) {
                        $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => 1, 'validated' => 1, 'bienvenue' => 1)));
                        if ($campagne->Campagne->libelle) {
                            $v->Service->promoBienvenue = $campagne->Campagne->libelle;
                        }
                    }
                } else {
                    $promo = $this->Affecter->findOneBy(array('conditions' => array('id_service' => $v->Service->id)));

                    if ($promo) {
                        $campagne = $this->Campagne->findOneBy(array('conditions' => array('id' => $promo->Affecter->id_campagne, 'validated' => 1)));
                        if ($campagne->Campagne->libelle) {
                            $v->Service->promoBienvenue = $campagne->Campagne->libelle;
                        }
                    }
                }
            }

            $available = 0;
            //added by andru
            $net_available = $this->MonStatusAvance($v->Service->id);
            if($net_available == 3)
            {
                $today = strtolower(date('l'));
                $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $v->Service->id))));
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

            $username = ($v->Service->username == '') ? $user->last_name . '-' . $user->first_name : $v->Service->username;

            $v->Service->available = $available;
            $v->Service->url = 'slug:' . clean($username) . '/id:' . $v->Service->id;
            $v->Service->category = $category->slug;
            $v->Service->subcategory = $subcategory->slug;
            $v->Service->user = $user;
            $v->Service->rating = ($rating->average == '') ? 'non noté' : number_format($rating->average, 2) . '<sub> / 10</sub>';
            $v->Service->calls = (!$calls) ? 'aucun appel' : count($calls) . ' appels';
            $v->Service->rateCount = ($rating->average == '') ? 0 : $rating->average;
            $v->Service->callCount = (!$calls) ? 0 : count($calls);
            //wrapped by andru
            //if($v->Service->available){
            //ajjouter par jean yves randrianiaina pour recuperer le statut de l expert
            //$v->Service->available = $this->MonStatus($v->Service->id);
            
            //end
        /*        
       $temp_state = $this->MonStatus($d['service']->id);
       $true_state = $v->Service->available;
       
       if ($temp_state == 1 && $true_state == 1) 
       {
       $true_state = 1;
       }
       elseif ($temp_state == 2 && $true_state == 1)
       {
       $true_state = 2;
       }
       elseif ($temp_state == 0 && $true_state == 1)
       {
       $true_state = 1;
       }
       elseif ($temp_state == 0 && $true_state == 2)
       {
       $true_state = 2;
       }
       elseif ($temp_state == 0 && $true_state == 0)
       {
       $true_state = 0;
       }
       else {
       $true_state = 0;
       }
       $v->Service->available = $true_state;
       */
            if ($v->Service->available == 1) {
                $taken = $this->Call->findOneBy(array('conditions' => array('service_id' => $v->Service->id, 'status' => 200)));
                $v->Service->available = ($taken) ? 2 : 1;
                $availables[] = $v;
            } else {
                $unavailables[] = $v;
            }
            //}
            // else
            // {
            //     $v->Service->available = 0;
            //     $this->Availability->ajax_indisponible_($v->Service->id);
            // }
            //$unavailables[] = $v;
        }

        usort($availables, function($a, $b) {
            $key = $_SESSION['sortBy'];
            $a = current($a);
            $b = current($b);
            return $b->$key - $a->$key;
        });

        $d['services'] = array_merge($availables, $unavailables);

        $this->set($d);
    }

    public function getCategories() {
        $categories = $this->Category->findBy(array('order' => 'position ASC'));
        foreach ($categories as $k => $v) {
            $v->Category->subcategories = $this->Subcategory->findBy(array('conditions' => array('category_id' => $v->Category->id)));
        }
        return $categories;
    }

}

?>
