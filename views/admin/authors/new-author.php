<?php 
    include '../../../includes/admin/templates/header.php';
    require_once "../../../db/db.php";
    
?>

<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="new-author.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
<?php
    include '../../../includes/admin/templates/navbar.php';
    include_once 'functionalities/new-author_includes/display_edit_author.php';
    
    include_once 'functionalities/new-author_includes/options.php';
   
   
?>
    <main>
        <div class="header">
            <h1 class="title"><?php echo isset($_GET['id'])? 'Edit Author': 'New Author'?></h1>
        </div>
        <section>
            <div class="container">
                <form name="form-author" onsubmit="return checkData(event)" action = "<?php echo isset($_GET['id']) ? 'functionalities\authors_query\edit_author.php' : 'functionalities\authors_query\insert_author.php' ?>" method="POST">
                    <div class="sub-container">
                        <div class="title">
                            <h3>Author Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-name">Author Name</label>
                                    <input type="text" placeholder="Author Name" id="a-name" name="a-name" value ="<?php echo isset($_POST['a-name']) ? $_POST['a-name'] : $table_rows[0]['author_name'] ?>">
                                    <input type="text" id = "a-id" name="a-id" value="<?php echo $table_rows[0]['author_id']?>" hidden readonly>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-role">Role</label>
                                    <select name="a-role" id="a-role" required>
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Faculty" <?php echo $table_rows[0]['type_of_author'] == 'Faculty' ? 'selected': ''?>>Faculty</option>
                                        <option value="Student" <?php echo $table_rows[0]['type_of_author'] == 'Student' ? 'selected': ''?>>Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-gender">Gender</label>
                                        <select name="a-gender" class="a-input-field" id="a-gender" required>
                                            <option value="" hidden>--Choose from the options--</option>
                                            <option value="Male"  <?php echo $table_rows[0]['gender']== 'Male' ? 'selected' : ''?>>Male</option>
                                            <option value="Female"  <?php echo $table_rows[0]['gender']== 'Female' ? 'selected' : ''?>>Female</option>
                                        </select>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="sub-container">
                        <div class="title">
                            <h3>Affiliations</h3>
                            <hr>
                        </div>
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
                                                if(isset($_GET['id'])){
                                                    display_edit_aff($table_rows, $campus_options, $program_options);
                                                }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="form-footer">
                        <input type="submit" class="submit-btn" name="<?php echo isset($_GET['id']) ? 'edit' : 'insert' ?>" value="Submit">
                        <input type="button" class="cancel-btn" value="Cancel">
                    </div>
                </form>
            </div>
        </section>
    </main>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<script src="./new-author.js"></script>
<?php
    include  'functionalities/new-author_includes/affiliations.php';
?>
</body>

