<?php

if (!defined('PATH')) exit;

/**
 *  
 * Input DD/MM/YYYY
 * Output YYYY-MM-DD
 * 
 */ 
function formatDateYMD($date) {
  $date = only_number($date);
  if (strlen($date) !== 8) return false;

  $date = sprintf(
    '%1$s-%2$s-%3$s',
    substr($date, 4, 4),
    substr($date, 2, 2),
    substr($date, 0, 2)
  );
  
  return $date;

}