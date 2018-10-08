<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function login()
	{
		$var = array('uname', 'ifpssd', 'keep');
		for($i = 0; $i < count($var); $i++) $$var[$i] = $this->input->post($var[$i]);
		if($uname && $ifpssd){
			
			if($this->auth->login($uname, $ifpssd, $keep)){
				echo action_response(2, 'iflogin_f', 'success-box', 'Login successful, redirecting..');
			}
			else echo slidedown_response('iflogin_f', 'error-box', 'Your login information didn\'t match.');
		}
		else echo slidedown_response('iflogin_f', 'error-box', 'Please complete the form below.');
	}
	
	public function logout()
	{
		$this->auth->logout();
	}
}