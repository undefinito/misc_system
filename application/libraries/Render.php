<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Render {

	protected $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
	}

	public function page($params=null)
	{
		if(empty($params) OR empty($params['page']))
		{
			redirect('error/404');
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

		$_page_parts = array(
				'header' 	 => null,
				'body'   	 => null,
				'footer' 	 => null,
				'js'	 	 => null,
				'body_class' => empty($params['body_class'])?'':$params['body_class'],
			);

		// load header <head>
		if(file_exists(views_path("page_builder/header.php")))
		{
			$_page_parts['header'] = $this->CI->load->view('page_builder/header',$params['view_params'],true);
		}

		// load js files
		if(file_exists(views_path("js_files.php")))
		{
			$_js_params = array_merge($params['view_params'],array('js_paths'=>$params['js_paths']));
			$_page_parts['js'] = $this->CI->load->view('js_files',$_js_params,true);
		}

		// load footer <footer>
		if(file_exists(views_path("page_builder/footer.php")))
		{
			$_page_parts['footer'] = $this->CI->load->view('page_builder/footer',$params['view_params'],true);
		}

		if( ! isset($_SESSION))
		{
			session_start();
		}
		

		// determine first the actual view format/layout
		$_menu = '';
		$_page_dir = '';
		$has_content_wrapper = true;
		$has_content_header = false;
		switch ($params['page'])
		{
			case 'home':
			case 'account':
				// top navigation menu
				$_menu = $this->menuHTML('top-nav',$params['view_params']);
				$_page_dir = "pages/overview/{$params['page']}";
				break;

			case 'login':
				$_page_dir = "pages/overview/{$params['page']}";
				$has_content_wrapper = false;
				break;


			case 'savings_home':
				$has_content_header = true;
				$_content_header_arr = array(
						'_content_header' => array(
							'title'      => 'Home',
							'breadcrumb' => array()
							)
						);

			case 'savings_pf':
				$has_content_header = true;
				$this->CI->load->model('systems_model','sys');
				$_menu_arr = $this->CI->sys->getMenuOf(1);

				// sort menu item list according to menu order
				$_menu_arr = array_column($_menu_arr, null,'menu_order');
				ksort($_menu_arr);

				// content header
				if (empty($_content_header_arr))
				{
					$_content_header_arr = array(
							'_content_header' => array(
								'title'      => 'Portfolio',
								'breadcrumb' => array()
								)
							);
					$_content_header_arr['_content_header']['breadcrumb'] = $this->CI->sys->getContentHeaderOf(1);
					// sort content header breadcrumb list according to content header order
					$_content_header_arr['_content_header']['breadcrumb'] = array_column($_content_header_arr['_content_header']['breadcrumb'], null,'header_order');
					ksort($_content_header_arr['_content_header']['breadcrumb']);
				}
				$_content_header = $this->headerHTML($params['page'],array_merge($params['view_params'],$_content_header_arr));
				// side navigation
				$_menu = $this->menuHTML('side-nav',array_merge($params['view_params'],array('_menu_arr'=>$_menu_arr)));
				$_page_dir = "pages/savings-monitor/{$params['page']}";
				break;
				
			default:
				// show failed msg
				$this->CI->load->view('failed',array('view_name'=>$params['page']));
				return;
		}

		if(file_exists(views_path("{$_page_dir}.php")))
		{
			// load actual view
			$_page_parts['body'] = $this->CI->load->view("{$_page_dir}",$params['view_params'],true);
		}
		else
		{
			// show failed msg
			$this->CI->load->view('failed',array('view_name'=>$params['page']));
		}

		if($has_content_wrapper)
		{
			if ($has_content_header)
			{
				$_page_parts['body'] = $_menu . ' <div class="content-wrapper">'. $_content_header . $_page_parts['body'] . "</div>";
			}
			else
			{
				$_page_parts['body'] = $_menu . ' <div class="content-wrapper">'. $_page_parts['body'] . "</div>";
			}
		}
		else
		{
			$_page_parts['body'] = $_menu . $_page_parts['body'];
		}


		// load page to contain everything
		if(file_exists(views_path("page_builder/body.php")))
		{
			$this->CI->load->view('page_builder/body',$_page_parts);
		}
		else
		{
			// show failed msg
			$this->CI->load->view('failed',array('view_name'=>$params['page']));
			return;
		}
	}

	/**
	 * menuHTML - generate menu HTML depending on $which (top-nav|side-nav)
	 * @param  string $which       top or side navigation menu
	 * @param  array  $view_params parameters for the current view/page
	 * @return string              menu HTML, NULL on unrecognized $which, or FALSE on failure
	 */
	private function menuHTML($which='side-nav',$view_params=null)
	{
		switch ($which)
		{
			case 'side-nav':
				// side navigation menu
				if(file_exists(views_path("page_builder/menu/side_nav.php")))
				{
					if( ! is_array($view_params) && ! is_null($view_params))
					{
						$view_params = null;
					}

					return $this->CI->load->view('page_builder/menu/side_nav',$view_params,true);
				}
				else
				{
					return null;
				}
				break;

			case 'top-nav':
				// top navigation menu
				if(file_exists(views_path("page_builder/menu/top_nav.php")))
				{
					if( ! is_array($view_params) && ! is_null($view_params))
					{
						$view_params = null;
					}

					return $this->CI->load->view('page_builder/menu/top_nav',$view_params,true);
				}
				else
				{
					return null;
				}
				break;
			
			default:
				return null;
		}

	}

	/**
	 * headerHTML - generate html of content/page header
	 * @param  string $which
	 * @param  array $view_params
	 * @return string
	 */
	private function headerHTML($which=null,$view_params=null)
	{
		switch ($which)
		{
			case 'savings_pf':
				// content header
				if(file_exists(views_path("page_builder/content_header.php")))
				{
					if( ! is_array($view_params) && ! is_null($view_params))
					{
						$view_params = null;
					}

					return $this->CI->load->view('page_builder/content_header',$view_params,true);
				}
				else
				{
					return null;
				}
				break;
			
			case 'savings_home':
			default:
				return null;
		}
	}
}