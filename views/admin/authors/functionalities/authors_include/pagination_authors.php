
<div class="table-footer">
    <p><?=countAuthors($conn)?></p>
    <div class="pagination">
        <?php
             $count_sql = "SELECT COUNT(*) FROM table_authors WHERE author_name ILIKE '%$search_query%' ";
             $params = [];
             if ($gender_filter !== null) {
                 $count_sql .= " AND gender = '$gender_filter' ";
             }
             if ($role_filter !== null) {
                 $count_sql .= " AND type_of_author = '$role_filter' ";
             }

            $count_result = pg_query($conn, $count_sql);
            $total_items = pg_fetch_result($count_result, 0, 0);

            $total_pages = ceil($total_items / $items_per_page);

            $prev = $page_number - 1;
            $next = $page_number + 1;
            if ($total_pages > 1) {

                $url_search = isset($_GET['search']) ? $_GET['search']: '';
                $url_role = isset($_GET['role']) ? $_GET['role']: '';
                $url_gender = isset($_GET['gender']) ? $_GET['gender']: '';
                $url_page = isset($_GET['page']) ? $_GET['page']: 1;

                $params=[];
                // Get the existing search parameters from the URL
                $search_params = $_GET;

                unset($search_params['page']);
                if($url_search!=''){
                    unset($search_params['search']);
                    $params = array_merge($search_params, ['search' => $url_search]);
                }
                if($url_role!=''){
                    unset($search_params['role']);
                    $params = array_merge($search_params, ['role' => $url_role]);
                }
                if($url_gender!=''){
                    unset($search_params['gender']);
                    $params = array_merge($search_params, ['gender' => $url_gender]);
                }
        
                if(isset($_GET['search']) || isset($_GET['role']) || isset($_GET['gemder'])){
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
</div>
<!-- 
 -->