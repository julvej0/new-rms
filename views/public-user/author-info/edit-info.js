function editField(id) {

  var field = document.getElementById(id);
  var button = document.querySelector(`#${id} + .edit-button`);
  var author_id = document.getElementById('author_id').value;

  if (field.hasAttribute('readonly')) {
    // switch to edit mode
    field.removeAttribute('readonly');
    button.textContent = 'SAVE';
    field.focus();
  } else {
    // switch to readonly mode
    field.setAttribute('readonly', true);
    button.textContent = 'EDIT';

    // validate the new value
    var newValue = field.value;

    // send the new value to the server
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          console.log(xhr.responseText); // success message
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            setTimeout(function(){
              location.reload(true);
            }, 1500);
            
            Toast.fire({
                icon: 'success',
                title: 'Edit Successful'
            })
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            
            Toast.fire({
                icon: 'error',
                title: 'Edit Unsuccessful!'
            })
          console.log(xhr.statusText); // error message
        }
      }
    };
    xhr.open('POST', 'functionalities/update-user.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('field=' + id + '&value=' + newValue + '&author_id=' + author_id);
  }
}
