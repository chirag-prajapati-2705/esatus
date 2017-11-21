<?php

    class AvailabilitiesController extends Controller {

        public $uses = array('Service','Availability');

        /**
         * Request Action.
         */
        public function test() {
            $service = current($this->Service->findOneBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id')))));
            $availabilities = current($this->Availability->findOneBy(array('conditions'=>array('service_id'=>$service->id))));
            return $availabilities->status;
        }

        /**
         * Pages.
         */
        public function ajax_next() {

            if ($this->request->data) {
                $data = $this->request->data;
                $d['value'] = $data->value;
                $this->set($d);
            } 

        }

        public function ajax_save($id) {

            if (!isset($id) || !is_numeric($id)) {
                die();
            }

            if ($this->request->data) {

                $data = $this->request->data;

                $service = $this->Service->findOneBy(array('conditions'=>array('id'=>$id,'profile_id'=>$this->Session->profile('id'))));

                if (!$service) {
                    die();
                } else {
                    $service = current($service);
                }

                $availabilities = current($this->Availability->findOneBy(array('conditions'=>array('service_id'=>$service->id))));

                $data->id = $availabilities->id;
                $data->monday = ($data->monday == '') ? '0:0':substr($data->monday,0,-1);
                $data->tuesday = ($data->tuesday == '') ? '0:0':substr($data->tuesday,0,-1);
                $data->wednesday = ($data->wednesday == '') ? '0:0':substr($data->wednesday,0,-1);
                $data->thursday = ($data->thursday == '') ? '0:0':substr($data->thursday,0,-1);
                $data->friday = ($data->friday == '') ? '0:0':substr($data->friday,0,-1);
                $data->saturday = ($data->saturday == '') ? '0:0':substr($data->saturday,0,-1);
                $data->sunday = ($data->sunday == '') ? '0:0':substr($data->sunday,0,-1);
                $this->Availability->save($data);
                
                $d = array();
                $this->set($d);
            } 

        }

        public function ajax_empty($id) {

            if (!isset($id) || !is_numeric($id)) {
                die();
            }

            if ($this->request->data) {

                $data = $this->request->data;

                $service = $this->Service->findOneBy(array('conditions'=>array('id'=>$id,'profile_id'=>$this->Session->profile('id'))));

                if (!$service) {
                    die();
                } else {
                    $service = current($service);
                }

                $availabilities = current($this->Availability->findOneBy(array('conditions'=>array('service_id'=>$service->id))));

                $data->id = $availabilities->id;
                $data->monday = '0:0';
                $data->tuesday = '0:0';
                $data->wednesday = '0:0';
                $data->thursday = '0:0';
                $data->friday = '0:0';
                $data->saturday = '0:0';
                $data->sunday = '0:0';
                $data->flag = 0;
                
                $this->Availability->save($data);
                
                $d = array();
                $this->set($d);
            } 
        }

        public function ajax_update() {

            $services = $this->Service->findBy(array('conditions'=>array('profile_id'=>$this->Session->profile('id'))));

            if (!$services) {
                die();
            } 

            foreach ($services as $k=>$v) {
                $v = current($v);

                $availabilities = $this->Availability->findOneBy(array('conditions'=>array('service_id'=>$v->id)));

                if ($availabilities) {
                    $availabilities = current($availabilities);
                    $availabilities->status = ($availabilities->status == 0) ? 1:0;
                    $this->Availability->save($availabilities);
                }
            }
        }

        //added by andru
        public function ajax_indisponible()
        {
            $service_id = $_POST["serviceid"];

            $availabilities = $this->Availability->findOneBy(array('conditions'=>array('service_id'=>$service_id)));
            if($availabilities)
            {
                $availabilities = current($availabilities);
                $availabilities->flag = 0;
                $availabilities->date_update = date('Y-m-d');
                $this->Availability->save($availabilities);

                echo "done";
            }
            die;
        }
        
        //added by andru
        public function ajax_statut()
        {
            $service_id = $_POST["serviceid"];
            $statut = $_POST["statut"];

            $availabilities = $this->Availability->findOneBy(array('conditions'=>array('service_id'=>$service_id)));
            if($availabilities)
            {
                $availabilities = current($availabilities);
                $availabilities->flag = $statut;
                $availabilities->date_update = date('Y-m-d');
                $this->Availability->save($availabilities);

                echo "done";
            }
            die;
        }
        
        public function ajax_empty2() {

        $service_id = $_POST["serviceid"];

        $availabilities = current($this->Availability->findOneBy(array('conditions' => array('service_id' => $service_id))));

        $data->id = $availabilities->id;
        $data->monday = '0:0';
        $data->tuesday = '0:0';
        $data->wednesday = '0:0';
        $data->thursday = '0:0';
        $data->friday = '0:0';
        $data->saturday = '0:0';
        $data->sunday = '0:0';
        $data->flag = 0;
        $data->date_update = date('Y-m-d');
        $this->Availability->save($data);
        echo $service_id;
        $d = array();
        $this->set($d);
        die;
    }

}

?>