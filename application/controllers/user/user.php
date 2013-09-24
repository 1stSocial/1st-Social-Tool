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
        if(!$temp->board_exist($isboardjobs1))
        {
            $fp = fopen($filepath, "w+");
            flock($fp,LOCK_EX);
            fwrite($fp, $str);
            flock($fp,LOCK_UN);
            fclose($fp);
            $this->load->view('user/header');
        }
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
      
        if($temp->board_exist($data_str))
        {    
            $fp = fopen($filepath, "w+");
             flock($fp,LOCK_EX);
             fwrite($fp, $str);
             flock($fp,LOCK_UN);
             fclose($fp);
             $data['board_name'] = $data_str;
             $this->load->view('user/header');
        }
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
               
               
                if(isset($board_id))
                {
                $data['post'] = $this->user_model->post_job($val * 5,$board_id);
                 $config['total_rows'] = $this->user_model->page_count('post_job',$board_id);
                
                }
                else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                    $config['total_rows'] = $this->user_model->page_count('post_job');
                }
                $data['pageno'] = $this->input->post('pageno');
//            $data['parent_id'] = $this->user_model->parent_id();
                $this->pagination->initialize($config);
                echo $this->load->view('user/mainpage_content', $data, TRUE);
            } else {
                if(isset($board_id))
                $config['total_rows'] = $this->user_model->refine_post_count($id_array,$board_id);
                else
                $config['total_rows'] = $this->user_model->refine_post_count($id_array);
                
                $this->pagination->initialize($config);
                if(isset($board_id))
                $data['post'] = $this->user_model->refine_post_job($id_array, $val * 5,$board_id);
                else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                }
                echo $this->load->view('user/content', $data, TRUE);
            }
            die;
        } else {
             if(isset($board_id))
            $config['total_rows'] = $this->user_model->page_count('post_job',$board_id);
             else
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
//       echo $board_id;
        if(isset($board_id))
        $data['tag'] = $tag_model->semi_parent($board_id);
        else
        $data['tag'] = $tag_model->semi_parent();
        
        $data['latestjob'] = $this->user_model->latest_job($board_id);
        $data['max_min'] =$this->user_model->taxo_val($board_id);
 //            var_dump($data);
//        $data['board_name'] = $
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
//                var_dump($id_array);die;
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
        $data['board_name']='home';
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer', $data['tag']);
    }

    public function footer_refine() {
        $id = $this->input->post('val');
        $data_str = $this->input->post('b_name');
        
        $board_id = $this->user_model->get_boardid($data_str);
         
        
        $id_array = array(
            '0' => $id,
            '1' => ''
        );

        $this->load->library('pagination');
        
        $config['base_url'] = site_url() . '/user/user/index';
        $config['per_page'] = 5;
        $config['total_rows'] = $this->user_model->refine_post_count($id_array,$board_id);
        $this->pagination->initialize($config);
        $val = $this->uri->segment(4);
        if($board_id=="")
         {
            $data['post'] = $this->user_model->refine_post_job($id_array, $val);
         }
        else
         {
//             var_dump($board_id);
            $data['post'] = $this->user_model->refine_post_job($id_array, $val,$board_id['0']->id);
         }
        
        $data['pagename'] = 'footer_refine';
        $data['board_name']=$data_str;
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    public function salary_refine() {
        $this->load->library('pagination');
//        $config['base_url'] = site_url().'/user/user/index';
        $config['per_page'] = 5;
        $data_str = $this->input->post('b_name');
         $board_id = $this->user_model->get_boardid($data_str);
        
        if($data_str == 'home')
        $config['total_rows'] = $this->user_model->page_count('refine_job_salary');
        else
        $config['total_rows'] = $this->user_model->page_count('refine_job_salary',$board_id);
        
        $this->pagination->initialize($config);
        $val = $this->uri->segment(4);
          $data_str = $this->input->post('b_name');
         if($board_id == "")
        $data['post'] = $this->user_model->refine_job_salary($val);
         else
        $data['post'] = $this->user_model->refine_job_salary($val,$board_id['0']->id);

        $data['pagename'] = 'salary_refine';
        $data['board_name']=$data_str;
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    public function detail() {
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $data_str = $this->uri->segment(5);;
       
        $boardId = $this->uri->segment(4);
        $base = base_url();
        
        $data['post'] = $this->user_model->view_detail($boardId);
//        var_dump($data['post']);die;
//        scandir($base.'assets/css/user/content/'.);
        $data['board_name']=$data_str;
        $data['content'] = $this->load->view('user/more_detail', $data, TRUE);

         $temp = new User_model;
         $id = "";
        
        if($data_str)
            $id = $temp ->get_boardid($data_str);
            
        
        
         if($id!="")
         {
        $data['tag'] = $tag_model->semi_parent($id[0]->id);
         $data['latestjob'] = $this->user_model->latest_job($id[0]->id);
        $data['max_min'] =$this->user_model->taxo_val($id[0]->id);
         }
        else
        $data['tag'] = $tag_model->semi_parent();
        
        $data['latestjob'] = $this->user_model->latest_job();
        
//        print_r($data);
      
        
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer', $data['tag']);
    }

    public function keyword_search() {
       
        $data_str = $this->input->post('b_name');
        $board_id = $this->user_model->get_boardid($data_str);
//        var_dump($board_id) ;
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
        if($board_id=="")
         {
            $data['post'] = $this->user_model->keyword_search($val);
         }
        else
         {
            $this->user_model->keyword_search($val,$board_id['0']->id);
         }
        

        $data['post'] = $this->user_model->keyword_search($val);
        $data['pagename'] = 'keyword_search';
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }
    

    public function gallary()
      {
          
          $this->load->model('setting/setting_model');
          
          $setting = new Setting_model();
          $data['item'] = $setting->get_image();
          
          $data['content'] = $this->load->view('user/gallary',$data,TRUE);
          $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer');
      }
    
}


?>  