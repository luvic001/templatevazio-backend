<?php 

if (!defined('PATH'))
	exit;

function get_image( $file, $with_tag = false, $class = '', $alt = '' )
{

    global $TEMPLATE_DIRECTORY_URI;

    if ($with_tag)
    	$src =  sprintf( '<img data-src="%s" class="%s" alt="%s">', sprintf( '%s/assets/img/%s', $TEMPLATE_DIRECTORY_URI, $file ), $class, $alt);
    else
    	$src = sprintf( '%s/assets/img/%s', $TEMPLATE_DIRECTORY_URI, $file );

    return( $src );

}

function get_icon( $file, $base = 'icon', $ext = 'png' )
{
	return (
		get_image (  
			sprintf(
				'icons/%s-%s.%s',
				$base,
				$file,
				$ext
			)
		)
	);
}