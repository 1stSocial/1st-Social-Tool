<?php
session_start(); //we need to call PHP's session object to access it through CI

class Setting extends CI_Controller {

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
        $this->load->library('form_validation');
        
        $setting_model = new Setting_model;
        
        $data['theme_data'] = $setting_model->theme_name();
        
        $this->load->view('admin/Theme_Management',$data);
    }
    
    public function select_theme()
    {
        $this->load->library('form_validation');
        
        $setting_model = new Setting_model;
        
        $data['theme_data'] = $setting_model->theme_name();
        
        $this->load->view('admin/select_theme',$data);
    }

        public function set_theme()
    {
        $setting_model = new Setting_model;
        
        $setting_model->set_theme();
        
        echo "";
        die;
    }
    
    public function delete_theme()
    {
        $setting_model = new Setting_model;
        $id = $this->uri->segment(4);
        $setting_model->delete_theme($id);
        $this->index();
    }

    public function edit_theme()
    {
        $setting_model = new Setting_model;
        $data['id'] = $this->uri->segment(4);
        $data['name'] = $setting_model->name($data['id']);
        $data['val'] = $setting_model->get_theme_by_id($data['id']);
        
        $this->load->view('admin/edit_theme',$data);
    }
    
    public function theme_update()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('themename', 'Theme Name', 'required');
        
        $setting_model = new Setting_model;
        
        if ($this->form_validation->run() == TRUE)
            {
                $setting_model->update();
//                die();
                $this->index();
            }
            else
            {
                $this->load->view('admin/edit_theme');
                $this->load->view('footer');
            }
        
    }
    public function theme()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('themename', 'Theme Name', 'required');
        
        $setting_model = new Setting_model;
        
        if($this->input->post())
        {
            if ($this->form_validation->run() == TRUE)
            {
                $setting_model->save();
                $this->index();
            }
            else
            {
                $this->load->view('admin/create_theme');
                $this->load->view('footer');
            }
        }
        else 
        {
            $this->load->view('admin/theam_edit');
            $this->load->view('footer');
        
        }
      }
      
      public function gallary()
      {
          
          $this->load->model('setting/setting_model');
          
          $setting = new Setting_model();
          $data['item'] = $setting->get_image();
          
          $this->load->view('admin/gallary',$data);
          $this->load->view('footer');
      }
      
      public function add_user()
      {
          
      }
}
?>
