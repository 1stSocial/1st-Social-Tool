<?php 
class MY_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //TO-DO: Implement this
    private function display_view($view, $data) 
 	{	
	    $this->load->view('header');

	    $this->load->view($view, $data);

	    $this->load->view('footer');

   		return NULL;
 	}

}

?>