<?php

/**
 *
 * @author Lucas Victor
 * @link https://fb.com/javascript.lucas
 *
 * ESSA FUNÇÃO FOI CRIADA PARA RESUMIR O CÓDIGO strftime()
 *
 * @version 1.0.0
 * @since 1.0.0			Função Criada
 *
 * @package GLV
 * @subpackage TTime
 *
 * @param {string} DATE 	- A data-escopo								- @since 1.0.0
 * @param {string} FORMAT 	- O Formato de exibição da data para ser
 *							  Retornada para a Função 					- @since 1.0.0
 *
 * @return {string}
 *
 */

if (!defined('PATH'))
	exit;

if (!function_exists('ttime'))
{
	function ttime($date, $format = '%A, %d de %B', $with_slash = false):string
	{

		if ($with_slash)
			$date = substr($date, 3, 2) . '/' . substr($date, 0, 2) . '/' . substr($date, 6, 4);

		$date = strtotime( $date );
		$date = strftime( $format, $date );

		$date = strtr($date, [
			'Sunday' => 'Domingo',
			'Monday' => 'Segunda',
			'Tuesday' => 'Terça',
			'Wednesday' => 'Quarta',
			'Thursday' => 'Quinta',
			'Friday' => 'Sexta',
			'Saturday' => 'Sábado',
			'January' => 'Janeiro',
			'February' => 'Fevereiro',
			'March' => 'Março',
			'April' => 'Abril',
			'May' => 'Maio',
			'June' => 'Junho',
			'July' => 'Julho',
			'August' => 'Agosto',
			'September' => 'Setembro',
			'October' => 'Outubro',
			'November' => 'Novembro',
			'December' => 'Dezembro'
		]);

		return ucfirst(utf8_encode($date));

	}
}