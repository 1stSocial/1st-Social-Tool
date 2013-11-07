<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxonomy extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                $this->load->view('header');
		$this->load->model("login_model");
                $this->load->helper('form');
                
                if ($this->session->userdata('logged_in')) 
                {
                    $session_data = $this->session->userdata('logged_in');
                    $data['username'] = $session_data['username'];
                    //Render Settings
                    $data['settings'] = $session_data['access_level'] == 'super-admin' || $session_data['access_level'] == 'admin' ? "<a href='" . base_url() . "index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;
                    
                    $data['access_level'] =  $session_data['access_level'];
                    
                    $this->load->view('admin/home', $data);
                    //$this->load->view('footer');
                } else {
                    //If no session, redirect to login page
                    redirect('/login');
                }
               
                $this->load->model('taxonomy_model');
	}

	function index($option = FALSE) {
           
            $this->load->model('tag_model');
            
            $data['taxonomy']=$this->taxonomy_model->get_taxonomy();
            if($option)
            {
              $data['option'] = $option;
              $obj = new Tag_model();
              $data['parenTag'] = $obj->root_parent();
              
              $this->load->view('manage_taxonomy',$data);
              
            }
            else
            {
                $this->load->view('manage_taxonomy',$data);
            }
//            var_dump($data);
            

	}

	function get_taxonomy() {
            $this->load->model('tag_model');
            
            $id =$this->input->post('id');
            $data= $this->taxonomy_model->get_taxonomy($id);
                $obj = new Tag_model();
              $data[0]->parenTag = $obj->root_parent();
              
              var_dump($data);
              
              echo $this->load->view('edit_taxonomy',$data[0],TRUE);
              die();
	}

	function set_taxonomy() {

	}

	function add_taxonomy() {
         
            if($this->input->post())
            {
              $this->taxonomy_model->add_taxonomy();
             
            }else
            { 
                 $this->load->view('add_taxonomy');
            }
            die();
	}

	function edit_taxonomy() {
        
           // var_dump($this->input->post()); 
        $this->taxonomy_model->update_taxonomy();   
       
        die();
	}
     
	function delete_taxonomy($taxonomy_id) {
           $this->taxonomy_model->delete_taxonomy($taxonomy_id);
         
           redirect('taxonomy');
           
	}
}