<html>
    <head>
        <title>PHPMAILER</title>
    </head>
    <body>
        <form action="sendcode.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="emailAddress" value="" required>
            <button type="submit" name="send">SEND</button>
        </form>
    </body>
    <?php
    if (isset($_GET['no_email'])) {
        echo "Please enter your email address.";
     }     
    ?>
</html>