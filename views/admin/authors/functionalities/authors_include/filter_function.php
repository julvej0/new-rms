<?php

//generating url for filter base on search, role, and gender
function filterAuthor($search, $role, $gender ){

    $params=[];//initialization

    // Get the existing search parameters from the URL
    $search_params = $_GET;

    unset($search_params['page']); //remove the 'page' params from get

    //remove param if exists
    if (isset($_GET['add'])){
        unset($search_params['add']);
    }

    if (isset($_GET['update'])){
        unset($search_params['update']);
    }

    if (isset($_GET['delete'])){
        unset($search_params['delete']);
    }

    //check if each param exists
    if($search!='empty_search'){
        array_push($params, 'search='.$search); //add param 
    }
    if($role!='empty_role'){
        array_push($params, 'role='.$role); //add param 
    }
    if($gender!='empty_gender'){
        array_push($params, 'gender='.$gender); //add param 
    }
    return $link = '?' . implode('&', $params); //generate and return url

}










?>