<?php

// <!-- sshiivutmqwmsbgd password code -->
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libs/email_ver/PHPMailer-master/src/Exception.php';
require '../libs/email_ver/PHPMailer-master/src/PHPMailer.php';
require '../libs/email_ver/PHPMailer-master/src/SMTP.php';
require '../libs/email_ver/PHPMailer-master/src/class.smtp.php';

//https://world.siteground.com/kb/gmail-smtp-server/
$sender_uname = "rms.websample@gmail.com";
$sender_pword = "yfjgkcjsxfljawee";
$sender_display_name = "Research Management Services";

if (!isset($_POST['email_recepient']) || !isset($_POST['subject']) || !isset($_POST['message'])) {
    return;
}

$recipient = $_POST['email_recepient'];
$subject = $_POST['subject'];
$message = $_POST['message'];

try {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->CharSet = 'UTF-8';
    $mail->SMTPAuth = true;
    $mail->Username = $sender_uname;
    $mail->Password = $sender_pword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    $mail->setFrom($sender_uname, $sender_display_name);
    $mail->addAddress($recipient, "");

    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = $message;

    $status = false;
    if ($mail->Send()) {
        $status = true;
    } 
    echo json_encode(array("status" => $status));
} catch (Exception $e) {
    echo json_encode(array("status" => false));
}
?>