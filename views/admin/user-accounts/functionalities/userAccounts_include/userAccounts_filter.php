<?php

function filterUserAccounts($search, $type){

    $params=[];
    // Get the existing search parameters from the URL
    $search_params = $_GET;

    unset($search_params['page']);
    if($search!='empty_search'){
        array_push($params, 'search='.$search);
    }
    if($type!='empty_type'){
        array_push($params, 'type='.$type);
    }

    return $link = '?' . implode('&', $params);

}

?>