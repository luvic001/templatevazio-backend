<?php

if (!defined('PATH')) exit;

function transform_money_in_float($money) {

  $money = str_ireplace('R$', '', $money);
  $money = trim($money);
  $money = str_ireplace('.', '', $money);
  $money = str_ireplace(',', '.', $money);
  
  return $money;

}