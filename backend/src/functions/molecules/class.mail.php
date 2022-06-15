<?php

namespace PHPMailer\PHPMailer;

if (!defined('PATH')) exit;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailSender {

  var $mail;

  public function __construct(){
    $this->mail = new PHPMailer(true);
  }

  public function sendMail($to, $subject, $message) {
    try {
      //Server settings
      // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
      $this->mail->SMTPDebug  = 0;
      $this->mail->isSMTP();                                            // Send using SMTP
      $this->mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $this->mail->Host       = SMTP_HOST;                              // Set the SMTP server to send through
      $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $this->mail->Username   = SMTP_USER;                              // SMTP username
      $this->mail->Password   = SMTP_PASS;                              // SMTP password
      $this->mail->Port       = SMTP_PORT;                              // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
      
      $this->mail->SMTPOptions = [
        'ssl' => [
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        ]
      ];

      //Recipients
      $this->mail->setFrom(STMP_FROM_BOX, SMTP_FROM_BOX_NAME);
      $this->mail->addAddress($to);     // Add a recipient
      $this->mail->addReplyTo(STMP_FROM_BOX, SMTP_FROM_BOX_NAME);
  
      // Attachments
      // $this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $this->mail->CharSet = 'UTF-8';

      // Content
      $this->mail->isHTML(true);                                  // Set email format to HTML
      $this->mail->Subject = $subject;
      $this->mail->Body    = $message;
      // $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
      $this->mail->send();

      return true;

    } catch (Exception $e) {
        if (DEBUG) {
          echo '<b>Não foi possível enviar o e-mail:<b/> <br><br>' . $this->mail->ErrorInfo . '<br><br>';
        }
    }
  
  }

}