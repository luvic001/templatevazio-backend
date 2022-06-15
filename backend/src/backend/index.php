<?php

if (!defined('PATH')) exit;
hjson();
get('routes');

global $host, $curRoute, $routes, $hashfier;
$hashfier = new controller\hashfier(AUTH_SALT);

if (!isset($routes->backend->{$curRoute[1]}->PATH)){
  fjson([
    'success' => false,
    'content' => 'Ops! Ponto de acesso não encontrado.'
  ], 404);
}

get('backend/Content');