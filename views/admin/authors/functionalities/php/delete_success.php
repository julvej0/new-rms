<?php
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
?>
