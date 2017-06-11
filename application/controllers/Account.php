<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function index()
	{
		if( ! isset($_SESSION))
		{
			session_start();
		}
		
		$render_params = array(
				'body_class'  => 'layout-top-nav skin-yellow',
				'page' 		  => 'account',
				'view_params' => array(
					'title'		   => 'Misc System',
					'current_page' => 'account'
				),
				'js_paths'	  => array(
					'account' => 'main_js',
				),
			);
		$this->load->library('render');

		$this->render->page($render_params);
	}
}
