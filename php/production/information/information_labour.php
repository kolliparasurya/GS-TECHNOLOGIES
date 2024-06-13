<?php

include "./connection.php";


$email = isset($_GET['email']) ? $_GET['email'] : null;
$email = stripcslashes($email);
$email = mysqli_real_escape_string($conn, $email);

if ($email != "") {
    $response = array();
    $response['labourId'] = "";
    $response['labourName'] =  "";
    $response['division'] =  "";
    $response['phoneNumber'] =  "";
    $response['email'] =  $email;
    $response['address'] =  "";



    $sql = "SELECT `labour_ID`,`name`,`division`,`phone_number`,`address` FROM `labour` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['labourName'] = $row['name'];
        $response['division'] =  $row['division'];
        $response['phoneNumber'] = $row['phone_number'];
        $response['address'] = $row['address'];
        $response['labourId'] = $row['labour_ID'];
    }


    echo json_encode($response);
}
