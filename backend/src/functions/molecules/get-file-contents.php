<?php

if (!defined('PATH'))
  exit;

function get_file($file){
  
  $dir = PATH . '/src/' . $file;

  if (!file_exists($dir)){
    ___a('Atenção, o arquivo ' . $file . ' não existe');
    $data = false;
  }
  else {
    $data = file_get_contents($dir);
  }
 
  return $data;

}