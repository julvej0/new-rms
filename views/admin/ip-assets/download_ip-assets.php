
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
        <div class="header">
            <div class="left">
                <form action="#">
                    <div class="form-group">
                        <input type="text" placeholder="Search...">
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
            </div>
        </div>
        <section>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Registration Number</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Class of Work</th>
                            <th>Date Registered</th>
                            <th>Campus</th>
                            <th>College</th>
                            <th>Programs</th>
                            <th>Authors</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td style="min-width: 320px;">The Design and Development of A's Glass and Aluminum Online Booking System</td>
                            <td>Type</td>
                            <td>ClassOfWork</td>
                            <td>January 1, 2023</td>
                            <td>Campus</td>
                            <td>College</td>
                            <td>Programs</td>
                            <td>Authors</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
        var table = document.getElementById("invoice");

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
        saveAs(blob, "author_list.xlsx");
    }

</script>
<?php
    include '../../../includes/admin/templates/footer.php';
?>