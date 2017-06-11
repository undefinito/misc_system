<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Systems_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	/**
	 * getAll - get all enabled systems
	 * @return array
	 */
	public function getAll()
	{
		$result = $this->db->get_where('system',array('is_enabled'=>1));
		return $result->result_array();
	}

}
