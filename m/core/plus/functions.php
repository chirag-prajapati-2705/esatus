<?php

	function debug($var) {
		$trace = debug_backtrace();
        echo "<p>&nbsp;</p>\n";
        echo "<p>\n";
        echo "\t".'<a href="#" onClick="$(this).parent().next(\'ol\').slideToogle(); return false;"><strong>'.$trace[0]["file"].'</strong> ligne '.$trace[0]["line"].'</a>'."\n";
        echo "</p>\n";
        echo '<ol style="display:none;">'."\n";
        foreach($trace as $k=>$v) {
            if ($k < 0) {
                echo "\t".'<li><strong>'.$v['file'].'</strong> ligne '.$v['line'].'</li>'."\n";
            }
        }
        echo "</ol>\n";
        echo "<pre>\n";
        print_r($var);
        echo "</pre>\n";
	}

    function breadcrumb($breadcrumb) {
        $b = '<div class="container">'."\n";
        $b .= '<div class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">'."\n";    
        $b .= '<a href="'.Router::url('pages/index').'" itemprop="url">><i class="icon-home"></i></a>'; 
        $b .= ' › ';       
        foreach ($breadcrumb as $k) {
            if ($k['type'] == 'url') {
                $b .= '<a href="'.$k['url'].'" itemprop="title"><span itemprop="title">'.$k['title'].'</span></a>';
                $b .= ' › ';
            } else {
                $b .= $k['title'];
            }
        }
        $b .= '</div>'."\n";
        $b .= '</div>'."\n";
        return $b;
    }

    function clean($text){
        $alphabet = array(
            'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
            'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
            'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        );
 
        $text = strtr ($text, $alphabet);
        $text = preg_replace('/\W+/', '-', $text);
        $text = strtolower($text);
        $text = str_replace(' ','_',$text);
 
        return $text;
    }

    function elapsedTime($date1,$date2) {
        $d1 = new DateTime($date1); 
        $d2 = new DateTime($date2); 
        $diff = $d1->diff($d2); 
        return (($diff->h < 10) ? '0'.$diff->h:$diff->h).':'.(($diff->i < 10) ? '0'.$diff->i:$diff->i).':'.(($diff->s < 10) ? '0'.$diff->s:$diff->s);
    }

    function since($date) {
        $a = strtotime("now"); 
        $b = strtotime($date);
        $c = $a-$b;
        $minute = 60;
        $hour = $minute*60;
        $day = $hour*24;
        $week = $day*7;
        if(is_numeric($c) && $c > 0) {
            if($c < 3) return 'tout de suite';
            if($c < $minute) return 'il y a '.floor($c).' secondes';
            if($c < $minute * 2) return 'il y a environ 1 minute';
            if($c < $hour) return 'il y a '.floor($c / $minute).' minutes';
            if($c < $hour * 2) return 'il y a environ 1 heure';
            if($c < $day) return 'il y a '.floor($c / $hour).' heures';
            if($c > $day && $c < $day * 2) return 'hier';
            if($c < $day * 365) return 'il y a '.floor($c / $day).' jours';
            return 'il y a plus d\'un an';
        }
    }

    function prettyDate($date) {
        $jour = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi","Samedi");
        $mois = array("01"=>"Janvier", "02"=>"Février", "03"=>"Mars", "04"=>"Avril", "05"=>"Mai", "06"=>"Juin", "07"=>"Juillet", "08"=>"Août", "09"=>"Septembre", "10"=>"Octobre", "11"=>"Novembre", "12"=>"Décembre");
        $split = preg_split('/\-/',$date);
        $j = substr($split[2],0,2);
        $m = $split[1];
        $a = $split[0];
        return $j.' '.$mois[$m].' '.$a;
    }

    function month($index) {
        $mois = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
        return $mois[$index-1];
    }

    function sortByCall($a, $b){
        return strcmp($a->Service->callCount, $b->Service->callCount);
    }

    function sortByRating($a, $b){
        return strcmp($a->Service->rateCount, $b->Service->rateCount);
    }

    function remove_accents($str) {
        $str = str_replace(
            array(
                'à', 'â', 'ä', 'á', 'ã', 'å',
                'î', 'ï', 'ì', 'í', 
                'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
                'ù', 'û', 'ü', 'ú', 
                'é', 'è', 'ê', 'ë', 
                'ç', 'ÿ', 'ñ', 
            ),
            array(
                'a', 'a', 'a', 'a', 'a', 'a', 
                'i', 'i', 'i', 'i', 
                'o', 'o', 'o', 'o', 'o', 'o', 
                'u', 'u', 'u', 'u', 
                'e', 'e', 'e', 'e', 
                'c', 'y', 'n', 
            ),
            $str
        );
        return $str; 
    }

    function slugify($str) {
        $str = utf8_encode($str);
        $str = remove_accents($str);
        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        return $str;
    }

?>