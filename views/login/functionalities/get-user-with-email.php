<?php
include_once dirname(__FILE__, 4) . "/helpers/db.php";

if (!isset($_POST['user_email'])) {
    return;
}
$email = $_POST['user_email'];
$response = file_get_contents($userurl);

if ($response === false) {
    echo "An error occurred while fetching user data.";
    exit();
}

$user = null;
$userData = json_decode($response, true)['table_user'];
foreach ($userData as $users) {
    $userEmail = $users['email'];
    if ($userEmail === $email) {
        $user = $users;
    }
}

echo json_encode(array("user" => $user));


?>