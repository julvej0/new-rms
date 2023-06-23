<?php 
include_once '../../../../db/db.php';
// Check if file was uploaded without errors
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
    $target_dir = "../../../../../new-rms-webdev/views/admin/account-management/uploads/";
    $user_email = $_POST['email'];
    $user_img_name = $target_dir . $user_email . "_userimage.png";
    
    // Check if file already exists
    if (file_exists($user_img_name)) {
        // Query the database to retrieve the current user_img value
        $select_query = "SELECT user_img FROM table_user WHERE email = $1";
        $select_stmt = pg_prepare($conn, "select_user_image", $select_query);
        $select_result = pg_execute($conn, "select_user_image", array($user_email));
        
        if ($select_result && $row = pg_fetch_assoc($select_result)) {
            // Delete the current user image file from the server
            unlink($row['user_img']);
        }
    }
    
    // Check if uploaded file is a PNG or JPG
    $allowed_types = array('image/png', 'image/jpg', 'image/jpeg');
    $file_type = $_FILES["file"]["type"];
    if (in_array($file_type, $allowed_types)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $user_img_name)) {
            echo "The file ". htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";

            $insert_query = "UPDATE table_user SET user_img = $1 WHERE email = $2";
            $insert_stmt = pg_prepare($conn, "insert_user_image", $insert_query);
            $insert_result = pg_execute($conn, "insert_user_image", array($user_img_name, $user_email));

            if ($insert_result) {
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
