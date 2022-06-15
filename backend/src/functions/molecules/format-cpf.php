<?php

if (!defined('PATH')) exit;

function cpf( $param ) {

  $cpf = only_number($param);
  $tam = strlen($cpf);

  if ($tam !== 11) return false;

  $cpf = [
    substr($cpf, 0, 3),
    substr($cpf, 3, 3),
    substr($cpf, 6, 3),
    substr($cpf, 9, 2),
  ];

  return sprintf('%1$s.%2$s.%3$s-%4$s', $cpf[0], $cpf[1], $cpf[2], $cpf[3]);

}