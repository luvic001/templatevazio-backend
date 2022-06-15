<?php

if (!defined('PATH'))
  exit;

/**
 * @author Lucas Victor
 * @package ViaCEP Integração
 * 
 * @version 1.0.0
 * 
 * @since 1.0.0 - Introduced
 * 
 * @var CEP - O cep a ser consultado
 * 
 * @requires get-HTTP_REQUEST_DATA.php
 * 
 */

class viaCEP {
  const HOST = 'https://viacep.com.br/ws/%s/json/';
  var $CEP;

  public function __construct($CEP){
    $this->CEP = $CEP;
    $this->sanitize();
  }

  private function sanitize(){
    $CEP = preg_replace('/\D/', '', $this->CEP);
    $this->CEP = $CEP;
  }

  public function index(){
    $url = sprintf(self::HOST, $this->CEP);
    $data = HTTP_REQUEST_DATA(0, $url)->content;
    return $data;
  }

}