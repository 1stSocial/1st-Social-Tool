<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Board_controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model("board_model");
		$this->load->model("login_model");
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
		$board_data = $this->board_model->get_all_boards()->result();
 		
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
		$board_html = $this->input->post("board_html");
		$fb_app_id = $this->input->post("fb_app_id");

		$this->board_model->modify_board($board_name, $board_url, $board_html, $fb_app_id);
	}

	function modify_board() {
		$board_name = $this->input->post("board_name");
		$board_url = $this->input->post("board_url");
		$board_html = addslashes($this->input->post("board_html"));

		$query = $this->board_model->create_board($board_name, $board_url, $board_html);
		echo json_encode(array("result" => $query));
	}

	function delete_board() {
		$board_name = $this->input->post("board_name");

		$query = $this->board_model->modify_board($board_name, $board_url, $board_html);

		echo json_encode(array("result" => $query));
	}

	function show_board($board_name, $board_style = "rss_board") {
		$board_data = $this->board_model->get_board($board_name);

		$data = array(
			"board_name" => $board_name,
			"board_url" => $board_data->board_url,
			"board_html" => $board_data->board_html,
			"board_style" => $board_style,
		);

		$this->load->view("rss_board", $data);
	}

}

?>