function confirmDelete(event, name){
    
    Swal.fire({
        title: 'Are you sure?',
        text: name + " will be deleted from authors. You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            return true
        } else if (result.isDenied) {
            return false
        }
      })
      event.preventDefault();
   

}