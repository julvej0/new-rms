<?php
include_once "../../../db/db.php";

if(isset($_POST['request'])){

    $request = $_POST['request'];

    // Create a prepared statement with a parameter for the search term
    $query = "SELECT * FROM table_ipassets WHERE CONCAT(type_of_document, class_of_work) ILIKE $1";
    $stmt = pg_prepare($conn, "", $query);

    // Execute the prepared statement with the value of $request as the parameter
    $result = pg_execute($conn, "", array("%$request%"));
    $count = pg_num_rows($result);

    ?>
    <table>
        <?php if($count){ ?>
            <tr>
                <th>Reg #</th>
                <th>Title</th>
                <th>Type of Document</th>
                <th>Class of Work</th>
            </tr>
            <?php while($row = pg_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row['registration_number']?></td>
                    <td><?php echo $row['title_of_work'] ?></td>
                    <td><?php echo $row['type_of_document'] ?></td>
                    <td><?php echo $row['class_of_work'] ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4">No records found.</td>
            </tr>
        <?php } ?>
    </table>
    <?php
}

?>