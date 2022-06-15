<?php

if (!defined('PATH')) exit;

class validateField {

  var $fieldValue,
      $type,
      $dbObject;

  const DB_TABLE_FOR_CHECK_IF_EXISTS = 'wp_users';

  public function __construct(){
    $this->dbObject = new db;
  }

  function setValue($fieldValue){
    $this->fieldValue = $fieldValue;
    return $this;
  }

  function setType($type = 'field_nome'){
    $this->type = $type;
    return $this;
  }

  function check($checkExists = true){
    if (!method_exists($this, $this->type)) return false;
    return $this->{$this->type}($checkExists);
  }
  
  private function field_cep(){
    $viaCEP = new viaCEP($this->fieldValue);
    return $viaCEP->index();
  }

  private function field_number(){
    $regex = "/^[0-9]{1,}$/";
    return preg_match($regex, $this->fieldValue);
  }

  private function field_nome(){
    $regex = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u";
    return preg_match($regex, $this->fieldValue);
  }

  private function field_email(){
    return filter_var($this->fieldValue, FILTER_VALIDATE_EMAIL);
  }

  private function field_rg($checkExists = true){
    if ($checkExists){
      return ( 
        (!$this->dbObject->select(self::DB_TABLE_FOR_CHECK_IF_EXISTS, [
          'user_rg' => only_number($this->fieldValue)
        ]))
      );
    }
    else {
      return true;
    }
  }

  private function field_cpf(){
    return validaCPF($this->fieldValue);
  }

  private function field_login() {
    return (bool) $this->dbObject->select(self::DB_TABLE_FOR_CHECK_IF_EXISTS, [
      'user_login' => only_number($this->fieldValue)
    ]);
  }

  public function field_phone(){
    $val = preg_replace('/\D/', '', $this->fieldValue);
    $ddd = substr($val, 0, 2);

    if ($ddd < 11 OR $ddd > 99) return false;
    if (strlen($val) < 10 or strlen($val) > 11) return false;

    return true;
  }

  public function field_endereco(){
    return true;
  }

  public function field_bairro(){
    return $this->field_nome();
  }

  public function field_cidade(){
    return $this->field_nome();
  }

  public function field_date(){
    $date = formatDateYMD($this->fieldValue);
    if (!$date) return false;

    $date  = explode('-', $date);
    $year  = $date[0];
    $month = $date[1];
    $day   = $date[2];

    return checkdate($month, $day, $year);

  }

  public function field_genre() {
    $genre = (int) only_number($this->fieldValue);
    if ($genre !== 1 and $genre !== 2) return false;

    return true;

  }

  public function field_estado(){
    $estados = [ 'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RO', 'RS', 'RR', 'SC', 'SE', 'SP', 'TO' ];
    return in_array($this->fieldValue, $estados);
  }

  public function field_ag() {
    return (bool) (is_numeric($this->fieldValue) and strlen($this->fieldValue) >= 4 );
  }

  public function field_cc() {
    return (bool) (strlen($this->fieldValue) >= 4 and strlen($this->fieldValue) <= 12);
  }

  public function field_bk() {
    $bk = ['001', '033', '041', '104', '237', '341'];
    return in_array($this->fieldValue, $bk);
  }

  public function field_due_date(){
    $due_date = get_due_date();
    return isset($due_date[$this->fieldValue]);
  }
  
}