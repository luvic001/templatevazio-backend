<?php

/**
 * 
 * @version 2.0
 * @author Lucas Victor
 * 
 * @since 1.0 - Introduced
 * @since 2.0 - Route Params
 * 
 */

if (!defined('PATH')) exit; 

global $host, $curRoute, $routes, $routeParams;

$curRoute = isset($_SERVER['REDIRECT_URL']) ? explode('/', $_SERVER['REDIRECT_URL']) : ['index'];

if (count($curRoute) > 1):

  unset($curRoute[0]);
  $routeLen = count($curRoute);
  if (empty($curRoute[$routeLen]) or $curRoute[$routeLen] == '') unset($curRoute[$routeLen]);

  foreach ($curRoute as $ind => $rt) {
    $rts[] = $rt;
  }

  $curRoute = $rts;

  for ($i = 1; $i < count($curRoute); $i++) {
    $routeParams[] = $curRoute[$i];
  }

endif;

$routes = [
  'backend' => [
    'index' => [
      'PATH' => 'core/home'
    ],
    'contato' => [
      'PATH' => 'cbma/contato'
    ]
  ]
];

$routes = to_object($routes);

if ($curRoute == '') {
  $curRoute = 'index';
}
