<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model','au');
		$this->load->model('user_model','user');

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
			redirect('error/404','location');
		}

		if($this->au->checkUserPass($user,$pass))
		{
			// logged in flag
			$_SESSION['logged_in'] = true;

			$uid = $this->user->getUserID($user);

			// user data
			$user_data = $this->user->getUserData($uid);
			// save user data to session
			$_SESSION['user_data'] = $user_data;
		}

		redirect('home','location');
	}

	public function verify()
	{
		if( ! $this->input->is_ajax_request())
		{
			redirect('error/404','location');
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