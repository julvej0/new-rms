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
            <h1 class="title">New Publication</h1>
        </div>
        <section>
            <div class="container">
            <form action="functionalities/ipa-insert.php" method="POST">
                    <div class="sub-container">
                        <div class="title">
                            <h3>Document Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="form-container">
                                <div class="form-control">
                                    <label for="ip-title" class="ip-label">Work Title</label>
                                    <input type="text" placeholder="Work Title" id="ip-title" name="title_of_paper" required/>
                                </div>
                                <div class="form-control">
                                    <label class="ip-label" for="ip-type">Type of Document</label>
                                    <select  name="type_of_ip" id="ip-type" required>
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
                                    <select class="ipa-input-field" id="class_of_work" name="class_of_work">
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value=" Class A">Class A</option>
                                        <option value="Class G">Class G</option>
                                        <option value="Class O">Class O</option>
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
                                    <input type="text" class="ipa-input-field" id="college" name="college" placeholder="college">
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="date-creation">Date of Creation</label>
                                    <input type="date" id="date-creation" names="date-creation" placeholder="Date Creation">
                                </div>
                                <div class="form-control">
                                    <label class="ipa-label" for="hyperlink">Hyperlink</label>
                                    <input type="text" class="ipa-input-field" id="hyperlink" name="hyperlink" placeholder="URL">
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
                                                <!-- <div class="form-control author-details">
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
                                                </div> -->
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
                                                                            
                                        echo '<input list="authors" name="author_name[]"
                                        style="
                                        width: 100%;
                                        height: 50px;
                                        padding: 10px 36px 10px 16px;
                                        border-radius: 5px;
                                        border: 1px solid var(--dark-grey);"
                                        onchange="showAuthorId(this)"
                                        placeholder="Author Name...">';
                                        echo '<datalist id="authors">';
                                        while ($row = pg_fetch_assoc($result)) {
                                            echo '<option value="' . $row['author_name'] . '">' . $row['author_id'] . '</option>';
                                        }
                                        echo '</datalist>';
                                        ?>
                                        <input type="hidden" name="author_id[]" class="author-id-input">
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="add-row-btn" style="height: 50px;">+</button>
                                    </td>
                                </tr>
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
                                        <input type="radio" name="registerInfo" id="registered" value="registered">
                                        <label for="registered" class="reg-choices">Yes</label>
                                    </div>
                                    <div class="choices">
                                        <input type="radio" name="registerInfo" id="not-registered" value="not-registered" checked="checked">
                                        <label for="not-registered" class="reg-choices">No</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="if-funded">If Registered : </h4>
                            <div class="reg-form-container2">
                                <div class="form-control">
                                    <label class="ip-label" for="reg-date" id="reg-date">Date of Registration</label>
                                    <input type="date" name="reg_date" id="reg-date" required>
                                </div>
                                <div class="form-control">
                                    <label class="ip-label" for="ip-certificate" id="ip-certificate">Upload Certificate</label>
                                    <input type="file" name="ip-certificate" id="ip-certificate" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                 <hr>
                <div class="form-footer">
                    <input type="submit" class="submit-btn" name="submitPB" value="Submit">
                    <input type="button" class="cancel-btn" value="Cancel">
                </div>
            </div>
        </section>
    </main>
<script src="./new-ip-asset.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
            //Author ID table workaround.
            function showAuthorId(input) {
                var authorName = input.value;
                var authorId = "";
                var options = input.list.options;
                for (var i = 0; i < options.length; i++) {
                    var option = options[i];
                    if (option.value === authorName) {
                        authorId = option.text;
                        break;
                    }
                }
                $(input).closest('tr').find('.author-id-input').val(authorId);
            }

            var max =15; //max number of Authors
            var x =1; //represents the 1st author field
            var rowHtml = '<tr>\
                                    <td class="ipa-author-field">\
                                        <?php
                                        $query = "SELECT author_id, author_name FROM table_authors";
                                        $params = array();
                                        $result = pg_query_params($conn, $query, $params);
                                        echo '<input list="authors" name="author_name[]" style="width: 100%; height: 50px; padding: 10px 36px 10px 16px; border-radius: 5px; border: 1px solid var(--dark-grey);" onchange="showAuthorId(this)">';
                                        echo '<datalist id="authors">';
                                        while ($row = pg_fetch_assoc($result)) {
                                            echo '<option value="' . $row['author_name'] . '">' . $row['author_id'] . '</option>';
                                        }
                                        echo '</datalist>';
                                        ?>
                                        <input type="hidden" name="author_id[]" class="author-id-input">\
                                    </td>\
                                    <td class="ipa-author-field" style="text-align:center;"><button name="remove" style="height: 50px; width:3.7rem; border-radius: 5px; border: none; padding: 0 20px; background: var(--primary); color: var(--light); font-size: 25px; font-weight: 600; cursor: pointer; letter-spacing: 1px; font-weight: 600;"id="remove"><i class="fa-solid fa-xmark fa-xs"></i></button> </td>\
                                </tr>';
            $('.add-row-btn').click(function(){
                if (x < max) {
                $('#author-tbl-body').append(rowHtml);
                x++;
                    }

                //Remove row function
                $('#author-tbl').on('click','#remove',function(){
                    $(this).closest('tr').remove();
                    x--;
                });
            });
        </script>
</body>
<?php
    include '../../../includes/admin/templates/footer.php';
?>