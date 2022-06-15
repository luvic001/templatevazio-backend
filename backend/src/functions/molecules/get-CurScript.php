<?php
/**
 * @author Lucas Victor
 * 
 * @requires get-file-contents.php@1.0.0
 * @requires ___.php
 * 
 * @since @1.0 - Introduced
 * 
 * @version @1.0
 * 
 */
if (!defined('PATH')) exit;

function getCurScript($filename, $CUR_PATH = null, $echo = true){
  if (!$CUR_PATH){
    if (!defined('CUR_PATH')) 
      return false;
    else
      $CUR_PATH = CUR_PATH;
  }

  ob_start();
  ?>
  <script>
    <?= get_file('modules/'.$CUR_PATH.'/'.$filename.'.js') ?>
  </script>
  <?php
  $content = ob_get_contents();
  ob_end_clean();

  if ($echo)
    ___($content);
  else
    return $content;

}