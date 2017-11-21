<?php 
	class Rating extends Model {
		public $rules = array(
            'comment' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez laisser un commentaire.'
            )   
        );
	} 
?>