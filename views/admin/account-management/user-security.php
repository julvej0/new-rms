<?php
include_once "../../../includes/admin/templates/header.php";
include_once "../../../includes/admin/templates/navbar.php";
include_once "functionalities/user-session.php";
?>
<link rel="stylesheet" href="user-security.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div id='whole-page'>


<!-- HTML code for change password modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Change Password</h2>
            <form id="change-password-form">
                <label for="current-password">Current Password:</label>
                <div class='password-container'>
                    <input type="password" class="oldPasswordInput" name="current-password"  maxlength='8' required>
                    <i class="toggle-password fas fa-eye-slash"></i>
                </div>
                <label for="new-password">New Password:</label>
                <div class='password-container'>
                    <input type="password" class="passwordInput" name="new-password"  maxlength='8' required>
                    <i class="toggle-password fas fa-eye-slash"></i>
                </div>  
                <label for="confirm-password">Confirm Password:</label>
                <div class='password-container'>
                    <input type="password" id="confirmPasswordInput" name="confirm-password"  maxlength='8' required>
                    <i class="toggle-password fas fa-eye-slash"></i>
                </div>  
                <button type="button" id="submit-password" onclick='changePss()'>Submit</button>
            </form>
        </div>
    </div>
</div>

<script src='change-pass-and-email.js'></script>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>
<script src='close-modal.js'></script>
<script>
    function changePss() {
    var currentPassword = document.querySelector('.oldPasswordInput').value;
    var newPassword = document.getElementsByClassName("passwordInput")[0].value;
    var confirmPassword = document.getElementById("confirmPasswordInput").value;
    var userEmail = "<?php echo $user['email'];?>"
    var changePasswordModal = document.getElementById('myModal')
    
    if (newPassword !== confirmPassword) {
        alert("New password and confirm password don't match.");
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'functionalities/change-password-no-otp.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.responseText === 'successful') {
                    alert('Password changed successfully!');
                    changePasswordModal.style.display = "none";
                    document.getElementById("change-password-form").reset();
                } else {
                    alert('Password change failed!');
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    };
    xhr.send('current-password=' + encodeURIComponent(currentPassword) + '&new-password=' + encodeURIComponent(confirmPassword) + '&email=' +encodeURIComponent(userEmail) );
}

</script>

<?php
include_once "../../../includes/admin/templates/footer.php";
?>