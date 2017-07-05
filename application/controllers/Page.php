<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		if( ! $this->input->is_ajax_request())
		{
			redirect('error/404','location');
		}
		else
		{
			$page_name = $this->input->get('page');

		}
	}

	public function fragment()
	{
		if( ! $this->input->is_ajax_request())
		{
			redirect('error/404','location');
		}
		else
		{
			$fragment_name = $this->input->get('fragment');

			switch ($fragment_name)
			{
				case 'new_account':
					if(file_exists(views_path('pages/savings-monitor/modals/new_account_modal.php')))
					{
						$html = $this->load->view('pages/savings-monitor/modals/new_account_modal',null,true);

						echo json_encode($html);
						break;
					}
				
				default:
					set_status_header(404);
					$this->load->view('failed');
			}
		}
	
	}
}