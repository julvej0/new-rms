
<?php
    //display base on search
    $count_text = $search != "empty_search" ? "Total Authors for \"". $search. "\" : " : "Total Authors :";
?>
<div class="table-footer">
    
    <p><?=$total_records ? $count_text.' '.$total_records : $count_text.' 0' ?></p>
   
    <div class="pagination">
        <?php
            //items per page = 10
            $total_pages = ceil($total_records / $items_per_page);

            //diplay pagination control if result consists 2 or more pages
            if ($total_pages > 1) {
                $params=[];
                // Get the existing search parameters from the URL
                $search_params = $_GET;

                unset($search_params['page']); // remove page param if exist

                //generate pagination link base on search and filters
                if($search!='empty_search'){
                    unset($search_params['search']);
                    $params = array_merge($search_params, ['search' => $search]);
                }
                if($gender!='empty_gender'){
                    unset($search_params['type']);
                    $params = array_merge($search_params, ['gender' => $gender]);
                }
                if($role!='empty_role'){
                    unset($search_params['class']);
                    $params = array_merge($search_params, ['role' => $role]);
                }


                //append page param to url base on searh and param 
                if(isset($_GET['search']) || isset($_GET['gender']) || isset($_GET['role'])){
                    $url_page ='&page=';
                }else{
                    $url_page ='page=';
                }

                $link = '?' . http_build_query($params).$url_page; //generate link for pagination control

                $max_pages_to_show = 1000; // maximum number of pages to show in the pagination
                $start_page = max(1, $page_number - (int)($max_pages_to_show / 2)); //starting page
                $end_page = min($start_page + $max_pages_to_show - 1, $total_pages); //ending page
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
</div>

