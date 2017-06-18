<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	private $user_db;

	public function __construct()
	{
		parent::__construct();
		$this->user_db = $this->load->database('misc_db',true);
	}

	/**
	 * getUserData - get user info
	 * @param  int $user_id
	 * @return array
	 */
	public function getUserData($user_id=null)
	{
		if(empty($user_id))
		{
			return false;
		}

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
		$this->user_db->select($select);
		$this->user_db->from('user u');
		$this->user_db->join('user_info ui','u.id = ui.user_id','left');
		$this->user_db->where('u.id',$user_id);
		$result = $this->user_db->get();
		return $result->row_array();
	}

	/**
	 * getUserID - get user id given the username
	 * @param  string $u  username
	 * @return int
	 */
	public function getUserID($u=null)
	{
		if (empty($u))
		{
			return false;
		}
		$this->user_db->select('id');
		$this->user_db->from('user');
		$this->user_db->where('username',$u);
		$result = $this->user_db->get();
		$data = $result->row_array();
		return empty($data['id']) ? -1 : @intval($data['id']);
	}

	/**
	 * updateUserInfo - update user account information
	 * @param  int $id        user id
	 * @param  array $user_data key-value pairs of info to update
	 * @return affected rows
	 */
	public function updateUserInfo($id=null,$user_data=null)
	{
		if(empty($id) OR empty($user_data))
		{
			return false;
		}

		foreach ($user_data as $key => $value)
		{
			switch ($key)
			{
				case 'first_name':
				case 'middle_name':
				case 'last_name':
					break;
				
				default:
					unset($user_data[$key]);
			}
		}
		$this->user_db->set($user_data);
		$this->user_db->where('user_id',$id);
		$this->user_db->update('user_info');
		$affected = $this->user_db->affected_rows();
		return is_int($affected);
	}
}
