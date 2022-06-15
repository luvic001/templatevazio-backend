<?php

/**
 * @author Lucas Victor
 * 
 *
 * @package GBL
 * @subpackage Convert special chars to HTML tags
 *
 * @see https://whatsapp.com
 *
 * @version 1.0.0
 *
 * @since 1.0.0 - Introduced
 *
 */

if (!defined('PATH'))
	exit;

function format_text_html($plain_string) {
	$styles = [ 
		'*' => 'strong', 
		'_' => 'i', 
		'~' => 'strike' 
	];

	return preg_replace_callback('/(?<!\w)([*~_])(.+?)\1(?!\w)/', function($m) use($styles) { 
		return '<'. $styles[$m[1]]. '>'. $m[2]. '</'. $styles[$m[1]]. '>';
	}, $plain_string);
}