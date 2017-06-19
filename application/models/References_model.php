<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class References_model extends CI_Model {

	private $ref_db;

	public function __construct()
	{
		parent::__construct();
		$this->ref_db = $this->load->database('reference_db',true);
	}

	/**
	 * getReferenceFor - get form reference
	 * @param  string $table mysql table name
	 * @return array
	 */
	public function getReferenceFor($table=null)
	{
		$result = $this->ref_db->get_where('forms_ref',array('table_name'=>$table));
		return $result->result_array();
	}

	/**
	 * formatArray - format input array for insert/update of a table
	 * @param  array  $data_array input array
	 * @param  string $for        specified usage
	 * @return array
	 */
	public function formatArray($data_array=null,$for=null)
	{
		if(empty($data_array) OR empty($for))
		{
			return false;
		}

		switch ($for)
		{
			// edit user account information
			case 'edit_info':
				$ref_array = $this->getReferenceFor('user_info');

			case 'edit_password':
					
				if( ! isset($ref_array))
				{
					$ref_array = $this->getReferenceFor('user');
				}
				
				$ref_array = array_column($ref_array,'col_name','input_name');
				$result_arr = array();
				foreach ($data_array as $key => $value)
				{
					if(array_key_exists($key, $ref_array))
					{
						$result_arr[$ref_array[$key]] = $value;
					}
				}

				return empty($result_arr) ? array() : $result_arr;

			default:
				// ERROR: unreqcognized purpose
				return false;	
		}
	}
}
