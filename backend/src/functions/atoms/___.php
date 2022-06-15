<?php

if (!defined('PATH')) exit;

function ___($param)
{
    echo $param;
}

/**
 *
 * @author Lucas Victor
 * @package GBL
 *
 * @version 2.0.1
 *
 * @subpackage alert
 *
 * @requires 'format-to_format.php', '___.php' -> custom php echo, '_custom-alert.sass'
 *
 * ESTE MÓDULO CRIA UMA DIV ALERTA COM MENSAGENS PERSONALIZADAS
 * ONDE A FUNÇÃO ___a() FOR CHAMADA
 *
 * @param $message {STRING} 	- A mensagem que será exibida 								--- @since 1.0.0
 * @param $case {STRING} 		- Os tipos de casos aceitos [ error, warn, success ]		--- @since 1.0.0
 *						   		  Caso nenhum dos valores forem informados, 
 *								  ele retornará o padrão 'log-default'
 *
 * @param $show_icon {BOOL} 	- Condição se deverá aparecer ou não o ícone				--- @since 1.0.0
 *
 * @since 2.0.1		- Icons disabled
 * 
 * @return {string} - O alerta em formato HTML
 *
 */

function ___a($message = '', $case = 'error', $show_icon = true):string
{

	switch ($case):

		case 'error':
			$class = [ 'type' => 'log-error', 'icon' => '<i class="fal fa-times fa-2x"></i>' ];
			break;

		case 'warn':
			$class = [ 'type' => 'log-warning', 'icon' => '<i class="fal fa-exclamation-triangle"></i>' ];
			break;
			
		case 'success':
			$class = [ 'type' => 'log-success', 'icon' => '<i class="fas fa-check"></i>' ];
			break;

		default:
			$class = [ 'type' => 'log-default', 'icon' => '<i class="fas fa-info-circle"></i>' ];
			break;
	
	endswitch;

	$class = to_object($class);

	if (!$show_icon)
		$icon = '';
	else
		$icon = $class->icon;

	$html = sprintf( '<div class="debug-content d-flex align-items-center %s">%s<p class="mb-0">%s</p></div>', $class->type, false, $message );
	
	return( $html );

}