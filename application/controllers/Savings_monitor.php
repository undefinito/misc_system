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

	public function account($action=null,$id=null)
	{
		if($this->input->is_ajax_request())
		{
			// load model
			$this->load->model('savings_model','svm');

			switch ($action)
			{
				case 'search':
					// account name to check if already existing
					$name_to_check = $this->input->get('acct_name');
					// whether to verify only or get record
					$verify_only = $this->input->get('verify_only');
					// search if account name already exists
					$data = $this->svm->searchAccount($name_to_check,boolval($verify_only));
					// format JSON response
					echo json_encode( empty($verify_only) ? $data : ( ! empty($data)) );
					break;
				
				case 'new':
					if($this->input->server('REQUEST_METHOD') == 'POST')
					{
						// account name
						$acct_name = $this->input->post('name');
						// amount value in account
						$amount = $this->input->post('amt');
						
						// extra validation of input
						if(preg_match('/([A-Z]|\-)*\w/i', $acct_name))
						{
							// get amount
							$amount = @floatval($amount);
							// create the new account
							$success = $this->svm->newAccount($acct_name,$amount);

							$response = is_int($success) ? array('success'=>1,'msg'=>'Successfully created new account','account_id'=>$success)
										: array('error'=>1,'msg'=>'Failed to create account');

							echo json_encode($response);
						}
						else
						{
							// invalid account name, considered as bad request
							set_status_header(400);
							echo json_encode(array('error'=>1,'msg'=>'Invalid account name'));
						}

						break;
					}

				case null:
				case 'all':
					// TODO: get all accounts for server-side datatable
					$all_accounts = $this->svm->getAllAccounts();
					break;

				default:
					echo json_encode(array('error'=>1, 'msg'=>'Unknown action'));
			}

		}
		else
		{
			redirect('error/404','location');
		}
	}
}
