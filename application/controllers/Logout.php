<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		if( ! isset($_SESSION))
		{
			session_start();
		}

		session_destroy();

		redirect('/','location');
	}

}
