<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../includes/public-user/templates/user-navbar.php'; 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./articles.css">


<!-- Table Cotainer -->

<div class='table-container'>

    <!-- Start of Table -->

    <table class='main-table'>

        <!-- Table Header -->
        <tr>
            <div class='table-header-container'>
                <div class='table-header'>
                    <p>LIST OF ARTICLES</p>
                </div>
                <div class='table-search'>
                    <input type='text' id='search-table' name='search-table' placeholder='Search Article'>
                </div>
                <div class='search-button'>
                    <button id='btn-search'>
                        <img src='https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/search-512.png' alt='Search'>
                    </button>
                </div>
                <div class='sort-button'>
                    <button id='btn-sort'>
                        <i class="fas fa-sort-amount-up"></i>
                    </button>
                    <span>SORT</span>
                </div>
                <div class='filter-button'>
                    <button id='btn-filter'>
                        <i class="fas fa-filter"></i>
                    </button>
                    <span>FILTER</span>
                </div>
            </div>
        </tr>

        <!-- main table content -->

        <tr>
            <thead>
                <th>Title</th>
                <th>Date Registered</th>
                <th>Campus</th>
                <th>Authors</th>
            </thead>
        </tr>
        <tr>
            <td><?php echo $user['title_of_paper']; ?></td>
            <td><?php echo $user['date_published']; ?></td>
            <td><?php echo $user['campus']; ?></td>
            <td><?php echo $user['authors']; ?></td>
        </tr>
    </table>
</div>




<?php 
    include '../../../includes/admin/templates/header.php';
?>