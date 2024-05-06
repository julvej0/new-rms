<?php
require_once dirname(__FILE__, 5) . "/helpers/utils/utils-author.php";
require_once dirname(__FILE__, 6) . "/helpers/db.php";
$author = isset($_POST['author']) ? $_POST['author'] : "";

if($author != ""){
    $message = createAuthor($authorurl, $author, "", "", "", "");
    echo json_encode(['message' => $message, 'author' => $author]);
}else{
    echo json_encode("");
}