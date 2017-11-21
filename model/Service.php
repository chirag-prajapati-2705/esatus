<?php 
	class Service extends Model {
		public $rules = array(
			// Description du service
			'title' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer le titre du service.'
            ), 
            'description' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez rédiger un description courte.'
            ), 
            'presentation' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez vous présenter.'
            ), 
            'reference' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer vos références.'
            ), 

            // Tarif du service
            'cost_per_minute' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer le tarif par minute du service.'
            ), 
            'cost_per_call' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer le tarif par apppel du service.'
            ), 

            // Informations générales
            'corporate_name' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer votre raison sociale.'
            ), 
            'duns' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer votre numéro de SIRET.'
            ), 
            'street_address' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer l\'adresse du siège social.'
            ), 
            'city' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer la ville du siège social.'
            ), 
            'zipcode' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer le code postal du siège social.'
            ), 

            // Téléphone
            'phone' => array(
                'rule' => '([0-9+])([0-9]{8,12})',
                'message' => 'Veuillez indiquer un numéro de téléphone valide.'
            )   
        );
	} 
?>