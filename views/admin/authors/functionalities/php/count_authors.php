<?php
    function countAuthors($conn){
        $search_query = isset($_GET['search']) ? $_GET['search'] : '';
        $count_sql = "SELECT COUNT(*) FROM table_authors WHERE author_name ILIKE '%$search_query%'";
        $count_result = pg_query($conn, $count_sql);
        $total_items = pg_fetch_result($count_result, 0, 0);

        if (isset($_GET['search'])){
            return "Author Count for \"".$_GET['search']."\" : ".$total_items;

        }
        else{
            return "Author Count : ".$total_items;
        }
    }
?>