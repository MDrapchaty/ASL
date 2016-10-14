<?php
//Drapchaty Matthew

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct() //construct method is used by every function in this class
    	{
        parent::__construct();
        $this->load->model('model_Tipkno');

        	// Load facebook library and pass associative array which contains appId and secret key
			// $fb_config = array(
			  //    'appId'  => '211684055910887',
			    //  'secret' => 'c85b80b107947c5c27c5d2f6488d4d2e'
			  //);
			  //$this->load->library('facebook', $fb_config);

			// Get user's login information
			//$this->user = $this->facebook->getUser();
		}

			// Store user information and send to profile page
			public function index() {
			
			$data['title'] = "TipKno";
			$data['tips'] = $this->model_Tipkno->getTips();
			$data['jobs'] = $this->model_Tipkno->getJobs();
			$this->load->view('welcome_message', $data);

}

/*
			$fb_config = array(
            'appId'  => 'YOUR_APP_ID_HERE',
            'secret' => 'YOUR_APP_SECRET_HERE'
        );

        $this->load->library('facebook', $fb_config);

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook
                    ->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {
            $data['logout_url'] = $this->facebook
                ->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook
                ->getLoginUrl();
        }

        $this->load->view('view',$data);


			}


/* not working code
			$fb_config = array(
            'appId'  => '211684055910887',
            'secret' => 'c85b80b107947c5c27c5d2f6488d4d2e'
        );

        $this->load->library('facebook', $fb_config);

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook
                    ->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {
            $data['logout_url'] = $this->facebook
                ->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook
                ->getLoginUrl();
        }

        $this->load->view('welcome_message',$data);
    	}
    	*/
    	

	

	function deletetip()
   	    {	
        	$id = $this->uri->segment(3);
			$this->model_Tipkno->deletetip($id);
			$this->index();
    	}

    function addtip()
    	{
	    	$this->model_Tipkno->addtip();
	    	$this->index();

    	}

    function addjob()
    	{
    		$this->model_Tipkno->addjob();
    		$this->index();
    	}

    function deletejob()
   	    {	
        	$id = $this->uri->segment(3);
			$this->model_Tipkno->deletejob($id);
			$this->index();
    	}
/*
    // Logout from facebook
	function logout() {

	// Destroy session
	session_destroy();

	// Redirect to baseurl
	redirect(base_url());
	}
*/
}