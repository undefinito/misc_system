<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savings_model extends CI_Model {

	private $sav_db;

	public function __construct()
	{
		parent::__construct();
		$this->sav_db = $this->load->database('savings_db',true);


		if( ! isset($_SESSION))
		{
			session_start();
		}
	}

	/**
	 * getAllAccounts - get all accounts
	 * @return array
	 */
	public function getAllAccounts()
	{
		$result = $this->sav_db->get('account');
		return $result->result_array();
	}

	/**
	 * searchAccount - search record of a specified name
	 * @param  string  $name        name of account
	 * @param  boolean $verify_only TRUE if only to return boolean value if account exists or not,
	 *                              FALSE if to return actual record/s with matching name
	 * @return array|boolean 		array of record/s or TRUE/FALSE if account with name exists or not
	 */
	public function searchAccount($name=null,$verify_only=false)
	{
		if(empty($name))
		{
			return false;
		}
		if( ! empty($verify_only))
		{
			$this->sav_db->select('1');
		}

		$this->sav_db->from('account');
		$this->sav_db->like('name',$name);
		$result = $this->sav_db->get();
		$data = $result->{empty($verify_only) ? 'result_array' : 'row_array'}();
		return empty($verify_only) ? $data : (! empty($data[1]));
	}

	/**
	 * newAccount - create a new account
	 * @param  string $name    account name
	 * @param  float  $amount  initial amount in the account
	 * @return boolean|int 		insert id on success, FALSE on failure
	 */
	public function newAccount($name=null,$amount=null)
	{
		if(empty($name) OR empty($_SESSION['user_data']['id']))
		{
			return false;
		}

		$data = array(
				'user_id' => @intval($_SESSION['user_data']['id']),
				'name'    => $name,
				'amount'  => @floatval($amount),
				'date_created' => date('Y-m-d h:i:s',now('Asia/Manila')),
			);
		$success = $this->sav_db->insert('account',$data);
		return empty($success) ? false : $this->sav_db->insert_id();
	}
}
