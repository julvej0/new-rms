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

