<?php
include_once "../../../includes/admin/templates/header.php";
include_once "../../../includes/admin/templates/navbar.php";
include_once "../account-management/functionalities/user-session.php";
?>
<link rel="stylesheet" href="account-management.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div id='whole-page'>
    <!-- navigation bar -->
    <div class="navigation-bar">
        <a href="#" class="nav-button" data-target="#profile-page"><span>Profile</span></a>
        <a href="#" class="nav-button" data-target="#security-page"><span>Security</span></a>
    </div>


    <!-- minipages -->


<!-- profile page -->
    <div id="profile-page" class="mini-page">
    <h2>Profile Information</h2>
    <div class="profile-info">
        <div class="profile-photo">
            <label for="photo-upload">
                <img src="" alt="User Photo" title="Click to Edit Photo">
            </label>
            <input type="file" id="photo-upload" style="display:none">
        </div>
        <div class="profile-details">
        <div class="profile-row">
            <label for="name">Name:</label>
            <input type="text" id="user_name" style="text-transform:uppercase;" value="<?php echo $user['user_name'];?>" readonly>
            <button class="edit-button" onclick="editField('user_name')">EDIT</button>
        </div>
        <div class="profile-row">
            <label for="address">SR Code:</label>
            <input type="text" id="sr_code" value="<?php echo $user['sr_code'];?>" readonly>
            <button class="edit-button" onclick="editField('sr_code')">EDIT</button>
        </div>
        <div class="profile-row">
            <label for="contact">Contact:</label>
            <input type="text" id="user_contact" maxlength='11' value="<?php echo $user['user_contact'];?>" readonly>
            <button class="edit-button" onclick="editField('user_contact')">EDIT</button>
        </div>
        <div class="profile-row">
            <label for="affiliation">Email:</label>
            <input type="text" id="email" value="<?php echo $user['email'];?>" readonly>
            <button class="edit-button" onclick="editField('email')">EDIT</button>
        </div>
        <div class="profile-row">
            <label for="occupation">Account:</label>
            <input type="text" id="occupation" value="<?php echo $user['account_type'];?>" readonly>
        </div>
        </div>
    </div>
    </div>


    <!-- security-page -->
    <div id="security-page" class="mini-page">
    <h2>Security Settings</h2>
        <button id="change-password-btn">Change Password</button>
    </div>

    <!-- HTML code for change password modal -->
    <div id="change-password-modal" class="modal">
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
<script>


//////////////////////////////////////////////////////////////////////for navigation button/////////////////////////////////////////////////////////////////////

    const navButtons = document.querySelectorAll('.nav-button');
    const miniPages = document.querySelectorAll('.mini-page');

    navButtons.forEach((button) => {
    button.addEventListener('click', () => {
        // remove focused class from all buttons
        navButtons.forEach((b) => {
        b.classList.remove('focused');
        });

        // hide all mini pages
        miniPages.forEach((page) => {
        page.classList.remove('active');
        });

        // show the selected mini page
        const target = button.dataset.target;
        document.querySelector(target).classList.add('active');

        // add focused class to the clicked button
        button.classList.add('focused');
    });
    });

    // show the profile page by default
    document.querySelector('#profile-page').classList.add('active');
    document.querySelector('.nav-button[data-target="#profile-page"]').classList.add('focused');

/////////////////////////////////////////////////////////////////////////////////for image//////////////////////////////////////////////////

// Check if there's a photo stored in localStorage
if (localStorage.getItem('userPhoto')) {
  var image = document.querySelector('.profile-photo img');
  image.src = localStorage.getItem('userPhoto');
}

document.querySelector('#photo-upload').addEventListener('change', function(event) {
  var file = event.target.files[0];
  var image = document.querySelector('.profile-photo img');
  var reader = new FileReader();
  reader.onload = function(event) {
    // Store the photo data in localStorage
    localStorage.setItem('userPhoto', event.target.result);
    image.src = event.target.result;
  };
  reader.readAsDataURL(file);
});

////////////////////////////////////////////////////////////////////////////////////for changing passowrd////////////////////////////////////////////////////////
function changePss() {
    var currentPassword = document.querySelector('.oldPasswordInput').value;
    var newPassword = document.getElementsByClassName("passwordInput")[0].value;
    var confirmPassword = document.getElementById("confirmPasswordInput").value;
    var userEmail = "<?php echo $user['email'];?>"
    var changePasswordModal = document.getElementById('change-password-modal')
    
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