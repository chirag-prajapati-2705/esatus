<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

class CallsVideoController extends Controller {

    public $uses = array('Call', 'Profile', 'User', 'Service', 'Category', 'Subcategory', 'Issue', 'Card', 'Balance', 'Availability', 'Calldetail', 'Callprogress', 'Preautorisation', 'Callstate', 'VideoCallDetail');

    public function callstart() {

        $this->loadModel('VideoCallDetail');
        $VideoCallDetail = new stdClass ();
        $service_id = $_POST["service_id"];
        $user_id = $_POST["user_id"];

        $VideoCallDetail->session_id = session_id();
        $VideoCallDetail->service_id = 1;
        $VideoCallDetail->user_id = 1;
        $VideoCallDetail->debut = date('Y-m-d H:i:s');
        $VideoCallDetail->fin = 0;
        $VideoCallDetail->cost = 0;
        $VideoCallDetail->payment = 0;
        $VideoCallDetail->statut = 'start';

        $this->VideoCallDetail->save($VideoCallDetail);

    }

    public function callend() {

        $this->loadModel('VideoCallDetail');
        $service_id = 1;
        $user_id = 4625;
        $payment = 0;


        $VideoCallDetail = current($this->VideoCallDetail->findOneBy(array('conditions' => array('session_id' => session_id(),'statut' => 'start'))));
        $service = current($this->Service->findOneBy(array('conditions' => array('id' => $service_id))));
        // Numéro de la carte
        $card = current($this->Card->findOneBy(array('conditions' => array('profile_id' => $user_id))));
        $preautorisation = current($this->Preautorisation->findOneBy(array('conditions' => array('profile_id' => $user_id))));
        $profile = current($this->Profile->findOneBy(array('conditions' => array('id' => $user_id))));


        $end = date('Y-m-d H:i:s');
        $c = strtotime($end) - strtotime($VideoCallDetail->debut);

        $cost = (($c / 60) * $service->cost_per_minute) + $service->cost_per_call;
        $issue = current($this->Issue->find(1));
        $url = "https://ppps.paybox.com/PPPS.php";


        $params = array(
            'VERSION' => '00104',
            'DATEQ' => date('dmYHis'),
            'TYPE' => '00052', // ?? 52
            'NUMQUESTION' => str_pad($issue->number, 10, "0", STR_PAD_LEFT),
            'SITE' => '1101352',
            'RANG' => '001',
            'CLE' => 'luguwPBf',
            'MONTANT' => number_format($cost, 2) * 100,
            'DEVISE' => '978',
            'REFERENCE' => 'video-1',
            'REFABONNE' => $profile->email,
            'PORTEUR' => $card->mark,
            'DATEVAL' => $card->expiry_date,
            'CVV' => $card->cryptogram,
            'ACTIVITE' => '027',
            'NUMTRANS' => $preautorisation->numtrans,
            'NUMAPPEL' => $preautorisation->numappel
        );
        $issue->number++;
        $this->Issue->save($issue);
        $post = '';
        foreach ($params as $k => $v) {
            $post .= $k . '=' . $v . '&';
        }
        $post = substr($post, 0, -1);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        if (preg_match('`^https://`i', $url)) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        }
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        $data = curl_exec($curl);

        $tmp = explode('&', $data);
        $response = new stdClass();
        foreach ($tmp as $value) {
            $vars = explode('=', $value);
            $vars[0] = strtolower($vars[0]);
            $response->$vars[0] = $vars[1];
        }

        if (isset($response->codereponse) && $response->codereponse == '00000') {
            $payment = 1;
        }

        $this->Preautorisation->delete($preautorisation->id);

        $VideoCallDetail->session_id = session_id();
        $VideoCallDetail->service_id = 1;
        $VideoCallDetail->user_id = 1;
        $VideoCallDetail->debut = $VideoCallDetail->debut;
        $VideoCallDetail->fin = $end;
        $VideoCallDetail->cost = number_format($cost, 2);
        $VideoCallDetail->payment = $payment;
        $VideoCallDetail->statut = 'end';

        $this->VideoCallDetail->save($VideoCallDetail);
    }

}

?>