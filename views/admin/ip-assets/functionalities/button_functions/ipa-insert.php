<?php
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
        $date_registered = "";
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
    $authors = $_POST['author_id']; 
    $author_name = $_POST['author_name'];
    
    $authors_string = implode(",", $authors); // join the array values with a comma delimiter


    $insert_query = "INSERT INTO table_authors (author_name) VALUES ($1)";
    $insert_stmt = pg_prepare($conn, "insert_author", $insert_query);
    
    foreach ($author_name as $name) {
        $insert_result = pg_execute($conn, "insert_author", array($name));
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