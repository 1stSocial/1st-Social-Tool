
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->load->helper(array('form'));
     	$this->load->view('header');
		$this->load->view('login');
     	$this->load->view('footer');
	}

}

?>

