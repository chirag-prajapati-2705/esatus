<?php 
	class Profile extends Model {
		public $rules = array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Votre email est invalide.'
            ),
            'password' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez préciser votre mot de passe.'
            )    
        );
	} 
?>