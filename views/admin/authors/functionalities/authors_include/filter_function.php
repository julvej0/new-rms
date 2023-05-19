<?php

function filterAuthor($search, $role, $gender ){

    $params=[];
    // Get the existing search parameters from the URL
    $search_params = $_GET;

    unset($search_params['page']);
    if (isset($_GET['add'])){
        unset($search_params['add']);
    }

    if (isset($_GET['update'])){
        unset($search_params['update']);
    }

    if (isset($_GET['delete'])){
        unset($search_params['delete']);
    }

    if($search!='empty_search'){
        array_push($params, 'search='.$search);
    }
    if($role!='empty_role'){
        array_push($params, 'role='.$role);
    }
    if($gender!='empty_gender'){
        array_push($params, 'gender='.$gender);
    }
    return $link = '?' . implode('&', $params);

}










?>