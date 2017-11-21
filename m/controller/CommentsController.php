<?php

    class CommentsController extends Controller {

    	public function erase($id,$sid,$cid) {

    		$this->loadModel('Service');
    		$this->loadModel('Comment');

    		$service = $this->Service->findOneBy(array('conditions'=>array('id'=>$sid,'profile_id'=>$this->Session->profile('id'))));

            if (!$service) {
                $this->redirect('services/calls');
                die();
            } 

    		$this->Comment->delete($id);
    		$this->redirect('services/comments/id:'.$sid.'/cid:'.$cid);

    	}

    }

?>