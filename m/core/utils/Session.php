<?php
    
    class Session {
        
        public function __construct($controller) {

            $this->controller = $controller;

            if (!isset($_SESSION)) {
                session_start();
                $_SESSION['id'] = session_id();
            }
        }

        public function check() {

            if (isset($_SESSION['init'])) {
                return true;
            } else {
                $_SESSION['init'] = true;
                return false;
            }

        }
        
        public function setFlash($message,$type = 'danger') {
            $_SESSION['flash'] = array(
               'message' => $message,
               'type' => $type
            );
        }
        
        public function flash() {
            if (isset($_SESSION['flash']['message'])) {
                $html = '<div class="alert alert-'.$_SESSION['flash']['type'].' text-center">'.$_SESSION['flash']['message'].'</div>';
                $_SESSION['flash'] = array();
                return $html;
            }
        }
        
        public function write($key,$value) {
            $_SESSION[$key] = $value;
        }
        
        public function read($key = null) {
            if ($key) {
                if (isset($_SESSION[$key])) {
                    return $_SESSION[$key];
                } else {
                    return false;
                }
            } else {
                return $_SESSION;
            }
        }
        
        public function isLogged() {
            return isset($_SESSION['profile']);
        }
        
        public function profile($key) {

            $this->controller->loadModel('Profile');
            $profile = $this->controller->Profile->findOneBy(array('conditions'=>array('id'=>$_SESSION['profile']->id)));

            if (!$profile) {
                $this->controller->redirect('users/create');
                die();
            }

            $this->write('profile',current($profile));

            if ($this->read('profile')) {
                if (isset($this->read('profile')->$key)) {
                    return $this->read('profile')->$key;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function admin($key) {
            
            if ($this->read('admin')) {
                if (isset($this->read('admin')->$key)) {
                    return $this->read('admin')->$key;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            
        }
        
    }
    
?>