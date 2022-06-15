<?php

if (!defined('PATH'))
  exit;

function money($number = 0){
  return number_format($number, 2, ',', '.');
}