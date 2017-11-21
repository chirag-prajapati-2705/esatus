<?php
class Status extends Controller{
private $db;
public $uses = array('User', 'Service', 'Category', 'Subcategory', 'Card', 'Call', 'Callprogress', 'Rating', 'Availability', 'Rib');
public function connect() {
$conf = Conf::database();
            try {
                $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',$conf['login'],$conf['password']);
                $this->db = $pdo;
            } catch (PDOException $e) {
                die($e->getMessage());
            }

        }

	public function MonStatus() {
	 $this->connect();
	 $mon_id = $this->Session->profile('id');
	 $q = ' SELECT flag FROM availabilities WHERE service_id = (select services.id from services where profile_id = "'.$mon_id.'") ';
	 $req = $this -> db -> query ($q);
	 $req->setFetchMode(PDO::FETCH_OBJ);
	 while ($res = $req -> fetch ()) {
	 $resultat = $res->flag;
	 }
	 return $resultat;         
	   }

	 //added by andru

	 public function MonStatusAvance(){
        $this->connect();
        
        $service = $this->Service->findOneBy(array('conditions' => array('profile_id' => $this->Session->profile('id'))));

        $id = $this->Session->profile('id');
        $q = 'SELECT flag, date_update FROM availabilities WHERE service_id =  "' . $service->Service->id . '"  ';
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
 }

?>