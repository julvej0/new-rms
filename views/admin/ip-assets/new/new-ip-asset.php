<title>RMS | NEW IPASSETS</title>
<?php
include dirname(__FILE__, 5) . '/components/header/header.php';
include dirname(__FILE__, 5) . '/helpers/db.php';
?>
<link rel="stylesheet" href="../../../../css/index.css">
<link rel="stylesheet" href="./new-ip-asset.css">

<body>
    <?php
    include dirname(__FILE__, 5) . '/components/public-user/templates/user-navbar.php';
    ?>
    <main>
        <div class="header">
            <h1 class="title">New IP Asset</h1>
        </div>
        <section>
            <div class="container">
                <form name="form-ipa" id="form-ipa" action="./functionalities/ipa-insert.php" method="POST"
                    enctype="multipart/form-data" onsubmit="return checkDuplicateAuthors()">
                    <div class="sub-container">
                        <div class="title">
                            <h3>Document Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="form-container">
                                <div class="form-control">
                                    <label for="ip-title" class="ip-label">Work Title <span
                                            style="color: red;">*</span></label>
                                    <input type="text" placeholder="Work Title..." id="ip-title" name="title_of_work"
                                        required />
                                </div>
                                <div class="form-control">
                                    <label class="ip-label" for="ip-type">Type of IP</label>
                                    <select name="type_of_ipa" id="ip-type">
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Invention">Invention</option>
                                        <option value="Utility Model">Utility Model</option>
                                        <option value="Industrial Design">Industrial Design</option>
                                        <option value="Trademark">Trademark</option>
                                        <option value="Copyright">Copyright</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="class_of_work">Class of Work</label>
                                    <select class="ipa-input-field" id="class_of_work" name="class_of_work">
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="A">Class A</option>
                                        <option value="G">Class G</option>
                                        <option value="O">Class O</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="ipa-campus">Campus</label>
                                    <select name="campus" class="ipa-input-field">
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
                                    <select name="program" class="ipa-input-field">
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Accountancy, Business, and International Hospitality">
                                            Accountancy, Business, and International Hospitality</option>
                                        <option value="Agriculture and Forestry">Agriculture and Forestry</option>
                                        <option value="Arts and Sciences">Arts and Sciences</option>
                                        <option value="Basic Education">Basic Education</option>
                                        <option value="College of Medicine">College of Medicine</option>
                                        <option value="Engineering, Architecture and Fine Arts">Engineering,
                                            Architecture and Fine Arts</option>
                                        <option value="ETEEAP">ETEEAP</option>
                                        <option value="Informatics and Computing Sciences">Informatics and Computing
                                            Sciences</option>
                                        <option value="Industrial Technology">Industrial Technology</option>
                                        <option value="Law">Law</option>
                                        <option value="Nursing, Nutrition and Dietetics">Nursing, Nutrition and
                                            Dietetics</option>
                                        <option value="Teacher Education">Teacher Education</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="college">College</label>
                                    <input type="text" class="ipa-input-field" id="college" name="college"
                                        placeholder="College...">
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="date-of-creation">Date of Creation</label>
                                    <input type="date" max="<?= date('Y-m-d'); ?>" id="date-of-creation"
                                        name="date_of_creation">
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="hyperlink">Hyperlink</label>
                                    <input type="text" class="ipa-input-field" id="hyperlink" name="hyperlink"
                                        placeholder="URL...">
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
                                                ?>
                                                <input list="authors" name="author_name[]" style="
                                            width: 100%;
                                            height: 50px;
                                            padding: 10px 36px 10px 16px;
                                            border-radius: 5px;
                                            border: 1px solid var(--dark-grey);" placeholder="Author Name...">
                                                <datalist id="authors">
                                                    <?php
                                                    while ($row = pg_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['author_name'] . '">' . $row['author_id'] . '</option>';
                                                    }
                                                    echo '</datalist>';
                                                    ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="add-row-btn"
                                                    style="height: 50px;">+</button>
                                            </td>
                                        </tr>
                                        <!-- Display an error message if duplicate author names are entered -->
                                        <div id="error-msg" style="display: none; color: red;">Duplicate author names
                                            are not allowed!</div>
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
                                <label class="reg-titles">Registered? <span style="color: red;">*</span></label>
                                <div class="form-control">
                                    <div class="choices radio-register">
                                        <input type="radio" onclick="RegisterRadio()" name="registerInfo" id="registered" value="registered"required>
                                        <label for="registered" class="reg-choices">Yes</label>
                                    </div>
                                    <div class="choices">
                                        <input type="radio" onclick="RegisterRadio()" name="registerInfo" id="not-registered"
                                            value="not-registered" required>
                                        <label for="not-registered" class="reg-choices">No</label>
                                    </div>
                                </div>
                            </div>
                            <div id="show-register" class="reg-form-container2" style="display:none">
                                <h4 id="show-register">If Registered : </h4>
                                <div class="reg-form-container2"  >
                                    <div class="form-control">

                                        <!-- Registration Number input field -->
                                        <label class="ip-label" for="reg_num">Registration Number: <span
                                                style="color: red;">*</span><span id="regnum-error"
                                                style="display: none; color: red;">This registration number already exists!</span></label>
                                        <input type="text" name="registration_number" id="reg_num"
                                            placeholder="Registration Number..." required>
                                        <?php
                                        // Fetch existing registration numbers from the database
                                        $regnum_query = "SELECT registration_number FROM table_ipassets";
                                        $regnum_params = array();
                                        $regnum_result = pg_query_params($conn, $regnum_query, $regnum_params);
                                        ?>
                                        <input type="hidden" list="regnums" id="db_regnum">
                                        <datalist id="regnums">
                                            <?php
                                            // Display existing registration numbers as datalist options
                                            while ($regnum_row = pg_fetch_assoc($regnum_result)) {
                                                echo '<option value="' . $regnum_row['registration_number'] . '"></option>';
                                            }
                                            echo '</datalist>';
                                            ?>
                                    </div>

                                    <div class="form-control">
                                        <label class="ip-label" for="reg-date">Date of Registration: </label>
                                        <input type="date" max="<?= date('Y-m-d'); ?>" name="date_registered" id="reg-date">
                                    </div>
                                    <div class="form-control">
                                        <label class="ip-label" for="ip-certificate">Upload Certificate: <span
                                                id="file-error" style="display: none; color: red;">Only PNG, JPG, JPEG, and
                                                PDF file types are allowed!</span></label>
                                        <input type="file" name="ip-certificate" id="ip-certificate-input"
                                            onchange="checkFileType(this)" accept=".png, .jpg, .jpeg, .pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-footer">
                        <input type="submit" class="submit-btn" id="submitBTN" name="submitIPA" value="Submit">
                        <input type="hidden" name="submitIPA" value="true">
                        <input type="button" class="cancel-btn add-mode" value="Cancel">
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="./new-ip-asset.js"></script>
</body>
<?php
include './new-ip-asset-js.php';
include dirname(__FILE__, 5) . '/components/footer/footer.php';
?>