<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Default page rendering parameters
|--------------------------------------------------------------------------
| 
| Associative array of default page parameters
|
*/
$config['page_render_params']['login'] = array(
		'body_class'  => 'hold-transition login-page',
		'page' 		  => 'login',
		'view_params' => array(
			'title'		   => 'Misc System',
			'current_page' => 'login'
		),
		'js_paths'	  => array(
			'auth/login' => 'main_js',
		),
	);
$config['page_render_params']['top_nav'] = array(
		'body_class'  => 'layout-top-nav skin-black',
		'page' 		  => 'home',
		'view_params' => array(
			'title'		   => 'Misc System',
			'current_page' => 'home'
		),
		'js_paths'	  => array(
			'home/home' => 'main_js',
		),
	);
$config['page_render_params']['side_nav'] = array(
		'body_class'  => 'layout-top-nav skin-black',
	);