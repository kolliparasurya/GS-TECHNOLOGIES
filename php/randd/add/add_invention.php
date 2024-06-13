<?php
include "./connection.php";

$data = array();

$data['scientistId'] = isset($_GET['scientistId']) ? $_GET['scientistId'] : null;
$data['scientistName'] = isset($_GET['scientistName']) ? $_GET['scientistName'] : null;
$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$data['date'] = isset($_GET['date']) ? $_GET['date'] : null;
$data['place'] = isset($_GET['place']) ? $_GET['place'] : null;


$data['scientistId'] = stripcslashes($data['scientistId']);
$data['scientistName'] = stripcslashes($data['scientistName']);
$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['date'] = stripcslashes($data['date']);
$data['place'] = stripcslashes($data['place']);


$scientistId = mysqli_real_escape_string($conn, $data['scientistId']);
$scientistName = mysqli_real_escape_string($conn, $data['scientistName']);
$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);
$date = mysqli_real_escape_string($conn, $data['date']);
$place = mysqli_real_escape_string($conn, $data['place']);


$sql = "SELECT MAX(invention_ID) as lastinventionid FROM `gs technologies`.invention;";
$result = mysqli_query($conn, $sql);
$recentInventionId = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentInventionId = $row['lastinventionid'];
}
$inventionId = $recentInventionId + 1;

if ($scientistId != "" && $scientistName != "" && $chipId != "" && $date != "" && $place != "") {
    $sql1 = "INSERT INTO `invention` (`invention_ID`,`scientist_ID`,`chip_Id`,`chip_name`,`scientist_name`,`added_date`,`invention_place`)
        VALUES ('$inventionId','$scientistId','$chipId','$chipName','$scientistName','$date','$place')";

    $result = "";
    $sql2 = "SELECT * FROM customers WHERE `PAN_NUMBER` = $panNumber";
    $result = mysqli_query($conn,$sql2)
    $rows = mysqli_num_rows($result);

    if ( == 1) {

        if (mysqli_query($conn, $sql1)) {
            $result = "Invention Added!";
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
    } else {
        echo "customer not in database";
    }
}


$conn->close();
