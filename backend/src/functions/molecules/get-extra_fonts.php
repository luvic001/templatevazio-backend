<?php 

if (!defined('PATH')) exit;

function load_extra_css($preload = true)
{
	global $load_extra_css;
	if (is_array($load_extra_css)):
		if(!empty($load_extra_css)):
			foreach ($load_extra_css as $file):
				if ($preload)
					___( sprintf('<link rel="stylesheet" href="%s/assets/%s.css" media="screen">', site_url(), $file) );
				else
					___( sprintf('<link rel="preload" href="%s/assets/%s.css" as="style">', site_url(), $file) );
			endforeach;
		endif;
	endif;

}