<?php
function sortLink($search, $sort, $dateStart, $dateEnd, $campuses){
    $params=[];

    $search_params = $_GET;

    unset($search_params['page']);

    if($search!='empty_search'){
        array_push($params, 'search-table='.$search);
    }
    
    if($sort!='empty_sort'){
        array_push($params, 'sort='.$sort);
    }

    if($dateStart!='empty_dStart'){
        array_push($params, 'date-start='.$dateStart);
    }

    if($dateEnd!='empty_dEnd'){
        array_push($params, 'date-end='.$dateEnd);
    }

    if($campuses!='empty_campus'){
        foreach ($campuses as $campus){
            array_push($params, 'select-campus='.$campus);
        }

        
    }

    return $link = '?' . implode('&', $params);

}
?>