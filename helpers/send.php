<?php

// <!-- sshiivutmqwmsbgd password code -->
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libs/email_ver/PHPMailer-master/src/Exception.php';
require '../libs/email_ver/PHPMailer-master/src/PHPMailer.php';
require '../libs/email_ver/PHPMailer-master/src/SMTP.php';
require '../libs/email_ver/PHPMailer-master/src/class.smtp.php';

echo "<script>console.log(send.php);</script>";
function send_mail($recipient, $subject, $message){
    //https://world.siteground.com/kb/gmail-smtp-server/
    try{
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "rms.websample@gmail.com";
        $mail->Password   = "sshiivutmqwmsbgd";
        $mail->From = "rms.websample@gmail.com";
        $mail->FromName ="Research Management Services";

        $mail->IsHTML(true);
        $mail->AddAddress($recipient, "");
        $mail->SetFrom("rms.websample@gmail.com", "Research Management Services");
        $mail->Subject = $subject;
        $content = $message;
        $mail->Body = $message;

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
        echo "<script>console.log('phpMailer self err: " . $e . "');</script>"; //Pretty error messages from PHPMailer
    } catch (Exception $e) {
        echo "<script>console.log('phpMailer err: " . $e . "');</script>"; //Boring error messages from anything else!
    }
}

?>