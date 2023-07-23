<?php
if (!isset($_POST['user_email']) || !isset($_POST['account_type']) || !isset($_POST['user_name'])) {
    return;
}

session_start();
$_SESSION['user_email'] = $_POST['user_email'];
$_SESSION['account_type'] = $_POST['account_type'];
$_SESSION['user_name'] = $_POST['user_name'];

echo json_encode(array("status" => "success"));
?>