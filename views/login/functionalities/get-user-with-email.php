<?php
include_once dirname(__FILE__, 4) . "/helpers/db.php";

if (!isset($_POST['user_email'])) {
    return;
}

$fetch_query = "SELECT * FROM table_users WHERE email = $1";
$fetch_result = pg_query_params($conn, $fetch_query, array($_POST['user_email']));
if (!$fetch_result) {
    echo ("userWithEmailQueryFailed err: " . pg_last_error($conn));
    exit;
}

$user = null;
if (pg_num_rows($fetch_result) > 0) {
    $user = pg_fetch_assoc($fetch_result);
}

echo json_encode(array("user" => $user));
?>