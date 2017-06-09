<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends MX_Controller {

	public function page($params=null)
	{
		if(empty($params) OR empty($params['page']) OR empty($params['module']))
		{
			echo Modules::run('error/error_con/index','404');
			return;
		}

		// if required parameters do not exist then set as NULL
		$_required_params = array('view_params','js_paths');
		foreach ($_required_params as $key)
		{
			if(empty($params[$key]))
			{
				$params[$key] = null;	
			}
		}

		// load module
		$this->load->module($params['module']);

		$_page_parts = array(
				'header' 	 => null,
				'body'   	 => null,
				'footer' 	 => null,
				'js'	 	 => null,
				'body_class' => empty($params['body_class'])?'':$params['body_class'],
			);

		// load header <head>
		if(file_exists(modules_path("/renderer/views/page_builder/header.php")))
		{
			$_page_parts['header'] = $this->load->view('page_builder/header',$params['view_params'],true);
		}

		// load js files
		if(file_exists(modules_path("/renderer/views/js_files.php")))
		{
			$_js_params = array_merge($params['view_params'],array('js_paths'=>$params['js_paths']));
			$_page_parts['js'] = $this->load->view('js_files',$_js_params,true);
		}

		// load footer <footer>
		if(file_exists(modules_path("/renderer/views/page_builder/footer.php")))
		{
			$_page_parts['footer'] = $this->load->view('page_builder/footer',$params['view_params'],true);
		}

		// determine first the actual view format/layout
		switch ($params['page'])
		{
			case 'home':
				// menu

				break;
				
			default:
				if(file_exists(modules_path("/{$params['module']}/views/{$params['page']}.php")))
				{
					// load actual view
					$_page_parts['body'] = $this->{$params['module']}->load->view($params['page'],$params['view_params'],true);
				}
				else
				{
					// show failed msg
					$this->load->view('failed',array('view_name'=>$params['page']));
					return;
				}
				break;
		}


		// load page to contain everything
		if(file_exists(modules_path("/renderer/views/page_builder/body.php")))
		{
			$this->load->view('page_builder/body',$_page_parts);
		}
		else
		{
			// show failed msg
			$this->load->view('failed',array('view_name'=>$params['page']));
			return;
		}
	}
}