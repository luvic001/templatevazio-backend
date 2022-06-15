<?php

if (!defined('PATH'))
  exit;

function loadScripts(){
  if (!defined('LOAD_SCRIPTS'))
    return false;
  
  $scripts = explode(',', LOAD_SCRIPTS);
  $scriptData = '';

  foreach ($scripts as $scriptName){
    $scriptData .= get_file(
      sprintf('js/%s.js', trim($scriptName))
    );
  }

  ___(
    sprintf('<script>%s</script>', $scriptData)
  );
  return true;
}

function minifyScripts($data){

  $expressions = array(
    'MULTILINE_COMMENT'     => '\Q/*\E[\s\S]+?\Q*/\E',
    'SINGLELINE_COMMENT'    => '(?:http|ftp)s?://(*SKIP)(*FAIL)|//.+',
    'WHITESPACE'            => '^\s+|\R\s*'
  );

  foreach ($expressions as $key => $expr) {
    $data = preg_replace('~'.$expr.'~m', '', $data);
  }

  return $data;

}