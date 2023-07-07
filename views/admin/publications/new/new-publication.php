<title>RMS | NEW PUBLICATIONS</title>
<?php
    include dirname(__FILE__, 5) . '/helpers/db.php';
    include dirname(__FILE__, 5) . '/components/header/header.php';
    include dirname(__FILE__, 5) . '/components/public-user/templates/user-navbar.php'; 
?>
<!-- <link rel="stylesheet" href="../../../css/index.css"> -->
<link rel="stylesheet" href="new-publication.css">

<body>
    <main>
        <div class="header">
            <h1 class="title">New Publication</h1>
        </div>
        <section>
            <div class="container">
                <form name="form-pb" id="form-pb" action="functionalities/button_functions/publication-insert.php" method="POST" onsubmit="return checkDuplicateAuthors()">
                    <div class="sub-container">
                        <div class="title">
                            <h3>Document Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-title">Work Title <span style="color: red;">*</span></label>
                                    <input type="text" placeholder="Work Title" id="pb-title" name="title_of_paper" required/>
                                </div>
                                <div class="form-control">
                                    <label class="pb-label" for="pb-type">Type of Document</label>
                                    <select  name="type_of_publication" id="pb-type">
                                        <option value="" hidden>--Choose from the options--</option>
                                        <option value="Original Article">Original Article</option>
                                        <option value="Review">Review</option>
                                        <option value="Proceedings">Proceedings</option>
                                        <option value="Communication">Communication</option>
                                        <option value="International">International</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="pb-label" for="pb-publisher">Publisher</label>
                                    <input type="text" id="pb-publisher" name="publisher" list="pb-type-list" placeholder="Publisher">
                                    <datalist id="pb-type-list">
                                        <option value="Clarivate">Clarivate</option>
                                        <option value="Silpakorn University">Silpakorn University</option>
                                    </datalist>
                                </div>
                                <div class="form-control">
                                    <label class="pb-label" for="pb-research-area">Research Area</label>
                                    <input type="text" id="pb-research-area" name="research_area" placeholder="Research Area">
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-college">College</label>
                                    <select name="college" class="pb-input-field" id="pb-college">
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
                                    <label class="pb-label" for="pb-campus">Campus</label>
                                    <select name="campus" id="pb-campus">
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
                                <div class="form-control">
                                    <div class="quartile-row">
                                        <div class="quarter">
                                            <label class="pb-label" for="pb-quarter">Quarter</label>
                                            <select name="quartile[]" id="pb-quarter">
                                                <option value="pb-quartile" hidden>--Choose from the options--</option>
                                                <option value="Q1">Quartile 1</option>
                                                <option value="Q2">Quartile 2</option>
                                                <option value="Q3">Quartile 3</option>
                                                <option value="Q4">Quartile 4</option>
                                            </select>
                                        </div>
                                        <div class="quarter-year">
                                            <label class="pb-label" for="pb-quarter-year">Year</label>
                                            <select name="quartile_year[]" id="pb-quarter-year">
                                                <option value="" hidden>-- Select Year --</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                                <option value="2019">2019</option>
                                                <option value="2018">2018</option>
                                                <option value="2017">2017</option>
                                                <option value="2016">2016</option>
                                                <option value="2015">2015</option>
                                                <option value="2014">2014</option>
                                                <option value="2013">2013</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="pb-label" for="pb-date-published">Date Published</label>
                                    <input type="date" max="<?= date('Y-m-d'); ?>" id="pb-date-published" name="date_published" placeholder="Date Published">
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control" id="sdg">
                                    <label class="pb-label" for="sdg_no">SDG (Choose at a maximum of 5):</label>
                                    <div class="checkbox-container">
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="1" id="sdg1" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg1" title="SDG 1: No Poverty">SDG 1</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="2" id="sdg2" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg2" title="SDG 2: Zero Hunger">SDG 2</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="3" id="sdg3" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg3" title="SDG 3: Good Health and Well-Being">SDG 3</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="4" id="sdg4" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg4" title="SDG 4 Quality Education">SDG 4</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="5" id="sdg5" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg5" title="SDG 5: Gender Equality">SDG 5</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="6" id="sdg6" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg6" title="SDG 6: Clean Water and Sanitation">SDG 6</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="7" id="sdg7" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg7" title="SDG 7: Affordable and Clean Energy">SDG 7</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="8" id="sdg8" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg8" title="SDG 8: Decent Work and Economic Growth">SDG 8</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="9" id="sdg9" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg9" title="SDG 9: Industry Innovation and Infrastructure">SDG 9</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="10" id="sdg10" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg10" title="SDG 10: Reduced Inequalities">SDG 10</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="11" id="sdg11" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg11" title="SDG 11: Sustainable Cities and Communities">SDG 11</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="12" id="sdg12" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg12" title="SDG 12: Responsible Consumption and Production">SDG 12</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="13" id="sdg13" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg13" title="SDG 13: Climate Action">SDG 13</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="14" id="sdg14" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg14" title="SDG 14: Life Below Water">SDG 14</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="15" id="sdg15" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg15" title="SDG 15: Life on Land">SDG 15</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="16" id="sdg16" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg16" title="SDG 16: Peace, Justice and Strong Institutions">SDG 16</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="17" id="sdg17" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg17" title="SDG 17: Partnership for the Goals">SDG 17</label>
                                        </div>      
                                        <div class="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-abstract">Abstract</label>
                                    <textarea rows="13" id="pb-abstract" name="abstract" placeholder="Abstract..."></textarea>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-url">Document Url</label>
                                    <input type="url" id="pb-url" name="google_scholar_details" placeholder="Document Url">
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
                                        <input list="authors" name="author_name[]"
                                        style="
                                        width: 100%;
                                        height: 50px;
                                        padding: 10px 36px 10px 16px;
                                        border-radius: 5px;
                                        border: 1px solid var(--dark-grey);"                                        
                                        placeholder="Author Name...">
                                        <datalist id="authors">
                                            <?php
                                        while ($row = pg_fetch_assoc($result)) {
                                            echo '<option value="' . $row['author_name'] . '">' . $row['author_id'] . '</option>';
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
                            <h3>Funding Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="funding-form-container">
                                <label class="funding-titles">Funding Nature </label>
                                <div class="form-control">
                                    <div class="choices">
                                        <input type="radio" name="nature_of_funding" id="funded" value="funded">
                                        <label for="funded" class="funding-choices">Funded</label>
                                    </div>
                                    <div class="choices">
                                        <input type="radio" name="nature_of_funding" id="non-funded" value="non-funded" checked="checked">
                                        <label for="non-funded" class="funding-choices">Non-funded</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="if-funded">If funded : </h4>
                            <div class="funding-form-container">
                                <label class="funding-titles" id="fund-type-label">Fund type </label>
                                <div class="form-control">
                                    <div class="choices">
                                        <input type="radio" name="funding_type" id="internal" value="internal" checked="checked">
                                        <label for="internal" class="funding-choices">Internal</label>
                                    </div>
                                    <div class="choices">
                                        <input type="radio" name="funding_type" id="external" value="external">
                                        <label for="external" class="funding-choices">External</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="if-external">If external : </h4>
                            <div class="funding-form-container2">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-funding-agency" id="pb-funding-label">Funding Agency</label>
                                    <input type="text" name="funding_source" class="pb-input-field" id="pb-funding-agency" placeholder="Funding Agency">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-footer">
                        <input type="submit" class="submit-btn" id="submitBTN" name="submitPB" value="Submit">
                        <input type="hidden" name="submitPB" value="true">
                        <input type="button" class="cancel-btn" value="Cancel">
                    </div>
                </form>
            </div>
        </section>
    </main>
</section>
<script src="new-publication.js"></script>

<?php
    include 'new-publication-js.php';
?>
</body>