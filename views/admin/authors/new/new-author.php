<?php
    include dirname(__FILE__, 5) . '/helpers/db.php';
    include dirname(__FILE__, 5) . '/components/header/header.php';
    include dirname(__FILE__, 5) . '/components/public-user/templates/user-navbar.php'; 
?>

<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="new-author.css">

<body>
    <?php
        include_once '../functionalities/new-author_includes/display_edit_author.php'; //display data if id exists 
        include_once '../functionalities/new-author_includes/options.php'; // options for select input
    ?>
    <section>
        <main>
            <div class="header">
                <h1 class="title"><?php echo isset($_GET['id'])? 'Edit Author': 'New Author'?></h1>
            </div>
            <section>
                <div class="container">
                    <form name="form-author" onsubmit="return checkData(event)"
                        action="<?php echo isset($_GET['id']) ? '../functionalities\authors_query\edit_author.php' : '../functionalities\authors_query\insert_author.php' ?>"
                        method="POST">
                        <div class="sub-container">
                            <div class="title">
                                <h3>Author Details</h3>
                                <hr>
                            </div>
                            <div class="form-col">
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="a-label" for="a-name">Author Name</label>
                                        <input required type="text" placeholder="Author Name" id="a-name" name="a-name"
                                            value="<?php echo isset($_POST['a-name']) ? $_POST['a-name'] : $author_info_arr[0]['author_name'] ?>">
                                        <input type="text" id="a-id" name="a-id"
                                            value="<?php echo $author_info_arr[0]['author_id']?>" hidden readonly>
                                    </div>
                                </div>
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="a-label" for="a-name">Email</label>
                                        <input list="user-email" id="a-email" name="a-email" placeholder="Email..."
                                        value=" <?php echo $author_info_arr[0]['email']?>">
                                            
                                        </input>
                                        <!--The input field to be submitted to the insert SQL query-->
                                        <input type="text" id="a-id" name="a-id"
                                            value="<?php echo $author_info_arr[0]['author_id']?>" hidden readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="a-label" for="a-role">Role</label>
                                        <select name="a-role" id="a-role">
                                            <option value="" hidden>--Choose from the options--</option>
                                            <option value="Faculty"
                                                <?php echo $author_info_arr[0]['type_of_author'] == 'Faculty' ? 'selected': ''?>>
                                                Faculty
                                            </option>
                                            <option value="Student"
                                                <?php echo $author_info_arr[0]['type_of_author'] == 'Student' ? 'selected': ''?>>
                                                Student</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="a-label" for="a-gender">Gender</label>
                                        <select name="a-gender" class="a-input-field" id="a-gender">
                                            <option value="" hidden>--Choose from the options--</option>
                                            <option value="Male"
                                                <?php echo $author_info_arr[0]['gender']== 'Male' ? 'selected' : ''?>>
                                                Male
                                            </option>
                                            <option value="Female"
                                                <?php echo $author_info_arr[0]['gender']== 'Female' ? 'selected' : ''?>>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="sub-container">
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
                                                                <button type="button" class="affiliation-sub-button"
                                                                    id="internal-btn">Internal</button>
                                                                <button type="button" class="affiliation-sub-button"
                                                                    id="external-btn">External</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                if(isset($_GET['id'])){
                                                    display_edit_aff($author_info_arr, $campus_options, $program_options);
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                        <div class="sub-container">
                            <div class="title">
                                <h3>Affiliations</h3>
                                <hr>
                            </div>
                            <div class="form-col">
                            <div class="form-container">
                                    <div class="form-control">
                                        <select name="a-affiliation" class="a-input-field" id="a-affiliation">
                                            <option value="" hidden>--Choose from the options--</option>
                                            <option value="internal"
                                                <?php echo $author_info_arr[0]['internal']== 'internal' ? 'selected' : ''?>> Internal
                                            </option>
                                            <option value="external"
                                                <?php echo $author_info_arr[0]['external']== 'external' ? 'selected' : ''?>>External
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-footer">
                            <input type="submit" class="submit-btn"
                                name="<?php echo isset($_GET['id']) ? 'edit' : 'insert' ?>" value="Submit">
                            <input type="button" class="cancel-btn" value="Cancel">
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </section>

    <script src="./new-author.js"></script>
    <!-- <?php
        include  '../functionalities/new-author_includes/affiliations.php'; //script for affiliation table functions
    ?> -->
</body>