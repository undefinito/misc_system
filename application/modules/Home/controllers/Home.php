<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function index()
	{
		// TODO: check if logged in

		$render_params = array(
				'body_class'  => 'hold-transition login-page',
				'page' 		  => 'home',
				'module'	  => 'home',
				'view_params' => array(
					'title'	=> 'Misc System',
				)
			);
		echo Modules::run('renderer/render/page',$render_params);
	}
}
