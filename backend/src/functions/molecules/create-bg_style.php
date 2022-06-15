<?php

/**
 *
 * @author Lucas Victor
 * @link https://fb.com/javascript.lucas
 *
 * @package GLV
 * @subpackage bg_style
 *
 * @version 1.0.0
 *
 * @since 1.0.0 						Módulo Iniciado
 *
 *
 * @param {string} $elemento 			- Classe ou elemento a receber a imagem -- @since 1.0.0 
 * @param {string} $image_desktop 		- Imagem para desktop
 * @param {string} $image_mobile 		- Imagem para mobile
 *
 * @return null
 *
 */

if (!defined('PATH'))
	exit;

function bg_style($elemento, $image_desktop, $image_mobile, $breakpoint = 768)
{

	___(sprintf('
		<style>%s { background-image: url("%s");} @media (min-width: %spx) { %s { background-image: url("%s"); } }</style>
		',
		$elemento, $image_mobile,
		$breakpoint, $elemento, $image_desktop
	));
}