<?php

class PagesController extends Controller {

    /**
     * Pages.
     */
    public function index() {
        
        
        $this->loadModel('Service');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
       $d['title_for_layout'] = 'Experts Voyance, Juridique et Psychologie | Esatus';
        $d['description_for_layout'] = " Sur Esatus.fr, profitez des conseils de spécialistes en Voyance, Juridique et Psychologie et dialoguez avec des stars. 300 experts disponibles 24h/24.";
        $d['classification_for_layout'] = "Consultez votre expert en ligne et par téléphone , des professionnels disponibles 7/7 sur Esatus dans tous les domaines. Voyance, Services, Informatique, Business, Enseignement, Juridique, Santé, Psychologique, Astro....";
		$d['keywords_for_layout'] = "Consulter, expert, Voyance, Services, Informatique, Business, Enseignement, Juridique, Santé, Psychologique, Astro, en ligne";
		$d['country_for_layout'] = "france";

        $experts = $this->Service->findBy(array('conditions' => array('slide' => 1)));
        if ($experts) {
            foreach ($experts as $k=>$v) {
                
                $username = ($v->Service->username == '') ? $user->last_name.'-'.$user->first_name:$v->Service->username;
                $v->Service->url = 'slug:'.clean($username).'/id:'.$v->Service->id;

                $category = $this->Category->findOneBy(array('conditions'=>array('id'=>$v->Service->category_id)));
                $v->Service->category = $category->Category->slug;
                
                $subcategory = $this->Subcategory->findOneBy(array('conditions'=>array('id'=>$v->Service->subcategory_id))); 
                $v->Service->subcategory = $subcategory->Subcategory->slug;
            }
            $d['experts'] = $experts;
        }
        $this->set($d);
    }

    public function search() {
        
        if ($this->request->data) {

            $data = $this->request->data;

            $this->loadModel('Service');

            $services = $this->Service->search(array(
                'match' => 'title,description,presentation,reference,username',
                'against' => $data->search,
                'mode' => true
            ));

            $d['services'] = array();

            $this->loadModel('Availability');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('User');
            $this->loadModel('Rating');

            foreach ($services as $k => $v) {

                if ($v->Service->cpt > 0 && $v->Service->validated == 1) {

                    $today = strtolower(date('l'));
                    $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $v->Service->id))));
                    $params = explode(':', $availabilities->$today);
                    $now = date('G');
                    $category = current($this->Category->findOneBy(array('conditions' => array('id' => $v->Service->category_id))));
                    $subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Service->subcategory_id))));
                    $user = $this->User->findOneBy(array('conditions' => array('id' => $v->Service->profile_id)));
                    if ($user) {
                        $user = current($user);
                        $slug = explode('.', $v->Service->img);
                        $rating = current($this->Rating->average('rate', 'service_id = ' . $v->Service->id));

                        $username = ($v->Service->username == '') ? $user->last_name . '-' . $user->first_name : $v->Service->username;

                        $v->Service->url = 'slug:' . clean($username) . '/id:' . $v->Service->id;
                        $v->Service->category = $category->slug;
                        $v->Service->subcategory = $subcategory->slug;
                        $v->Service->user = $user;
                        $v->Service->available = ($now >= $params[0] && $now < $params[1]) ? true : false;
                        $v->Service->rating = ($rating->average == '') ? 'non noté' : number_format($rating->average, 2) . '<sub> / 10</sub>';
                        $d['services'][] = $v;
                    }
                }
            }
        } else {
            $this->redirect('pages/index');
            die();
        }

        $d['title_for_layout'] = 'Recherche';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Recherche',
                'type' => 'current'
            )
        );
        $this->set($d);
    }

    public function customersfaq() {
        
        $d['title_for_layout'] = 'Trouvez  des experts dans les différents domaines : juridique, médecine, business';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Foire aux questions - Client',
                'type' => 'current'
            )
        );
        $this->set($d);
    }

    public function expertsfaq() {
        
        $d['title_for_layout'] = 'Esatus vous permet de généré un chiffre d’affaire conséquent sans investissement de départ';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Foire aux questions - Expert',
                'type' => 'current'
            )
        );
        $this->set($d);
    }

    public function contact() {
        
        if ($this->request->data) {

            $data = $this->request->data;

            if (empty($data->name)) {
                $this->Session->setFlash('Veuillez indiquer votre nom et votre prénom.');
                $this->redirect('pages/contact');
                die();
            }

            if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
                $this->Session->setFlash('Veuillez indiquer votre adresse email.');
                $this->redirect('pages/contact');
                die();
            }

            if (empty($data->message)) {
                $this->Session->setFlash('Veuillez rédiger le contenu de votre message.');
                $this->redirect('pages/contact');
                die();
            }

            $check = Mailer::contact($data);
            $return = ($check) ? 'Votre message a été envoyé avec succès !' : 'Une erreur est survenue.';
            $type = ($check) ? 'info' : 'danger';
            $this->Session->setFlash($return, $type);
        }

        $d['title_for_layout'] = 'Conseils d\'experts par téléphone sur ESATUS';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Contactez-nous',
                'type' => 'current'
            )
        );

        $this->set($d);
    }

    public function termsofuse() {

        $d['title_for_layout'] = 'Conditions générales d\'utilisation';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Conditions générales d\'utilisation',
                'type' => 'current'
            )
        );
        $this->set($d);
    }

    public function imprint() {

        $d['title_for_layout'] = 'Mentions légales';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Mentions légales',
                'type' => 'current'
            )
        );
        $this->set($d);
    }

    /**
     * XML.
     */
    public function xml_sitemap() {

        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Service');
        $this->loadModel('User');

        $d['categories'] = $this->Category->findAll();
        foreach ($d['categories'] as $k => $v) {
            $v->Category->subcategories = $this->Subcategory->findBy(array('conditions' => array('category_id' => $v->Category->id)));
        }

        $d['services'] = $this->Service->findBy(array('conditions' => array('validated' => 1)));
        foreach ($d['services'] as $k => $v) {
            $category = $this->Category->findOneBy(array('conditions' => array('id' => $v->Service->category_id)));
            $subcategory = $this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Service->subcategory_id)));
            $user = $this->User->findOneBy(array('conditions' => array('id' => $v->Service->profile_id)));
            if ($user) {
                $username = ($v->Service->username == '') ? $user->User->last_name . '-' . $user->User->first_name : $v->Service->username;
            } else {
                $username = ($v->Service->username == '') ? 'inconnu' : $v->Service->username;
            }
            $v->Service->slug = 'services/view/cat:' . $category->Category->slug . '/subcat:' . $subcategory->Subcategory->slug . '/slug:' . clean($username) . '/id:' . $v->Service->id;
        }

        $this->set($d);
    }

    /**
     * Txt.
     */
    public function txt_robots() {
        
    }

    public function txt_humans() {
        
    }

    /**
     * Txt.
     */
    public function consultationgratuite() {
        $d['title_for_layout'] = 'Conditions générales d\'utilisation';
        $d['description_for_layout'] = "";
        $d['breadcrumb_for_layout'] = array(
            array(
                'title' => 'Conditions générales d\'utilisation',
                'type' => 'current'
            )
        );
        $this->set($d);
    }

}

?>