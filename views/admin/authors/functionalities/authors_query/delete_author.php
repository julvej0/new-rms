<?php
include_once dirname(__FILE__, 6) . '/helpers/db.php'; //db connection
include_once dirname(__FILE__, 5) . '/helpers/utils/utils-user.php';
include_once dirname(__FILE__, 5) . '/helpers/utils/utils-author.php';
include_once dirname(__FILE__, 5) . '/helpers/utils/utils-ipasset.php';
include_once dirname(__FILE__, 5) . '/helpers/utils/utils-publication.php';

//determine if id parameter is existing
// throw new Exception('haha');
if (isset ($_POST['id'])) {
    $id = $_POST['id'];//initialize
    //check if the author was removed from publication and ipasset

    if (updateIpassetsByAuthor($ipassetsurl, $id) == "Task Completed" && updatePublicationsByAuthor($publicationurl, $id) == "Task Completed") {
        //deleting the author
        $delete_result = deleteAuthorById($authorurl, $id);

        if ($delete_result) {
            echo "Success";
            exit();
        } else {
            echo "Error";
            exit();
        }
    } else {
        echo "Error";
        exit();

    }
} else {
    header("Location: ../../authors.php"); //if id does not exists
}

//updating the account type after removal
function updateAccountType($userurl, $authorurl, $id)
{
    $author_email = getAuthorById($authorurl, $id);
    $update_result = updateUser($userurl, "email", $author_email['email'], ['account_type' => "Regular"]);

    return "Task Completed";
    // if ($update_result === 'successful') {
    // } else {
    //     return "Not Updated";
    // }

}



?>