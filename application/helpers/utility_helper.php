<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('asset_url'))
{
	function asset_url($url='')
	{
		return base_url("assets/{$url}");
	}	
}

if( ! function_exists('asset_path'))
{
	function asset_path($path='')
	{
		return FCPATH . "assets/{$path}";
	}	
}

if( ! function_exists('views_path'))
{
	function views_path($path='')
	{
		return FCPATH . "application/views/{$path}";
	}	
}
