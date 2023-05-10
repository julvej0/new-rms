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
}
?>