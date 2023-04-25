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
                                    <label class="pb-label" for="pb-title">Author Name</label>
                                    <input type="text" placeholder="Author Name" id="pb-title" />
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-type">Role</label>
                                    <select name="pb-type" id="pb-type">
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-college">Gender</label>
                                        <select name="pb-college" class="pb-input-field" id="pb-college" required>
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
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-control author-name">
                                                    <label class="pb-label" for="pb-author-name">Name</label>
                                                    <input type="text" id="pb-author-name" name="pb-author-name" placeholder="Author Name">
                                                </div>
                                                <div class="form-control author-details">
                                                    <label class="pb-label" for="pb-author-type">Role</label>
                                                    <select name="pb-author-type" id="pb-author-type" required>
                                                        <option value="" hidden>--Choose from the options--</option>
                                                        <option value="Main Author">Main Author</option>
                                                        <option value="Co-Author">Co-Author</option>
                                                        <option value="Student">Student</option>
                                                    </select>
                                                </div>
                                                <div class="form-control author-details">
                                                    <label class="pb-label" for="pb-author-gender">Gender</label>
                                                    <select name="pb-author-gender" id="pb-author-gender" required>
                                                        <option value="" hidden>--Choose from the options--</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-control author-details">
                                                    <label class="pb-label" for="pb-author-affil">Affiliation(s)</label>
                                                    <input type="text" id="pb-author-affil" name="pb-author-affil" placeholder="Author Affiliation(s)">
                                                </div>
                                                <button id="pb-add-btn">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="form-footer">
                        <input type="submit" class="submit-btn" name="submitPB" value="Submit">
                        <input type="button" class="cancel-btn" value="Cancel" onclick="history.back(-1)">
                    </div>
                </form>
            </div>
        </section>
    </main>
</section>
<script src="./new-publication.js"></script>
</body>