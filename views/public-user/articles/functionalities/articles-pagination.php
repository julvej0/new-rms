<?php
    $total_records = countPublications($conn, authorSearch($conn, $search_query), $search_query, $campus_query, $dateStart_query, $dateEnd_query );
    $count_text = $search_query != "empty_search" ? "Total Publications for \"". $search_query. "\" : " : "Total Publications :";
?>

<div class="total-articles">
    <p><?=$count_text.' '.$total_records?></p>
</div>
<div class="pagination">
    

    <?php
        $items_per_page = 10;
        $total_pages = ceil($total_records / $items_per_page);

        

        if ($total_pages > 1) {

            $params=[];
            // Get the existing search parameters from the URL
            $search_params = $_GET;

            unset($search_params['page']);

            if($search_query!='empty_search'){
               $params = array_merge($search_params, ['search-table' => $search]);
                
            }
            if($sort_query!='empty_sort'){
                $params = array_merge($search_params, ['sort' => $sort_query]);
                
            }
            if($campus_query!='empty_campus'){
                if(is_array($campus_query)){
                    foreach ($campus_query as $campus){
                        $params = array_merge($search_params, ['select-campus' => $campus]);
                    }

                }

                else{
                    $params = array_merge($search_params, ['select-campus' => $campus_query]);
                }
                
            }
            if($dateStart_query!='empty_dStart'){
                $params = array_merge($search_params, ['date-start' => $dateStart_query]);
            }
            if($dateEnd_query!='empty_dEnd'){
                $params = array_merge($search_params, ['date-end' => $dateEnd_query]);
            }
        
        
            if(isset($_GET['search-table']) || isset($_GET['sort']) || isset($_GET['select-campus']) || isset($_GET['sort']) || isset($_GET['date-start']) || isset($_GET['date-end'])){
                $url_page ='&page=';
            }else{
                $url_page ='page=';
            }
            
            $link = '?' . http_build_query($params).$url_page;
            $max_pages_to_show = 1000; // maximum number of pages to show in the pagination
            $start_page = max(1, $page_number - (int)($max_pages_to_show / 2));
            $end_page = min($start_page + $max_pages_to_show - 1, $total_pages); 
    ?>
    <li>
        <a href="<?php echo $link.(1);?>" <?php echo ($page_number==1 ? "style='pointer-events: none;'" : ""); ?>><i class='bx bx-chevrons-left icon' ></i></a>
    </li>
    <li>
        <a href="<?php echo $link.($page_number-1); ?>" <?php echo ($page_number==1 ? "style='pointer-events: none;'" : ""); ?>><i class='bx bx-chevron-left icon' ></i></a>
    </li>
    <li>
        <span class="current-page"><?=$page_number?></span>
    </li>
    <li>
        <a href="<?php echo $link.($page_number+1); ?>" <?php echo ($page_number==$total_pages ? "style='pointer-events: none;'" : ""); ?>><i class='bx bx-chevron-right icon' ></i></a>
    </li>
    <li>
        <a href="<?php echo $link.($end_page); ?>" <?php echo ($page_number==$total_pages ? "style='pointer-events: none; '" : ""); ?>><i class='bx bx-chevrons-right icon' ></i></a>
    </li>
    <?php } ?>
</div>  