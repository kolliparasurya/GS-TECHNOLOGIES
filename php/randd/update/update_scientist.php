<?php
include "./connection.php";

$data = array();

$data['scientistId'] = isset($_GET['scientistId']) ? $_GET['scientistId'] : null;
$data['name'] = isset($_GET['name']) ? $_GET['name'] : null;
$data['phoneNumber'] = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['degree'] = isset($_GET['degree']) ? $_GET['degree'] : null;
$data['address'] = isset($_GET['address']) ? $_GET['address'] : null;
$data['dob'] = isset($_GET['dob']) ? $_GET['dob'] : null;

$data['scientistId'] = stripcslashes($data['scientistId']);
$data['name'] = stripcslashes($data['name']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['email'] = stripcslashes($data['email']);
$data['degree'] = stripcslashes($data['degree']);
$data['address'] = stripcslashes($data['address']);
$data['dob'] = stripcslashes($data['dob']);

$scientistId = mysqli_real_escape_string($conn, $data['scientistId']);
$name = mysqli_real_escape_string($conn, $data['name']);
$phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']);
$email = mysqli_real_escape_string($conn, $data['email']);
$degree = mysqli_real_escape_string($conn, $data['degree']);
$address = mysqli_real_escape_string($conn, $data['address']);
$dob = mysqli_real_escape_string($conn, $data['dob']);



if ($name != "") {
    $sql1 = "UPDATE `scientists` SET `name` = '$name',`phone_number` = '$phoneNumber',`email` = '$email',`degree` = '$degree',`address` = '$address' ,`dob` = '$dob' WHERE (`sc_ID` = '$scientistId');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Scientist Updated!";
        echo $result;
    } else {
        if (mysqli_errno($conn) == 1062) {
            $result = "Enter different details";
            echo $result;
        } else {
            $result = "Database insertion error";
            echo $result;
        }
    }
}



$conn->close();
