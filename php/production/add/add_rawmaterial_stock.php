<?php
include "./connection.php";

$data = array();

$data['rawmaterialName'] = isset($_GET['rawmaterialName']) ? $_GET['rawmaterialName'] : null;
$data['rawmaterialId'] = isset($_GET['rawmaterialId']) ? $_GET['rawmaterialId'] : null;
$data['quantity'] = isset($_GET['quantity']) ? $_GET['quantity'] : null;
$data['stockedDate'] = isset($_GET['stockedDate']) ? $_GET['stockedDate'] : null;


$data['rawmaterialName'] = stripcslashes($data['rawmaterialName']);
$data['rawmaterialId'] = stripcslashes($data['rawmaterialId']);
$data['quantity'] = stripcslashes($data['quantity']);
$data['stockedDate'] = stripcslashes($data['stockedDate']);


$rawmaterialName = mysqli_real_escape_string($conn, $data['rawmaterialName']);
$rawmaterialId = mysqli_real_escape_string($conn, $data['rawmaterialId']);
$quantity = mysqli_real_escape_string($conn, $data['quantity']);
$stockedDate = mysqli_real_escape_string($conn, $data['stockedDate']);

$rawmaterialId = (int)$rawmaterialId;

$sql = "SELECT MAX(batch_ID) as lastbatchid FROM `gs technologies`.raw_material_stock;";
$result = mysqli_query($conn, $sql);
$recentBatchId = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentBatchId = $row['lastbatchid'];
}
$batchId = $recentBatchId + 1;

if ($rawmaterialName != "" && $rawmaterialId != "" && $quantity != "" && $stockedDate != "") {
    $sql1 = "INSERT INTO `raw_material_stock` (`raw_material_ID`,`batch_ID`,`name`,`quantity`,`stocked_date`)
        VALUES ('$rawmaterialId','$batchId','$rawmaterialName','$quantity','$stockedDate')";

    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Rawmaterial Stock Added!";
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
