<?php

if (!isset($_POST['user_password']) || !isset($_POST['user_hashed_password'])) {
    return;
}

$isPasswordValid = password_verify($_POST['user_password'], $_POST['user_hashed_password']);
echo json_encode(array("password_valid" => $isPasswordValid));
?>