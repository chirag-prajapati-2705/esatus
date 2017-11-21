<?php 
	class Callprogress extends Model {
	public $rules = array(
            'SESID' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown session ID'
            ),
            'EXPERT' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown expert state'
            ), 
            'CLIENT' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown client state'
            )
        );
	} 
?>

