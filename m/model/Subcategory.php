<?php 
	class Subcategory extends Model {
		public $table = 'subcategories';
		public $rules = array(
			'title' => array(
                'rule' => 'notEmpty',
                'message' => 'Veuillez indiquer le titre de la sous-catégorie.'
            )
        );
	} 
?>