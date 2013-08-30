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

        if ($this->input->post()) {
            $id = $this->input->post('val');
            $id_array = explode(",", $id);
            if (count($id_array) - 1 == 0) {
                $data['post'] = $this->user_model->post_job();
//            $data['parent_id'] = $this->user_model->parent_id();
                
                echo $this->load->view('user/mainpage_content', $data, TRUE);
            } else {
                $data['post'] = $this->user_model->refine_post_job($id_array);
                echo $this->load->view('user/content', $data, TRUE);
            }
            die;
        } else {
            $data['post'] = $this->user_model->post_job();
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

    function footer_refine() {
        $id = $this->input->post('val');
        $id_array = array(
            '0' => $id,
            '1' => ''
        );
        $data['post'] = $this->user_model->refine_post_job($id_array);
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    function salary_refine() {
        $data['post'] = $this->user_model->refine_job_salary();
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }
    
    function detail()
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

}

?>