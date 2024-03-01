// CANCEL MODAL
//Javascript code that doesn't required PHP specific functinality

const cancelBtn = document.querySelector(".cancel-btn");

// Add click event listener to the cancel button
cancelBtn.addEventListener("click", (e) => {
  e.preventDefault();

  // Show a confirmation dialog using Swal (SweetAlert) library
  Swal.fire({
    title: "Are you sure?",
    text: "You want to cancel?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes!",
  }).then((result) => {
    if (result.isConfirmed) {
      // If the user confirms, redirect to the specified URL
      window.location.href = "../ip-assets/ip-assets.php";
    }
  });
});

var inputElement = document.getElementById("reg_num");
var dataList = document.getElementById("regnums");
var errorMsg = document.getElementById("regnum-error");
var submit_button = document.getElementById("submitBTN");

// Add input event listener to the input element
inputElement.addEventListener("input", function () {
  var value = inputElement.value;
  var options = dataList.options;
  var exists = false;
  // Check if the input value exists in the data list options
  for (var i = 0; i < options.length; i++) {
    if (options[i].value === value) {
      exists = true;
      break;
    }
  }
  // If the input value exists, show error message and disable the submit button
  if (exists) {
    errorMsg.style.display = "inline";
    submit_button.disabled = true;
    submit_button.style.backgroundColor = "gray";
  } else {
    // If the input value doesn't exist, hide error message and enable the submit button
    errorMsg.style.display = "none";
    submit_button.disabled = false;
    submit_button.style.backgroundColor = "var(--blue)";
  }
});

// Check if certificate file type is valid
function checkFileType(fileInput) {
  const allowedExtensions = ["jpeg", "jpg", "png", "pdf"];
  const file = fileInput.files[0];
  const errorElement = document.getElementById("file-error");
  const certificateInput = document.getElementById("ip-certificate-input");
  if (file) {
    const fileName = file.name.toLowerCase();
    const fileExtension = fileName.split(".").pop();

    if (allowedExtensions.includes(fileExtension)) {
      // File type is allowed
      errorElement.style.display = "none";
      return true;
    } else {
      // File type is not allowed
      errorElement.style.display = "inline";
      certificateInput.value = "";
      return false;
    }
  } else {
    // No file selected
    errorElement.style.display = "none";
    return false;
  }
}
