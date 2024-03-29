<?php
include_once '../../../../../helpers/db.php'; //db connection
include_once dirname(__FILE__, 5) . '/helpers/utils/utils-user.php';
include_once dirname(__FILE__, 5) . '/helpers/utils/utils-author.php';
include_once dirname(__FILE__, 6) . '/helpers/db.php';

//check if every data needed exists
if (isset ($_POST['a-name'], $_POST['a-gender'], $_POST['a-role'], $_POST['a-id'], $_POST['a-email'])) {
    //initialize
    $author_name = $_POST['a-name'];
    $id = $_POST['a-id'];
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
    //update query
    $author_data = array(
        'author_name' => $author_name,
        'gender' => $gender,
        'type_of_author' => $types,
        'affiliation' => $affiliation == null ? '' : $affiliation,
        'email' => $email,
    );
    $update_result = updateAuthorById($authorurl, $id, $author_data);

    if ($update_result == "successful") {
        //update user type 
        $user = getUserByEmail($userurl, $email);
        if ($user['account_type'] != 'Admin') {

            $update_type_result = updateUser($userurl, "email", $email, array("account_type" => "Author"));
            // $update_account_type = updateAccountType($authorurl, $userurl, $email);
        }

        header("Location: ../../authors.php?search=" . $author_name . "&update=success");
        exit();

    } else {
        header("Location: ../../authors.php?search=" . $author_name . "&update=failed");
        exit();
    }

} else {
    header("Location: ../../authors.php");
    exit();
}

//updating the accout type
// function updateAccountType($authorurl, $userurl, $email)
// {
//     $update_result = "";
//     $author_emails = getAuthors($authorurl);
//     $emails = array_column($author_emails, 'email');
//     $user = getUserByEmail($userurl, $email);
//     if (!in_array($email, $emails) && $user['account_type'] != "Admin") {
//         $update_result = updateUser($userurl, "email", $email, array('account_type' => 'Regular'));
//     }
//     if ($update_result != "") {
//         return true;
//     } else {
//         return false;
//     }

// }
?>