<?php
    //check if delete is on page's get parameter
    if(isset($_GET['delete'])){
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
        
    }

    //check if update is on page's get parameter
    if(isset($_GET['update'])){
      //result depends on update's value
      if($_GET['update'] == 'success'){
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
  
      }
      else{
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
  if(isset($_GET['add'])){
    //result depends on add's value
    if($_GET['add'] == 'success'){
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

    }
    else{
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
