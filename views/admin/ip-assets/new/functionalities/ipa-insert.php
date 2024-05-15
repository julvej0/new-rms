<?php
include_once("../../../account-management/functionalities/user-session.php");
if (isset($_POST['submitIPA'])) {
    $date_of_creation = $_POST['date_of_creation'] != '' ? $_POST['date_of_creation'] : "2001-01-01";

    $date_registered = $_POST['date_registered'] != '' ? $_POST['date_registered'] : "2001-01-01";

    $registration_number = $_POST['registration_number'] != '' ? trim($_POST['registration_number']) : strval(time()); //timestamp
    $title_of_work = trim($_POST['title_of_work']);
    $type_of_document = $_POST['type_of_ipa'];
    $class_of_work = $_POST['class_of_work'];
    $campus = $_POST['campus'];
    $college = trim($_POST['college']);
    $program = $_POST['program'];
    $hyperlink = trim($_POST['hyperlink']);
    $status = $_POST['registerInfo'];

    $authors_name = isset($_POST['author_name']) ? $_POST['author_name'] : null;
    
    if (!$authors_name) {
        $authors_name = "";
        $authors_string = "";
    } else {
        $author_ids = array();

        foreach ($authors_name as $name) {
            $url = 'http://localhost:5000/table_authors';
            $response = @file_get_contents($url);

            if ($response !== false) {
                $data = json_decode($response, true);

                if (isset($data['table_authors'])) {
                    $authorIdColumn = array_column($data['table_authors'], 'author_id');
                    $authorNameColumn = array_column($data['table_authors'], 'author_name');

                    $authorMapping = array_combine($authorIdColumn, $authorNameColumn);

                    foreach ($authorMapping as $author_id => $author_name) {
                        if ($author_name == $name) {
                            $author_ids[] = $author_id;
                        }
                    }
                }
            }
        }

        $authors_string = implode(",", $author_ids);
    }

    if (isset($_FILES["ip-certificate"]) && $_FILES["ip-certificate"]["error"] == 0) {
        $target_dir = "../uploads/";
        $certificate_file = $target_dir . $registration_number . "_certificate.png";
        $file_name = $registration_number . "_certificate.png";
        
        if (file_exists($certificate_file)) {
            echo "
            <script>
            alert('Sorry, file already exists.');
            window.history.back();
            </script>";
        } else {
            $allowed_types = array('image/png', 'image/jpg', 'image/jpeg');
            $file_type = $_FILES["ip-certificate"]["type"];
            
            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($_FILES["ip-certificate"]["tmp_name"], $certificate_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["ip-certificate"]["name"])) . " has been uploaded.";

                    $postData = array(
                        'registration_number' => $registration_number,
                        'title_of_work' => $title_of_work,
                        'type_of_document' => $type_of_document,
                        'class_of_work' => $class_of_work,
                        'date_of_creation' => $date_of_creation,
                        'date_registered' => $date_registered,
                        'campus' => $campus,
                        'college' => $college,
                        'program' => $program,
                        'authors' => $authors_string,
                        'hyperlink' => $hyperlink,
                        'status' => $status,
                        'certificate' => $file_name
                    );
                    $jsonData = json_encode($postData);
                    
                    $ch = curl_init('http://localhost:5000/table_ipassets');
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    
                    $response = curl_exec($ch);
                    if (str_contains($response, 'error') || strpos($response, '"table_ipassets"') == false) {
                        header("Location: ../../ip-assets.php?upload=failed");
                    } else {
                        $logurl = 'http://localhost:5000/table_log';

                        $response_id = @file_get_contents($logurl);

                        if ($response_id !== false) {
                            $data = json_decode($response_id, true);

                            $logs = $data['table_log'];

                            usort($logs, function ($a, $b) {
                                return strcmp($a['log_id'], $b['log_id']);
                            });

                            $lastLog = end($logs);

                            $last_id = $lastLog['log_id'];

                            $numericPart = intval(substr($last_id, 3));

                            $nextNumericID = $numericPart + 1;

                            $paddedNumericID = str_pad($nextNumericID, 6, '0', STR_PAD_LEFT);

                            $log_id = 'AL' . $paddedNumericID;

                            echo $log_id;
                        }

                        $date_time = date('Y-m-d H:i:s.uO');
                        $uid = intval($user_id);
                        $activity = 'Upload IP-Assets';
                        $description = 'Uploaded Registration no. "' . $registration_number . '" titled "' . $title_of_work . '" by "' . $authors_string . '".';

                        $ipasset_log = array(
                            'log_id' => $log_id,
                            'date_time' => $date_time,
                            'user_id' => $uid,
                            'activity' => $activity,
                            'description' => $description
                        );

                        $jsonData = json_encode($ipasset_log);

                        $ch = curl_init('http://localhost:5000/table_log');
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                        $response = curl_exec($ch);

                        if (!str_contains($response, 'error')) {
                            echo "Insert successful.";
                            header("Location: ../../ip-assets.php?upload=success");
                        } else {
                            echo "Insert unsuccessful.";
                            header("Location: ../../ip-assets.php?upload=failedd");
                        }
                    }

                    curl_close($ch);
                } else {
                    header("Location: ../../ip-assets.php?upload=failed");
                }
            } else {
                header("Location: ../../ip-assets.php?upload=failed");
            }
        }
    } else {
        $postData = array(
            'registration_number' => $registration_number,
            'title_of_work' => $title_of_work,
            'type_of_document' => $type_of_document,
            'class_of_work' => $class_of_work,
            'date_of_creation' => $date_of_creation,
            'date_registered' => $date_registered,
            'campus' => $campus,
            'college' => $college,
            'program' => $program,
            'authors' => $authors_string,
            'hyperlink' => $hyperlink,
            'status' => $status
        );

        $jsonData = json_encode($postData);

        $ch = curl_init('http://localhost:5000/table_ipassets');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        if (str_contains($response, 'error') || strpos($response, '"table_ipassets"') == false) {
            header("Location: ../../ip-assets.php?upload=failed");
        } else {
            $logurl = 'http://localhost:5000/table_log';

            $response_id = @file_get_contents($logurl);

            if ($response_id !== false) {
                $data = json_decode($response_id, true);

                $logs = $data['table_log'];

                usort($logs, function ($a, $b) {
                    return strcmp($a['log_id'], $b['log_id']);
                });

                $lastLog = end($logs);

                $last_id = $lastLog['log_id'];

                $numericPart = intval(substr($last_id, 3));

                $nextNumericID = $numericPart + 1;

                $paddedNumericID = str_pad($nextNumericID, 6, '0', STR_PAD_LEFT);

                $log_id = 'AL' . $paddedNumericID;

                echo $log_id;
            }

            $date_time = date('Y-m-d H:i:s.uO');
            $uid = intval($user_id);
            $activity = 'Upload IP-Assets';
            $description = 'Uploaded Registration no. "' . $registration_number . '" titled "' . $title_of_work . '" by "' . $authors_string . '".';

            $ipasset_log = array(
                'log_id' => $log_id,
                'date_time' => $date_time,
                'user_id' => $uid,
                'activity' => $activity,
                'description' => $description
            );

            $jsonData = json_encode($ipasset_log);

            $ch = curl_init('http://localhost:5000/table_log');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (!str_contains($response, 'error')) {
                echo "Insert successful.";
                header("Location: ../../ip-assets.php?upload=success");
            } else {
                echo "Insert unsuccessful.";
                header("Location: ../../ip-assets.php?upload=failedd");
            }
        }

        curl_close($ch);
    }
} else {
    header("Location: ../../ip-assets.php?upload=failed");
}
?>