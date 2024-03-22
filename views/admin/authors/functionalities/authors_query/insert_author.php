<?php
include dirname(__FILE__, 6) . '/helpers/db.php';
include_once dirname(__FILE__, 5) . "/helpers/utils/utils-author.php";
include_once dirname(__FILE__, 5) . "/helpers/utils/utils-user.php";

//check if every data needed exists
if (isset ($_POST['a-name'], $_POST['a-gender'], $_POST['a-role'], $_POST['a-email'])) {
    //initialize

    $author_name = $_POST['a-name'];
    $gender = $_POST['a-gender'] != "" ? $_POST['a-gender'] : null;
    $email = $_POST['a-email'] != "" ? $_POST['a-email'] : null;
    $types = $_POST['a-role'] != "" ? $_POST['a-role'] : null;

    //combining the affiliation for updating
    if (isset ($_POST['a-aff-dept']) && isset ($_POST['a-aff-prog']) && isset ($_POST['a-aff-camp'])) {
        //initialize
        $department_affiliations = $_POST['a-aff-dept'];
        $program_affiliations = $_POST['a-aff-prog'];
        $campus_affiliations = $_POST['a-aff-camp'];
        $internal_affiliations = [];

        //combine each internal into a string
        for ($i = 0; $i < count($campus_affiliations); $i++) {
            $internal_affiliations[] = $department_affiliations[$i] . ", " . $program_affiliations[$i] . ", " . $campus_affiliations[$i];
        }
        $arrayInternal = implode('_ ', $internal_affiliations); //turn array to string

    } else {
        $arrayInternal = ''; //if no internal affiliation exists
    }

    //check for external affiliation input
    if (isset ($_POST['a-ex-aff'])) {
        $external_affiliations = $_POST['a-ex-aff']; //initialize
        //check content
        if (is_array($external_affiliations)) {
            $arrayExternal = implode('_ ', $external_affiliations);
        } else {
            $arrayExternal = $external_affiliations;
        }

    } else {
        $arrayExternal = ''; //if external affiliation input does not exists
    }

    if ($arrayInternal != '' || $arrayExternal != '') {
        $arrayCombined = array($arrayInternal, $arrayExternal); //combine internal and external                                                                                                                                                                                                                                 
        $affiliation = implode(' || ', $arrayCombined); //turn to string for updating
    } else {
        $affiliation = null; //if no affilition inputs
    }
    $response = @file_get_contents($authorurl);
    $json_response = json_decode($response, true);

    if ($json_response != false) {
        $author_count = count($json_response['table_authors']);
    }
    //update query
    $insert_result = createAuthor($authorurl, $author_name, $gender, $types, $affiliation, $email);
    if (strpos($insert_result, 'success') !== false) {
        //update user type
        $user_data = getUserByEmail($userurl, $email);
        if($user_data['account_type'] == "Admin"){
            $update_result = updateUser($userurl, "email", $email, ["account_type" => "Author"]);
            if (strpos($update_result, 'success') !== false) {
                header("Location: ../../authors.php?add=success");
                exit();
            } else if (strpos($update_result, 'No user') !== false) {
                header("Location: ../../authors.php?add=update-failed");
                exit();
            }else{
                header("Location: ../../authors.php?add=failed");
                exit();
            }

        }
        header("Location: ../../authors.php?add=success");
        exit();

    } else {
        header("Location: ../../authors.php?add=failed");
        exit();
    }



} else {
    header("Location: ../../authors.php");
    exit();
}



?>