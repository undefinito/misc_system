<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Systems_model extends CI_Model {

	private $sys_db;

	public function __construct()
	{
		parent::__construct();
		$this->sys_db = $this->load->database('misc_db',true);
	}

	/**
	 * getAll - get all enabled systems
	 * @return array
	 */
	public function getAll()
	{
		$result = $this->sys_db->get_where('system',array('is_enabled'=>1));
		return $result->result_array();
	}

	/**
	 * getMenuOf - get list of menu items of a specified system
	 * @param  int $system_id system id
	 * @return array
	 */
	public function getMenuOf($system_id=null)
	{
		if(empty($system_id))
		{
			return false;
		}

		$result = $this->sys_db->get_where('menu',array('system_id'=>$system_id,'is_enabled'=>1));
		return $result->result_array();
	}

	/**
	 * getContentHeaderOf - get content header breadcrumbs of specified system page
	 * @param  int $menu_id
	 * @return array
	 */
	public function getContentHeaderOf($menu_id=null)
	{
		if(empty($menu_id))
		{
			return false;
		}

		$result = $this->sys_db->get_where('content_header',array('menu_id'=>$menu_id));
		return $result->result_array();
	}

}
