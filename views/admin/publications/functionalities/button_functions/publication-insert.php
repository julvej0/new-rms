<?php
include_once ("../../../account-management/functionalities/user-session.php");
//TODO: add some description/tooltip to fields like author describing how they work.
//that you can just type an author's name to add it to the database
if (isset ($_POST['submitPB'])) {
    $date_published = $_POST["date_published"];
    $date_published = isset ($_POST['date_published']) ? $_POST['date_published'] : null;
    $status = "";
    if (!$date_published) {
        $date_published = null;
        $status = "not-registered";
    } else {
        $date_published = $_POST["date_published"];
        $status = "registered";
    }
    $if_funded = isset ($_POST['funding_type']) ? $_POST['funding_type'] : null;
    if (!$if_funded) {
        $if_funded = "";
    } else {
        $if_funded = $_POST["funding_type"];
    }
    $sdg = $_POST["sdg_no"];
    $sdg_no = isset ($_POST['sdg_no']) ? $_POST['sdg_no'] : null;
    if (!$sdg_no) {
        $sdg_no = null;
    } else {
        $sdg_no = $_POST["sdg_no"];
        $sdg_string = implode(", ", $sdg);
    }
    $quartile_sem = $_POST["quartile"];
    $quartile_year = $_POST["quartile_year"];
    $department = $_POST["research_area"];
    $college = $_POST["college"];
    $campus = $_POST["campus"];
    $title = $_POST["title_of_paper"];
    $type = $_POST["type_of_publication"];
    $url = $_POST["google_scholar_details"];
    $funding_nature = $_POST["nature_of_funding"];
    $publisher = $_POST["publisher"];
    $abstract = $_POST["abstract"];

    $authors_name = isset ($_POST['author_name']) ? $_POST['author_name'] : null;

    if (!$authors_name) {
        $authors_name = "";
        $authors_string = "";
    } else {
        $author_ids = array();

        foreach ($authors_name as $name) {

            $url = 'http://localhost:5000/table_authors';
            $response = file_get_contents($url);

            if ($response !== false) {
                $data = json_decode($response, true);

                if (isset ($data['table_authors'])) {
                    $authorIdColumn = array_column($data['table_authors'], 'author_id');
                    $authorNameColumn = array_column($data['table_authors'], 'author_name');

                    $authorMapping = array_combine($authorIdColumn, $authorNameColumn);

                    foreach ($authorMapping as $author_id => $author_name) {
                        if ($author_name == $name) { // Check if author_name matches the desired name
                            $author_ids[] = $author_id;
                        }
                    }
                }
            }
        }

        $authors_string = implode(",", $author_ids);
    }

    $quartileJoin = array();
    foreach ($quartile_sem as $index => $value) {
        $quartileJoin[] = $value . '_' . $quartile_year[$index];
    }
    $quartile = implode(", ", $quartileJoin);

    if ($if_funded == "internal") {
        $if_external = "BatState-U Research Fund";
    } else {
        $if_external = isset ($_POST['funding_source']) ? $_POST['funding_source'] : null;
        if (!$if_external) {
            $if_external = "";
        } else {
            $if_external = $_POST["funding_source"];
        }
    }

    $publicationurl = 'http://localhost:5000/table_publications';

    $response_pubid = @file_get_contents($publicationurl);

    if ($response_pubid !== false) {
        $data = json_decode($response_pubid, true);

        $publications = $data['table_publications'];

        usort($publications, function ($a, $b) {
            return strcmp($a['publication_id'], $b['publication_id']);
        });

        $lastPublication = end($publications);

        $last_id = $lastPublication['publication_id'];

        $numericPart = intval(substr($last_id, 3));

        $nextNumericID = $numericPart + 1;

        $paddedNumericID = str_pad($nextNumericID, 6, '0', STR_PAD_LEFT);

        $publication_id = 'PID' . $paddedNumericID;

        echo $publication_id;
    } else {
        $publication_id = 'PID000001';
    }

    $publication_data = array(
        'publication_id' => $publication_id,
        'date_published' => $date_published,
        'quartile' => $quartile,
        'authors' => $authors_string,
        'department' => $department,
        'college' => $college,
        'campus' => $campus,
        'title_of_paper' => $title,
        'type_of_publication' => $type,
        'funding_source' => $if_external,
        'google_scholar_details' => $url,
        'sdg_no' => $sdg_string,
        'funding_type' => $if_funded,
        'nature_of_funding' => $funding_nature,
        'publisher' => $publisher,
        'status' => $status,
        'abstract' => $abstract,
        'number_of_citation' => 0,
    );

    $jsonData = json_encode($publication_data);
    $ch = curl_init('http://localhost:5000/table_publications');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    if (str_contains($response, 'error')) {
        header("Location: ../../publications.php?upload=failed");
    } else {
        $logurl = 'http://localhost:5000/table_log';

        $response_id = file_get_contents($logurl);

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
        $activity = 'Upload Publication';
        $description = 'Uploaded Publication ID "' . $publication_id . '" titled "' . $title . '" by "' . $authors_string . '".';

        $publication_log = array(
            'log_id' => $log_id,
            'date_time' => $date_time,
            'user_id' => $uid,
            'activity' => $activity,
            'description' => $description
        );

        $jsonData = json_encode($publication_log);

        $ch = curl_init('http://localhost:5000/table_log');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response_logpost = curl_exec($ch);

        echo "Insert successful.";
        header("Location: ../../publications.php?upload=success");
    }

    curl_close($ch);
} else {
    header("Location: ../../publications.php?upload=failed");
}
?>