<?php

    class SubcategoriesController extends Controller {

        public $uses = array('Subcategory');

        /**
         * Pages.
         */
        public function ajax_getList() {

            if ($this->request->data) {
                $data = $this->request->data;
                $subcategories = $this->Subcategory->findBy(array('conditions'=>array('category_id'=>$data->id)));
                if ($subcategories) {
                    $d['subcategories'] = $subcategories;
                    $this->set($d);
                } 
            } 

        }
        
    }

?>