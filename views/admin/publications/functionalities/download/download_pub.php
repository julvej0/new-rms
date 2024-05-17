<?php 
    include '../../../../../helpers/db.php';
    $search = (isset($_GET['search']) && strpos($_GET['search'], "'") === false )? $_GET['search']: 'empty_search';
    $type = isset($_GET['type']) ? $_GET['type'] : 'empty_type';
    $fund = isset($_GET['fund']) ? $_GET['fund'] : 'empty_fund';
    $year = isset($_GET['year']) ? $_GET['year'] : 'empty_year';
?>
<link rel="stylesheet" href="../../../../../css/index.css">
<link rel="stylesheet" href="../../functionalities/download/download_pub.css">

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://kit.fontawesome.com/02052a094f.js" crossorigin="anonymous"></script>

<!-- download as excel -->
<script src="https://unpkg.com/xlsx@0.15.6/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<body>
    <main id="dl-modal-container">
        <section>
            <div class="header">
                <div class="dl-buttons">
                    <button onclick="downloadExcelFile()" class="btn">
                        <i class="fa-solid fa-file-excel fa-lg" style="color: green"></i>
                    </button>
                </div>
                <div class="left">
                    <form action='' method='get'>
                        <div class="form-group">
                            <input type='text' name='search' value='<?php echo $search == 'empty_search' ? '' : $search?>' placeholder="Search...">
                            <i class='bx bx-search icon'></i>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="table-container"> -->
            <?php
                    include_once '../download/publication_table_download.php';
                ?>
            <!-- </div> -->
        </section>
    </main>
    </section>
    <link rel="stylesheet" href="../../../css/sweetalert2.min.css">
    <script src="../download/download_pub.js"></script>
</body>