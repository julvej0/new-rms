// DELETE MODAL
const deleteBtn = document.querySelector('.delete-btn');

deleteBtn.addEventListener('click', (e) => {
    e.preventDefault();
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'file deleted!',
        showConfirmButton: false,
        timer: 1500
        })
    }
    })
})

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



