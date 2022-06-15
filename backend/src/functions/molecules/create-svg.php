<?php

/**
 *
 * @author Lucas Victor
 * @link https://fb.com/javascript.lucas
 *
 * @version 3.0.0
 *
 * @since 1.0.0			Módulo iniciado
 * @since 2.0.0			Função alterada para capturar ícones gravados dinamicamente na pasta "icons"
 * @since 3.0.0			Alteração no formato de entrada e adição da condição de returns para evitar exceptions
 *
 * @package Global site by Lucas Victor - SRRJ
 * @subpackage SVG
 * 
 * @global {array} $site_svg    Crie um índice para este array e salve seu conteúdo dentro da pasta "inc/icons"
 *
 * @return [bool|string] Se existir dados, retornará o array no índice escolhido; Se não, retornará FALSE.
 *
 * @access public
 *
 */

if (!defined('PATH'))
	exit;

function svg($ID):string
{
	global $site_svg;

	if ($site_svg[$ID])
		return $site_svg[$ID];
	else
		return false;

}