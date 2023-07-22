<?php

// <!-- sshiivutmqwmsbgd password code -->
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libs/email_ver/PHPMailer-master/src/Exception.php';
require '../libs/email_ver/PHPMailer-master/src/PHPMailer.php';
require '../libs/email_ver/PHPMailer-master/src/SMTP.php';
require '../libs/email_ver/PHPMailer-master/src/class.smtp.php';

//https://world.siteground.com/kb/gmail-smtp-server/
$sender_uname = "manalor2018@gmail.com";
$sender_pword = "guuqorljmiphvdyj";
$sender_display_name = "Research Management Services";

if (!isset($_POST['arguments'])) {
    return;
}
echo "<script>console.log('inside send-mail');</script>";

$recipient = $_POST['arguments'][0];
$subject = $_POST['arguments'][1];
$message = $_POST['arguments'][2];

try {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2;
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
    // $content = $message;
    $mail->Body = $message;
    $mail->AltBody = $message;

    // $mail->MsgHTML($content);
    if (!$mail->Send()) {
        echo "<script>console.log('Error while sending Email.');</script>";
        throw new ErrorException("Message sending failed", 0, 5);
    } else {
        echo "<script>console.log('Email sent successfully');</script>";
        return true;
    }
} catch (Exception $e) {
    echo "<script>console.log('phpMailer err: " . $e . "');</script>"; //Boring error messages sender_uname anything else!
}
?>