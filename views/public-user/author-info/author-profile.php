<?php
include_once "../../../includes/public-user/templates/user-navbar.php";
include_once "functionalities/user-session.php";

include_once "functionalities/display-edit-affiliations.php";


include_once "functionalities/options.php";

?>

<link rel="stylesheet" href="../../../css/index.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="author-profile.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<div id='whole-page'>


<!-- profile page -->
    <div id="author-page">

        <div class="page-title">
            <h3 class="animate__animated animate__zoomIn">AUTHOR DETAILS</h3>
        </div>
        <div class="profile-container">
            
            <div class="profile-details">
            <label class='author-header'>AUTHOR INFORMATION</label>
                <div class="profile-row">
                    <label for="affiliation">Author Identification Code:</label>
                    <input type="text" id="author_id" name='author_id' value="<?php echo $author_user['author_id'] ? $author_user['author_id'] : 'Not Yet Set';?>" readonly>
                </div>
                <div class="profile-row">
                    <label for="affiliation">Type:</label>
                    <input type="text" id="author_id" name='author_id' value="<?php echo $author_user['type_of_author'] ? $author_user['type_of_author'] : 'Not Yet Set';?>" readonly>
                </div>
                <div class="profile-row">
                    <label for="affiliation">Name:</label>
                    <input type="text" id="author_name" name='author_name' value="<?php echo $author_user['author_name'] ? $author_user['author_name'] : 'Not Yet Set';?>" readonly>
                </div>
               
            </div>
            <div id='author-affiliate'>
                <label class='author-header'>AFFILIATION DETAILS</label>
                <div class="profile-row">
                    <div class="form-col">
                        <div class="author-table-container">
                            <table>
                                <tbody id='affiliation-tbl'>
                                    <tr id="affiliation-tbl-body"> 
                                        <td>
                                            <div class="affiliation-main-menu">
                                                <div class="affiliation-main-menu">
                                                    <button type="button" id="a-add-btn">+</button>  
                                                    <div class="affiliation-sub-menu">
                                                        <button type="button" class="affiliation-sub-button" id="internal-btn">Internal</button>
                                                        <button type="button" class="affiliation-sub-button"id="external-btn">External</button>
                                                    </div>
                                                </div>      
                                            </div>  
                                        </td>
                                        <?php
                                            
                                            display_edit_aff($author_user['affiliation'], $campus_options, $program_options);
                                            
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <label id='author-pubs'>AUTHOR'S WORKS</label>
                <div id='author-info'  style='display: flex; justify-content: center;'>
                    <?php
                        include_once "functionalities/author-data.php";
                        display_publications($conn, $author_user['author_id']);
                        display_ipassets($conn, $author_user['author_id']);
                    ?>
                </div>
    </div>
</div>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>

<?php
    include_once "functionalities/affiliations.php";
?>


