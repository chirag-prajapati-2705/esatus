<?php 
	class Calldetail extends Model {
	public $rules = array(
            'disposition' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown disposition'
            ),
            'disposition2' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown disposition2'
            ), 
            'billsec' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown billsec'
            ),
	    'answer' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown answer time'
            ),
            'end' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown end time'
            ),
            'dst' => array(
                'rule' => 'notEmpty',
                'message' => 'Uknown destination'
            )
        );
	} 
?>
