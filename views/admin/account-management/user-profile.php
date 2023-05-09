<?php
include_once "../../../includes/admin/templates/header.php";
include_once "../../../includes/admin/templates/navbar.php";
include_once "functionalities/user-session.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="user-profile.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div id='whole-page'>


<!-- profile page -->
    <div id="profile-page" class="mini-page">
        <h2 id='userh2'>Profile Information</h2>
        <div class="profile-info">
            <div class="profile-photo">
                <label for="photo-upload">
                    <img id="user-image" src="<?php echo $user['user_img']; ?>" alt="User Image">
                </label>
                <input type="file" id="photo-upload" name="file" style="display:none">
            </div>
        <div class="profile-details">

                <div class="profile-row">
                    <label for="name">Given Name:</label>
                    <input type="text" id="user_fname" value="<?php echo $user['user_fname']; ?>" readonly>
                    <button class="edit-button" onclick="editField('user_fname')">EDIT</button>
                </div>
                <div class="profile-row">
                    <label for="name">Middle Name:</label>
                    <input type="text" id="user_mname" value="<?php echo $user['user_mname']; ?>" readonly>
                    <button class="edit-button" onclick="editField('user_mname')">EDIT</button>
                </div>
                <div class="profile-row">
                    <label for="name">Surname:</label>
                    <input type="text" id="user_lname" value="<?php echo $user['user_lname']; ?>" readonly>
                    <button class="edit-button" onclick="editField('user_lname')">EDIT</button>
                </div>
                
                <div class="profile-row">
                    <label for="contact">Contact Number:</label>
                    <input type="text" id="user_contact" maxlength='11' value="<?php echo $user['user_contact'];?>" readonly>
                    <button class="edit-button" onclick="editField('user_contact')">EDIT</button>
                </div>

                <div class="profile-row">
                    <label for="address">SR Code:</label>
                    <input type="text" id="sr_code" value="<?php echo $user['sr_code'];?>" readonly>
                </div>

                <div class="profile-row">
                    <label for="affiliation">Email:</label>
                    <input type="text" id="email" name='email' value="<?php echo $user['email'];?>" readonly>
                </div>
            
                
                
                <div class="profile-row">
                    <label for="occupation">Account:</label>
                    <input type="text" id="occupation" value="<?php echo $user['account_type'];?>" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>

<script>
$(document).ready(function() {
    $('#photo-upload').change(function() {
        var file_data = $(this).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('email', '<?php echo $user['email']; ?>');
        $.ajax({
            url: 'functionalities/upload-user-img.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Image uploaded successfully!',
                    }).then((result) => {
                        location.reload(true);
                    });
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    });
});
</script>



