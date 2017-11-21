<?php

    class Time {
        
        public $controller;
        
        public function __construct($controller) {
            $this->controller = $controller;
        }

        public function parse($date) {
	        $mois = array("01"=>"janvier", "02"=>"février", "03"=>"mars", "04"=>"avril", "05"=>"mai", "06"=>"juin", "07"=>"juillet", "08"=>"août", "09"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"décembre");
	        $split = preg_split('/\-/',$date);
	        $j = substr($split[2],0,2);
	        $m = $split[1];
	        $a = $split[0];
	        return $j.' '.$mois[$m].', '.$a;
	    }
        
    }

?>