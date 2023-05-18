<?php
include_once '../../../../../db/db.php';
if (isset($_POST['updateIPA'])) {
    $date_of_creation = $_POST["date_of_creation"];
    $date_of_creation = isset($_POST['date_of_creation']) ? $_POST['date_of_creation'] : null;
    if (!$date_of_creation) {
        $date_of_creation = null;
    }else{
        $date_of_creation = $_POST["date_of_creation"];
    }
    $date_registered = $_POST['date_registered'];
    $date_registered = isset($_POST['date_registered']) ? $_POST['date_registered'] : null;
    if (!$date_registered) {
        $date_registered = null;
    }else{
        $date_registered = $_POST["date_registered"];
    }

    $authors = isset($_POST['author_name']) ? $_POST['author_name'] : null;
    if (!$authors) {
        $authors = "";
        $authors_string = ""; // join the array values with a comma delimiter
    }else{
        $author_name = $_POST["author_name"];

        $select_query = "SELECT author_id FROM table_authors WHERE author_name = $1 ";
        $select_stmt = pg_prepare($conn, "select_author_details", $select_query);
        
        $author_ids = array(); // Define the array outside the loop
        
        foreach ($author_name as $name) {
            $auth_name = pg_escape_string($conn, $name);
            $sql = "INSERT INTO table_authors (author_name)
                    SELECT '$name'
                    WHERE NOT EXISTS (SELECT 1 FROM table_authors WHERE author_name = '$name')";
            pg_query($conn, $sql);
        
            $select_result = pg_execute($conn, "select_author_details", array($name));
        
            while ($row = pg_fetch_assoc($select_result)) {
                $author_ids[] = $row['author_id'];
            }
        }
        
        $authors_string = implode(",", $author_ids);
    }

    $registration_number = $_POST['registration_number'];
    $title_of_work = $_POST['title_of_work'];
    $type_of_document = $_POST['type_of_ipa'];
    $class_of_work = $_POST['class_of_work'];
    $campus = $_POST['campus'];
    $college = $_POST['college'];
    $program = $_POST['program'];
    $hyperlink = $_POST['hyperlink'];
    $status = $_POST['registerInfo'];
    $cert = $_FILES['ip-certificate'];

    $target_dir = "uploads/";
    $certificate_file = $target_dir . $registration_number . "_certificate.png";

        // Check if file was uploaded without errors
        if (isset($_FILES["ip-certificate"]) && $_FILES["ip-certificate"]["error"] == 0) {            
            // Check if file already exists
            if (file_exists($certificate_file)) {
                    if (unlink($certificate_file)) { // delete the file
                        $allowed_types = array('image/png', 'image/jpg', 'image/jpeg');
                        $file_type = $_FILES["ip-certificate"]["type"];
                        if (in_array($file_type, $allowed_types)) {
                                    // Upload file to server
                            if (move_uploaded_file($_FILES["ip-certificate"]["tmp_name"], $certificate_file)) {
                                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?update=applied");
                            }
                        }
                    } else {
                        echo "Error deleting file";
                    }
                    
            } else {
                    // Check if uploaded file is a PNG or JPG
                        $allowed_types = array('image/png', 'image/jpg', 'image/jpeg');
                        $file_type = $_FILES["ip-certificate"]["type"];
                        if (in_array($file_type, $allowed_types)) {
                                    // Upload file to server
                            if (move_uploaded_file($_FILES["ip-certificate"]["tmp_name"], $certificate_file)) {
                                echo "The file ". htmlspecialchars(basename($_FILES["ip-certificate"]["name"])) . " has been uploaded.";
    
                            // Create SQL UPDATE statement
                            $update_query = "UPDATE table_ipassets SET title_of_work=$1, type_of_document=$2, class_of_work=$3, date_of_creation=$4, date_registered=$5, campus=$6, college=$7, program=$8, authors=$9, hyperlink=$10, status=$11, certificate=$12 WHERE registration_number=$13";

                            // Prepare the SQL statement
                            $update_stmt = pg_prepare($conn, "update_ipa_details", $update_query);

                            // Execute the prepared statement with the input values
                            $update_result = pg_execute($conn, "update_ipa_details", array($title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink, $status, $certificate_file, $registration_number));

                            if (!$update_result) {
                                die("Error in SQL query: " . pg_last_error());
                            }

                            // Check if the update was successful
                            if (pg_affected_rows($update_result) > 0) {
                                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?update=applied");
                            } else {
                                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?update=!update");
                            }
    
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        } else {
                            echo "
                            <script>
                            alert('Error: Only PNG and JPG files are allowed.');
                            window.history.back();
                            </script>";
                        }
            }
        } else {
            $update_query = "UPDATE table_ipassets SET title_of_work=$1, type_of_document=$2, class_of_work=$3, date_of_creation=$4, date_registered=$5, campus=$6, college=$7, program=$8, authors=$9, hyperlink=$10, status=$11 WHERE registration_number=$12";
            $update_stmt = pg_prepare($conn, "update_ipa_details", $update_query);
            $update_result = pg_execute($conn, "update_ipa_details", array($title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink, $status, $registration_number));

            if (!$update_result) {
                die("Error in SQL query: " . pg_last_error());
            }
            if (pg_affected_rows($update_result) > 0) {
                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?update=applied");
            } else {
                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?update=failed");
            }
        }
} else {
    header("Location: ../../../../../views/admin/ip-assets/ip-assets.php");
}

?>
