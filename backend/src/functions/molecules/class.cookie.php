<?php

class cookie {

  var $hashfier,
      $expires;

  public function __construct(){
    $this->hashfier = new controller\hashfier(AUTH_SALT);
  }

  public function setExpires($time){
    $this->expires = $time;
  }
  public function getExpires(){
    return $this->expires;
  }

  public function set($cookieName, $value) {
    $content = $this->hashfier->make($value);
    $expires = $this->getExpires() ?? 30 * 30 * 60;
    setcookie($cookieName, b64($content), time() + $expires, '/');
  }

  public function get($cookieName) {
    if (!$_COOKIE[$cookieName]) return false;
    $content = $_COOKIE[$cookieName];
    $content = $this->hashfier->unmake(unb64($content));
    return $content;
  }

  public function destroy($cookieName) {
    if (!$_COOKIE[$cookieName]) return false;
    $this->setExpires(-3600);
    $this->set($cookieName, null);
    $this->setExpires(null);
    return true;
  }
  
}