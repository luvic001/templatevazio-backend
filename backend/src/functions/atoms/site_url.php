<?php

if (!defined('PATH')) exit;

if (!function_exists('site_url'))
{
	function site_url()
	{
	    global $TEMPLATE_DIRECTORY_URI;
	    return $TEMPLATE_DIRECTORY_URI;
	}
}