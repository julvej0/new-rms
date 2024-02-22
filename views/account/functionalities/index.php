<?php
$userurl = "http://localhost:5000/table_user";
$useremail = "20-08137@g.batstate-u.edu.ph";
// $ch = curl_init($userurl);
// // $ch = curl_init("http://localhost:5000/table_user");
// $data = json_encode(["password"=>"$2y$10$7E.EiGxMPYnxDnFJYayEWus1zLgy0nx\/JhqfHLvEFwDpZdylF3QqC"]);
// $id = 3;


// // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
// // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// // curl_setopt($ch, CURLOPT_HTTPHEADER, [
// //     'Content-Type: application/json',
// //     'Content-Length: ' . strlen($data)
// // ]);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $response = curl_exec($ch);
// // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); //HTTP_CODE
// curl_close($ch);
// print_r($userurl . "/" . $id);



function getUserData($userurl, $email) {
    
    // print_r('haha');
    $response = file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $userData = json_decode($response, true)['table_user'];

    foreach ($userData as $user) {
        if ($user['email'] === $email) {
            return array('id' => $user['user_id'], 'current_password' => $user['password']);
        }
    }

    return null; // User not found
}

getUserData($userurl, $useremail);