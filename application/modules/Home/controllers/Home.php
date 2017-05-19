<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function index()
	{
		// TODO: check if logged in

		$this->load->model('auth/auth_model','au');

		$render_params = array(
				'body_class'  => 'hold-transition login-page',
				'page' 		  => 'login',
				'module'	  => 'home',
				'view_params' => array(
					'title'	=> 'Misc System',
				),
				'js_paths'	  => array(
					'auth/login' => 'main_js',
				),
			);
		echo Modules::run('renderer/render/page',$render_params);
	}
}
