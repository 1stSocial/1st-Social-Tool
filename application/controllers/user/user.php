<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->view('user/header');
        $this->load->model('user_model/user_model');
        $this->load->helper('date');
        
    }

    public function index() {
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $this->load->library('pagination');
        $config['base_url'] = site_url().'/user/user/index';
        $config['per_page'] = 5;
        $val =$this->uri->segment(4);
        
        if ($this->input->post()) {
            $id = $this->input->post('val');
            $id_array = explode(",", $id);
            if (count($id_array) - 1 == 0) {
                $config['total_rows'] = $this->user_model->page_count('post_job');
                $data['post'] = $this->user_model->post_job($val);
//            $data['parent_id'] = $this->user_model->parent_id();
                $this->pagination->initialize($config);
                echo $this->load->view('user/mainpage_content', $data, TRUE);
            } else {
                $config['total_rows'] = $this->user_model->refine_post_count($id_array);
                $this->pagination->initialize($config);
                $data['post'] = $this->user_model->refine_post_job($id_array,$val);
                echo $this->load->view('user/content', $data, TRUE);
            }
            die;
        } else {
            $config['total_rows'] = $this->user_model->page_count('post_job');
            $this->pagination->initialize($config);
            $data['post'] = $this->user_model->post_job($val);
//            $data['parent_id'] = $this->user_model->parent_id();
            $data['content'] = $this->load->view('user/mainpage_content', $data, TRUE);
//         
        }
        $data['tag'] = $tag_model->semi_parent();
        $data['latestjob'] = $this->user_model->latest_job();
//            var_dump($data);
        
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer', $data['tag']);
    }

    public function footer_refine() {
        $id = $this->input->post('val');
        $id_array = array(
            '0' => $id,
            '1' => ''
        );
        
        $this->load->library('pagination');
        $config['base_url'] = site_url().'/user/user/index';
        $config['per_page'] = 5;
        $config['total_rows'] = $this->user_model->refine_post_count($id_array);
        $this->pagination->initialize($config);
        $val =$this->uri->segment(4); 
        $data['post'] = $this->user_model->refine_post_job($id_array,$val);
        $data['pagename'] = 'footer_refine';
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    public function salary_refine() {
        $this->load->library('pagination');
//        $config['base_url'] = site_url().'/user/user/index';
        $config['per_page'] = 5;
        $config['total_rows'] = $this->user_model->page_count('refine_job_salary');
         $this->pagination->initialize($config);
        $val =$this->uri->segment(4);
        
        
        $data['post'] = $this->user_model->refine_job_salary($val);
        $data['pagename'] = 'salary_refine';
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }
    
    public function detail()
    {
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        
        $boardId = $this->uri->segment(4);
        
        $data['post'] = $this->user_model->view_detail($boardId);
        
        $data['content'] = $this->load->view('user/more_detail', $data, TRUE);
       
        $data['tag'] = $tag_model->semi_parent();
        $data['latestjob'] = $this->user_model->latest_job();
//        print_r($data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer', $data['tag']);
        
    }
    
    public function keyword_search()
    {
        $this->load->library('pagination');
//        $config['base_url'] = site_url().'/user/user/index';
        $config['per_page'] = 5;
        $config['total_rows'] = $this->user_model->page_count('keyword_search');
        $var = $this->input->post('page');
        
        if($var)
        {
            $config['current_page'] = $var;
//            $config['use_page_numbers'] = TRUE;
            $var = $var -1;
            $val = $var * $config['per_page'];
        }
        else
        {
            $val = $this->uri->segment(4);
        }
         $this->pagination->initialize($config);
        
         
        $data['post'] = $this->user_model->keyword_search($val);
        $data['pagename'] = 'keyword_search';
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

}

?>