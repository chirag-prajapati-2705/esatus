<?php

    class Text {
        
        public $controller;
        
        public function __construct($controller) {
            $this->controller = $controller;
        }
        
        public function excerpt($text,$radius=60,$ending='...'){
            if (strlen($text)>$radius) {
                $text = substr(substr($text,0,$radius),0,strrpos(substr($text,0,$radius),' ')).$ending;
            }
            return $text;
        }
        
    }

?>