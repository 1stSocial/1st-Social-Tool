<?php 
Class Board_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_board($board_name) {
		$query = $this->db->query("SELECT * FROM rss_board WHERE board_name = '$board_name'");
		if ($query->num_rows() == 1) {
			return $query->row();
		}
	}

	function get_all_boards() {
		$query = $this->db->query("SELECT * FROM rss_board");
		return $query;
	}

	function create_board($board_name, $board_url, $board_html) {

	}

	function modify_board($board_name = "", $board_url = "", $board_html = "") {
		
	}
}


?>