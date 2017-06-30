<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savings_monitor extends CI_Controller {

	private $render_params = array();


	public function __construct()
	{
		parent::__construct();
		$this->load->library('render');
		
		$this->render_params = $this->config->item('page_render_params');
	}
	
	public function index()
	{
		$this->dashboard();
	}
	
	public function dashboard()
	{
		$this->render_params['savings_monitor']['view_params']['current_link'] = 'savings_monitor/dashboard';
		$this->render->page($this->render_params['savings_monitor']);
	}

	public function portfolio()
	{
		$this->render_params['savings_portfolio']['view_params']['current_link'] = 'savings_monitor/portfolio';
		$this->render->page($this->render_params['savings_portfolio']);
	}
}
