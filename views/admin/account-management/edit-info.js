

function editField(id) {

    var field = document.getElementById(id);
    var button = document.querySelector(`#${id} + .edit-button`);
    var srCode = document.getElementById('sr_code').value;
    

    
    if (field.hasAttribute('readonly')) {
      // switch to edit mode
      field.removeAttribute('readonly');
      button.textContent = 'SAVE';
      field.focus();
    } else {
      // switch to readonly mode
      field.setAttribute('readonly', true);
      button.textContent = 'EDIT';
  
      // send the new value to the server
      var newValue = field.value;
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            console.log(xhr.responseText); // success message
          } else {
            console.log(xhr.statusText); // error message
          }
        }
      };
      xhr.open('POST', 'functionalities/update-user.php');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.send('field=' + id + '&value=' + newValue + '&sr_code=' + srCode);
    }
}
