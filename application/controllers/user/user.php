<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model/user_model');
        $temp = new User_model;
        $theme = $temp->apply_theme();

        $str = "";

        if (is_array($theme)) {
            foreach ($theme as $val) {
                $str .= '@' . $val['key'] . ':' . $val['value'] . '!important;';
            }
        } else {
            $str = "";
        }
        $filepath = 'assets/css/user/temp.less';
         if(file_exists ($filepath ))
         {
             unlink($filepath);
         }
        
        $isboardjobs1 = $this->uri->segment(1) ; 
        $isboardjobs2 = $this->uri->segment(2) ; 
        $isboardjobs3 = $this->uri->segment(3) ; 
      
        if($isboardjobs1 != "board" && $isboardjobs2!="board" && $isboardjobs3!="board")
        {
        $fp = fopen($filepath, "w+");
        flock($fp,LOCK_EX);
        fwrite($fp, $str);
        flock($fp,LOCK_UN);
        fclose($fp);
          $this->load->view('user/header');
        }
//          chmod($filepath,'0750');
        $this->load->helper('date');
    }

     public function board($data_str = FALSE)
    {
        $temp = new User_model;
        if($data_str)
        {
            $id = $temp ->get_boardid($data_str);
            if($id!="")
            {
                $board_id = $id[0]->id;
           $theme = $temp->apply_theme2($id[0]->id);
            }else
            $theme = $temp->apply_theme();    
        }
        else
        {
            $theme = $temp->apply_theme();
        }
        $str = "";
        $myarr = array();
        if (is_array($theme)) {
            foreach ($theme as $val) {
                $str .= '@' . $val['key'] . ':' . $val['value'] . '!important;';
            }  
        } else {
            $str = ""; 
        }
       $filepath = 'assets/css/user/temp.less';
       $fp = fopen($filepath, "w+");
        flock($fp,LOCK_EX);
        fwrite($fp, $str);
        flock($fp,LOCK_UN);
        fclose($fp);
        $this->load->view('user/header');
        
        //body start here..
        
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/user/board/'.$data_str ;
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $val = $this->uri->segment(5);
//        var_dump($val);die;
        
        $data['pageno'] = $val;
      

        if ($val > 1) {
            $val = $val - 1;
        } else {
            $val = 0;
        }

        if ($this->input->post()) {
            $id = $this->input->post('val');
            $id_array = explode(",", $id);
            if (count($id_array) - 1 == 0) {
                $config['total_rows'] = $this->user_model->page_count('post_job');
                if(isset($board_id))
                $data['post'] = $this->user_model->post_job($val * 5,$board_id);
                else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                }
                $data['pageno'] = $this->input->post('pageno');
//            $data['parent_id'] = $this->user_model->parent_id();
                $this->pagination->initialize($config);
                echo $this->load->view('user/mainpage_content', $data, TRUE);
            } else {
                $config['total_rows'] = $this->user_model->refine_post_count($id_array);
                $this->pagination->initialize($config);
                $data['post'] = $this->user_model->refine_post_job($id_array, $val * 5);
                echo $this->load->view('user/content', $data, TRUE);
            }
            die;
        } else {
            $config['total_rows'] = $this->user_model->page_count('post_job');
            $this->pagination->initialize($config);
//            echo $val ; die;
            if(isset($board_id))
                $data['post'] = $this->user_model->post_job($val * 5,$board_id);
                else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                }
            $data['content'] = $this->load->view('user/mainpage_content', $data, TRUE);
//         
        }
        $data['tag'] = $tag_model->semi_parent();
        $data['latestjob'] = $this->user_model->latest_job();
//            var_dump($data);

        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer', $data['tag']);
        
    }


    public function index() {
       
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/user/index';
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $val = $this->uri->segment(4);
        $data['pageno'] = $val;

        if ($val > 1) {
            $val = $val - 1;
        } else {
            $val = 0;
        }

        if ($this->input->post()) {
            $id = $this->input->post('val');
            $id_array = explode(",", $id);
            if (count($id_array) - 1 == 0) {
                $config['total_rows'] = $this->user_model->page_count('post_job');
                $data['post'] = $this->user_model->post_job($val * 5);
                $data['pageno'] = $this->input->post('pageno');
//            $data['parent_id'] = $this->user_model->parent_id();
                $this->pagination->initialize($config);
                echo $this->load->view('user/mainpage_content', $data, TRUE);
            } else {
                $config['total_rows'] = $this->user_model->refine_post_count($id_array);
                $this->pagination->initialize($config);
                $data['post'] = $this->user_model->refine_post_job($id_array, $val * 5);
                echo $this->load->view('user/content', $data, TRUE);
            }
            die;
        } else {
            $config['total_rows'] = $this->user_model->page_count('post_job');
            $this->pagination->initialize($config);

            $data['post'] = $this->user_model->post_job($val * 5);
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
        $config['base_url'] = site_url() . '/user/user/index';
        $config['per_page'] = 5;
        $config['total_rows'] = $this->user_model->refine_post_count($id_array);
        $this->pagination->initialize($config);
        $val = $this->uri->segment(4);
        $data['post'] = $this->user_model->refine_post_job($id_array, $val);
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
        $val = $this->uri->segment(4);


        $data['post'] = $this->user_model->refine_job_salary($val);
        $data['pagename'] = 'salary_refine';
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    public function detail() {
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

    public function keyword_search() {
        $this->load->library('pagination');
//        $config['base_url'] = site_url().'/user/user/index';
        $config['per_page'] = 5;
        $config['total_rows'] = $this->user_model->page_count('keyword_search');
        $var = $this->input->post('page');

        if ($var) {
            $config['current_page'] = $var;
//            $config['use_page_numbers'] = TRUE;
            $var = $var - 1;
            $val = $var * $config['per_page'];
        } else {
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