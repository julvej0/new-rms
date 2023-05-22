<?php
session_start();

if (isset($_SESSION['user_email'])) {
    echo "true";
}else {
    echo "false";
}
?>