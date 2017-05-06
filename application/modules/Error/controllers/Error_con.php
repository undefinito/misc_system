<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_con extends MX_Controller {

	public function index($code='404')
	{
		$code_ref = array(
				'404' => 'page not found',
				'500' => 'internal server error',
				'403' => 'forbidden',
			);
		$msg = '';
		switch ($code)
		{
			case '403':
			case '404':
			case '500':
				$msg = "Error {$code}: {$code_ref[$code]}";
				break;

			default:
				$msg = 'Error 404: page not found';
				break;
		}

		echo $msg;
	}
}