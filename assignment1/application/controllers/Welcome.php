<?php
//Drapchaty Matthew

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct() //construct method is used by every function in this class
    	{
        parent::__construct();
        $this->load->model('model_Tipkno');
        $this->load->helper('url');




            //NOT WORKING ATTEMP # 1
         //Load facebook library and pass associative array which contains appId and secret key
	    /*   $a = 'application/libraries/';
           require_once( $a."base_facebook.php");
           require_once(  $a."facebook.php");
           $fb_config = array(
			     'appId'  => '211684055910887',
			     'secret' => 'c85b80b107947c5c27c5d2f6488d4d2e'
			 );
			$this->load->library('facebook', $fb_config);

			// Get user's login information
			$this->user = $this->facebook->getUser();
            */
		}

			// Store user information and send to profile page
			public function index() {
			
			$data['title'] = "TipKno";
			$data['tips'] = $this->model_Tipkno->getTips();
			$data['jobs'] = $this->model_Tipkno->getJobs();
            $data['results'] = $this->model_Tipkno->getResult();
		    $this->load->view('welcome_message', $data);



}



/* not working code ATTEMPT 2
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
   	    {	?>
          <script type="text/javascript">
            if (confirm("This Will Delete All Tips For This Job. Are You Sure?")){
                 <?
                 $id = $this->uri->segment(3);
                 $this->model_Tipkno->deletejob($id);
                 $this->index();
                 ?>
            } else {
                 history.go(-1);
            }     
          </script>
          <?php  
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
    //same ERROR at line 124 when called NOT WORKING ATTEMPT #3
    public function login(){
        $this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));
        $user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            // Solves first time login issue. (Issue: #10)
            $this->facebook->destroySession();
        }
        if ($user) {
            $data['logout_url'] = site_url('Welcome/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('welcome/login'), 
                'scope' => array("email") // permissions here
            ));
        }
        $this->load->view('login',$data);
    }
    public function logout(){
        $this->load->library('facebook');
        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.
        redirect('Welcome/login');
    }



}

?>