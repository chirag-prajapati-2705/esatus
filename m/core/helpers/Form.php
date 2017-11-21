<?php

    class Form {
        
        public $controller;

        public $html;
        
        public $errors;
        
        public function __construct($controller) {
            $this->controller = $controller;
        }
        
        public function create($options) {
            $this->html = '<form';
            if (isset($options)) {
                if (is_array($options)) {
                    foreach($options as $k=>$v){
                        $this->html .= ' '.$k.'="'.$v.'"';
                    }
                } else {
                    $this->html .= $options;
                }
            } else {
                $this->html .= $options;
            }
            $this->html .= '>'."\n";
            echo $this->html;
            $this->html = '';
        }

        public function input($options=array()) {

            $error = (isset($this->errors[$options['name']])) ? $this->errors[$options['name']]:false;
            
            if (isset($options['options']['value']) && !isset($this->errors[$options['name']])) {

                $value = $options['options']['value'];

            } else {
                $value = (isset($this->controller->request->data->$options['name'])) ? stripslashes(utf8_encode($this->controller->request->data->$options['name'])):'';   
            }


            if ($options['type'] == 'hidden') {

                $this->html .= "\t".'<input type="hidden" name="'.$options['name'].'" value="'.$value.'">'."\n";

            } else {

                $this->html .= '<label ';
                if (isset($options['addClass']) && !empty($options['addClass'])) {
                    $this->html .= 'class="'.$options['addClass'].'"';
                }
                $this->html .= 'for="'.$options['name'].'">'.$options['label'].'</label>'."\n";
                $this->html .= '<input ';
                $this->html .= 'type="'.$options['type'].'" name="'.$options['name'].'" value="'.$value.'"';
                if (isset($options['options'])) {
                    foreach($options['options'] as $k=>$v){
                        if ($k != 'type' && $k != 'value') {
                            $this->html .= ' '.$k.'="'.$v.'"';
                        }
                    }
                }
                $this->html .= ">\n";                
                $this->html .= ($error) ? '<div class="alert alert-info">'.$error.'</div>':'';

            } 

            echo $this->html;
            $this->html = '';
        }

        public function textarea($options=array()) {

            $error = (isset($this->errors[$options['name']])) ? $this->errors[$options['name']]:false;

            if (isset($options['options']['value']) && !isset($this->errors[$options['name']])) {

                $value = $options['options']['value'];

            } else {
                $value = (isset($this->controller->request->data->$options['name'])) ? stripslashes(utf8_encode($this->controller->request->data->$options['name'])):'';   
            }


            $this->html .= '<label ';
            if (isset($options['addClass']) && !empty($options['addClass'])) {
                $this->html .= 'class="'.$options['addClass'].'"';
            }
            $this->html .= 'for="'.$options['name'].'">'.$options['label'].'</label>'."\n";
            $this->html .= '<textarea ';
            $this->html .= 'name="'.$options['name'].'"';
            if (isset($options['options'])) {
                foreach($options['options'] as $k=>$v){
                    if ($k != 'type') {
                        $this->html .= ' '.$k.'="'.$v.'"';
                    }
                }
            }
            $this->html .= ">\n";
            $this->html .= $value;
            $this->html .= '</textarea>';
            $this->html .= ($error) ? '<div class="alert alert-info">'.$error.'</div>':'';

            echo $this->html;
            $this->html = '';

        }

        public function select($options=array()) {
            /* $options = array(
                'label'=>'Name',
                'name'=>'name',
                'options'=>array(
                    'class'=>'test',
                    'pattern'=>'^.+$',
                    'required'=>'required'
                )
            ); */
            $this->html .= "\t".'<div class="input">'."\n";
            $this->html .= "\t\t".'<label for="'.$options['name'].'">'.$options['label'].'</label>'."\n";
            $this->html .= "\t\t".'<select name="'.$options['name'].'"';
            if (isset($options['options'])) {
                foreach($options['options'] as $k=>$v){
                    if ($k != 'type') {
                        $this->html .= ' '.$k.'="'.$v.'"';
                    }
                }
            }
            $this->html .='">'."\n";
            foreach($options['lists'] as $k=>$v) {
                $html .= "\t\t\t".'<option value="'.$v->id.'">'.utf8_encode($v->name).'</option>'."\n";
            }
            $this->html .= "\t\t".'</select>'."\n";
            $this->html .= "\t".'</div>'."\n";
        }

        public function checkbox($name) {
            $value = (isset($this->controller->request->data->$name)) ? stripslashes(utf8_encode($this->controller->request->data->$name)):'';
            $this->html .= "\t".'<div class="input">'."\n";
            $this->html .= "\t\t".'<input type="checkbox" name="'.$name.'" '.(empty($value) ? '':'checked').' >'."\n";
            $this->html .= "\t\t".'<span>Cocher cette case pour afficher l\'article</span>';
            $this->html .= "\t".'</div>'."\n";
        }

        public function submit($message) {
            $this->html .= "\t".'<div class="input">'."\n";
            $this->html .= "\t\t".'<input type="submit" value="'.$message.'">'."\n";
            $this->html .= "\t".'</div>'."\n";
        }

        public function end() {
            $this->html .= '</form>'."\n";
            echo $this->html;
        }
        
    }

?>