<?php
include "./connection.php";

$data = array();

$data['machineryName'] = isset($_GET['machineryName']) ? $_GET['machineryName'] : null;
$data['use'] = isset($_GET['use']) ? $_GET['use'] : null;

$data['machineryName'] = stripcslashes($data['machineryName']);
$data['use'] = stripcslashes($data['use']);

$machineryName = mysqli_real_escape_string($conn, $data['machineryName']);
$use = mysqli_real_escape_string($conn, $data['use']);


$sql = "SELECT MAX(machinery_ID) as lastmachineryid FROM `gs technologies`.machinery;";
$result = mysqli_query($conn, $sql);
$recentMachineryId = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentMachineryId = $row['lastmachineryid'];
}
$machineryId = $recentMachineryId + 1;

if ($machineryName != "" && $use != "") {
    $sql1 = "INSERT INTO `labour` (`machinery_ID`,`name`,`use`)
        VALUES ('$machineryId','$machineryName','$use')";

    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Machinery Added!";
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
