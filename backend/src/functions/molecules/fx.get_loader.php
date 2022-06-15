<?php

if (!defined('PATH')) exit;

function get_loader($message = null) {

  ob_start();
  get_modules('loader', 'global', [
    'loading_message' => $message
  ]);
  $content = ob_get_contents();
  ob_end_clean();

  return $content;

}