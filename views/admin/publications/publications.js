window.addEventListener("load", function () {
  var loadingScreen = document.getElementById("loading-screen");
  loadingScreen.style.display = "none";
});

// Floating action rotate
let isRotated = false;
const checkboxContainer = document.getElementById("checkbox-container");

function rotateButton() {
  const buttonIcon = document.getElementById("button-icon");
  if (isRotated) {
    buttonIcon.style.transform = "rotate(0deg)";
    checkboxContainer.style.transition =
      "margin-top 0.3s ease-out, opacity 0.4s ease-in-out";
    checkboxContainer.style.opacity = 0;
    setTimeout(() => {
      checkboxContainer.style.marginTop = "0rem";

      setTimeout(() => {
        checkboxContainer.style.display = "none";
      }, 100); // wait for opacity transition to complete before hiding container
    }, 150); // wait for margin-top transition to complete before setting opacity to 0
    isRotated = false;
  } else {
    buttonIcon.style.transform = "rotate(540deg)";
    checkboxContainer.style.transition =
      "margin-top 0.3s ease-in-out, opacity 0.4s ease-in-out";
    checkboxContainer.style.display = "block";
    setTimeout(() => {
      checkboxContainer.style.opacity = 1;
      checkboxContainer.style.marginTop = "0.5rem";
    }, 10); // wait for margin-top transition to complete before setting opacity to 1
    isRotated = true;
  }
}

// get all the checkboxes
var checkboxes = document.querySelectorAll("input[type=checkbox]");

// loop through each checkbox
checkboxes.forEach(function (checkbox) {
  // Hide cells that correspond to unchecked checkboxes by default
  var colName = checkbox.name;
  var cells = document.querySelectorAll("." + colName);
  cells.forEach(function (cell) {
    cell.style.display = checkbox.checked ? "table-cell" : "none";
  });

  // add event listener for when the checkbox state changes
  checkbox.addEventListener("change", function () {
    // get the name of the checkbox
    var colName = this.name;
    // get the table cells that correspond to this column name
    var cells = document.querySelectorAll("." + colName);
    // loop through each cell and hide/show it based on checkbox state
    cells.forEach(function (cell) {
      cell.style.display = checkbox.checked ? "table-cell" : "none";
    });
  });
});

// loop through each checkbox
checkboxes.forEach(function (checkbox) {
  // get the stored state of the checkbox
  var storedState = sessionStorage.getItem(checkbox.name);

  // if there is a stored state, update the checkbox state to match it
  if (storedState !== null) {
    checkbox.checked = storedState === "true";
  }

  // add event listener for when the checkbox state changes
  checkbox.addEventListener("change", function () {
    // store the state of the checkbox in session storage
    sessionStorage.setItem(checkbox.name, checkbox.checked);

    // get the name of the checkbox
    var colName = this.name;
    // get the table cells that correspond to this column name
    var cells = document.querySelectorAll("." + colName);
    // loop through each cell and hide/show it based on checkbox state
    cells.forEach(function (cell) {
      cell.style.display = checkbox.checked ? "table-cell" : "none";
    });
  });

  // Hide cells that correspond to unchecked checkboxes by default
  var colName = checkbox.name;
  var cells = document.querySelectorAll("." + colName);
  cells.forEach(function (cell) {
    cell.style.display = checkbox.checked ? "table-cell" : "none";
  });
});

// DROPDOWN FILTER
const allFilter = document.querySelectorAll("main .header .left .filter");
allFilter.forEach((item) => {
  const filterBtn = item.querySelector(".btn");
  const filterLink = item.querySelector(".filter-link");
  const dropdownItems = item.querySelectorAll("a");

  filterBtn.addEventListener("click", (e) => {
    e.preventDefault();
    filterLink.classList.toggle("show");
  });

  dropdownItems.forEach((choices) => {
    choices.addEventListener("click", () => {
      var icon = document.querySelector(".icon");
      const selected = choices.textContent;
      iconString = icon.toString();

      filterBtn.innerHTML =
        selected + "<i class='bx bx-chevron-down icon'></i>";
    });
  });
});

window.addEventListener("click", (e) => {
  allFilter.forEach((item) => {
    const filterBtn = item.querySelector(".btn");
    const filterLink = item.querySelector(".filter-link");

    if (e.target !== filterBtn) {
      if (e.target !== filterLink) {
        if (filterLink.classList.contains("show")) {
          filterLink.classList.remove("show");
        }
      }
    }
  });
});

//Redirect Certificate

function redirect(url) {
  // Check if the URL is 'no_url'
  if (url == "no_url") {
    // Display an informational toast notification using SweetAlert library
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });

    Toast.fire({
      icon: "info",
      title: "Google scholar link not set!",
    });
  } else {
    // Open the URL in a new tab or window
    window.open(url, "_blank");
  }
}

function submitDelete(id) {
  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure the request
  xhr.open("DELETE", "http://localhost:5000/table_publications/" + id, true);

  // Define the callback function to handle the response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var logurl = "http://localhost:5000/table_log";

        var xhrLog = new XMLHttpRequest();
        xhrLog.open("GET", logurl, true);

        xhrLog.onreadystatechange = function () {
          if (xhrLog.readyState === 4 && xhrLog.status === 200) {
            var response_id = xhrLog.responseText;
            var data = JSON.parse(response_id);
            var logs = data["table_log"];

            logs.sort(function (a, b) {
              return a["log_id"].localeCompare(b["log_id"]);
            });

            var lastLog = logs[logs.length - 1];
            var last_id = lastLog["log_id"];

            var numericPart = parseInt(last_id.substr(2));
            var nextNumericID = numericPart + 1;

            var paddedNumericID = nextNumericID.toString().padStart(6, "0");

            var log_id = "AL" + paddedNumericID;

            console.log(log_id);

            var date_time = new Date().toISOString();
            var user_id = 18;
            var activity = "Delete Publication";
            var description = 'Deleted Publication ID "' + id + '"';

            var publication_log = {
              log_id: log_id,
              date_time: date_time,
              user_id: user_id,
              activity: activity,
              description: description,
            };

            var jsonData = JSON.stringify(publication_log);

            var xhrLogPost = new XMLHttpRequest();
            xhrLogPost.open("POST", "http://localhost:5000/table_log", true);
            xhrLogPost.setRequestHeader("Content-Type", "application/json");

            xhrLogPost.onreadystatechange = function () {
              if (xhrLogPost.readyState === 4 && xhrLogPost.status === 200) {
                var response_logpost = xhrLogPost.responseText;
                // Handle the response as needed
              }
            };

            xhrLogPost.send(jsonData);
          }
        };

        xhrLog.send();

        // Remove the 'delete' parameter from the current URL
        let queryString = window.location.search;
        const searchParams = new URLSearchParams(queryString);
        if (searchParams.has("delete")) {
          searchParams.delete("delete");
        }

        // Append the 'delete=success' parameter to the modified URL
        window.location.href = "?" + searchParams + "&delete=success";
      } else {
        // Display an error message using SweetAlert library
        Swal.fire({
          icon: "error",
          title: "Delete was Unsuccessful",
          text: "Something went wrong! Please try again later!",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "OK",
        });
        console.log(xhr.responseText);
      }
    }
  };

  // Send the request
  xhr.send();
}

function confirmDelete(id) {
  // Display a confirmation dialog using SweetAlert library
  Swal.fire({
    title: "Are you sure?",
    text:
      id +
      " will be deleted from Publications. You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    // Handle the user's choice
    if (result.isConfirmed) {
      // If confirmed, call the submitDelete function to perform the delete operation
      submitDelete(id);
    }
  });
}
