<?php
include dirname(__FILE__, 6) . '/helpers/db.php';
require_once ('../download/ipa-get-info-download.php');

$search_query = (isset($_GET['search']) && strpos($_GET['search'], "'") === false) ? $_GET['search'] : 'empty_search';
$type = (isset($_GET['type']) && strpos($_GET['type'], "'") === false) ? $_GET['type'] : 'empty_type';
$class = (isset($_GET['class']) && strpos($_GET['class'], "'") === false) ? $_GET['class'] : 'empty_class';
$year = (isset($_GET['year']) && strpos($_GET['year'], "'") === false) ? $_GET['year'] : 'empty_year';


include_once dirname(__FILE__, 6) . '\helpers\db.php';
$table_rows = get_data($ipassetsurl, $authorurl, $search_query, $type, $class, $year);
?>

<!-- <link rel="stylesheet" href="../../ip-assets.css"> -->
<link rel="stylesheet" href="../download/download_button.css">
<link rel="stylesheet" href="../../../../../css/index.css">

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://kit.fontawesome.com/02052a094f.js" crossorigin="anonymous"></script>

<!-- download as excel -->
<script src="https://unpkg.com/xlsx@0.15.6/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<section>
    <div class="header" id="dl-modal-container">
        <div class="dl-buttons">
            <button onclick="downloadExcelFile()" class="btn">
                <i class="fa-solid fa-file-excel fa-lg" style="color: green;" aria-hidden="true"></i>
            </button>
        </div>
        <div class="left">
            <form action='' method='get'>
                <div class="form-group">
                    <input type='text' placeholder="Search" name='search' value='<?php $search_query ?>'
                        placeholder="Search...">
                    <i class='bx bx-search search-icon'></i>
                </div>
            </form>
        </div>
    </div>
    <table id="tbl_download_ip-assets">
        <thead class="sticky-header">
            <tr>
                <th class="col-registration">Registration Number</th>
                <th class="col-title" style="min-width: 350px;">Title</th>
                <th class="col-type">Type</th>
                <th class="col-cow">Class of Work</th>
                <th class="col-date-cre">Date of Creation</th>
                <th class="col-date-reg">Date Registered</th>
                <th class="col-campus">Campus</th>
                <th class="col-college">College</th>
                <th class="col-program">Program</th>
                <th class="col-authors">Authors</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_records = count($table_rows);

            if ($table_rows !== null) {
                foreach ($table_rows as $row) {
                    echo '<tr>
                            <td class="reg-num-col col-registration">' . $row['registration_number'] . '</td>
                            <td class="title-col col-title">' . $row['title_of_work'] . '</td>
                            <td class="type-col col-type">' . ($row['type_of_document'] != null ? $row['type_of_document'] : "N/A") . '</td>
                            <td class="cow-col col-cow">' . $row['class_of_work'] . '</td>
                            <td class="tbl-col">' . ($row['date_of_creation'] != null ? $row['date_of_creation'] : "N/A") . '</td>
                            <td class="date-reg-col col-date-reg">' . $row['date_registered'] . '</td>
                            <td class="campus-col col-campus">' . ($row['campus'] != null ? $row['campus'] : "N/A") . '</td>
                            <td class="college-col col-college">' . ($row['college'] != null ? $row['college'] : "N/A") . '</td>
                            <td class="program-col col-program">' . ($row['program'] != null ? $row['program'] : "N/A") . '</td>
                            <td class="authors-col col-authors">' . ($row['authors'] != null ? $row['authors'] : "N/A") . '</td>
                        </tr>';
                }
            } else {
                echo '<tr>
                        <td colspan="10" style="text-align:center">No Records Found!</td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
</section>
<script src="./download_button.js"></script>


<?php
include dirname(__FILE__, 6) . '/components/footer/footer.php';
?>