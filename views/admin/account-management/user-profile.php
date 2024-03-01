<title>RMS | PROFILE</title>
<?php
include dirname(__FILE__, 4) . '/components/header/header.php';
include dirname(__FILE__, 4) . '/components/navbar/navbar.php';
include_once "functionalities/user-session.php";
?>

<link rel="stylesheet" href="user-profile.css">
<section id='appbar-and-content'>
    <?php include_once dirname(__FILE__, 4) . '/components/navbar/admin-navbar.php'; ?>
    <div id='whole-page'>
        <!-- profile page -->
        <div id="profile-page" class="mini-page">
            <h2 id='userh2'>Profile Information</h2>
            <div class="profile-info">
                <div class="profile-photo">
                    <label for="photo-upload">
                        <!-- TODO: add a caption saying that you need to click the image box to add/edit it -->
                        <!-- TODO: make image upload work -->
                        <img id="user-image"
                            src="<?php echo isset($user['user_img']) ? $user['user_img'] : "./uploads/user.png"; ?>"
                            alt="User Image">
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
                        <input type="text" id="user_contact" maxlength='11'
                            value="<?php echo $user_contact = $user['user_contact'] ?? ""; ?>" readonly>
                        <button class="edit-button" onclick="editField('user_contact')">EDIT</button>
                    </div>

                    <div class="profile-row">
                        <label for="address">SR Code:</label>
                        <input type="text" id="sr_code" value="<?php echo $user['sr_code']; ?>" readonly>
                    </div>

                    <div class="profile-row">
                        <label for="affiliation">Email:</label>
                        <input type="text" id="email" name='email' value="<?php echo $user['email']; ?>" readonly>
                    </div>
                    <div class="profile-row">
                        <label for="occupation">Account:</label>
                        <input type="text" id="occupation" value="<?php echo $user['account_type']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>

<script>
    $(document).ready(function () {
        $('#photo-upload').change(function () {
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
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Image uploaded successfully!',
                    }).then((result) => {
                        location.reload(true);
                    });
                },
                error: function (response) {
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