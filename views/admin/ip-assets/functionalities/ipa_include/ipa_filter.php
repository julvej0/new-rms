<?php
function filterIPA($search, $type, $class, $year){

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
    if($type!='empty_type'){
        array_push($params, 'type='.$type);
    }
    if($class!='empty_class'){
        array_push($params, 'class='.$class);
    }
    if($year!='empty_year'){
        array_push($params, 'year='.$year);
    }

    return $link = '?' . implode('&', $params);

}





?>