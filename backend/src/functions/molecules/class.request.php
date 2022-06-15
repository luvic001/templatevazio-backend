<?php

if (!defined('PATH')) exit;

class Request {

  var $type,
      $request_fields,
      $response, 
      $url,
      $header,
      
      $payloadJson;

  public function setURL($url) {
    $this->url = $url;
  }

  public function isPost($type = true) {
    $this->type = $type;
  }

  public function setPayloadTypeToJson() {
    $this->payloadJson = true;
  }

  public function addField($fields) {
    foreach ($fields as $key => $value)
      $this->request_fields[$key] = $value;
  }

  public function addHeader($fields) {
    foreach ($fields as $key => $value) {
      $header[] = sprintf('%1$s: %2$s', $key, $value);
    }
    $this->header = $header;
    
  }
    
  public function send() {
    $this->response = HTTP_REQUEST_DATA($this->type, $this->url, $this->request_fields, $this->payloadJson, ((bool) $this->header), $this->header );
  }

  public function getResponse(){
    return $this->response;
  }

}