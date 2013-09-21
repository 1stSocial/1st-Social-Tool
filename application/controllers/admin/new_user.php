<?php

class New_user extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->view('header');
        if ($this->session->userdata('logged_in')) {
            $this->load->model('setting/setting_model');
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            //Render Settings
            $data['settings'] = $session_data['access_level'] == 'super-admin' || $session_data['access_level'] == 'admin' ? "<a href='" . base_url() . "index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;

            $data['access_level'] = $session_data['access_level'];

            $this->load->view('admin/home', $data);
            $this->load->helper('form');
            //$this->load->view('footer');
        } else {
            //If no session, redirect to login page
            redirect('/login');
        }

        $this->load->helper('form');
    }

     public function index()
    {
         $this->load->model('adduser');
         $this->load->model('setting/setting_model');
         $session_data = $this->session->userdata('logged_in');
         
         $user_model = new adduser();
         $user = $session_data['username'];
         
         $data['user'] = $user_model->get_user($user);
         
         $this->load->view('admin/user_management',$data);
    }
    
    
    public function create_user()
    {
         $this->load->model('setting/setting_model');
         $this->load->model('adduser');
         
        $session_data = $this->session->userdata('logged_in');
        
         $user_model = new adduser();
         
         if($this->input->post())
         {
            $user_model->add_user();
            echo '';
            die;
         }
        else 
          {

                $value['parent_user_id'] =$user_model->user_id($session_data['username']);
                if($session_data['access_level'] == 'admin')
                {
                    $value['session'] = $session_data;
                    $value['domain'] = $user_model->domain();
                
                }
               else
               {
                    $value['session'] = $session_data;
               }
               $data = $this->load->view('admin/add_user',$value,TRUE);
               echo $data;
               die;
          }
    }
    
    public function edit_user()
    {
        $this->load->model('setting/setting_model');
         $this->load->model('adduser');
         
        $session_data = $this->session->userdata('logged_in');
        $id = $this->uri->segment(4);
     
         $user_model = new adduser();
         $value['val'] = $user_model->detail($id);
//         var_dump($value);die;
         
         if($this->input->post())
         {

            $user_model->update_user();
            echo '';
            die;
         }
        else 
          {

                $value['parent_user_id'] =$user_model->user_id($session_data['username']);
                if($session_data['access_level'] == 'admin')
                {
                    $value['session'] = $session_data;
                    $value['domain'] = $user_model->domain();
                
                }
               else
               {
                    $value['session'] = $session_data;
               }
//               var_dump($value);die;
               $data = $this->load->view('admin/edit_user',$value,TRUE);
               echo $data;
               die;
          }
    }
    
    public function username_check()
    {
         $this->load->model('adduser');
         $user_model = new adduser();
         
         
         $val =  $user_model->username_check();
         if($val == 'ok')
         {
             echo 'ok';
             
         }
         if($val == 'no')
         {
             echo 'no';
         }
         die;
    }
    
    public function delete_user($id)
    {
         $this->load->model('adduser');
         $user_model = new adduser();
         $user_model->delete_user($id);
         $this->index();
    }
    
 
}
?>
