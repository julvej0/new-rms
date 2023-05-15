<?php
    function countUserAccounts($conn){
        $count_sql = "SELECT COUNT(*) FROM table_user";
        $count_result = pg_query($conn, $count_sql);
        $total_items = pg_fetch_result($count_result, 0, 0);

        return $total_items;
    }
?>