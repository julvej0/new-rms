<?php

// <!-- sshiivutmqwmsbgd password code -->
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libs/email_ver/PHPMailer-master/src/Exception.php';
require '../libs/email_ver/PHPMailer-master/src/PHPMailer.php';
require '../libs/email_ver/PHPMailer-master/src/SMTP.php';

echo "send.php";
function send_mail($recipient,$subject,$message){

    $mail = new PHPMailer(true);
    try{
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
            echo "Error while sending Email.";
            //echo "<pre>";
            //var_dump($mail);
            return false;
        } else {
            echo "Email sent successfully";
            return true;
        }
    }catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
    }
}

?>