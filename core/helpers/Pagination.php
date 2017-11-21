<?php

    class Pagination {
        
        public $controller;

        public $paginate = array(
            'model'=>'Article',
            'perpage'=>25, 
            'url'=>array(
                'controller'=>'pages',
                'action'=>'index'
            ),
            'query'=>array(
                'fields'=>'*',
                'conditions'=>null,
                'order'=>'date DESC'
            )
        );

        private $check = false;

        private $count = 0;

        private $limit = 0;

        /**
         *  La méthode __construct($controller) est appelé lors de la création d'une occurence de la classe Pagination.
         *  @param      $controller
         */
        public function __construct($controller) {
            $this->controller = $controller;
        }
        
        /**
         *  La méthode activate() permet d'activer la pagination.
         */
        public function activate() {


            $model = $this->paginate->model;
            $this->count = $this->controller->$model->count($this->paginate['query']['conditions']);
            $this->limit = ($this->controller->request->page*$this->paginate['perpage']);
            $this->$check = ($limit < $this->count) ? true:false;

            return $this->controller->$model->findBy(array(
                'fields'=>$this->paginate->query['query']['fields'],
                'conditions'=>$this->paginate['query']['conditions'],
                'order'=>$this->paginate['query']['order'],
                'limit'=>$limit
            ));

        }

        /**
         *  La méthode prev() permet d'afficher un lien vers la page précédente.
         */
        public function prev() {



        }

        /**
         *  La méthode next() permet d'afficher un lien vers la page suivante.
         */
        public function next() {

            
            
        } 

        /**
         *  La méthode counter() permet d'afficher X et Y, ou X est la page courante et Y est le nombre de pages restantes.
         */
        public function counter() {



        }     
        
    }

?>