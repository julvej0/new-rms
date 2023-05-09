<?php
include_once "../../../db/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Document</title>
</head>
<style>
    body{
        margin: 5em;
        pading: 0,

    }
    table, th, td {
    border: 1px solid;
    }
    .loading-wave {
  width: 300px;
  height: 100px;
  display: flex;
  justify-content: center;
  align-items: flex-end;
}

.loading-bar {
  width: 20px;
  height: 10px;
  margin: 0 5px;
  background-color: #3498db;
  border-radius: 5px;
  animation: loading-wave-animation 1s ease-in-out infinite;
}

.loading-bar:nth-child(2) {
  animation-delay: 0.1s;
}

.loading-bar:nth-child(3) {
  animation-delay: 0.2s;
}

.loading-bar:nth-child(4) {
  animation-delay: 0.3s;
}

@keyframes loading-wave-animation {
  0% {
    height: 10px;
  }

  50% {
    height: 50px;
  }

  100% {
    height: 10px;
  }
}
</style>
<body>
    <div class="filters" id="filters">
        <select name="fetchval" id="fetchval">
            <option value="" selected="" disabled="">Type</option>
            <option value="Copyright">Copyright</option>
            <option value="Original">Original</option>
        </select>
        <select name="fetchval1" id="fetchval1">
            <option value="" selected="" disabled="">Class</option>
            <option value="G">Class G</option>
            <option value="O">Class O</option>
            <option value="A">Class A</option>
        </select>
    </div>
    <div class="container">
        <table>
            <tr>
                <th>Reg #</th>
                <th>Title</th>
                <th>Type of Document</th>
                <th>Class of Work</th>
            </tr>
            <?php 
            $query ="SELECT * FROM table_ipassets";
            $query_run = pg_query($conn, $query);
            while($row = pg_fetch_assoc($query_run)){
            ?>
            <tr>
                <td><?php echo $row['registration_number']?></td>
                <td><?php echo $row['title_of_work'] ?></td>
                <td><?php echo $row['type_of_document'] ?></td>
                <td><?php echo $row['class_of_work'] ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#fetchval").on('change', function(){
                var value = $(this).val();
                // console.log(value);
                $.ajax({
                    url: "try-fetch.php",
                    type: "POST",
                    data: 'request=' + value,
                    beforeSend: function(){
                        $(".container").html(`<h1>LOADING.......</h1>`);
                    },
                    success: function(data){
                        $(".container").html(data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#fetchval1").on('change', function(){
                var value = $(this).val();
                // console.log(value);
                $.ajax({
                    url: "try-fetch.php",
                    type: "POST",
                    data: 'request=' + value,
                    beforeSend: function(){
                        $(".container").html(`<h1>LOADING.......</h1>`);
                    },
                    success: function(data){
                        $(".container").html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>