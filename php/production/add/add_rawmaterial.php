<?php
include "./connection.php";

$data = array();

$data['rawmaterialName'] = isset($_GET['rawmaterialName']) ? $_GET['rawmaterialName'] : null;
$data['rawmaterialName'] = stripcslashes($data['rawmaterialName']);
$rawmaterialName = mysqli_real_escape_string($conn, $data['rawmaterialName']);


$sql = "SELECT MAX(raw_material_ID) as lastrmid FROM `gs technologies`.raw_materials;";
$result = mysqli_query($conn, $sql);
$recentChipId = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentrmId = $row['lastrmid'];
}
$rawmaterialId = $recentrmId + 1;

if ($rawmaterialId != "" && $rawmaterialName != "") {
    $sql1 = "INSERT INTO `raw_materials` (`raw_material_ID`,`name`)
        VALUES ('$rawmaterialId','$rawmaterialName')";

    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Rawmaterial Added!";
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
