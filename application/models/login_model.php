<?php
Class Login_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function check_login() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];

            //Render Settings
            $data['settings'] = $session_data['user_level'] == 'super-admin' || $session_data['user_level'] == 'admin' ? "<a href='".base_url()."index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;



            $this->load->view('home', $data);
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }      
}

?>