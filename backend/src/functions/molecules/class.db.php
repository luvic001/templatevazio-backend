<?php

if (!defined('PATH')) exit;

class db {

  var $db;

  public function __construct(){
    global $db;
    $this->db = $db;
  }

  public function insert($table, $data){

    try {

      $sql = sprintf('INSERT INTO `%1$s` ', $table);
      $val = '';

      foreach ($data as $key => $value){
        $keys[] = $key;
        $val .= ':' .$key. ' ';
      }

      $keys = implode("`, `", $keys); 
      $keys = '`' . $keys . '`';

      $val = explode(' ', $val);
      $val = implode(', ', $val);
      $val = substr($val, 0, strlen($val) - 2);

      $sql .= sprintf('(%s) ', $keys);
      $sql .= 'VALUES (' . $val . ')';
      
      $stmt = $this->db->prepare($sql);
      
      foreach ($data as $key => $value){
        $param = ':' . $key;
        $stmt->bindValue($param, $value);
      }

      $stmt->execute();

      return $this->db->lastInsertId();

    }

    catch (PDOExeption $e){
      return false;
    }

  }

  public function select($table, $where = null, $orderby = null, $join = null, $selectFieldAs = null){

    if (!$selectFieldAs)
      $sql = sprintf('SELECT * FROM `%s` ', $table);
    else {
      $sql = 'SELECT ';
      $ind=0;
      $len=count($selectFieldAs);
      foreach ($selectFieldAs as $key => $newKey) {
        $ind++;
        $sql .= sprintf(' %s AS %s %s ', $key, $newKey, ($ind >= $len) ? '' : ',' );
      }
      $sql .= sprintf(' FROM %s ', $table);

    }

    if ($join) {
      $sql .= sprintf(' INNER JOIN %s ON %s = %s ', $join['table'], $table.'.'.$join['fields'][0], $join['table'].'.'.$join['fields'][1]);
    }

    if ($where) {
      $sql .= 'WHERE';
      $ind = 0;
      foreach ($where['fields'] as $key => $value){
        $sql .= sprintf(' %2$s %1$s %4$s :%3$s', $table.'.'.$key, $ind > 0 ? 'AND' : '', $key, $where['compare'] ?? '=');
        $ind++;
      }
    }

    if ($orderby) {
      $sql .= ' ORDER BY '.$table.'.'.$orderby['order_by'].' '.$orderby['order'];
    }

    $stmt = $this->db->prepare($sql);
    if ($where) {
      foreach ($where['fields'] as $key => $value){
        $param = ':'.$key;
        if ($where['compare'] == 'LIKE') {
          $value = '%'.$value.'%';
        }
        $stmt->bindValue($param, $value);
      }
    }
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

  }

  public function delete($table, $param) {

    try {

      $sql = 'DELETE FROM '.$table.' WHERE ';

      foreach ($param as $field => $value) {
        $sql .= $field . ' = :' . $field;
      }
      
      $stmt = $this->db->prepare($sql);

      foreach ($param as $field => $value) {
        $fld = ':'.$field;
        $stmt->bindParam($fld, $value);
      }

      $stmt->execute();

      return true;

    }
    catch (PDOException $e) {
      return false;
    }

  }

  public function update($table, $param, $where) {

    $sql = 'UPDATE '.$table.' SET ';

    $ind = 1;
    $separatorLimiter = count($param);
    foreach ($param as $field => $value) {
      $separator = ($ind < $separatorLimiter) ? ', ' : '';
      $sql .= ' `'.$table.'`.`' . $field .'` = :'.$field.'_prm ' . $separator. ' ';
      $ind++;
    }

    $sql .= ' WHERE ';
    $ind = 0;
    
    foreach ($where['fields'] as $field => $value) {
      if ($ind > 0)
        $sql .= sprintf(' %s ', $where['relation'] ?? 'AND');

      $sql .= ' '. $field.' = :'.$field . '_whr ' . ' ';
      $ind++;
    }
    
    try {
      $stmt = $this->db->prepare($sql);
      
      foreach ($param as $field => $value) {
        $fld = ':'.$field.'_prm';
        $stmt->bindValue($fld, $value);
      }
      
      foreach ($where['fields'] as $field => $value) {
        $fld = ':'.$field.'_whr';
        $stmt->bindValue($fld, $value);
      }
      
      $stmt->execute();

      return true; 

    }

    catch (PDOException $e) {
      return false;
    }


  }

}