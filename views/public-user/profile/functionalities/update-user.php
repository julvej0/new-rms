<?php
include_once dirname(__FILE__, 5) . "/helpers/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $field = $_POST['field'];
  // $value = $field === 'user_contact' ? $_POST['value'] : $_POST['value']; //?
  // print_r("this is value ", $field);
  $value = $_POST['value'];
  $srCode = $_POST['sr_code'];

  // validate the new value
  if ($field === 'user_contact' && !ctype_digit($value)) {
    echo "Please enter a valid phone number.";
    exit;
  }

  // update the user record in the database
  require_once dirname(__FILE__, 4) . "/helpers/utils/utils-user.php";

  $userId = getUserIdBySrCode($userurl, $srCode);

  $httpCode = updateUserImageById($userurl, $userId, $value, $field);

  if ($httpCode === 200) {
    echo "successful";
    exit();
  } else {
    echo "User update failed. Error: " . $response;
    exit();
  }

}
?>