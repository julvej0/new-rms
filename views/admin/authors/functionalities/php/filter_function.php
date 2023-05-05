<?php
function filterAuthor($url_search, $url_role, $url_gender){

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


    if($url_search!='empty_search'){
        $params = array_merge($search_params, ['search' => $url_search]);
    }
    if($url_role!='empty_role'){
        $params = array_merge($search_params, ['role' => $url_role]);
    }
    if($url_gender!='empty_gender'){
        $params = array_merge($search_params, ['gender' => $url_gender]);
    }

   
    
    return $link = '?' . http_build_query($params);

}





?>