// CANCEL MODAL

const cancelBtn = document.querySelector('.cancel-btn');

cancelBtn.addEventListener('click', (e) => {
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to cancel?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
    }).then((result) => {
    if (result.isConfirmed) {
        history.back(-1);
    }
    })
})
