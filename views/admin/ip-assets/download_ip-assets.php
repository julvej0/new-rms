

<?php 
    include '../../../db/db.php';
    require_once('functionalities/ipa-get-info-download.php');
    $additionalQuery= authorSearch($conn);
    $table_rows = get_data($conn, $additionalQuery);
?>

<link rel="stylesheet" href="./ip-assets.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
<script src="package/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>

<!--download as PDF package -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.9.3/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<!-- download as excel -->
<script src="https://unpkg.com/xlsx@0.15.6/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<!-- download as Word document -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
/* CSS styles for the button */
  .btn {
    display: inline-block;
    padding: 10px;
    border: none;
    cursor: pointer;
    background-color: #ffff;
}
.btn img {
    width: 40px;
    height: 40px;
    margin-right: 5px;
    vertical-align: middle;
    background-color: #ffff;
}
</style>

<body>

    <main>
    <button onclick="downloadExcelFile()" class="btn" style="cursor: pointer;">Excel</button>
    <button onclick="downloadTableAsPDF()" class="btn" style="cursor: pointer;">PDF</button>
    <button onclick="exportTableToWord()" class="btn" style="cursor: pointer;">Word</button>
    <form action='' method='get'>
        <div class="form-group">
            <input type='text' placeholder="Search" name='search' value='<?php $search_query?>' placeholder="Search..." >
            <i class='bx bx-search icon' ></i>
        </div>
    </form>
    <section>
                <table id="mytable">
                    <thead>
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

                         $search_query = isset($_GET['search']) ? $_GET['search'] : '';
                       $result_count = pg_query($conn, "SELECT * FROM table_ipassets WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors) ILIKE '%$search_query%'".$additionalQuery.";");
                       $total_records = pg_fetch_result($result_count, 0, 0);
                       
                       
                       if ($table_rows !== null) {
                        foreach ($table_rows as $row) {
                    ?>
                    <tr>
                       
                        <td class="reg-num-col col-registration"><?=$row['registration_number'];?></td>
                        <td class="title-col col-title"><?=$row['title_of_work'];?></td>
                        <td class="type-col col-type"><?=$row['type_of_document'];?></td>
                        <td class="cow-col col-cow"><?=$row['class_of_work'];?></td>
                        <td class="tbl-col"><?=$row['date_of_creation'];?></td>
                        <td class="date-reg-col col-date-reg"><?=$row['date_registered'];?></td>
                        <td class="campus-col col-campus"><?=$row['campus'];?></td>
                        <td class="college-col col-college"><?=$row['college'];?></td>
                        <td class="program-col col-program"><?=$row['program'];?></td>
                        <td class="authors-col col-authors"><?=$row['authors'];?></td>

                    </tr>
                    <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan='10' style="text-align:center">No Records Found!</td>
                    </tr>
                <?php
                }
                ?>
                    </tbody>
            </table>
    </section>
    </main>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="./ip-assets.js"></script>
</body>
<script>
    // Function to download the excel file
    function downloadExcelFile() {
        // Get the table element by its ID
        var table = document.getElementById("mytable");

        // Convert the table to a worksheet object
        var worksheet = XLSX.utils.table_to_sheet(table);

        // Create a workbook object
        var workbook = XLSX.utils.book_new();

        // Add the worksheet to the workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

        // Convert the workbook to a binary string
        var excelData = XLSX.write(workbook, { bookType: 'xlsx', type: 'binary' });

        // Convert a string to an ArrayBuffer
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) {
                view[i] = s.charCodeAt(i) & 0xFF;
            }
            return buf;
        }

        // Trigger download
        var blob = new Blob([s2ab(excelData)], { type: "application/octet-stream" });
        saveAs(blob, "IPASSETS_list.xlsx");
    }

  // download as pdf
  function downloadTableAsPDF() {
            var table = document.getElementById('mytable');
            
            html2pdf()
                .from(table)
                .save('table_example.pdf');
        }

// download as word document
function exportTableToWord() {
  var table = document.getElementById('mytable');
  var html = table.outerHTML;

  // Set page orientation and size
  var style = "<style>@media print { @page { size: landscape; } }</style>";
  html = style + html;

  var blob = new Blob(['\ufeff', html], { type: 'application/vnd.ms-word;charset=utf-8' });
  var url = URL.createObjectURL(blob);
  var link = document.createElement('a');
  link.href = url;
  link.download = 'table.doc';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

</script>
<?php
    include '../../../includes/admin/templates/footer.php';
?>