<?php
include "./connection.php";

$data = array();

$data['labourName'] = isset($_GET['labourName']) ? $_GET['labourName'] : null;
$data['division'] = isset($_GET['division']) ? $_GET['division'] : null;
$data['phoneNumber'] = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['address'] = isset($_GET['address']) ? $_GET['address'] : null;


$data['labourName'] = stripcslashes($data['labourName']);
$data['division'] = stripcslashes($data['division']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['email'] = stripcslashes($data['email']);
$data['address'] = stripcslashes($data['address']);


$labourName = mysqli_real_escape_string($conn, $data['labourName']);
$division = mysqli_real_escape_string($conn, $data['division']);
$phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']);
$email = mysqli_real_escape_string($conn, $data['email']);
$address = mysqli_real_escape_string($conn, $data['address']);


$sql = "SELECT MAX(labour_ID) as lastlabourid FROM `gs technologies`.labour;";
$result = mysqli_query($conn, $sql);
$recentlabourId = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentLabourId = $row['lastlabourid'];
}
$labourId = $recentlabourId + 1;

if ($labourName != "" && $division != "" && $phoneNumber != "" && $email != "" && $address != "") {
    $sql1 = "INSERT INTO `labour` (`labour_ID`,`name`,`division`,`phone_number`,`email`,`address`)
        VALUES ('$labourId','$labourName','$division','$phoneNumber','$email','$address')";

    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Labour Added!";
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
