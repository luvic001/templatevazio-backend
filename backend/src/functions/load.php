<?php

if (!defined('PATH')) exit;

$files = glob(PATH . '/src/functions/**/*.php');

foreach ($files as $file)
  require($file);