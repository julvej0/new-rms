<?php
include_once "../../../includes/admin/templates/header.php";
include_once "../../../includes/admin/templates/navbar.php";
include_once "functionalities/user-session.php";
?>
<link rel="stylesheet" href="user-profile.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div id='whole-page'>


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
                    <input type="text" id="user_name" value="<?php echo $user['user_name'];?>" readonly>
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
</div>
<script src='change-pass-and-email.js'></script>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>