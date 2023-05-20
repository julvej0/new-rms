<?php
var_dump($_POST);

include_once '../../../../../db/db.php';
if (isset($_POST['submitIPA'])) {
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
    $registration_number = $_POST['registration_number'];    
    $title_of_work = $_POST['title_of_work'];
    $type_of_document = $_POST['type_of_ipa'];
    $class_of_work = $_POST['class_of_work'];
    $campus = $_POST['campus'];
    $college = $_POST['college'];
    $program = $_POST['program'];
    $hyperlink = $_POST['hyperlink'];
    $status = $_POST['registerInfo'];
    
    $authors_name = isset($_POST['author_name']) ? $_POST['author_name'] : null;
    if (!$authors_name) {
        $authors_name = "";
        $authors_string = "";
    } else {
        $select_query = "SELECT author_id FROM table_authors WHERE author_name = $1";
        $select_stmt = pg_prepare($conn, "select_author_details", $select_query);

        $author_ids = array(); // Define the array outside the loop

        foreach ($authors_name as $name) { // Change variable name from $author_name to $authors_name
            $auth_name = pg_escape_string($conn, $name);

            if (!empty($auth_name)) { // Check if the name is not empty
                $sql = "INSERT INTO table_authors (author_name)
                        SELECT '$auth_name'
                        WHERE NOT EXISTS (SELECT 1 FROM table_authors WHERE author_name = '$auth_name')";
                pg_query($conn, $sql);

                $select_result = pg_execute($conn, "select_author_details", array($auth_name));

                while ($row = pg_fetch_assoc($select_result)) {
                    $author_ids[] = $row['author_id'];
                }
            }
        }

        $authors_string = implode(",", $author_ids); // join the array values with a comma delimiter
    }

    
      
    
    // Check if file was uploaded without errors
    if (isset($_FILES["ip-certificate"]) && $_FILES["ip-certificate"]["error"] == 0) {
        $target_dir = "uploads/";
        $certificate_file = $target_dir . $registration_number . "_certificate.png";
        
        // Check if file already exists
        if (file_exists($certificate_file)) {
            echo "
            <script>
            alert('Sorry, file already exists.');
            window.history.back();
            </script>";
        } else {
                // Check if uploaded file is a PNG or JPG
                    $allowed_types = array('image/png', 'image/jpg', 'image/jpeg');
                    $file_type = $_FILES["ip-certificate"]["type"];
                    if (in_array($file_type, $allowed_types)) {
                                // Upload file to server
                        if (move_uploaded_file($_FILES["ip-certificate"]["tmp_name"], $certificate_file)) {
                            echo "The file ". htmlspecialchars(basename($_FILES["ip-certificate"]["name"])) . " has been uploaded.";

                            $insert_query = "INSERT INTO table_ipassets (registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, hyperlink, status, certificate) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)";
                            $insert_stmt = pg_prepare($conn, "insert_ipa_details", $insert_query);
                            $insert_result = pg_execute($conn, "insert_ipa_details", array($registration_number, $title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink, $status, $certificate_file));

                            if ($insert_result) {
                                echo "Insert successful.";
                                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?success");
                            } else {
                                echo "Insert failed.";
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
        $insert_query = "INSERT INTO table_ipassets (registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, hyperlink, status) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)";
                            $insert_stmt = pg_prepare($conn, "insert_ipa_details", $insert_query);
                            $insert_result = pg_execute($conn, "insert_ipa_details", array($registration_number, $title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink, $status));

                            if ($insert_result) {
                                echo "Insert successful.";
                                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?success");
                            } else {
                                echo "Insert failed.";
                            }

    }
    
} else {
    header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?failed");
}   
?>