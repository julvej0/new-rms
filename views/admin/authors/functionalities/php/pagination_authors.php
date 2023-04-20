<tr>
    <?php
        $count_sql = "SELECT COUNT(*) FROM table_authors WHERE author_name ILIKE '%$search_query%'";
        $count_result = pg_query($conn, $count_sql);
        $total_items = pg_fetch_result($count_result, 0, 0);

        $total_pages = ceil($total_items / $items_per_page);

        $prev = $page_number - 1;
        $next = $page_number + 1;
        ?>
    <td colspan="6" >
        <div class="pagination">
            <?php if ($total_pages > 1) {
                $link = "";
                if (isset($_GET['search'])){
                    $link = "?search=".$_GET['search']."&page=";
                }else{
                    $link = "?page=";
                }

                $max_pages_to_show = 1000; // maximum number of pages to show in the pagination
                $start_page = max(1, $page_number - (int)($max_pages_to_show / 2));
                $end_page = min($start_page + $max_pages_to_show - 1, $total_pages); ?>
                
                <div class="pagination-controls">
                    <a href="<?php echo $link.($start_page); ?>" class="prev-btn" <?php echo ($page_number==1 ? "style='pointer-events: none; background-color: gray;'" : "style='background-color: #EF1F3B;'"); ?>><i class="fa fa-angle-double-left"></i> FIRST</a>

                    <a href="<?php echo $link.($page_number-1); ?>" class="prev-btn" <?php echo ($page_number==1 ? "style='pointer-events: none; background-color: gray;'" : "style='background-color: #EF1F3B;'"); ?>><i class="fa fa-angle-left"></i> Previous</a>
                    <?php if ($total_pages > 1) { ?>
                        <div class="page-num"><span class="current-page"><?php echo $page_number; ?></span></div>
                    <?php } ?>
                    <a href="<?php echo $link.($page_number+1); ?>" class="next-btn" <?php echo ($page_number==$total_pages ? "style='pointer-events: none; background-color: gray;'" : "style='background-color: #EF1F3B;'"); ?>>Next <i class="fa fa-angle-right"></i></a>

                    <a href="<?php echo $link.($end_page); ?>" class="next-btn" <?php echo ($page_number==$total_pages ? "style='pointer-events: none; background-color: gray;'" : "style='background-color: #EF1F3B;'"); ?>>LAST <i class="fa fa-angle-double-right"></i></a>
                </div>
                
            <?php } ?>
        </div>
    </td>
</tr>