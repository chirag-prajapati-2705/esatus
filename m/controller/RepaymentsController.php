<?php

    class RepaymentsController extends Controller {

        public function request($id) {

        	if (!isset($id) || !is_numeric($id)) {
        		$this->redirect('services/index');
        		die();
        	}

        	$this->loadModel('Repayment');
        	$this->loadModel('Rib');
        	$this->loadModel('Balance');

        	$rib = $this->Rib->findOneby(array('conditions'=>array('service_id'=>$id)));

        	if (!$rib) {
        		$this->redirect('services/bdi/id:'.$id);
        		die();
        	}

        	$balance = $this->Balance->findOneby(array('conditions'=>array('service_id'=>$id)));

			if (!$balance) {
        		$this->redirect('services/repayments/id:'.$id);
        		die();
        	} else {
        		$balance = current($balance);
        	}   

			$repayment = new stdClass();
			$repayment->date = date('Y-m-d');
			$repayment->service_id = $id;
			$repayment->amount = $balance->gain;
			$repayment->status = 0;
			$this->Repayment->save($repayment);

			$balance->gain = 0;
			$this->Balance->save($balance);

            $this->Session->setFlash('Votre demande de virement a été enregistré.','info');
        	$this->redirect('admin/admins/services');
            die();	

        }
        
    }

?>