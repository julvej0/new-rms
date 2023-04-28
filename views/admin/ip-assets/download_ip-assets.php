
<link rel="stylesheet" href="./ip-assets.css">
<body>
    <main>
        <div class="header">

            <div class="left">
                <form action="#">
                    <div class="form-group">
                        <input type="text" placeholder="Search...">
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
            </div>
        </div>
        <section>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Registration Number</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Class of Work</th>
                            <th>Date Registered</th>
                            <th>Campus</th>
                            <th>College</th>
                            <th>Programs</th>
                            <th>Authors</th>
                            <th class='stickey-col-header'  style="background-color: var(--grey);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td style="min-width: 320px;">The Design and Development of A's Glass and Aluminum Online Booking System</td>
                            <td>Type</td>
                            <td>ClassOfWork</td>
                            <td>January 1, 2023</td>
                            <td>Campus</td>
                            <td>College</td>
                            <td>Programs</td>
                            <td>Authors</td>
                            <td class='pb-action-btns stickey-col'>
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="#" class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="./ip-assets.js"></script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>