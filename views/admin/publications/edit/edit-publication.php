<?php
include dirname(__FILE__, 5) . '/helpers/db.php';
include dirname(__FILE__, 5) . '/components/header/header.php';
include dirname(__FILE__, 5) . '/components/public-user/templates/user-navbar.php';
include_once dirname(__FILE__, 4) . '/helpers/utils/utils-publication.php';
include_once dirname(__FILE__, 4) . '/helpers/utils/utils-author.php';
if (isset($_POST['edit'])) {
    ?>
    <link rel="stylesheet" href="../../../../css/index.css">
    <link rel="stylesheet" href="../../publications/new/new-publication.css">
    <link rel="stylesheet" href="../new/modal.css">

    <body>
        <!-- <?php
        include '../../../includes/admin/templates/navbar.php';
        ?> -->
        <main>
            <div class="header">
                <h1 class="title">Publication Edit</h1>
            </div>
            <section>
                <div class="container">
                    <?php
                    $publicationID = $_POST['row_id'];
                    $publication_data = getPublicationById($publicationurl, $publicationID);
                    $row = $publication_data;
                    ?>
                    <form name="form-pb" id="form-pb" action="../functionalities/button_functions/publication-edit.php"
                        method="POST" onsubmit="return checkDuplicateAuthors();">
                        <div class="sub-container">
                            <div class="title">
                                <h3>Document Details</h3>
                                <hr>
                            </div>
                            <div class="form-col">
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-title">Work Title <span
                                                style="color: red;">*</span></label>
                                        <input type="text" placeholder="Work Title" id="pb-title" name="title_of_paper"
                                            value="<?= $row['title_of_paper'] ?>" required />
                                    </div>
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-type">Type of Document</label>
                                        <select name="type_of_publication" id="pb-type">
                                            <option
                                                value="<?= isset($row['type_of_publication']) ? $row['type_of_publication'] : "" ?>"
                                                hidden>
                                                <?= isset($row['type_of_publication']) ? $row['type_of_publication'] : "" ?>
                                            </option>
                                            <option value="Original Article">Original Article</option>
                                            <option value="Review">Review</option>
                                            <option value="Proceedings">Proceedings</option>
                                            <option value="Communication">Communication</option>
                                            <option value="International">International</option>
                                        </select>
                                    </div>
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-publisher">Publisher</label>
                                        <input type="text" id="pb-publisher" name="publisher" list="pb-type-list"
                                            placeholder="Publisher"
                                            value="<?= isset($row['publisher']) ? $row['publisher'] : "" ?>">
                                        <datalist id="pb-type-list">
                                            <option value="Clarivate">Clarivate</option>
                                            <option value="Silpakorn University">Silpakorn University</option>
                                        </datalist>
                                    </div>
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-research-area">Research Area</label>
                                        <input type="text" id="pb-research-area" name="research_area"
                                            placeholder="Research Area"
                                            value="<?= isset($row['department']) ? $row['department'] : "" ?>">
                                    </div>
                                </div>
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-college">College</label>
                                        <select name="college" class="pb-input-field" id="pb-college">
                                            <option value="<?= isset($row['college']) ? $row['college'] : "" ?>" hidden>
                                                <?= isset($row['college']) ? $row['college'] : "" ?>
                                            </option>
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
                                        <label class="pb-label" for="pb-campus"
                                            value="<?= isset($row['campus']) ? $row['campus'] : "" ?>">Campus</label>
                                        <select name="campus" id="pb-campus">
                                            <option value="<?= isset($row['campus']) ? $row['campus'] : "" ?>" hidden>
                                                <?= $row['campus'] ?>
                                            </option>
                                            <option value="Alangilan (Main II)">Alangilan (Main II)</option>
                                            <option value="Balayan">Balayan</option>
                                            <option value="Lemery">Lemery</option>
                                            <option value="Lipa">Lipa</option>
                                            <option value="Lobo">Lobo</option>
                                            <option value="Mabini">Mabini</option>
                                            <option value="Malvar">Malvar-JPCPC</option>
                                            <option value="Nasugbu">Nasugbu-Arasof</option>
                                            <option value="Pablo Borbon (Main I)">Pablo Borbon (Main I)</option>
                                            <option value="Padre Garcia">Padre Garcia</option>
                                            <option value="Rosario">Rosario</option>
                                            <option value="San Juan">San Juan</option>
                                        </select>
                                    </div>
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-quarter">Quarter (e.g. Q1_2023)</label>
                                        <input type="text" name="pb-quartile" class="pb-select-field" id="pb-quarter"
                                            value="<?= isset($row['quartile']) ? $row['quartile'] : "" ?>"></input>
                                    </div>
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-date-published">Date Published</label>
                                        <input type="date" max="<?= date('Y-m-d'); ?>" id="pb-date-published"
                                            name="date_published" placeholder="Date Published"
                                            value="<?= isset($row['date_published']) ? date_format(new DateTime($row['date_published']), "Y-m-d") : '' ?>">
                                    </div>
                                </div>
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="pb-label" for="sdg_no">SDG (Choose at a maximum of 5):</label>
                                        <div class="checkbox-container">
                                            <?php
                                            $sdg_array = explode(",", isset($row['sdg_no']) ? $row['sdg_no'] : "");
                                            ?>
                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="1" id="sdg1"
                                                    onclick="limitSelection()" 
                                                    <?php if (in_array('1', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg1" title="SDG 1: No Poverty">SDG
                                                    1</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="2" id="sdg2"
                                                    onclick="limitSelection()" <?php if (in_array('2', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg2" title="SDG 2: Zero Hunger">SDG
                                                    2</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="3" id="sdg3"
                                                    onclick="limitSelection()" <?php if (in_array('3', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg3"
                                                    title="SDG 3: Good Health and Well-Being">SDG 3</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="4" id="sdg4"
                                                    onclick="limitSelection()" <?php if (in_array('4', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg4" title="SDG 4 Quality Education">SDG
                                                    4</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="5" id="sdg5"
                                                    onclick="limitSelection()" <?php if (in_array('5', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg5" title="SDG 5: Gender Equality">SDG
                                                    5</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="6" id="sdg6"
                                                    onclick="limitSelection()" <?php if (in_array('6', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg6"
                                                    title="SDG 6: Clean Water and Sanitation">SDG 6</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="7" id="sdg7"
                                                    onclick="limitSelection()" <?php if (in_array('7', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg7"
                                                    title="SDG 7: Affordable and Clean Energy">SDG 7</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="8" id="sdg8"
                                                    onclick="limitSelection()" <?php if (in_array('8', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg8"
                                                    title="SDG 8: Decent Work and Economic Growth">SDG 8</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="9" id="sdg9"
                                                    onclick="limitSelection()" <?php if (in_array('9', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg9"
                                                    title="SDG 9: Industry Innovation and Infrastructure">SDG 9</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="10" id="sdg10"
                                                    onclick="limitSelection()" <?php if (in_array('10', $sdg_array))
                                                        echo 'checked="checked"'; ?>>
                                                <label class="sdg-checkbox" for="sdg10"
                                                    title="SDG 10: Reduced Inequalities">SDG 10</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="11" id="sdg11"
                                                    onclick="limitSelection()" <?= in_array('11', $sdg_array) ? 'checked' : ''; ?>>
                                                <label class="sdg-checkbox" for="sdg11"
                                                    title="SDG 11: Sustainable Cities and Communities">SDG 11</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="12" id="sdg12"
                                                    onclick="limitSelection()" <?= in_array('12', $sdg_array) ? 'checked' : ''; ?>>
                                                <label class="sdg-checkbox" for="sdg12"
                                                    title="SDG 12: Responsible Consumption and Production">SDG 12</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="13" id="sdg13"
                                                    onclick="limitSelection()" <?= in_array('13', $sdg_array) ? 'checked' : ''; ?>>
                                                <label class="sdg-checkbox" for="sdg13" title="SDG 13: Climate Action">SDG
                                                    13</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="14" id="sdg14"
                                                    onclick="limitSelection()" <?= in_array('14', $sdg_array) ? 'checked' : ''; ?>>
                                                <label class="sdg-checkbox" for="sdg14" title="SDG 14: Life Below Water">SDG
                                                    14</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="15" id="sdg15"
                                                    onclick="limitSelection()" <?= in_array('15', $sdg_array) ? 'checked' : ''; ?>>
                                                <label class="sdg-checkbox" for="sdg15" title="SDG 15: Life on Land">SDG
                                                    15</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="16" id="sdg16"
                                                    onclick="limitSelection()" <?= in_array('16', $sdg_array) ? 'checked' : ''; ?>>
                                                <label class="sdg-checkbox" for="sdg16"
                                                    title="SDG 16: Peace, Justice and Strong Institutions">SDG 16</label>
                                            </div>

                                            <div class="checkbox-col">
                                                <input type="checkbox" name="sdg_no[]" value="17" id="sdg17"
                                                    onclick="limitSelection()" <?= in_array('17', $sdg_array) ? 'checked' : ''; ?>>
                                                <label class="sdg-checkbox" for="sdg17"
                                                    title="SDG 17: Partnership for the Goals">SDG 17</label>
                                            </div>

                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-container">
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-url">Document Url</label>
                                        <input type="url" id="pb-url" name="google_scholar_details"
                                            placeholder="Document Url"
                                            value="<?= isset($row['google_scholar_details']) ? $row['google_scholar_details'] : "" ?>">
                                    </div>
                                </div>
                                <div class="form-container">
                                    <div class="form-control"></div>
                                    <label class="pb-label" for="pb-abstract">Abstract</label>
                                    <textarea cols="30" rows="10" type textarea id="pb-abstract" name="abstract"
                                        placeholder="Abstract..."><?= isset($row['abstract']) ? $row['abstract'] : "" ?></textarea>
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
                                            <?php
                                            $author_list = isset($row["authors"]) ? $row["authors"] : "";
                                            $authors = explode(",", $author_list);
                                            foreach ($authors as $author) {
                                                $authorData = getAuthorById($authorurl, $author);
                                                $author_list_row = isset($authorData) ? $authorData : "";
                                                if ($author_list_row != "") {
                                                    echo '
                                                    <tr>
                                                        <td class="ipa-author-field">
                                                            <input list="authors" name="author_name[]"
                                                            style="
                                                            width: 100%;
                                                            height: 50px;
                                                            padding: 10px 36px 10px 16px;
                                                            border-radius: 5px;
                                                            border: 1px solid var(--dark-grey);"
                                                            placeholder="Author Name..."
                                                            value="' . $author_list_row['author_name'] . '" id="pub-author">';
                                                    echo '<datalist id="authors">';
                                                    $params = array();
                                                    $result = getAuthors($authorurl);
                                                    foreach ($result as $key => $author_row) {
                                                        echo '<option value="' . $author_row['author_name'] . '" id="option">' . $author_row['author_id'] . '</option>';
                                                    }
                                                    echo '</datalist>';
                                                    echo '
                                                        </td>
                                                        <td class="ipa-author-field" style="text-align:center;">
                                                            <button name="remove" style="height: 50px; width:3.7rem; border-radius: 5px; border: none; padding: 0 20px; background: var(--primary); color: var(--light); font-size: 25px; font-weight: 600; cursor: pointer; letter-spacing: 1px; font-weight: 600;" id="remove">
                                                                <i class="fas fa-xmark fa-xs"></i>
                                                            </button>
                                                        </td>
                                                    </tr>';
                                                    // }
                                                }
                                            }
                                            ?>
                                        </tbody>

                                        <td style="text-align: center;" colspan="2">
                                            <button type="button" class="add-row-btn"
                                                style="height: 50px; width: 10%;">+</button>
                                        </td>
                                        <div id="error-msg" style="display: none; color: red;">Duplicate author names are
                                            not allowed!</div>
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
                                    <label class="funding-titles">Funding Nature</label>
                                    <div class="form-control">
                                        <div class="choices">
                                            <input type="radio" name="nature_of_funding" id="funded" value="funded"
                                                <?= (isset($row['nature_of_funding']) ? $row['nature_of_funding'] : "" == 'funded') ? 'checked="checked"' : ''; ?>>
                                            <label for="funded" class="funding-choices">Funded</label>
                                        </div>
                                        <div class="choices">
                                            <input type="radio" name="nature_of_funding" id="non-funded" value="non-funded"
                                                <?= (isset($row['nature_of_funding']) ? $row['nature_of_funding'] : "" != 'funded') ? 'checked="checked"' : ''; ?>>
                                            <label for="non-funded" class="funding-choices">Non-funded</label>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="if-funded">If funded : </h4>
                                <div class="funding-form-container">
                                    <label class="funding-titles" id="fund-type-label">Fund type </label>
                                    <div class="form-control">
                                        <div class="choices">
                                            <input type="radio" name="funding_type" id="internal" value="internal"
                                                <?= ((isset($row['funding_type']) ? $row['funding_type'] : "") == 'internal') ? 'checked="checked"' : ''; ?>>
                                            <label for="internal" class="funding-choices">Internal</label>
                                        </div>
                                        <div class="choices">
                                            <input type="radio" name="funding_type" id="external" value="external"
                                                <?= ((isset($row['funding_type']) ? $row['funding_type'] : "") == 'external') ? 'checked="checked"' : ''; ?>>
                                            <label for="external" class="funding-choices">External</label>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="if-external">If external : </h4>
                                <div class="funding-form-container2">
                                    <div class="form-control">
                                        <label class="pb-label" for="pb-funding-agency" id="pb-funding-label">Funding
                                            Agency</label>
                                        <input type="text" name="funding_source" class="pb-input-field"
                                            id="pb-funding-agency" placeholder="Funding Agency"
                                            value="<?= isset($row['funding_source']) ? $row['funding_source'] : "" ?>"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-footer">
                            <input type="submit" class="submit-btn" name="updatePB" value="Submit">
                            <input type="hidden" name="pubID" value="<?= $row['publication_id'] ?>">
                            <input type="hidden" name="updatePB" value="true">
                            <input type="button" class="cancel-btn" value="Cancel">
                        </div>
                    </form>
                </div>
            </section>
        </main>
        </section>
        <div id="myModal" class="modal">
        <div class="modal-container">
            <span class="close">&times;</span>
            <h2>Author not found.</h2>
            <div class="modal-content">
                 <div class="modal-body" id="modalBody">

                </div>
                <button type="button" id="close-btn" class="exit">Close</button>
            </div>
        </div>
    </div>
    
    </body>
    <script src="edit-publication.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
    include '../new/new-publication-js.php';
} else {
    header("Location: ../../publications.php");
}
?>