<?php

    class Dispatcher {
        
        /**
         * L'attribut $request admet comme valeur une instance de la classe Request.
         */
        public $request;
        
        /**
         * La méthode __construct() est appelé lors de la création d'une occurence de la classe Dispatcher.
         */
        public function __construct() {
            $this->request = new Request();
            $parsed = Router::parse($this->request->url,$this->request);
            $action = $this->request->action;
            if ($this->request->prefix) {
                $action = $this->request->prefix.'_'.$action;
            }
            
            $controller = $this->loadController($this->request->controller);
            
            if (!in_array($action, array_diff(get_class_methods($controller),get_class_methods('Controller')))){
                header('HTTP/1.0 404 Not Found');
                $controller = new Controller($this->request);
                $controller->error();
            } else {
                call_user_func_array(array($controller,$action),$this->request->params);
                $controller->render($action);
            }
        }
        
        /**
         * La méthode loadController($name) charge un controller puis renvoie une instance de celui-ci.
         * @param       $name   Le nom du controller à charger.
         * @return      Une instance du controller demandé.
         */
        private function loadController($name) {
            $name = ucfirst($name).'Controller';
            $filename = ROOT.DS.'controller'.DS.$name.'.php';
            
            if (file_exists($filename)){
                require $filename;
                $controller = new $name($this->request);
            } else {
                $controller = new Controller($this->request);
            }
            return $controller;
        }
        
    }
    
?>