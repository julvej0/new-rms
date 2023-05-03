<title>RMS | IP ASSETS</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../db/db.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./ip-assets.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> <!--Font Awesome CDN-->

<body>
    <?php
        include '../../../includes/admin/templates/navbar.php';
    ?>

    <main>
        <div class="header">
            <h1 class="title">IP-assets</h1>
            <div class="left">
                <form action='' method='get'>
                    <div class="form-group">
                        <input type='text' placeholder="Search" name='search' value='<?php $search_query?>' placeholder="Search..." >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <a href="./new-ip-asset.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New Article</a>
            </div>
        </div>
        <section>
            <div class="table-container">
                <?php
                    include_once 'functionalities/ipa_include/ipa_table.php';
                ?>
            </div>
            <div class="table-footer">
                <?php
                    include_once 'functionalities/ipa_include/ipa_count.php';
                ?>

                <p><?=countIPA($conn)?></p>
                <div class="download">
                    <button onclick="openModal()" class="download-btn">Download</button>
                </div>
                <div class="pagination">
                    <?php
                        include_once 'functionalities/ipa_include/pagination.php';
                    ?>
                </div>
            </div>
    </main>
    </section>
        <!-- Modal Popup -->
     <div id="myModal" class="modal">
        <div class="modal-content1">
        <span class="close" onclick="closeModal()">&times;</span>
        <iframe src="functionalities/download/download_ip-assets.php"></iframe>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="./ip-assets.js"></script>
<script src="functionalities/download//download_button.js"></script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>