<?php
function filterPublication($search, $type, $fund, $year){

    $params=[];//initialize 


    // Get the existing search parameters from the URL
    $search_params = $_GET;

    unset($search_params['page']); //remove page parameter

    //remove other parameter from GET    
    if (isset($_GET['add'])){
        unset($search_params['add']); //unset parameter
    }

    if (isset($_GET['update'])){
        unset($search_params['update']); //unset parameter
    }

    if (isset($_GET['delete'])){
        unset($search_params['delete']); //unset parameter
    }

    //check if user searched
    if($search!='empty_search'){
        array_push($params, 'search='.$search);
    }

    //check if filter parameters
    if($type!='empty_type'){
        array_push($params, 'type='.$type);
    }
    if($fund!='empty_fund'){
        array_push($params, 'fund='.$fund);
    }
    if($year!='empty_year'){
        array_push($params, 'year='.$year);
    }

    return $link = '?' . implode('&', $params); //return generated url

}
