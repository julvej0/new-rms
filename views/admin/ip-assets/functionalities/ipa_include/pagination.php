
<div class="table-footer">
    <p><?=countIPA($conn, $additionalQuery)?></p>
    <div class="download">
                    <button onclick="openModal()" class="download-btn">Download</button>
                </div>
    <div class="pagination">
        <?php
            $search_query = isset($_GET['search']) ? $_GET['search'] : '';
            $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;


            $count_sql = "SELECT COUNT(*)
                            FROM (
                                SELECT * 
                                FROM table_ipassets 
                                WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors, status, certificate) ILIKE '%$search_query%' ";

            if ($additionalQuery !== null) {
            $count_sql .= $additionalQuery;
            }

            $count_sql .= " )AS searched_ipa WHERE 1=1 ";

            if ($type !== "empty_type") {
            $count_sql .= " AND searched_ipa.type_of_document = '$type' ";
            }
            if ($class !== "empty_class") {
            $count_sql .= " AND searched_ipa.class_of_work = '$class' ";
            }
            if ($year !== "empty_year") {
            $count_sql .= " AND EXTRACT(YEAR FROM searched_ipa.date_registered) = '$year' ";
            }
             
            $items_per_page = 10;
            $count_result = pg_query($conn, $count_sql);
            $total_items = pg_fetch_result($count_result, 0, 0);

            $total_pages = ceil($total_items / $items_per_page);

            if ($total_pages > 1) {

                $params=[];
                // Get the existing search parameters from the URL
                $search_params = $_GET;

                unset($search_params['page']);
                if($search!='empty_search'){
                    unset($search_params['search']);
                    $params = array_merge($search_params, ['search' => $search]);
                }
                if($type!='empty_type'){
                    unset($search_params['type']);
                    $params = array_merge($search_params, ['type' => $type]);
                }
                if($class!='empty_class'){
                    unset($search_params['class']);
                    $params = array_merge($search_params, ['class' => $class]);
                }
                if($year!='empty_year'){
                    unset($search_params['year']);
                    $params = array_merge($search_params, ['year' => $year]);
                }
        
                if(isset($_GET['search']) || isset($_GET['type']) || isset($_GET['class']) || isset($_GET['year'])){
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