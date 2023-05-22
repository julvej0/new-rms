<?php
if(isset($_GET['login'])){
    if ($_GET['login'] == "incorrect"){
        echo '
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Incorrect Email/Password",
                    icon: "error"
                    });
            </script>
        
        
        ';
    }
    else if ($_GET['login'] == "notexist"){
        echo '
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Account does not exist",
                    icon: "error"
                    });
            </script>
        
        
        ';
    }
}
if(isset($_GET['login']))
{
    if($_GET['login'] == 'required'){
       echo $_GET['login'];
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
                title: "Login Required!"
                })
        
            </script>
            
            ';
    }

}
?>