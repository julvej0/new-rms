// Floating action rotate
let isRotated = false;
const checkboxContainer = document.getElementById("checkbox-container");

function rotateButton() {
    const buttonIcon = document.getElementById("button-icon");
    if (isRotated) {
        // If the button is already rotated, reset its rotation and hide the checkbox container
        buttonIcon.style.transform = "rotate(0deg)";
        checkboxContainer.style.transition = "margin-top 0.3s ease-out, opacity 0.4s ease-in-out";
        checkboxContainer.style.opacity = 0;
        setTimeout(() => {
            checkboxContainer.style.marginTop = "0rem";
            setTimeout(() => {
                checkboxContainer.style.display = "none";
            }, 100); // Wait for opacity transition to complete before hiding container
        }, 150); // Wait for margin-top transition to complete before setting opacity to 0
        isRotated = false;
    } else {
        // If the button is not rotated, rotate it and show the checkbox container
        buttonIcon.style.transform = "rotate(540deg)";
        checkboxContainer.style.transition = "margin-top 0.3s ease-in-out, opacity 0.4s ease-in-out";
        checkboxContainer.style.display = "block";
        setTimeout(() => {
            checkboxContainer.style.opacity = 1;
            checkboxContainer.style.marginTop = "0.5rem";
        }, 10); // Wait for margin-top transition to complete before setting opacity to 1
        isRotated = true;
    }
}
// get all the checkboxes
var checkboxes = document.querySelectorAll('input[type=checkbox]');

// loop through each checkbox
checkboxes.forEach(function(checkbox) {

// Hide cells that correspond to unchecked checkboxes by default
var colName = checkbox.name;
var cells = document.querySelectorAll('.' + colName);
cells.forEach(function(cell) {
cell.style.display = checkbox.checked ? 'table-cell' : 'none';
});

// add event listener for when the checkbox state changes
checkbox.addEventListener('change', function() {
    // get the name of the checkbox
    var colName = this.name;
    // get the table cells that correspond to this column name
    var cells = document.querySelectorAll('.' + colName);
    // loop through each cell and hide/show it based on checkbox state
    cells.forEach(function(cell) {
    cell.style.display = checkbox.checked ? 'table-cell' : 'none';
    });
});
});

// loop through each checkbox
checkboxes.forEach(function(checkbox) {

    // get the stored state of the checkbox
    var storedState = sessionStorage.getItem(checkbox.name);

    // if there is a stored state, update the checkbox state to match it
    if (storedState !== null) {
    checkbox.checked = storedState === 'true';
    }

    // add event listener for when the checkbox state changes
    checkbox.addEventListener('change', function() {
    // store the state of the checkbox in session storage
    sessionStorage.setItem(checkbox.name, checkbox.checked);
    
    // get the name of the checkbox
    var colName = this.name;
    // get the table cells that correspond to this column name
    var cells = document.querySelectorAll('.' + colName);
    // loop through each cell and hide/show it based on checkbox state
    cells.forEach(function(cell) {
        cell.style.display = checkbox.checked ? 'table-cell' : 'none';
    });
    });

    // Hide cells that correspond to unchecked checkboxes by default
    var colName = checkbox.name;
    var cells = document.querySelectorAll('.' + colName);
    cells.forEach(function(cell) {
    cell.style.display = checkbox.checked ? 'table-cell' : 'none';
    });
});

// DROPDOWN FILTER
const allFilter = document.querySelectorAll('main .header .left .filter');
allFilter.forEach(item => {
    const filterBtn = item.querySelector('.btn');
    const filterLink = item.querySelector('.filter-link');
    const dropdownItems = item.querySelectorAll('a');

    filterBtn.addEventListener('click', (e) => {
        e.preventDefault();
        filterLink.classList.toggle('show');
    })

    dropdownItems.forEach(choices => {
        choices.addEventListener('click', () => {
            var icon = document.querySelector('.icon');
            const selected = choices.textContent;
            iconString = icon.toString();

            filterBtn.innerHTML = selected + "<i class='bx bx-chevron-down icon'></i>";
        });
    });
});


window.addEventListener('click', (e) => {
    allFilter.forEach(item => {
        const filterBtn = item.querySelector('.btn');
        const filterLink = item.querySelector('.filter-link');

        if(e.target !== filterBtn){
            if(e.target !== filterLink){
                if(filterLink.classList.contains('show')){
                    filterLink.classList.remove('show');
                }
            }
        }
    })
})

// Redirect Certificate
function redirect(url) {
    if (url == 'no_url') {
        // If the URL is 'no_url', display a toast notification indicating that the certificate is not set
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        Toast.fire({
            icon: 'info',
            title: 'Certificate not set!',
        });
    } else {
        // If the URL is valid, open it in a new tab
        window.open(url, "_blank");
    }
}

// Submit Delete
function submitDelete(id) {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Open a POST request to the IPA delete PHP script
    xhr.open("POST", "functionalities/button_functions/ipa-delete.php", true);
    
    // Set the request header
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    // Define the callback function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "Success") {
                // If the delete operation is successful, update the URL parameters and refresh the page
                let queryString = window.location.search;
                const searchParams = new URLSearchParams(queryString);
                if (searchParams.has('delete')) {
                    searchParams.delete('delete');
                }
                window.location.href = "?" + searchParams + "&delete=success";
            } else {
                // If the delete operation fails, display an error message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Delete was Unsuccessful',
                    text: 'Something went wrong! Please try again later!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                console.log(xhr.responseText);
            }
        }
    };
    
    // Send the request with the ID parameter
    xhr.send("id=" + id);
}

// Confirm Delete
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: id + " will be deleted from Patented Document. You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirms the deletion, call the submitDelete() function to initiate the deletion process
            submitDelete(id);
        } 
    });
}

  


