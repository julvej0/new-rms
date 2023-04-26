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
