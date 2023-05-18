<?php
include_once "../../../includes/public-user/templates/user-navbar.php";
include_once "functionalities/user-session.php";
?>

<link rel="stylesheet" href="../../../css/index.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="author-profile.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div id='whole-page'>


<!-- profile page -->
    <div id="author-page">
        <label id='author-header'>AUTHOR INFORMATION</label>
        <div class="profile-details">
            <div class="profile-row">
                <label for="affiliation">Author Identification Code:</label>
                <input type="text" id="author_id" name='author_id' value="<?php echo $author_user['author_id'] ? $author_user['author_id'] : 'Not Yet Set';?>" readonly>
            </div>
            <div class="profile-row">
                <label for="affiliation">Author Name:</label>
                <input type="text" id="author_name" name='author_name' value="<?php echo $author_user['author_name'] ? $author_user['author_name'] : 'Not Yet Set';?>" readonly>
                <button class="edit-button" onclick="editField('author_name')">EDIT</button>
            </div>
            <div class="profile-row">
                <label for="affiliation">Affiliation:</label>
                <input type="text" id="affiliation" name='affiliation' value="<?php echo $author_user['affiliation'] ? $author_user['affiliation'] : 'Not Yet Set';?>" readonly>
                <button class="edit-button" onclick="editField('affiliation')">EDIT</button>
            </div>
            
        </div>
        <label id='author-pubs'>AUTHOR PUBLICATIONS</label>
            <div id='author-info'  style='display: flex; justify-content: center;'>
                <?php
                    include_once "functionalities/author-data.php";
                ?>
            </div>
    </div>
</div>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>

