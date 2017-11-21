<?php

	if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$this->layout = 'ajax';
	}

    if ($this->request->prefix == 'admin') {
        session_start();
        if (isset($_SESSION['admin'])) {
            $this->layout = 'admin';
        } else {
            $this->redirect('admins/login');
            die();
        }
    }

    switch ($this->request->prefix) {
        case 'pdf': 
            $this->layout = 'pdf';
        break;
        case 'server': 
            $this->layout = 'server';
        break;
        case 'txt': 
            $this->layout = 'txt';
        break;
        case 'xml': 
            $this->layout = 'xml';
        break;
        case 'csv': 
            $this->layout = 'csv';
        break;
    }

?>