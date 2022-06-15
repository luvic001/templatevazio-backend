<?php

/**
 * @author Lucas Victor
 * @link https://instagram.com/lucasv003
 * 
 * Função para simplificar a sintaxe json_encode e decode 
 * 
 * @version 3.0.0
 * 
 * @since 1.0.0 	- json + unjson
 * @since 2.0.0 	- FUNCTION HJSON
 * @since 3.0.0 	- FUNCTION FJSON (final json) die() and includes http_response_code()
 * 
 */

if (!defined('PATH'))
	exit;

if (!function_exists('hjson'))
{
	function hjson(){
		header('content-type: application/json');
	}
}

function json($param){
	return (json_encode($param));
}

function unjson($param){
	return (json_decode($param));
}

if (!function_exists('fjson')){
	function fjson($content = [], $code = 200){
		http_response_code($code);
		die(json($content));
	}
}