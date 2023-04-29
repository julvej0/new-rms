

<?php

// <!-- sshiivutmqwmsbgd password code -->
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'email_ver/PHPMailer-master/src/Exception.php';
require 'email_ver/PHPMailer-master/src/PHPMailer.php';
require 'email_ver/PHPMailer-master/src/SMTP.php';

function send_mail($recipient,$subject,$message)
{

  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "rms.websample@gmail.com";
  $mail->Password   = "sshiivutmqwmsbgd";

  $mail->IsHTML(true);
  $mail->AddAddress($recipient,"");
  $mail->SetFrom("rms.websample@gmail.com", "Research Management Services");
  $mail->Subject = $subject;
  $content = $message;

  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
    //echo "Error while sending Email.";
    //echo "<pre>";
    //var_dump($mail);
    return false;
  } else {
    //echo "Email sent successfully";
    return true;
  }

}

?>