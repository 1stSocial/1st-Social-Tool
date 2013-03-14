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

		$boards_data = $this->board_model->get_all_boards();
		
		$data = array(
			"boards" => $boards_data->result(), 
		);
		
		$this->load->view("board_frame", $data);
		
		$this->load->view("footer");
	}

	function create_board() {

	}

	function modify_board() {

	}

	function delete_board() {

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