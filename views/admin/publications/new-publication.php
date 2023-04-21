<?php 
    include '../../../includes/admin/templates/header.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="new-publication.css">

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
                <form>
                    <div class="sub-container">
                        <div class="title">
                            <h3>Document Details</h3>
                            <hr>
                        </div>
                        <div class="form-col">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-title">Work Title</label>
                                    <input type="text" placeholder="Work Title" id="pb-title" />
                                </div>
                                <div class="form-control">
                                    <label class="pb-label" for="pb-type">Type of Document</label>
                                    <select name="pb-type" id="pb-type" required>
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
                                    <input type="text" id="pb-research-area" name="research" placeholder="Research Area">
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-college">College</label>
                                    <select name="pb-college" class="pb-input-field" id="pb-college" required>
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
                                    <select name="pb-campus" id="pb-campus" required>
                                        <option value="pb-campus" hidden>--Choose from the options--</option>
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
                                            <select name="pb-quarter" id="pb-quarter" required>
                                                <option value="pb-quartile" hidden>--Choose from the options--</option>
                                                <option value="Q1">Quartile 1</option>
                                                <option value="Q2">Quartile 2</option>
                                                <option value="Q3">Quartile 3</option>
                                                <option value="Q4">Quartile 4</option>
                                            </select>
                                        </div>
                                        <div class="quarter-year">
                                            <label class="pb-label" for="pb-quarter-year">Year</label>
                                            <select name="pb-quarter-year" id="pb-quarter-year" required>
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
                                    <input type="date" id="pb-date-published" name="pb-date" placeholder="Date Published">
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="sdg_no">SDG (choose at least 5):</label>
                                    <div class="checkbox-container">
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="1" id="sdg1" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg1">SDG 1</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="2" id="sdg2" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg2">SDG 2</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="3" id="sdg3" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg3">SDG 3</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="4" id="sdg4" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg4">SDG 4</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="5" id="sdg5" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg5">SDG 5</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="6" id="sdg6" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg6">SDG 6</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="7" id="sdg7" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg7">SDG 7</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="8" id="sdg8" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg8">SDG 8</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="9" id="sdg9" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg9">SDG 9</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="10" id="sdg10" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg10">SDG 10</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="11" id="sdg11" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg11">SDG 11</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="12" id="sdg12" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg12">SDG 12</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="13" id="sdg13" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg13">SDG 13</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="14" id="sdg14" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg14">SDG 14</label>
                                        </div>

                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="15" id="sdg15" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg15">SDG 15</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="16" id="sdg16" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg16">SDG 16</label>
                                        </div>
                                        
                                        <div class="checkbox-col">
                                            <input type="checkbox" name="sdg_no[]" value="17" id="sdg17" onclick="limitSelection()">
                                            <label class="sdg-checkbox" for="sdg17">SDG 17</label>
                                        </div>      
                                        <div class="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="pb-label" for="pb-url">Document Url</label>
                                    <input type="url" id="pb-url" name="pb-url" placeholder="Document Url">
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
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-control">
                                                <label class="pb-label" for="pb-author-name">Name</label>
                                                <input type="text" id="pb-author-name" name="pb-author-name" placeholder="Author Name">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-control">
                                                <label class="pb-label" for="pb-author-type">Type</label>
                                                <select name="pb-authorname" id="pb-author-name" required>
                                                    <option value="" hidden>--Choose from the options--</option>
                                                    <option value="Main Author">Main Author</option>
                                                    <option value="Co-author">Co-author</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-control">
                                                <label class="pb-label" for="pb-author-gender">Gender</label>
                                                <select name="pb-authorname" id="pb-author-gender" required>
                                                    <option value="" hidden>--Choose from the options--</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-control">
                                                <label class="pb-label" for="pb-author-affil">Affiliation</label>
                                                <input type="text" id="pb-author-affil" name="pb-author-affil" placeholder="Author Gender">
                                            </div>
                                        </td>
                                        <td>
                                            <button id="add-author-btn">Add New</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
</section>
<script src="./new-publication.js"></script>
</body>