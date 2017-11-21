<?php

    class Request {
        
        /**
         * L'attribut <code>$url</code> admet comme valeur l'url appelée par l'utilisateur.
         */
        public $url;
        
        /**
         * L'attribut <code>$page</code> admet comme valeur la page appelée par l'utilisateur.
         */
        public $page;
        
        /**
         * L'attribut <code>$prefix</code> admet comme valeur le nom du prefix de la page d'administration.
         */
        public $prefix = false;
        
        /**
         * 
         */
        public $data = false;

        /**
         * 
         */
        public $files = false;
        
        /**
         *  La méthode <code>__construct()</code> est appelé lors de la création d'une occurence de la classe Request.
         */
        public function __construct() {
            
            $this->url = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO']:"/pages/index";
            $this->page = 1;
            
            if (isset($_GET['page'])) {
                if (is_numeric($_GET['page'])) {
                    if ($_GET['page'] > 0) {
                        $this->page = round($_GET['page']);
                    }
                }
            }
            
            if (!empty($_POST)) {
                $this->data = new stdClass();
                foreach($_POST as $k => $v) {
                    $this->data->$k = utf8_decode($v);
                }
            }

            if (!empty($_FILES)) {
                $this->files = new stdClass();
                foreach($_FILES as $k => $v) {
                    $this->files->$k = $v;
                }
            }
            
        }
        
    }

?>