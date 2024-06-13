<?php
include "./connection.php";

$data = array();

$data['scientistId'] = isset($_GET['scientistId']) ? $_GET['scientistId'] : null;
$data['scientistName'] = isset($_GET['scientistName']) ? $_GET['scientistName'] : null;
$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$data['date'] = isset($_GET['date']) ? $_GET['date'] : null;
$data['place'] = isset($_GET['place']) ? $_GET['place'] : null;
$data['inventionId'] = isset($_GET['inventionId']) ? $_GET['inventionId'] : null;


$data['scientistId'] = stripcslashes($data['scientistId']);
$data['scientistName'] = stripcslashes($data['scientistName']);
$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['date'] = stripcslashes($data['date']);
$data['place'] = stripcslashes($data['place']);
$data['inventionId'] = stripcslashes($data['inventionId']);


$scientistId = mysqli_real_escape_string($conn, $data['scientistId']);
$scientistName = mysqli_real_escape_string($conn, $data['scientistName']);
$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);
$date = mysqli_real_escape_string($conn, $data['date']);
$place = mysqli_real_escape_string($conn, $data['place']);
$inventionId = mysqli_real_escape_string($conn, $data['inventionId']);



if ($scientistId != "") {
    $sql1 = "UPDATE `invention` SET `scientist_ID` = '$scientistId',`scientist_name` = '$scientistName',`chip_ID` = '$chipId',`chip_name` = '$chipName',`added_date` = '$date' ,`invention_place` = '$place' WHERE (`invention_ID` = '$inventionId');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Invention Updated!";
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
