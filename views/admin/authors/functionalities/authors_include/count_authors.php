<?php
    function countAuthors($conn){
        $search_query = isset($_GET['search']) ? $_GET['search'] : '';
        $gender_filter = isset($_GET['gender']) ? $_GET['gender'] : null;
        $role_filter = isset($_GET['role']) ? $_GET['role'] : null;

        $count_sql = "SELECT COUNT(*) FROM table_authors WHERE author_name ILIKE '%$search_query%'";
        if ($gender_filter !== null) {
            $count_sql .= " AND gender = '$gender_filter' ";
        }
        if ($role_filter !== null) {
            $count_sql .= " AND type_of_author = '$role_filter' ";
        }
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