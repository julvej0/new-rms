<?php
    require_once('functionalities/publication-get-info.php');

    $additionalQuery= authorSearch($conn);
    $table_rows = get_data($conn, $additionalQuery);
?>

<table>
    <thead>
        <tr>
            <th class="col-title" style="min-width: 350px;">Title</th>
            <th class="col-type">Type</th>
            <th class="col-publisher" style="min-width: 190px;">Publisher</th>
            <th class="col-research-area">Research Area</th>
            <th class="col-college">College</th>
            <th class="col-quartile">Quartile</th>
            <th class="col-campus">Campus</th>
            <th class="col-sdg">SDG's</th>
            <th class="col-date-published">Date Published</th>
            <th class="col-authors" style="min-width: 190px;">Authors</th>
            <th class="col-funding">Funding</th>
            <th class="col-fund-type">Fund Type</th>
            <th class="col-fund-agency">Fund Source</th>
            <th class="col-citations">Citations</th>
            <th class="col-status">Status</th>
            <th class='stickey-col-header' style="background-color: var(--grey);">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php
            //Search Query
            $search_query = isset($_GET['search']) ? $_GET['search'] : '';
            $no_of_records_per_page = 10;
            // Get total number of records
            $result_count = pg_query($conn, "SELECT COUNT(*) FROM table_publications WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher, status) ILIKE '%$search_query%';");
            $total_records = pg_fetch_result($result_count, 0, 0);
            $total_pages = ceil($total_records / $no_of_records_per_page);
        
        if ($table_rows !== null) {
        foreach ($table_rows as $row) {
        ?>
        <tr>
            <td class="publication-col col-title" style="min-width: 15.625rem"><?=$row['title_of_paper'];?></td>
            <td class="publication-col col-type"><?=$row['type_of_publication'];?></td>
            <td class="publication-col col-publisher"><?=$row['publisher'];?></td>
            <td class="publication-col col-research-area"><?=$row['department'];?></td>
            <td class="publication-col col-college"><?=$row['college'];?></td>
            <td class="publication-col col-quartile"><?=$row['quartile'];?></td>
            <td class="publication-col col-campus"><?=$row['campus'];?></td>
            <td class="publication-col col-sdg"><?=$row['sdg_no'];?></td>
            <td class="publication-col col-date-published"><?=$row['date_published'];?></td>
            <td class="publication-col col-authors"><?=$row['authors'];?></td>  
            <td class="publication-col col-funding"><?=$row['nature_of_funding'];?></td>
            <td class="publication-col col-fund-type"><?=$row['funding_type'];?></td>
            <td class="publication-col col-fund-agency"><?=$row['funding_source'];?></td>
            <td class="publication-col col-citations"><?=$row['number_of_citation'];?></td>
            <td class="publication-col col-status"><?=$row['status'];?></td>
            <td class='pb-action-btns stickey-col'>
            <!-- Open certificate in a new tab-->
                <a href="<?=$row['google_scholar_details'];?>" target="_blank" class="gdrive-btn">
                        <i class="fa-solid fa-arrow-up-right-from-square icon"></i>
                </a>
                <form action="edit-publication.php" method="POST">
                    <input type="hidden" name="row_id" value="<?=$row['publication_id']?>">
                    <button type="submit" class="edit-btn" name="edit"><i class="fa-solid fa-pen-to-square icon"></i></button>
                </form>
                <form action="functionalities/button_functions/publication-delete.php" method="POST" class="delete-form">
                    <input type="hidden" name="row_id" value="<?=$row['publication_id']?>">
                    <button type="submit" class="delete-btn" name="delete"><i class="fa-solid fa-trash-can icon"></i></button>
                </form>                            
            </td>
    </tr>
    <?php
    }
}else{
    ?>
    <tr>
        <td colspan='15' style="text-align:center">No Records Found!</td>
    </tr>
<?php
}
?>
    </tbody>
</table>