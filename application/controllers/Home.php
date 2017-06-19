<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $render_params = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('systems_model','sys');

		$this->render_params = $this->config->item('page_render_params');
	}

	public function index()
	{
		if( ! isset($_SESSION))
		{
			session_start();
		}

		$page = empty($_SESSION['logged_in']) ? 'login' : 'top_nav';

		// if logged in
		if( ! empty($_SESSION['logged_in']))
		{
			// get all systems
			$systems = $this->sys->getAll();

			$this->render_params['top_nav']['view_params']['systems_list'] = empty($systems) ? array() : $systems;
		}

		$this->load->library('render');

		$this->render->page($this->render_params[$page]);
	}
}
