<?php

if (!isset($_POST['password'])) {
    return;
}

echo json_encode(array("hashed_password" => password_hash($_POST['password'], PASSWORD_DEFAULT)));
?>