<?php
/**
 * 
 * @version 1.0.0
 * @author Lucas Victor
 * 
 * @since 1.0.0 - Introduced
 * 
 * @uses controller\hashfier
 * @uses @param string AUTH_SALT
 * @uses fx: b64 @version 1.0.0
 * @uses fx: unb64 @version 1.0.0
 * 
 * @param string $content_to_be_hashed
 * @return string 
 * 
 * Codifica no @method BF-CBC o @param string $content_to_be_hashed
 * 
 */

/**
 * fx: do_hash
 * @version 1.0.0
 */
function do_hash($content_to_be_hashed = null) {

  $hashfier = new controller\hashfier(AUTH_SALT);
  $hashed_content = b64(
    $hashfier->make($content_to_be_hashed)
  );

  return $hashed_content;

}

/**
 * fx: undo_hash
 * @version 1.0.0
 */
function undo_hash($content_to_be_unhashed = null) {
  
  $content_to_be_unhashed = unb64($content_to_be_unhashed);

  if (!$content_to_be_unhashed) {
    return false;
  }

  $hashfier = new controller\hashfier(AUTH_SALT);
  $unhashed_content = $hashfier->unmake($content_to_be_unhashed);

  return $unhashed_content ?? false;

}