<?php

if (!defined('PATH')) exit;

/**
 * @author Lucas Victor
 *
 * @package GBL
 * @subpackage excerpt_maker
 *
 * @param {STRING} content - O texto que será delimitado
 * @param {STRING} limit - A quantidade máxima de caracteres
 *
 */

function excerpt_maker($content = null, $limit = 115)
{
	if (!$content or empty($content))
		return false;

	if (strlen($content) <= $limit)
		return $content;
	else
		return substr($content, 0, $limit) . '...';

}