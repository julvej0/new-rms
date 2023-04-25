
<div class="table-footer">
    <p><?=countAuthors($conn)?></p>
    <div class="pagination">
        <?php
            $count_sql = "SELECT COUNT(*) FROM table_authors WHERE author_name ILIKE '%$search_query%'";
            $count_result = pg_query($conn, $count_sql);
            $total_items = pg_fetch_result($count_result, 0, 0);

            $total_pages = ceil($total_items / $items_per_page);

            $prev = $page_number - 1;
            $next = $page_number + 1;
            if ($total_pages > 1) {
                $link = "";
                if (isset($_GET['search'])){
                    $link = "?search=".$_GET['search']."&page=";
                }else{
                    $link = "?page=";
                }

                $max_pages_to_show = 1000; // maximum number of pages to show in the pagination
                $start_page = max(1, $page_number - (int)($max_pages_to_show / 2));
                $end_page = min($start_page + $max_pages_to_show - 1, $total_pages); 
        ?>
        <li>
            <a href="<?php echo $link.(1);?>" <?php echo ($page_number==1 ? "style='pointer-events: none; background-color: #c5c5c5;'" : ""); ?>><i class='bx bx-chevrons-left icon' ></i></a>
        </li>
        <li>
            <a href="<?php echo $link.($page_number-1); ?>" <?php echo ($page_number==1 ? "style='pointer-events: none; background-color: #c5c5c5;'" : ""); ?>><i class='bx bx-chevron-left icon' ></i></a>
        </li>
        <li>
            <span class="current-page"><?=$page_number?></span>
        </li>
        <li>
            <a href="<?php echo $link.($page_number+1); ?>" <?php echo ($page_number==$total_pages ? "style='pointer-events: none; background-color: #c5c5c5;'" : ""); ?>><i class='bx bx-chevron-right icon' ></i></a>
        </li>
        <li>
            <a href="<?php echo $link.($end_page); ?>" <?php echo ($page_number==$total_pages ? "style='pointer-events: none; background-color: #c5c5c5;'" : ""); ?>><i class='bx bx-chevrons-right icon' ></i></a>
        </li>
        <?php } ?>
    </div>
</div>
    
            
    
    



