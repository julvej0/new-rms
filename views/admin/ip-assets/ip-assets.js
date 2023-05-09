// DELETE MODAL
// const deleteBtn = document.querySelector('.delete-btn');

// deleteBtn.addEventListener('click', (e) => {
//     e.preventDefault();
//     Swal.fire({
//     title: 'Are you sure?',
//     text: "You won't be able to revert this!",
//     icon: 'warning',
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Yes, delete it!'
//     }).then((result) => {
//     if (result.isConfirmed) {
//         Swal.fire({
//         position: 'center',
//         icon: 'success',
//         title: 'file deleted!',
//         showConfirmButton: false,
//         timer: 1500
//         })
//     }
//     })
// })

// // SHOW DOWNLOAD MENU
// const allMenu = document.querySelectorAll('main .table-footer .download');

// allMenu.forEach(item => {
//     const downloadBtn = item.querySelector('.download-btn');
//     const dlLink = item.querySelector('.dl-link');

//     downloadBtn.addEventListener('click', (e) => {
//         e.preventDefault();
//         dlLink.classList.toggle('show');
//     })
// })

// // HIDE DROPDOWN WHEN CLICKED OUTSIDE
// window.addEventListener('click', (e) => {
//     allMenu.forEach(item => {
//         const downloadBtn = item.querySelector('.download-btn');
//         const dlLink = item.querySelector('.dl-link');
//         if(e.target !== downloadBtn){
//             if(dlLink.classList.contains('show')){
//                 dlLink.classList.remove('show');
//             }
//         }
//     })
// })

// 
// Floating action rotate
let isRotated = false;
const checkboxContainer = document.getElementById("checkbox-container");

function rotateButton() {
    const buttonIcon = document.getElementById("button-icon");
    if (isRotated) {
        buttonIcon.style.transform = "rotate(0deg)";
        checkboxContainer.style.transition = "margin-top 0.3s ease-out, opacity 0.4s ease-in-out";
        checkboxContainer.style.opacity = 0;
        setTimeout(() => {
            checkboxContainer.style.marginTop = "0rem";
        
        setTimeout(() => {
            checkboxContainer.style.display = "none";
        }, 100); // wait for opacity transition to complete before hiding container
        }, 150); // wait for margin-top transition to complete before setting opacity to 0
        isRotated = false;
    } else {
        buttonIcon.style.transform = "rotate(135deg)";
        checkboxContainer.style.transition = "margin-top 0.3s ease-in-out, opacity 0.4s ease-in-out";
        checkboxContainer.style.display = "block";
        setTimeout(() => {
        checkboxContainer.style.opacity = 1;
        checkboxContainer.style.marginTop = "0.5rem";
        }, 10); // wait for margin-top transition to complete before setting opacity to 1
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

