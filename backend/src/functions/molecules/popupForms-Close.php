<?php

if (!defined('PATH'))
  exit;

function closePopup($text = null, $time = 400){
  ob_start();
  ?>
  <?php if ($text) ___('<p class="p-3">'.$text.'</p>') ?>
  <script>
    window.setTimeout(() => {
      window.location.reload(true);
    }, <?= $time ?>);
    </script>
  <?php
  $content = ob_get_contents();
  ob_end_clean();

  return $content;
}