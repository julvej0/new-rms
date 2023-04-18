<?php 
    include '../../../includes/admin/templates/header.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="publications.css">

<body>
<?php
    include '../../../includes/admin/templates/navbar.php';
?>
    <main>
        <h1 class="title">Publications</h1>
        <section>
            <div class="pb-tbl-container">
                <table>
                     <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Publisher</th>
                        <th>Research Area</th>
                        <th>College</th>
                        <th>Quartile</th>
                        <th>Campus</th>
                        <th>SDG's</th>
                        <th>Date Published</th>
                        <th>Document Url</th>
                        <th>Authors</th>
                        <th>Funding</th>
                        <th>Fund Type</th>
                        <th>Fund Agency</th>
                        <th>Citations</th>
                        <th class="stickey-col-header" style="background-color: #eee;">Actions</th>
                    </tr>
                    <tr>
                        <td>Aritcle ni Lloyd</td>
                        <td>Review</td>
                        <td>Clarivate</td>
                        <td>CAS</td>
                        <td>CICS</td>
                        <td>Alangilan</td>
                        <td>SDG_1, SDG_2</td>
                        <td>April 18, 2023</td>
                        <td>https://localhost:5000</td>
                        <td>Lloyd Anthony Bautista</td>
                        <td>Funded</td>
                        <td>External</td>
                        <td>RMS</td>
                        <td>350</td>
                        <td class="pb-action-buttons stickey-col">
                            <a href="#" class="edit-btn"></a>
                            <a href="#" class="delete-btn"></a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class='pb-tbl-footer'>
                <div>
                    <p>Article Count: 1</p>
                </div>
            </div>
        </section>
    </main>
</section>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>