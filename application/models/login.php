<?php
Class Login extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function check_login() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('home', $data);
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }      
}

?>