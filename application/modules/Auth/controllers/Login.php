<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model','au');
		
		if(empty($_SESSION))
		{
			session_start();
		}
	}

	public function index()
	{
		$user = $this->input->post('u');
		$pass = $this->input->post('pw');

		$_ex = false;
		if($this->au->checkUserPass($user,$pass))
		{
			$_ex = true;
			$_SESSION['logged_in'] = true;
		}
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

		if(empty($_SESSION))
		{
			session_start();
		}

		$_ex = false;
		if($this->au->checkUserPass($user,$pass))
		{
			$_ex = true;
			$_SESSION['logged_in'] = true;
		}

		echo json_encode($_ex);
	}
}