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
      window.location.href = cancelBtn.classList.contains("edit-mode")
        ? "./ip-assets.php"
        : "../ip-assets.php";
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

function RegisterRadio() {
  const registerRadio = document.querySelector(
    'input[name="registerInfo"]:checked'
  );
  const registerResult = document.getElementById("show-register");
  const regID = document.getElementById("reg_num");
  const regDate = document.getElementById("reg-date");
  const regIpCert = document.getElementById("ip-certificate-input");

  if (registerRadio) {
    const registerValue = registerRadio.value;

    if (registerValue === "registered") {
      registerResult.style.display = "flex";
      regID.setAttribute("required", "");
      regDate.setAttribute("required", "");
    } else if (registerValue === "not-registered") {
      registerResult.style.display = "none";
      regID.removeAttribute("required");
      regDate.removeAttribute("required");
      regID.value = "";
      regDate.value = "";
      regIpCert.value = "";
    }
  }
}

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

function toggleRequired() {
  let ipTypeSelect = document.getElementById("ip-type");
  let classOfWorkSelect = document.getElementById("class_of_work");
  let campusSelect = document.getElementById("ipa-campus");
  let programSelect = document.getElementById("program");
  let collegeSelect = document.getElementById("college");
  let authorSelect = document.getElementById("ipa-author");
  let classofwork = document.querySelector(".class_of_work");
  let college = document.querySelector(".college");
  let campus = document.querySelector(".ipa-campus");
  let program = document.querySelector(".program");
  let authors = document.querySelector(".authors");

  if (ipTypeSelect.value === "Trademark") {
    classOfWorkSelect.removeAttribute("required");
    campusSelect.removeAttribute("required");
    programSelect.removeAttribute("required");
    collegeSelect.removeAttribute("required");
    authorSelect.removeAttribute("required");
    classofwork.style.color = "white";
    college.style.color = "white";
    program.style.color = "white";
    campus.style.color = "white";
    authors.style.color = "white";
  } else if (ipTypeSelect.value === "Copyright") {
    programSelect.removeAttribute("required");
    collegeSelect.removeAttribute("required");
    classOfWorkSelect.setAttribute("required", "required");
    campusSelect.setAttribute("required", "required");
    // collegeSelect.setAttribute("required");
    authorSelect.setAttribute("required", "required");
    program.style.color = "white";
    classofwork.style.color = "red";
    college.style.color = "white";
    authors.style.color = "red";
    campus.style.color = "red";
  } else {
    classOfWorkSelect.removeAttribute("required");
    campusSelect.setAttribute("required", "required");
    programSelect.setAttribute("required", "required");
    collegeSelect.setAttribute("required", "required");
    authorSelect.setAttribute("required", "required");
    classofwork.style.color = "white";
    college.style.color = "red";
    program.style.color = "red";
    authors.style.color = "red";
    campus.style.color = "red";
  }
}
