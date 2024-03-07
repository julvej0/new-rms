<?php
include_once '../../../../helpers/db.php';
// Check if file was uploaded without errors
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
    $target_dir = "../uploads/";
    $user_email = $_POST['email'];
    $user_img_name = $target_dir . $user_email . "_userimage.png";

    // Check if file already exists
    // if (file_exists($user_img_name)) {
    //     unlink($user_img_name);
    // }

    require_once dirname(__FILE__, 4) . "/helpers/utils.php";

    // Check if uploaded file is a PNG or JPG
    $allowed_types = array('image/png', 'image/jpg', 'image/jpeg');
    $file_type = $_FILES["file"]["type"];
    if (in_array($file_type, $allowed_types)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $user_img_name)) {
            echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
            $userId = getUserIdByEmail($userurl, $user_email);
            $httpCode = updateUserImageById($userurl, $userId, substr($user_img_name, 1), "user_img");
            if ($httpCode === 200) {
                // Update the user's image URL in the $user array
                $user['user_img'] = $user_img_name;
                echo "Insert successful.";
            } else {
                echo "Insert failed.";
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Error: Only PNG and JPG files are allowed.";
    }
} else {
    echo "Error: " . $_FILES["file"]["error"];
}

?>