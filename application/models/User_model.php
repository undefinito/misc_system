<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	/**
	 * getUserData - get user info
	 * @param  int $user_id
	 * @return array
	 */
	public function getUserData($user_id=null)
	{
		$select = array(
				'u.id',
				'u.username',
				'ui.first_name',
				'ui.middle_name',
				'ui.last_name',
				"CONCAT(ui.last_name,', ',ui.first_name,' ',LEFT(ui.middle_name,1),'.') full_name",
				'u.date_created',
				'ui.last_update',
				"DATE_FORMAT(u.date_created,'%M %Y') user_since",
				"DATE_FORMAT(ui.last_update,'%M %d %Y %h:%i %p') last_update_formatted");
		$this->db->select($select);
		$this->db->from('user u');
		$this->db->join('user_info ui','u.id = ui.user_id','left');
		$this->db->where('u.id',$user_id);
		$result = $this->db->get();
		return $result->row_array();
	}

	/**
	 * getUserID - get user id given the username
	 * @param  string $u  username
	 * @return int
	 */
	public function getUserID($u=null)
	{
		$this->db->select('id');
		$this->db->from('user');
		$this->db->where('username',$u);
		$result = $this->db->get();
		$data = $result->row_array();
		return empty($data['id']) ? -1 : @intval($data['id']);
	}

}
