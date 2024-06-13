<?php
include "./connection.php";

$data = array();

$data['machineryId'] = isset($_GET['machineryId']) ? $_GET['machineryId'] : null;
$data['machineryName'] = isset($_GET['machineryName']) ? $_GET['machineryName'] : null;
$data['use'] = isset($_GET['use']) ? $_GET['use'] : null;


$data['machineryId'] = stripcslashes($data['machineryId']);
$data['machineryName'] = stripcslashes($data['machineryName']);
$data['use'] = stripcslashes($data['use']);

$machineryId = mysqli_real_escape_string($conn, $data['machineryId']);
$machineryName = mysqli_real_escape_string($conn, $data['machineryName']);
$use = mysqli_real_escape_string($conn, $data['use']);



if ($machineryId != "") {
    $sql1 = "UPDATE `machinery` SET `machinery_ID` = '$machineryId',`name` = '$machineryName',`use` = '$use');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Machinery Updated!";
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
