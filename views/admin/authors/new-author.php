<?php 
    include '../../../includes/admin/templates/header.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="new-author.css">

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
                                    <input type="text" placeholder="Author Name" id="a-name" />
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-role">Role</label>
                                    <select name="a-role" id="a-role">
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="a-label" for="a-gender">Gender</label>
                                        <select name="a-gender" class="a-input-field" id="a-gender">
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
                                            <td>
                                                <div class="form-control aff-info">
                                                    <label class="a-label" for="a-aff-dept">Department</label>
                                                    <input type="text" id="a-aff-dept" name="a-aff-dept" placeholder="Department">
                                                </div>
                                                <div class="form-control aff-categ">
                                                    <label class="a-label" for="a-aff-prog">Program</label>
                                                    <select name="a-aff-prog" id="a-aff-prog" >
                                                        <option value="" hidden>--Choose from the options--</option>
                                                        <option value="Main Author">Main Author</option>
                                                        <option value="Co-Author">Co-Author</option>
                                                        <option value="Student">Student</option>
                                                    </select>
                                                </div>
                                                <div class="form-control aff-categ">
                                                    <label class="a-label" for="a-aff-camp">Campus</label>
                                                    <select name="a-aff-camp" id="a-aff-camp" >
                                                        <option value="" hidden>--Choose from the options--</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="a-remove-btn">x</button>
                                                
                                            </td>
                                            <td>
                                                <div class="form-control aff-info">
                                                    <label class="a-label" for="a-ex-aff">External Affiliation</label>
                                                    <input  type="text" id="a-ex-aff" name="a-ex-aff" placeholder="Affiliation">
                                                </div>                                               
                                                <button type="button" class="a-remove-btn">x</button>
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
                        <input type="button" class="cancel-btn" value="Cancel" onclick="history.back(-1)">
                    </div>
                </form>
            </div>
        </section>
    </main>
</section>
<?php
    include  'functionalities/php/affiliations.php';
?>
</body>

