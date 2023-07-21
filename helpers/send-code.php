<?php
session_start(); // start the session
include_once realpath(dirname(__FILE__) . '/..') . "/helpers/send.php";
// echo "<script>console.log(send-code.php);</script>";

echo "<script>console.log('textVal: " . $_POST['textValue'] . "');</script>";
if (isset($_POST['textValue'])) {
    $email = $_POST['textValue'];

    // generate a random verification code and store it in a session variable
    $verification_code = rand(100000, 999999); // change this to generate a code of desired length
    $_SESSION['verification_code'] = $verification_code;
    echo "<script>console.log('verCode: " . $verification_code . "');</script>";

    // send the verification code to the user's email
    $recipient = $email;
    $subject = "VERIFICATION CODE";
    $message = "This is your verification code: ".$verification_code;
    echo "Email sent to " . $recipient;
    send_mail($recipient, $subject, $message);
}else{
    echo "email sending failed";
}
?>