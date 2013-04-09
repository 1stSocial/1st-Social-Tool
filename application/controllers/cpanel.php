<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper("url");

	}

	function index() {
		//$this->create_subdomain("greg-sub");
		//$this->create_subdomain($subdomain_name);

	}

	function create_subdomain($subdomain_name) {
		$this->cpanel_authenticate();
		return $this->xmlapi->api1_query('accountname','SubDomain','addsubdomain',array($subdomain_name,'domain.com',0,0,'/public_html/'));  
	}

	function create_database($db_name) {
		$this->cpanel_authenticate();
		$api_query = $this->xmlapi->api1_query('accountname', 'Mysql', 'adddb', array($db_name)); 
		
		mysql_connect("firstexe_tool")

		return $api_query->data->result;
	}


	private function cpanel_authenticate() {
		$this->load->library('xmlapi', '184.172.173.27:2083');
		$this->xmlapi->password_auth('firstexe','SDCjJDAWmLow'); 
		// $this->xmlapi->set_debug(1); 
	}

	function duplicate_db() {
		$output = exec('ls -lah');
		var_dump($output);
		//var_dump(shell_exec('mysqldump -h 127.0.0.1 -u root -p558505 greg_db | mysql -h 127.0.0.1 -u root -p558505 ccc'));
	}



}