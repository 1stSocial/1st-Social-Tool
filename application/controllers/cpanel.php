<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper("url");

	}

	function index() {
		//$this->create_subdomain("greg-sub");
		$this->cpanel_authenticate();

	}

	private function create_subdomain($subdomain_name) {


	}

	private function cpanel_authenticate() {

		$this->load->library('xmlapi', '184.172.173.27:2083');
		// $this->$xmlapi = new xmlapi('184.172.173.27'); 
		
		$this->xmlapi->password_auth('firstexe','SDCjJDAWmLow'); 
		// $this->xmlapi->set_debug(1); 
		print $this->xmlapi->api1_query('accountname','SubDomain','addsubdomain',array('sub','domain.com',0,0,'/public_html/folder'));  
	}





}