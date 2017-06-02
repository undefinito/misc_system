<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');

		if( ! isset($_SESSION))
		{
			session_start();
		}
	}

	/**
	 * TODO: make better/more secure
	 * checkUserPass - checks if validity of username password combination
	 * @param  string $u  username
	 * @param  string $pw password
	 * @return boolean     TRUE if valid, FALSE otherwise
	 */
	public function checkUserPass($u=null,$pw=null)
	{
		$this->db->distinct();
		$this->db->select('1');
		$this->db->from('user');
		$this->db->where('username',$u);
		$this->db->where('password',$pw);
		$result = $this->db->get();
		$data = $result->row_array();
		return ! empty($data['1']);
	}
}
