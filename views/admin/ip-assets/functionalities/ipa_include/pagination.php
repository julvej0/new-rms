<?php if ($total_pages > 1) {
    $current_page = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
    $max_pages_to_show = 1000; // maximum number of pages to show in the pagination
    $start_page = max(1, $current_page - (int)($max_pages_to_show / 2));
    $end_page = min($start_page + $max_pages_to_show - 1, $total_pages); ?>
    
    <li>
        <a href="?pageno=<?php echo ($start_page); ?>" class="prev-btn" <?php echo ($current_page==1 ? "style='pointer-events: none; cursor: ' not-allowed;'" : ""); ?>><i class='bx bx-chevrons-left icon'></i></a>
    </li>
    <li>
        <a href="?pageno=<?php echo ($current_page-1); ?>" class="prev-btn" <?php echo ($current_page==1 ? "style='pointer-events: none;'" : ""); ?>><i class='bx bx-chevron-left icon'></i></a>
    </li>
    <li>
        <?php if ($total_pages > 1) { ?>
            <div class="page-num"><span class="current-page"><?php echo $current_page; ?></span></div>
        <?php } ?>
    </li>
    <li>
        <a href="?pageno=<?php echo ($current_page+1); ?>" class="next-btn" <?php echo ($current_page==$total_pages ? "style='pointer-events: none;'" : ""); ?>><i class='bx bx-chevron-right icon' ></i></a>
    </li>
    <li>
        <a href="?pageno=<?php echo ($end_page); ?>" class="next-btn" <?php echo ($current_page==$total_pages ? "style='pointer-events: none;'" : ""); ?>><i class='bx bxs-chevrons-right icon' ></i></a>
    </li>                   
<?php
    }
?>