<?php
include_once '../../../../../db/db.php';
if (isset($_POST['submitIPA'])) {
    // Retrieve the value of 'date_of_creation' from the POST data
    $date_of_creation = isset($_POST['date_of_creation']) ? $_POST['date_of_creation'] : null;

    // Check if 'date_of_creation' is empty or not provided in the POST data
    if (!$date_of_creation) {
        // If it's empty or not provided, set it to null
        $date_of_creation = null;
    } else {
        // Otherwise, assign the value of 'date_of_creation' from the POST data
        $date_of_creation = $_POST["date_of_creation"];
    }

    // Retrieve the value of 'date_registered' from the POST data
    $date_registered = isset($_POST['date_registered']) ? $_POST['date_registered'] : null;

    // Check if 'date_registered' is empty or not provided in the POST data
    if (!$date_registered) {
        // If it's empty or not provided, set it to null
        $date_registered = null;
    } else {
        // Otherwise, assign the value of 'date_registered' from the POST data
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
    
    // Retrieve the value of 'author_name' from the POST data
    $authors_name = isset($_POST['author_name']) ? $_POST['author_name'] : null;

    // Check if 'author_name' is empty or not provided in the POST data
    if (!$authors_name) {
        // If it's empty or not provided, set variables to empty strings
        $authors_name = "";
        $authors_string = "";
    } else {
        // Prepare the SELECT query to retrieve author IDs based on author names
        $select_query = "SELECT author_id FROM table_authors WHERE author_name = $1";
        $select_stmt = pg_prepare($conn, "select_author_details", $select_query);

        $author_ids = array(); // Define the array outside the loop

        // Iterate through each author name in the array
        foreach ($authors_name as $name) {
            // Escape the author name for safe database query
            $auth_name = pg_escape_string($conn, $name);

            if (!empty($auth_name)) { // Check if the name is not empty
                // Check if the author name already exists in the table_authors
                // If not, insert it into the table
                $sql = "INSERT INTO table_authors (author_name)
                        SELECT '$auth_name'
                        WHERE NOT EXISTS (SELECT 1 FROM table_authors WHERE author_name = '$auth_name')";
                pg_query($conn, $sql);

                // Execute the SELECT query to retrieve the author ID
                $select_result = pg_execute($conn, "select_author_details", array($auth_name));

                // Retrieve the author IDs and add them to the author_ids array
                while ($row = pg_fetch_assoc($select_result)) {
                    $author_ids[] = $row['author_id'];
                }
            }
        }

        // Join the author IDs with a comma delimiter
        $authors_string = implode(",", $author_ids);
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
        
                    // Prepare and execute the INSERT query to add IPA details to the database
                    $insert_query = "INSERT INTO table_ipassets (registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, hyperlink, status, certificate) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)";
                    $insert_stmt = pg_prepare($conn, "insert_ipa_details", $insert_query);
                    $insert_result = pg_execute($conn, "insert_ipa_details", array($registration_number, $title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink, $status, $certificate_file));
        
                    if ($insert_result) {
                        echo "Insert successful.";
                        header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?upload=success");
                    } else {
                        header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?upload=failed");
                    }
                } else {
                    header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?upload=failed");
                }
            } else {
                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?upload=failed");
            }
        }        
    } else {
        $insert_query = "INSERT INTO table_ipassets (registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, hyperlink, status) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)";
                            $insert_stmt = pg_prepare($conn, "insert_ipa_details", $insert_query);
                            $insert_result = pg_execute($conn, "insert_ipa_details", array($registration_number, $title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink, $status));

                            if ($insert_result) {
                                echo "Insert successful.";
                                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?upload=success");
                            } else {
                                header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?upload=failed");
                            }

    }
    
} else {
    header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?upload=failed");
}   
?>