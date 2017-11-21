<?php 
	class User extends Model {
	public $rules = array(
            'pseudo' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez préciser votre pseudo.'
            ),
                    
            'phone' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer un numéro de téléphone valide. exemple 0912345678'
            )   
        );
        public $check = array(
            'phone' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer un numéro de téléphone valide.'
            )   
        );
	} 
?>