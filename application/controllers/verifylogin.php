<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model','',TRUE);
 }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

  
   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
   if($this->form_validation->run() == FALSE)
   {   
     //Field validation failed.&nbsp; User redirected to login page
      $this->load->view('header');
      $this->load->view('login');
      $this->load->view('footer');
   }
   else
   {  
     //Go to private area
   	$userData=$this->session->userdata('logged_in');
     switch($userData['access_level']){
     	case 'admin':
     		              redirect('/admin/home');
     		              break;
     	case 'partnet': 
     		              redirect('/partner/home');
     		              break;
     	case 'client':
     		              redirect('client/home');	
     		              break;	 
     	case 'user':
     		              redirect('user/home');
     		              break;		                          		                
     }
     
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.&nbsp; Validate against database
    $username = $this->input->post('username'); 

   //query the database
   $result = $this->user_model->login($username, $password);   
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->username, 
         'access_level' => $row->access_level
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 } 
}
