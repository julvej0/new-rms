<?php 
    include '../../../includes/admin/templates/header.php';
    include_once '../../../db/db.php';
?>

<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="new-author.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
<?php
    include '../../../includes/admin/templates/navbar.php';
   
?>
    <main>
        <div class="header">
            <h1 class="title">New Author</h1>
        </div>
        <section>
            <div class="container">
                <form>
                    <div class="sub-container">
                        <div class="title">
                            <h3>Author Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-name">Author Name</label>
                                    <input type="text" placeholder="Author Name" id="a-name" required/>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-role">Role</label>
                                    <select name="a-role" id="a-role" required>
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-gender">Gender</label>
                                        <select name="a-gender" class="a-input-field" id="a-gender" required>
                                            <option value="" hidden>--Choose from the options--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
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
                                <table >
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
                                            </td>
                                           
                                        </tr>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="form-footer">
                        <input type="submit" class="submit-btn" name="submita" value="Submit">
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
    include  'functionalities/php/affiliations.php';
?>
</body>

