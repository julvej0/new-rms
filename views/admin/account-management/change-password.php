<?php
include_once dirname(__FILE__, 4) . '/components/header/header.php';
include_once dirname(__FILE__, 4) . '/components/navbar/navbar.php'; 
include_once "functionalities/user-session.php";
?>
<link rel="stylesheet" href="user-security.css">
<section id='appbar-and-content'>
    <?php include_once  dirname(__FILE__, 4) . '/components/navbar/admin-navbar.php'; ?>  
    <div id='whole-page'>


    <!-- HTML code for change password modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Change Password</h2>
                <form id="change-password-form">
                    <label for="current-password">Current Password:</label>
                    <div class='password-container'>
                        <input type="password" class="oldPasswordInput" name="current-password" minlength='8' maxlength='16' required>
                        <i class="toggle-password fas fa-eye-slash"></i>
                    </div>
                    <label for="new-password">New Password:</label>
                    <div class='password-container'>
                        <input type="password" class="passwordInput" name="new-password" minlength='8' maxlength='16' required>
                        <i class="toggle-password fas fa-eye-slash"></i>
                    </div>  
                    <label for="confirm-password">Confirm Password:</label>
                    <div class='password-container'>
                        <input type="password" id="confirmPasswordInput" name="confirm-password" minlength='8' maxlength='16' required>
                        <i class="toggle-password fas fa-eye-slash"></i>
                    </div>  
                    <button type="button" id="submit-password" onclick='changePss()'>Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src='change-pass-and-email.js'></script>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>
<script src='close-modal.js'></script>

<script>
    function changePss() {
    var currentPassword = document.querySelector('.oldPasswordInput').value;
    var newPassword = document.getElementsByClassName("passwordInput")[0].value;
    var confirmPassword = document.getElementById("confirmPasswordInput").value;
    var userEmail = "<?php echo $user['email'];?>";
    var changePasswordModal = document.getElementById('myModal');
    var disableSubmitPassword = document.getElementById('submit-password');
    
    if (newPassword !== confirmPassword) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        Toast.fire({
            icon: 'error',
            title: 'Passwords Do Not Match, Please Try Again!'
        })
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'functionalities/change-password-no-otp.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.responseText === 'successful') {
                    disableSubmitPassword.disabled = true;
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Password Changed Successfully'
                    })
                    // Redirect to login page after 3 seconds
                    setTimeout(() => {
                        changePasswordModal.style.display = "none";
                        document.getElementById("change-password-form").reset();
                        window.location.href = "user-profile.php";
                    }, 3000);
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    
                    Toast.fire({
                        icon: 'error',
                        title: 'Password Change Fail!'
                    })
                }
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                    
                Toast.fire({
                    icon: 'error',
                    title: 'There Was a Problem With The Request!'
                })
            }
        }
    };
    xhr.send('current-password=' + encodeURIComponent(currentPassword) + '&new-password=' + encodeURIComponent(confirmPassword) + '&email=' +encodeURIComponent(userEmail) );
}

</script>
