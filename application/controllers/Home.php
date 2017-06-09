<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// TODO: check if logged in

		if( ! isset($_SESSION))
		{
			session_start();
		}

		$render_params = array(
				'body_class'  => 'hold-transition login-page',
				'page' 		  => 'login',
				'view_params' => array(
					'title'		   => 'Misc System',
					'current_page' => 'login'
				),
				'js_paths'	  => array(
					'auth/login' => 'main_js',
				),
			);


		// if logged in
		if( ! empty($_SESSION['logged_in']))
		{
			$render_params['body_class'] = 'layout-top-nav skin-yellow';
			$render_params['page'] 		 = 'home';
			$render_params['view_params']['current_page'] = 'home';
			$render_params['js_paths'] = array(
					'home/home'	=> 'main_js'
				);
		}

		$this->load->library('render');

		$this->render->page($render_params);
	}
}
