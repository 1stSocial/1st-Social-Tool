<?php
ob_start();

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model/user_model');
        $temp = new User_model;
        $theme = $temp->apply_theme();
        $css = "";
        $fb_val = "";

        $str = "";

        
        
        if (is_array($theme)) {
            foreach ($theme as $val) {
                if ($val['key'] != 'css_box')
                    $str .= '@' . $val['key'] . ':' . $val['value'] . '!important;';
                else {
                    $css = $val['value'];
                }
            }
        } else {
            $str = "";
        }
        $filepath = 'assets/css/user/temp.less';
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        $isboardjobs1 = $this->uri->segment(1);
        $isboardjobs2 = $this->uri->segment(2);
        $isboardjobs3 = $this->uri->segment(3);


        if ($isboardjobs1 != "board" && $isboardjobs2 != "board") {


            if (!$temp->board_exist($isboardjobs1)) {

                $fp = fopen($filepath, "w+");
                flock($fp, LOCK_EX);
                fwrite($fp, $str);
                flock($fp, LOCK_UN);
                fclose($fp);

                if ($this->uri->segment(3) || $this->uri->segment(1) == 'fb') {


                    if ($this->uri->segment(3) == 'fb') {
                        $fb_val = 'fb';
                        $data_str = $this->uri->segment(4);
                        $this->session->set_userdata(array('fb', 'fb'));
                    } else {
                        if ($this->uri->segment(1) == 'fb') {
                            $fb_val = 'fb';
                            $data_str = $this->uri->segment(2);
                            $this->session->set_userdata(array('fb', 'fb'));
                        } else {
                            $fb_val = '';
                            $this->session->set_userdata(array('fb', ''));
                            $data_str = $this->uri->segment(3);
                        }
                    }
                    if ($this->uri->segment(6) == 'fb' || $this->uri->segment(3) == 'detail') {
                        if ($this->uri->segment(6) != 'fb') {
                            $fb_val = '';
                            $this->session->set_userdata(array('fb', ''));
                        }
                        $data_str = $this->uri->segment(5);
                    }



                    if ($data_str) {
                        $id = $temp->get_boardid($data_str);
                        
                        $data['main'] = $id;
                        
                        if ($id != "") {
                            $board_id = $id[0]->id;
                            $theme = $temp->apply_theme2($id[0]->id);
                        }
                        else
                            $theme = $temp->apply_theme();
                    }
                    else {
                        $theme = $temp->apply_theme();
                    }
                    $str = "";
                    $myarr = array();
                    if (is_array($theme)) {
                        foreach ($theme as $val) {
                            if ($val['key'] != 'css_box')
                                $str .= '@' . $val['key'] . ':' . $val['value'] . '!important;';
                            else {
                                $css = $val['value'];
                            }
                        }
                    } else {
                        $str = "";
                    }
                    $filepath = 'assets/css/user/temp.less';

                    if ($temp->board_exist($data_str)) {
                        $fp = fopen($filepath, "w+");
                        flock($fp, LOCK_EX);
                        fwrite($fp, $str);
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        $data['board_name'] = $data_str;
                    } else {
                        unset($data);
                    }
                    if (isset($data))
                        ;
                }


                if (isset($data)) {

                    if ($this->uri->segment(3) == 'fb' || $this->uri->segment(6) == 'fb') {
                        $fb_val = 'fb';
                        $data['fb'] = 1;
                        $this->session->set_userdata(array('fb', 'fb'));
                        $data['css'] = $css;
                         if ($data_str) {
                            $id = $temp->get_boardid($data_str);
                            $template = $temp->template_name($id[0]->id);
                            $data['template'] = $template;
                            }
                        $this->load->view('user/header', $data);

                    } else {
                        $fb_val = '';
                        $this->session->set_userdata(array('fb', ''));
                        if ($this->uri->segment(3) == 'detail') {
                            $data['css'] = $css;
                            $data['fb_val'] = $fb_val;
                           if ($data_str) {
                            $id = $temp->get_boardid($data_str);
                            $template = $temp->template_name($id[0]->id);
                            $data['template'] = $template;
                            }
                            $this->load->view('user/header', $data);
                        }
                    }
                } else {
                    if ($this->uri->segment(3) == 'fb' || $this->uri->segment(6) == 'fb') {
                        $data['fb'] = 1;
                        $fb_val = 'fb';
                        $this->session->set_userdata(array('fb', 'fb'));
                        $data['css'] = $css;
                        $data['fb_val'] = $fb_val;
                        $this->load->view('user/header', $data);
//                        die;
                    } else {
                        if ($isboardjobs1 == 'user' && $this->uri->segment(3) != 'board') {
                            $fb_val = "";
                           
//                            if ($data_str) {
//                            $id = $temp->get_boardid($data_str);
//                            $template = $temp->template_name($id[0]->id);
//                            $data['template'] = $template;
//                            }
                            
                            $data['fb_val'] = $fb_val;
                            $this->session->set_userdata(array('fb', ''));
                            $data['css'] = $css;
                            $this->load->view('user/header', $data);
                        }
                    }
                }
            }
        }
        $this->load->helper('date');
    }

    public function fb($a = false, $data_str = FALSE) {
        
        $fb_val = "fb";
$data['fb_val'] = "fb";
        $this->session->set_userdata(array('fb', 'fb'));
        $css = "";
        if ($this->uri->segment(3)) {

            if ($this->uri->segment(3) == 'fb') {
                $data_str = $this->uri->segment(4);
            }
            else
                $data_str = $this->uri->segment(3);
        }
        $temp = new User_model;


        if ($data_str) {
            $id = $temp->get_boardid($data_str);
            $values['main'] = $id;
            if ($id != "") {
                $board_id = $id[0]->id;
                $data['title'] = $id[0]->board_title;
                $theme = $temp->apply_theme2($id[0]->id);
            }
            else
                $theme = $temp->apply_theme();
        }
        else {
            $theme = $temp->apply_theme();
        }

        $str = "";
        $myarr = array();
        if (is_array($theme)) {
            foreach ($theme as $val) {
                if ($val['key'] != 'css_box')
                    $str .= '@' . $val['key'] . ':' . $val['value'] . '!important;';
                else {
                    $css = $val['value'];
                }
            }
        } else {
            $str = "";
        }
        $filepath = 'assets/css/user/temp.less';

        if ($temp->board_exist($data_str)) {
            
           
            
            $fp = fopen($filepath, "w+");
            flock($fp, LOCK_EX);
            fwrite($fp, $str);
            flock($fp, LOCK_UN);
            fclose($fp);
            $data['board_name'] = $data_str;
            $data['fb'] = 1;
            $values['fb'] = 1;
            if ($this->uri->segment(3) != 'fb') {
                $values['css'] = $css;
                 if ($data_str) {
                            $id = $temp->get_boardid($data_str);
                            $template = $temp->template_name($id[0]->id);
                            
                            $values['template'] = $template;
                            }
                $this->load->view('user/header', $values);
            }
        }

        //body start here..

        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/user/fb/' . $data_str;
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 5;

        $val = $this->uri->segment(5);

        $data['pageno'] = $val;


        if ($val > 1) {
            $val = $val - 1;
        } else {
            $val = 0;
        }

        if ($this->input->post() && $this->uri->segment(1) != 'fb') {

            $id = $this->input->post('val');
            $id_array = explode(",", $id);
            if (count($id_array) - 1 == 0) {


                if (isset($board_id)) {
                    $data['post'] = $this->user_model->post_job($val * 5, $board_id);
                    $config['total_rows'] = $this->user_model->page_count('post_job', $board_id);
                    $data['btn_name'] = $this->user_model->btn_name($board_id);
                } else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                    $config['total_rows'] = $this->user_model->page_count('post_job');
                }
                $data['pageno'] = $this->input->post('pageno');
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = round($choice);
                $this->pagination->initialize($config);
                $data['fb_val'] = "fb";
                echo $this->load->view('user/mainpage_content', $data, TRUE);
            } else {
                if (isset($board_id)) {
                    $data['btn_name'] = $this->user_model->btn_name($board_id);
                    $config['total_rows'] = $this->user_model->refine_post_count($id_array, $board_id);
                }
                else
                    $config['total_rows'] = $this->user_model->refine_post_count($id_array);
                $config['base_url'] = "";
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = round($choice);
                $this->pagination->initialize($config);
                if (isset($board_id))
                    $data['post'] = $this->user_model->refine_post_job($id_array, $val * 5, $board_id);
                else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                }

                $data['pagename'] = 'sidebar_refine';

                $data['total_row'] = $config['total_rows'];

                $data['fb'] = 1;

                $data['fb_val'] = "fb";

                echo $this->load->view('user/content', $data, TRUE);
            }
            die;
        } else {


            if (isset($board_id))
                $config['total_rows'] = $this->user_model->page_count('post_job', $board_id);
            else
                $config['total_rows'] = $this->user_model->page_count('post_job');

            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);
            $this->pagination->initialize($config);
            if (isset($board_id)) {
                $data['btn_name'] = $this->user_model->btn_name($board_id);
                $data['post'] = $this->user_model->post_job($val * 5, $board_id);
                $data['btn_name'] = $this->user_model->btn_name($board_id);
            } else {
                $data['post'] = $this->user_model->post_job($val * 5);
            }


            $data['fb'] = 'fb';
            $data['fb_val'] = "fb";
            $data['content'] = $this->load->view('user/mainpage_content', $data, TRUE);
//         
        }
        if (isset($board_id)) {
            $data['tag'] = $tag_model->semi_parent($board_id);
            $data['latestjob'] = $this->user_model->latest_job($board_id);
            $data['max_min'] = $this->user_model->taxo_val($board_id);
        } else {
            $data['tag'] = $tag_model->semi_parent();
            $data['latestjob'] = $this->user_model->latest_job();
            $data['max_min'] = $this->user_model->taxo_val();
        }
        $data['fb_val'] = "fb";
        $this->load->view('user/sidebar', $data);
    }

    public function board($data_str = FALSE) {

        
        $temp = new User_model;
        $css = "";
        $data['fb_val'] = '';
        $this->session->set_userdata(array('fb', ''));
        if ($data_str) {
            $id = $temp->get_boardid($data_str);
            
            
            $values['main'] =  $id;
             $template = $temp->template_name( $id[0]->id);
             $values['template'] = $template;
         
            if ($id != "") {
                $board_id = $id[0]->id;
                $data['title'] = $id[0]->board_title;
                $theme = $temp->apply_theme2($id[0]->id);
            }
            else
                $theme = $temp->apply_theme();
        }
        else {
            $theme = $temp->apply_theme();
        }

        $str = "";
        $myarr = array();
        if (is_array($theme)) {
            foreach ($theme as $val) {
                if ($val['key'] != 'css_box')
                    $str .= '@' . $val['key'] . ':' . $val['value'] . '!important;';
                else {
                    $css = $val['value'];
                }
            }
        } else {
            $str = "";
        }
        $filepath = 'assets/css/user/temp.less';

        if ($temp->board_exist($data_str)) {
            $fp = fopen($filepath, "w+");
            flock($fp, LOCK_EX);
            fwrite($fp, $str);
            flock($fp, LOCK_UN);
            fclose($fp);
            $data['board_name'] = $data_str;
            $values['css'] = $css;
            $this->load->view('user/header', $values);
        }

        //body start here..

        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/user/board/' . $data_str;
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 5;

        $val = $this->uri->segment(5);

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


                if (isset($board_id)) {
                    $data['post'] = $this->user_model->post_job($val * 5, $board_id);
                    $config['total_rows'] = $this->user_model->page_count('post_job', $board_id);
                    $data['btn_name'] = $this->user_model->btn_name($board_id);
                    $data['btn_name'] = $this->user_model->btn_name($board_id);
                } else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                    $config['total_rows'] = $this->user_model->page_count('post_job');
                }
                $data['pageno'] = $this->input->post('pageno');
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = round($choice);
                $this->pagination->initialize($config);
                echo $this->load->view('user/mainpage_content', $data, TRUE);
            } else {
                if (isset($board_id))
                    $config['total_rows'] = $this->user_model->refine_post_count($id_array, $board_id);
                else
                    $config['total_rows'] = $this->user_model->refine_post_count($id_array);
                $config['base_url'] = "";
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = round($choice);
                $this->pagination->initialize($config);
                if (isset($board_id)) {
                    $data['btn_name'] = $this->user_model->btn_name($board_id);
                    $data['post'] = $this->user_model->refine_post_job($id_array, $val * 5, $board_id);
                } else {
                    $data['post'] = $this->user_model->post_job($val * 5);
                }

                $data['pagename'] = 'sidebar_refine';

                $data['total_row'] = $config['total_rows'];

                if ($this->uri->segment(3) == 'fb' || $this->input->post('fb') == 'fb') {
                    $data['fb'] = 1;
                    $data['fb_val'] = 'fb';
                } else {
                    $data['fb_val'] = '';
                }


                echo $this->load->view('user/content', $data, TRUE);
            }
            die;
        } else {


            if (isset($board_id))
                $config['total_rows'] = $this->user_model->page_count('post_job', $board_id);
            else
                $config['total_rows'] = $this->user_model->page_count('post_job');

            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);
            $this->pagination->initialize($config);
//            echo $val ; die;
            if (isset($board_id)) {
                $data['post'] = $this->user_model->post_job($val * 5, $board_id);

                $data['btn_name'] = $this->user_model->btn_name($board_id);
            } else {
                $data['post'] = $this->user_model->post_job($val * 5);
            }

            $data['fb_val'] = '';

            $data['content'] = $this->load->view('user/mainpage_content', $data, TRUE);
        }
        if (isset($board_id)) {
            $data['tag'] = $tag_model->semi_parent($board_id);
            $data['latestjob'] = $this->user_model->latest_job($board_id);
            $data['max_min'] = $this->user_model->taxo_val($board_id);
        } else {
            $data['tag'] = $tag_model->semi_parent();
            $data['latestjob'] = $this->user_model->latest_job();
            $data['max_min'] = $this->user_model->taxo_val();
        }

        $data['fb_val'] == '';
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer', $data['tag']);
    }

    public function theme($data_str = FALSE) {
        $temp = new User_model;
        if ($data_str) {
            $id = $temp->get_boardid($data_str);

            if ($id != "") {
                $board_id = $id[0]->id;
                $data['title'] = $id[0]->board_title;
                $theme = $temp->apply_theme2($id[0]->id);
            }
            else
                $theme = $temp->apply_theme();
        }
        else {
            $theme = $temp->apply_theme();
        }

        $str = "";
        $myarr = array();
        if (is_array($theme)) {
            foreach ($theme as $val) {
                if ($val['key'] != 'css_box')
                    $str .= '@' . $val['key'] . ':' . $val['value'] . '!important;';
                else {
                    $css = $val['value'];
                }
            }
        } else {
            $str = "";
        }
        $filepath = 'assets/css/user/temp.less';

        if ($temp->board_exist($data_str)) {
            $fp = fopen($filepath, "w+");
            flock($fp, LOCK_EX);
            fwrite($fp, $str);
            flock($fp, LOCK_UN);
            fclose($fp);
            $data['board_name'] = $data_str;
        }
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
            $data['content'] = $this->load->view('user/mainpage_content', $data, TRUE);
        }
        $data['tag'] = $tag_model->semi_parent();
        $data['latestjob'] = $this->user_model->latest_job();
        $data['board_name'] = 'home';
        $data['title'] = 'home';
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer', $data['tag']);
    }

    public function footer_refine() {
        $id = $this->input->post('val');
        $data_str = $this->input->post('b_name');

        $board_id = $this->user_model->get_boardid($data_str);
        if (isset($board_id['0']->id)) {
            $id_t = $board_id['0']->id;
            $data['title'] = $board_id['0']->board_title;
        }

        $id_array = array(
            '0' => $id,
            '1' => ''
        );

        $this->load->library('pagination');

        $config['base_url'] = site_url() . '/user/user/footer_refine';
        $config['per_page'] = 5;
        $config['total_rows'] = $this->user_model->refine_post_count($id_array, $id_t);
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $this->pagination->initialize($config);
        $val = $this->uri->segment(4);

        if ($val == 0) {
            $val = 0;
        } else {
            $val = ($val - 1) * 5;
        }
        if (isset($board_id['0']->id)) {
            $data['post'] = $this->user_model->refine_post_job($id_array, $val, $id_t);
        } else {
            $data['post'] = $this->user_model->refine_post_job($id_array, $val);
        }


        $data['pagename'] = 'footer_refine';
        $data['board_name'] = $data_str;
        $data['tag_id'] = $id;
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    public function salary_refine() {
        $this->load->library('pagination');
        $config['per_page'] = 5;
        $data_str = $this->input->post('b_name');
        $board_id = $this->user_model->get_boardid($data_str);
        $val = 1;
        if ($board_id == '')
            $config['total_rows'] = $this->user_model->page_count('refine_job_salary');
        else
            $config['total_rows'] = $this->user_model->page_count('refine_job_salary', $board_id['0']->id);

        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);


        $this->pagination->initialize($config);
        $val = $this->uri->segment(4);

        if ($val == "") {
            $val = 1;
        }
        $data_str = $this->input->post('b_name');
        if ($board_id == "")
            $data['post'] = $this->user_model->refine_job_salary(($val - 1) * 5);
        else {
            $data['post'] = $this->user_model->refine_job_salary(($val - 1) * 5, $board_id['0']->id);
            $data['title'] = $board_id[0]->board_title;
        }
        $data['pagename'] = 'salary_refine';
        $data['board_name'] = $data_str;

        $fb = $this->input->post('fb');

        if ($fb == 'fb') {
            $data['fb'] = 1;
            $data['fb_val'] = 'fb';
        }


        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    public function detail() {
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $data_str = $this->uri->segment(5);

        $boardId = $this->uri->segment(4);
        $base = base_url();

        $board_id = $this->user_model->get_boardid($data_str);
        if ($board_id != "")
            $data['title'] = $board_id[0]->board_title;

        $data['btn_name'] = $this->user_model->btn_name($board_id[0]->id);
        $data['post'] = $this->user_model->view_detail($boardId);
        $data['board_name'] = $data_str;
        if ($this->uri->segment(6) == 'fb') {
            $data['fb'] = 1;
            $data['fb_val'] = 'fb';
        }
        $data['content'] = $this->load->view('user/more_detail', $data, TRUE);

        $temp = new User_model;
        $id = "";

        if ($data_str) {
            $id = $temp->get_boardid($data_str);
            $this->theme($data_str);
        }

        if ($id != "") {
            $data['tag'] = $tag_model->semi_parent($id[0]->id);
            $data['latestjob'] = $this->user_model->latest_job($id[0]->id);
            $data['max_min'] = $this->user_model->taxo_val($id[0]->id);
        } else {
            $data['tag'] = $tag_model->semi_parent();
            $data['latestjob'] = $this->user_model->latest_job();
        }

        $this->load->view('user/sidebar', $data);
        if ($this->uri->segment(6) != 'fb' && $this->session->userdata('fb') != 'fb')
            $this->load->view('user/footer', $data['tag']);
    }

    public function keyword_search() {

        $data_str = $this->input->post('b_name');
        $board_id = $this->user_model->get_boardid($data_str);
        $this->load->library('pagination');
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;



        if ($board_id != "") {
            $config['total_rows'] = $this->user_model->page_count('keyword_search', $board_id['0']->id);
        } else {
            $config['total_rows'] = $this->user_model->page_count('keyword_search');
        }
        $var = $this->input->post('page');

        if ($var) {
            $config['current_page'] = $var;
            $var = $var - 1;
            $val = $var * $config['per_page'];
        } else {
            $val = $this->uri->segment(4);
        }
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $this->pagination->initialize($config);
        if ($board_id == "") {
            $data['post'] = $this->user_model->keyword_search($val);
        } else {
            $data['title'] = $board_id[0]->board_title;
            $data['post'] = $this->user_model->keyword_search($val, $board_id['0']->id);
        }


        $data['pagename'] = 'keyword_search';
        $data['board_name'] = $data_str;
        echo $this->load->view('user/content', $data, TRUE);
        die;
    }

    public function gallary() {

        $this->load->model('setting/setting_model');

        $setting = new Setting_model();
        $data['item'] = $setting->get_image();

        $data['content'] = $this->load->view('user/gallary', $data, TRUE);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/footer');
    }

}

?>  