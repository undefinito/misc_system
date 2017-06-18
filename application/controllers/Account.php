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
					'title'		   => 'Misc System: Account',
					'current_page' => 'account',
				),
				'js_paths'	  => array(
					'account' => 'main_js',
				),
			);
		$this->load->library('render');

		$this->render->page($render_params);
	}

	public function edit($user_id=null)
	{
		if( ! $this->input->is_ajax_request())
		{
			redirect('error/404','location');
			return false;
		}

		$post_data = $this->input->post();

		// load references model
		$this->load->model('references_model','refm');
		// load user model
		$this->load->model('user_model','user');

		// reference array
		$edit_data = $this->refm->formatArray($post_data,'edit_info');

		if(empty($edit_data))
		{
			redirect('error/404','location');
			return false;
		}
		
		// actual update of user info
		$success = $this->user->updateUserInfo($user_id,$edit_data);

		$alert_html = '';
		if(empty($success))
		{
			$alert_html .= '<i class="fa fa-exclamation-circle"></i> ';
			$alert_html .= 'An error has occurred.';
		}
		else
		{

			if( ! isset($_SESSION))
			{
				session_start();
			}

			// retrieve new user data
			$_SESSION['user_data'] = $this->user->getUserData($user_id);

			$alert_html .= '<i class="fa fa-check"></i> ';
			$alert_html .= 'Successfully updated user account information.';
		}

		$response = array(
				(empty($success) ? 'error' : 'success') => 1,
				'html'		  => $alert_html,
				'last_update' => empty($_SESSION['user_data']['last_update_formatted']) ? false : $_SESSION['user_data']['last_update_formatted'],
				'full_name' => empty($_SESSION['user_data']['full_name']) ? false : $_SESSION['user_data']['full_name']
			);

		echo json_encode($response);
	}
}
