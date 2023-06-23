

// Open modal popup
function openModal() {
    document.getElementById('myModal').style.display = 'block';
}

// Close modal popup
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

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
  var excelData = XLSX.write(workbook,  { bookType: 'xlsx', type: 'binary' });

  // Convert a string to an ArrayBuffer
  function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i < s.length; i++) {
      view[i] = s.charCodeAt(i) & 0xFF;
    }
    return buf;
  }
  // Generate unique filename with timestamp
  var timestamp = new Date().getTime();
  var filename = "ipassets_" + timestamp + ".xlsx";
  // Trigger download
  var blob = new Blob([s2ab(excelData)], { type: "application/octet-stream" });
  saveAs(blob, filename);
}
      

