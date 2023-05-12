<?php
    include '../../../db/db.php';
    include '../../../includes/admin/templates/header.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./new-ip-asset.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <?php
        include '../../../includes/admin/templates/navbar.php';
    ?>
    <main>
        <div class="header">
            <h1 class="title">New IP Assets</h1>
        </div>
        <section>
            <div class="container">
            <form action="functionalities/button_functions/ipa-insert.php" method="POST" enctype="multipart/form-data" onsubmit="return checkDuplicateAuthors();">
                    <div class="sub-container">
                        <div class="title">
                            <h3>Document Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="form-container">
                                <div class="form-control">
                                    <label for="ip-title" class="ip-label">Work Title</label>
                                    <input type="text" placeholder="Work Title..." id="ip-title" name="title_of_work" required/>
                                </div>
                                <div class="form-control">
                                    <label class="ip-label" for="ip-type">Type of Document</label>
                                    <select  name="type_of_ipa" id="ip-type" required>
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Original Article">Original Article</option>
                                        <option value="Review">Review</option>
                                        <option value="Proceedings">Proceedings</option>
                                        <option value="Communication">Communication</option>
                                        <option value="International">International</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="class_of_work">Class of Work</label>
                                    <select class="ipa-input-field" id="class_of_work" name="class_of_work" required>
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="A">Class A</option>
                                        <option value="G">Class G</option>
                                        <option value="O">Class O</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="ipa-campus">Campus</label>
                                    <select name="campus" class="ipa-input-field" required>
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Alangilan">Alangilan</option>
                                        <option value="Balayan">Balayan</option>
                                        <option value="Lemery">Lemery</option>
                                        <option value="Lipa">Lipa</option>
                                        <option value="Lobo">Lobo</option>
                                        <option value="Mabini">Mabini</option>
                                        <option value="Malvar">Malvar-JPCPC</option>
                                        <option value="Nasugbu">Nasugbu-Arasof</option>
                                        <option value="Pablo Borbon (Main I)">Pablo Borbon</option>
                                        <option value="Padre Garcia">Padre Garcia</option>
                                        <option value="Rosario">Rosario</option>
                                        <option value="San Juan">San Juan</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="ipa-label" for="program">Program</label>
                                    <select name="program" class="ipa-input-field" required>
                                            <option value="" hidden>--Choose from the options--</option>
                                            <option value="Accountancy, Business, and International Hospitality">Accountancy, Business, and International Hospitality</option>
                                            <option value="Agriculture and Forestry">Agriculture and Forestry</option>
                                            <option value="Arts and Sciences">Arts and Sciences</option>
                                            <option value="Basic Education">Basic Education</option>
                                            <option value="College of Medicine">College of Medicine</option>
                                            <option value="Engineering, Architecture and Fine Arts">Engineering, Architecture and Fine Arts</option>
                                            <option value="ETEEAP">ETEEAP</option>
                                            <option value="Informatics and Computing Sciences">Informatics and Computing Sciences</option>
                                            <option value="Industrial Technology">Industrial Technology</option>
                                            <option value="Law">Law</option>
                                            <option value="Nursing, Nutrition and Dietetics">Nursing, Nutrition and Dietetics</option>
                                            <option value="Teacher Education">Teacher Education</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="college">College</label>
                                    <input type="text" class="ipa-input-field" id="college" name="college" placeholder="College..." required>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="date-of-creation">Date of Creation</label>
                                    <input type="date" max="<?= date('Y-m-d'); ?>" id="date-of-creation" name="date_of_creation" required>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="hyperlink">Hyperlink</label>
                                    <input type="text" class="ipa-input-field" id="hyperlink" name="hyperlink" placeholder="URL...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sub-container">
                        <div class="title">
                            <h3>Author Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="author-table-container">
                            <table id="author-tbl">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="author-tbl-body">
                                <tr>
                                    <td class="ipa-author-field">
                                        <?php
                                        $query = "SELECT author_id, author_name FROM table_authors";
                                        $params = array();
                                        $result = pg_query_params($conn, $query, $params);
                                                                            
                                        echo '<select list="authors" name="author_id[]"
                                        style="
                                        width: 100%;
                                        height: 50px;
                                        padding: 10px 36px 10px 16px;
                                        border-radius: 5px;
                                        border: 1px solid var(--dark-grey);"
                                        onchange="showAuthorId(this)"
                                        required>';
                                        echo '<datalist id="authors">';
                                        echo '<option hidden name="author_id[]" value="">Select an Author...</option>';
                                        while ($row = pg_fetch_assoc($result)) {
                                            echo '<option name="author_id[]" value="' . $row['author_id'] . '">' . $row['author_name'] . '</option>';
                                        }
                                        echo '</datalist>';
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="add-row-btn" style="height: 50px;">+</button>
                                    </td>
                                </tr>
                                <div id="error-msg" style="display: none; color: red;">Duplicate author names are not allowed!</div>
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="sub-container">
                        <div class="title">
                            <h3>Registration Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="reg-form-container">
                                <label class="reg-titles">Registered?</label>
                                <div class="form-control">
                                    <div class="choices">
                                        <input type="radio" name="registerInfo" id="registered" value="registered" required>
                                        <label for="registered" class="reg-choices">Yes</label>
                                    </div>
                                    <div class="choices">
                                        <input type="radio" name="registerInfo" id="not-registered" value="not-registered" required>
                                        <label for="not-registered" class="reg-choices">No</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="if-funded">If Registered : </h4>
                            <div class="reg-form-container2">
                                <div class="form-control">
                                    <label class="ip-label" for="reg_num">Registration Number:</label>
                                    <input type="text" name="registration_number" id="reg_num" placeholder="Registration Number..." required>
                                </div>
                                <div class="form-control">
                                    <label class="ip-label" for="reg-date">Date of Registration</label>
                                    <input type="date" max="<?= date('Y-m-d'); ?>" name="date_registered" id="reg-date" required>
                                </div>
                                <div class="form-control">
                                    <label class="ip-label" for="ip-certificate" id="ip-certificate">Upload Certificate</label>
                                    <input type="file" name="ip-certificate" id="ip-certificate" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                        </div>
                    </div>
                 <hr>
                <div class="form-footer">
                    <input type="submit" class="submit-btn" name="submitIPA" value="Submit">
                    <input type="button" class="cancel-btn" value="Cancel">
                </div>
            </form>
            </div>
        </section>
    </main>
<script src="./new-ip-asset.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
</body>
<?php
    include 'new-ip-asset-js.php';
    include '../../../includes/admin/templates/footer.php';
?>