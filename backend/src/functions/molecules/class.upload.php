<?php

if (!defined('PATH')) exit;

class file_upload {

  const UPLOAD_DIR = 'assets/uploads/%1$s/%2$s';
  public $UPLOAD_PATH;

  public function __construct() {
    self::set_upload_path();
  }

  public function file_extension($file = null) {
    return pathinfo($file, PATHINFO_EXTENSION);
  }

  private function set_upload_path() {
    $upload_dir = sprintf(self::UPLOAD_DIR, date('Y'), date('m'));
    $this->UPLOAD_PATH = sprintf('%1$s/%2$s', $_SERVER['DOCUMENT_ROOT'], $upload_dir);
  }

  private function get_upload_path() {
    return $this->UPLOAD_PATH;
  }

  private function create_path() {
    $upload_path = self::get_upload_path();
    $create_dir = mkdir($upload_path, 0755, true);
    return (object) [ 
      'was_created' => $create_dir,
      'dir' => $upload_path
    ];
  }

  public function send($temp_file, $file_name) {
    
    $upload_destination = sprintf(
      '%s/%s-%s.%s',
      self::create_path()->dir,
      str_ireplace( 
        sprintf(
          '.%s', 
          self::file_extension($file_name)
        ), 
        '', 
        $file_name
      ),
      date('Y-m-d_H.i.s'),
      self::file_extension($file_name)
    );

    $upload = move_uploaded_file(
      $temp_file,
      $upload_destination
    );

    if ($upload) {
      $file_link = str_ireplace($_SERVER['DOCUMENT_ROOT'], '', $upload_destination);
      return $file_link;
    }
    else {
      return false;
    }

  }

}