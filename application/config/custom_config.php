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
$config['page_render_params']['home'] = array(
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
$config['page_render_params']['account'] = array(
		'body_class'  => 'layout-top-nav skin-black',
		'page' 		  => 'account',
		'view_params' => array(
			'title'		   => 'Misc System: Account',
			'current_page' => 'account'
		),
		'js_paths'	  => array('account' => 'main_js'),
	);

/////////////////////
// SAVINGS MONITOR //
/////////////////////
$config['page_render_params']['savings_monitor'] = array(
		'body_class'  => 'layout-boxed sidebar-mini skin-black',
		'page' 		  => 'savings_home',
		'view_params' => array(
			'title'		   => 'Savings Monitor',
			'current_page' => 'savings_home',
		),
		'js_paths'	  => array('savings_home' => 'main_js'),
	);
$config['page_render_params']['savings_portfolio'] = array(
		'body_class'  => 'layout-boxed sidebar-mini skin-black',
		'page' 		  => 'savings_pf',
		'view_params' => array(
			'title'		   => 'SvM: Portfolio',
			'current_page' => 'savings_pf',
		),
		'js_paths'	  => array(
				'savings_pf' => array('main_js','objects'),
			),
	);