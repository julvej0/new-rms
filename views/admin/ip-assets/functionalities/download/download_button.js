

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
        var filename = "table_" + timestamp + ".xlsx";
        // Trigger download
        var blob = new Blob([s2ab(excelData)], { type: "application/octet-stream" });
        saveAs(blob, filename);
      }
      

// download as pdf
function downloadTableAsPDF() {
  var table = document.getElementById('mytable');
  
  // Set the page orientation to landscape
  var options = {
    filename: 'table_example.pdf',
    jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
  };

  // Clone the table element and add it to a new div element
  var clonedTable = table.cloneNode(true);
  var wrapperDiv = document.createElement('div');
  wrapperDiv.appendChild(clonedTable);
  
  // Set the CSS styles for the cloned table
  clonedTable.style.width = "100%";
  clonedTable.style.maxWidth = "none";
  clonedTable.style.transform = "rotate(270deg)";

  // Convert the cloned table to PDF using html2pdf
  html2pdf()
    .set(options)
    .from(wrapperDiv)
    .save();

  // Reset the CSS styles for the cloned table
  clonedTable.style.width = "";
  clonedTable.style.maxWidth = "";
  clonedTable.style.transform = "";
  }
  

//download as Word document
function exportTableToWord() {
  var table = document.getElementById('mytable');
  var html = table.outerHTML;
  
  // Set table style
  var tableStyle = "<style>table {border-collapse: collapse;} th, td {border: 1px solid black;}</style>";
  html = tableStyle + html;
  
  // Set page orientation and size
  var pageStyle = "<style>@page { size: landscape; }</style>";
  html = pageStyle + html;

  var data = new Blob([html], {
    type: 'text/html'
  });

  // Create URL and download link
  var url = window.URL.createObjectURL(data);
  var link = document.createElement('a');
  link.href = url;
  link.download = 'table.doc';
  document.body.appendChild(link);
  
  // Download file
  link.click();
  document.body.removeChild(link);
}

