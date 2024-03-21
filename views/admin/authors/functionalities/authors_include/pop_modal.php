<?php
//check if delete is on page's get parameter
if (isset ($_GET['delete'])) {
  if ($_GET['delete'] == 'success') {
    echo

      '
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            }
          })
          
          Toast.fire({
            icon: "success",
            title: "Author Deleted!"
          })
    
        </script>
        
        ';
  } else {
    echo

      '
      <script>
      const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
          }
        })
        
        Toast.fire({
          icon: "error",
          title: "Failed Deleting Author Info!"
        })
  
      </script>
      
      ';

  }
}

//check if update is on page's get parameter
if (isset ($_GET['update'])) {
  //result depends on update's value
  if ($_GET['update'] == 'success') {
    echo

      '
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            }
          })
          
          Toast.fire({
            icon: "success",
            title: "Author Info Updated!"
          })
    
        </script>
        
        ';

  } else {
    echo

      '
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            }
          })
          
          Toast.fire({
            icon: "error",
            title: "Failed Updating Author Info!"
          })
    
        </script>
        
        ';

  }


}

//check if add is on page's get parameter
if (isset ($_GET['add'])) {
  //result depends on add's value
  if ($_GET['add'] == 'success') {
    echo

      '
      <script>
      const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
          }
        })
        
        Toast.fire({
          icon: "success",
          title: "Author Added!"
        })
  
      </script>
      
      ';

  } else if ($_GET['add'] == 'update-failed') {
    echo

      '
      <script>
      const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
          }
        })
        
        Toast.fire({
          icon: "warning",
          title: "Author Added!",
          text: "Failed to update User."
        })
  
      </script>
      
      ';

  } else {
    echo

      '
      <script>
      const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
          }
        })
        
        Toast.fire({
          icon: "error",
          title: "Failed Adding Author!"
        })
  
      </script>
      
      ';
  }


}
?>