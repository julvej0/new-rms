<!DOCTYPE html>
<html>
<head>
    <title>Send Data to API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
        }
        
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Send Data to API</h1>
        <form method="post">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" name="user_id" id="user_id" required>
            </div>
            <div class="form-group">
                <label for="sr_code">SR Code:</label>
                <input type="text" name="sr_code" id="sr_code" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="account_type">Account Type:</label>
                <input type="text" name="account_type" id="account_type" required>
            </div>
            <div class="form-group">
                <label for="user_contact">User Contact:</label>
                <input type="text" name="user_contact" id="user_contact" required>
            </div>
            <div class="form-group">
                <label for="user_fname">First Name:</label>
                <input type="text" name="user_fname" id="user_fname" required>
            </div>
            <div class="form-group">
                <label for="user_lname">Last Name:</label>
                <input type="text" name="user_lname" id="user_lname" required>
            </div>
            <div class="form-group">
                <label for="user_mname">Middle Name:</label>
                <input type="text" name="user_mname" id="user_mname" required>
            </div>
            <div class="form-group">
                <button class="btn" type="submit">Send Data</button>
            </div>
        </form>
    </div>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Data to be sent
        $data = array(
            "user_id" => (int)$_POST['user_id'],
            "sr_code" => $_POST['sr_code'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "account_type" => $_POST['account_type'],
            "user_contact" => $_POST['user_contact'],
            "user_fname" => $_POST['user_fname'],
            "user_lname" => $_POST['user_lname'],
            "user_mname" => $_POST['user_mname']
        );

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // Initialize cURL
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/table_user');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            echo '<p>Error: ' . curl_error($ch) . '</p>';
        } else {
            echo '<p>Data sent successfully!</p>';
        }

        // Close the cURL session
        curl_close($ch);
    }
echo 'Request Info:';
var_dump(curl_getinfo($ch));

echo 'Response:';
var_dump($response);

?>
</body>
</html>
