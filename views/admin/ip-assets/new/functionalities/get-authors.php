<?php 

$authors = isset($_POST['author']) ? $_POST['author'] : "";

if($authors != ""){
    echo json_encode($authors);
}else{
    echo json_encode("");
}