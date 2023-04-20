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
        <div class="header">
            <h1 class="title">Publications</h1>
            <a href="./new-publication.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New Article</a>
        </div>
        <section>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Publisher</th>
                            <th>Research Area</th>
                            <th>College</th>
                            <th>Quartile</th>
                            <th>campus</th>
                            <th>SDG's</th>
                            <th>Date Published</th>
                            <th>Document Url</th>
                            <th>Authors</th>
                            <th>Funding</th>
                            <th>Fund Type</th>
                            <th>Fund Source</th>
                            <th class='stickey-col-header' style="background-color: #fff;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="min-width: 320px;">The Design and Development of A's Glass and Aluminum Online Booking System</td>
                            <td>Type</td>
                            <td>Publisher</td>
                            <td>Research Area</td>
                            <td>College</td>
                            <td>Quartile</td>
                            <td>campus</td>
                            <td>SDG's</td>
                            <td>Date Published</td>
                            <td>Document Url</td>
                            <td>Authors</td>
                            <td>Funding</td>
                            <td>Fund Type</td>
                            <td>Fund Source</td>
                            <td class='pb-action-btns stickey-col'>
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="#" class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-footer">
                <p>Article Count : 1</p>
                <div class="pagination">
                    <li>
                        <a href="#"><i class='bx bx-chevrons-left icon' ></i>First</a>
                    </li>
                    <li>
                        <a href="#"><i class='bx bx-chevron-left icon' ></i>Prev</a>
                    </li>
                    <li>
                        <span class="current-page">1</span>
                    </li>
                    <li>
                        <a href="#">Next<i class='bx bx-chevron-right icon' ></i></a>
                    </li>
                    <li>
                        <a href="#">Last<i class='bx bx-chevrons-right icon' ></i></a>
                    </li>
                </div>
            </div>
        </section>
    </main>
</section>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>