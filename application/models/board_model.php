<?php 
//I WILL NOT USE ACTIVE RECORDS
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

	function create_board($board_name, $board_url = "", $board_html = "", $board_css = "", $board_background = "", $fb_app_id = "") {
		$sql = "INSERT INTO rss_board (board_name, board_url, board_html, board_css, board_background, fb_app_id)
		VALUES ('$board_name', '$board_url', '$board_html', '$board_css', '$board_background', '$fb_app_id')";

		return $this->db->query($sql);
	}

	function modify_board($board_name, $board_url = "", $board_html = "", $board_css = "", $board_background = "", $fb_app_id = "") {
		$sql = "UPDATE rss_board 
				SET board_url = '$board_url', 
				board_html = '$board_html', 
				board_css = '$board_css', 
				board_background = '$board_background',
				fb_app_id = '$fb_app_id'
				WHERE board_name = '$board_name'";

		return $this->db->query($sql);
	}

	function delete_board($board_name) {
		$sql = "DELETE FROM rss_board
				WHERE board_name = '$board_name'";
		return $this->db->query($sql);
	}
}


?>