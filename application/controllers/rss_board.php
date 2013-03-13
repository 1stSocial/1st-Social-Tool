<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rss_board extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view("rss_board");
	}

}

?>