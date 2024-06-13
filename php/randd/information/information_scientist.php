<?php

include "./connection.php";


$email = isset($_GET['email']) ? $_GET['email'] : null;
$email = stripcslashes($email);
$email = mysqli_real_escape_string($conn, $email);

if ($email != "") {
    $response = array();
    $response['email'] = $email;
    $response['name'] = "";
    $response['scientistId'] =  "";
    $response['degree'] =  "";
    $response['address'] =  "";
    $response['dob'] =  "";
    $resopnse['phone_number'] = "";



    $sql = "SELECT `sc_ID`,`name`,`phone_number`,`degree`,`address`,`dob` FROM `scientists` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['name'] =  $row['name'];
        $response['scientistId'] =   $row['sc_ID'];
        $response['degree'] =   $row['degree'];
        $response['address'] =   $row['address'];
        $response['dob'] =   $row['dob'];
        $resopnse['phoneNUmber'] =  $row['phone_number'];
    }


    echo json_encode($response);
}
