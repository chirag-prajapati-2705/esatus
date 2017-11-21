<?php

class changeStatus {

    private $db;

    function __construct() {
        $this->host = 'localhost';
        $this->pass = 'QCuN30g0O2WGYOZ';
        $this->user = 'esatus_bdd_user';
        $this->base = 'esatus';
        $this->connexion = $this->connect();
    }

    public function connect() {

        $connexion = @mysql_pconnect($this->host, $this->user, $this->pass) or die('erreur de connexion :' . mysql_error());
        mysql_select_db($this->base);

        return $connexion;
    }

    public function execute($sql) {
        $result = mysql_query($sql) or die('erreur sur la requete :' . mysql_error());
        return $result;
    }

    public function Status($value, $id) {
        $this->connect();
        $the_date = date('Y-m-d');

        //added by andru [updating date]
        $date_query = 'update availabilities set date_update = "' . $the_date . '" where service_id = (select services.id from services where profile_id = "' . $id . '")';
        $this->execute($date_query);

        if ($value == "En ligne") {
            //echo 'En ligne';
            $q = 'update availabilities set flag = "1" where service_id = (select services.id from services where profile_id = "' . $id . '")';
            //$q = 'UPDATE availabilities SET flag = "1", date_update = "'.$date.'" where service_id = (select services.id from services where profile_id = "'.$id.'" )';
            $this->execute($q);
            echo 'en ligne';
        }
        if ($value == "Indisponible") {
        //l utilisateur sera indisponible
            //echo 'Indisponible';

            $q = 'update availabilities set flag = "0" where service_id = (select services.id from services where profile_id = "' . $id . '")';
            //$q = 'UPDATE availabilities SET flag = "0", date_update = "'.$date.'" where service_id = (select services.id from services where profile_id = "'.$id.'" )';
            $this->execute($q);
            echo 'Indisponible';
        }
        if ($value == "Occupe") {
            //echo 'autre';
            //$this->connect();
            $q = 'update availabilities set flag = "2" where service_id = (select services.id from services where profile_id = "' . $id . '")';
            //$q = 'UPDATE availabilities SET flag = "2", date_update = "'.$date.'" where service_id = (select services.id from services where profile_id = "'.$id.'" )';
            $this->execute($q);
            echo 'Occupe';
        }
    }

}

$mon_id = $_GET['id_session'];
$value = $_POST['val_sel'];
$set_my_state = new changeStatus();
$set_my_state->Status($value, $mon_id);
