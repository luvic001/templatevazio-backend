<?php
/**
 * @author Lucas Victor
 * 
 * @requires get-file-contents.php@1.0.0
 * @requires ___.php
 * 
 * @since @1.0 - Introduced
 * @since @1.1 - $echo (bool) - return || echo
 * @since @1.2 - $CUR_PATH as variable
 * 
 * @version @1.2
 * 
 */
if (!defined('PATH')) exit;

function getCurStyleSheet($filename, $CUR_PATH = null, $echo = true){
  if (!$CUR_PATH){
    if (!defined('CUR_PATH')) 
      return false;
    else
      $CUR_PATH = CUR_PATH;
  }

  ob_start();
  ?>
  <style>
    <?= get_file('modules/'.$CUR_PATH.'/'.$filename.'.css') ?>
  </style>
  <?php
  $content = ob_get_contents();
  ob_end_clean();

  if ($echo)
    ___($content);
  else
    return $content;

}