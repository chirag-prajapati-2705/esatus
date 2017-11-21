<?php
    
    class Controller {

        /**
         * La variable $utils permet de charger des classes.
         */
        public $utils = array('Session');

        /**
         * La variable $helpers permet de charger des Helpers.
         */
        public $helpers = array('HTML','Form','Pagination');

        /**
         * La variable $uses permet de charger des Models.
         */
        public $uses = array('Call', 'Profile', 'User', 'Service', 'Category', 'Subcategory', 'Issue', 'Card', 'Balance', 'Availability', 'Calldetail', 'Callprogress', 'Preautorisation', 'Callstate', 'Partner');
        
        /**
         * L'attribut $request admet comme valeur une instance de la classe Request.
         */
        public $request;
                
        /**
         * L'attribut $vars admet comme valeur un tableau contenant les variables que l'on veut faire passer à la vue.
         */
        private $vars = array();
        
        /**
         * L'attribut $layout admet comme valeur le nom du layout à charger.
         */
        public $layout = 'default';
        
        /**
         * L'attribut $rendered indique si la vue est déjà rendu.
         */
        private $rendered = false;
        
        /**
         *  La méthode __construct() est appelé lors de la création d'une occurence de la classe Controller.
         *  @param      $request
         */
        public function __construct($request=null) {

            if ($request) {
                $this->request = $request;
                require ROOT.DS.'config'.DS.'hook.php';
            }

            $this->init();

        }

        private function init() {

            if ($this->utils) {
                foreach ($this->utils as $k) {
                    require_once('utils/'.$k.'.php');
                    $this->$k = new $k($this);
                }
            }

            if ($this->helpers) {
                foreach ($this->helpers as $k) {
                    require_once('helpers/'.$k.'.php');
                    $this->$k = new $k($this);
                }
            }

            if ($this->uses) {
                foreach ($this->uses as $k) {
                    $this->loadModel($k);
                }
            }

        }
        
        /**
         * La méthode loadModel($name) charge un model.
         * @param       $name : Le nom du model à charger.
         */
        public function loadModel($name) {
            $file = ROOT.DS.'model'.DS.$name.'.php';
            require_once $file;
            if (!isset($this->name)) {
                $this->$name = new $name();
                if (isset($this->Form)) {
                    $this->$name->Form = $this->Form;
                }
            }  
        }

        public function requestAction($params) 
        {
            $name = ucfirst($params['controller']).'Controller';
            $filename = ROOT.DS.'controller'.DS.$name.'.php';
            if (file_exists($filename))
            {
                require_once $filename;
                $controller = new $name($this->request);
                $action = $params['action'];
                if(isset($params['value']))
                {
                    return $controller->$action($params['value']);
                }
                else
                {
                    return $controller->$action();
                }
            } 
        }

        /**
         * La méthode render($view) charge et affiche la vue demandée dans le layout.
         * @param       $view
         */
        public function render($view) {
            if ($this->rendered) {
                return false;
            } else {
                header("Status: 200 OK", false, 200);
                extract($this->vars);
                $view = (strpos($view,'/')===0) ? ROOT.DS.'view'.$view.'.php':ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
                ob_start();
                require $view;
                $content_for_layout = ob_get_clean();
                require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
                $this->rendered = true;
            }
        }
        
        /**
         * La méthode set($key,$value=null) permet de passer des variables à la vue.
         * @param       $key
         * @param       $value
         */
        public function set($key,$value=null) {
            if (is_array($key)){
                $this->vars += $key;
            } else {
                $this->vars[$key] = $value;
            }
        }
        
        /**
         * La méthode redirect($url,$permanently=false) permet de rediriger vers une autre page.
         * @param   $url : L'url de la page.
         * @param   $permanently : Indique si la redirection est permanente.
         */
        public function redirect($url,$permanently=false) {
            $location = Router::url($url);
            if ($permanently) {
                header('HTTP/1.0 301 Moved Permanently');
            }

            header("Location: $location");
        }
        
        /**
         * La méthode error() permet de rediriger vers la page 404.
         */
        public function error() {
            header('HTTP/1.0 404 Not Found');
            $d['title_for_layout'] = 'Page introuvable !';
            $d['description_for_layout'] = "Il n'y a rien ici!";
            $d['context_for_layout'] = 'error';
            $d['id_for_layout'] = 5;
            $this->set($d);
            $this->render('/errors/404');
        }
        
    }

?>