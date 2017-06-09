<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model','au');

		if( ! isset($_SESSION))
		{
			session_start();
		}
	}

	public function index()
	{
		echo '<head><title>Logging in...</title></head>';

		$user = $this->input->post('u');
		$pass = $this->input->post('pw');

		if(empty($user) OR empty($pass))
		{
			redirect('error/444','location');
		}

		$_ex = false;
		if($this->au->checkUserPass($user,$pass))
		{
			$_ex = true;
			$_SESSION['logged_in'] = true;
		}

		var_dump($_SESSION);
		redirect('home','location');
	}

	public function verify()
	{
		if( ! $this->input->is_ajax_request())
		{
			redirect('errors/error_404','location');
			return;
		} 

		$user = $this->input->post('u');
		$pass = $this->input->post('pw');

		if( ! isset($_SESSION))
		{
			session_start();
		}

		// verify username/password combination
		$_ex = $this->au->checkUserPass($user,$pass);

		echo json_encode(array('verified' => @intval($_ex)));
	}
}