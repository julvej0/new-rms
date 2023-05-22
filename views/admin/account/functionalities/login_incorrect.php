<?php

// this functions is to get if the login credential are not correct or not existing.
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
?>