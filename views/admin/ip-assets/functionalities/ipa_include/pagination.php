
<?php
//TODO: make a shared folder with all the shared resources for admin and non-admin user pages
    //check if user searched, result is base on whether the user searched or not
    $count_text = $search != "empty_search" ? "Total Patented Docs for \"". $search. "\" : " : "Total Patented Docs :";
?>
<div class="table-footer">
    <p><?=$count_text.' '.$total_records?></p>
    <div class="download">
        <button onclick="openModal()" class="download-btn">Download</button>
    </div>
    
    <div class="pagination">
        <?php
            $items_per_page = 10; //total records per page
            $total_pages = ceil($total_records / $items_per_page); // total pages for paging
            
            //if result consists of more then one pages
            if ($total_pages > 1) {

                $params=[]; //initialize

                // Get the existing search parameters from the URL
                $search_params = $_GET;

                unset($search_params['page']); //remove page parameter

                //check if user searched
                if($search!='empty_search'){
                    unset($search_params['search']);
                    $params = array_merge($search_params, ['search' => $search]);
                }

                //check if user used filters
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
        
                //check if parameters exists
                if(isset($_GET['search']) || isset($_GET['type']) || isset($_GET['class']) || isset($_GET['year'])){
                    $url_page ='&page=';
                }else{
                    $url_page ='page=';
                }
                
                $link = '?' . http_build_query($params).$url_page; //generate url for pagination
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
