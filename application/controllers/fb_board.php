<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fb_board extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model("fb_board_model");
		$this->load->model("login_model");
		$this->load->helper('file');
	}

	function index() {
		$this->load->view("header");
		$this->login_model->check_login();
		
		$data = array(
			"board_table_html" => $this->get_board_table_html()
		);

		$this->load->view("board_frame", $data);
		
		$this->load->view("footer");
	}

	function get_board_table_html($ajax = false) {
		$board_data = $this->fb_board_model->get_all_boards()->result();
 		
 		$board_table_html = $this->load->view("board_table", 
									array("boards" => $board_data), true);

		if ($ajax) {
			echo json_encode($board_table_html);
		} else {
			return $board_table_html;
		}
	}
	
	function create_board() {
		$board_name = $this->input->post("board_name");
		$board_url = $this->input->post("board_url");
		$board_html = addslashes($this->input->post("board_html"));
		$board_css = addslashes($this->input->post("board_css"));
		$board_background = $this->input->post("board_background");
		$fb_app_id = $this->input->post("fb_app_id");

		$query = $this->fb_board_model->create_board($board_name, $board_url, $board_html, $board_css, $board_background, $fb_app_id);

		echo json_encode(array("result" => $query));
	}

	function modify_board() {
		$board_name = $this->input->post("board_name");
		$board_url = $this->input->post("board_url");
		$board_html = addslashes($this->input->post("board_html"));
		$board_css = addslashes($this->input->post("board_css"));
		$board_background = $this->input->post("board_background");
		$fb_app_id = $this->input->post("fb_app_id");

		$query = $this->fb_board_model->modify_board($board_name, $board_url, $board_html, $board_css, $board_background, $fb_app_id);
	
		echo json_encode(array("result" => $query));
	}

	function delete_board() {
		$board_name = $this->input->post("board_name");
		$query = $this->fb_board_model->delete_board($board_name);
		echo json_encode(array("result" => $query));
	}

	function show_board($board_name, $board_style = "rss_board") {
		$board_data = $this->fb_board_model->get_board($board_name);

		$data = array(
			"board_name" => $board_name,
			"board_url" => $board_data->board_url,
			"board_html" => $board_data->board_html,
			"fb_app_id" => $board_data->fb_app_id,
			"board_style" => $board_data->board_css,
			"board_background" => $board_data->board_background
		);

		$this->load->view("rss_board", $data);
	}

	function show_subdomain_board() {
                $this->load->view("header");
		$this->login_model->check_login();
		$this->load->view("subdomain_page");	
                $this->load->view("footer");

	}

}