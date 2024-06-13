<?php
include "./connection.php";


$data = array();


$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$data['producedQuantity'] = isset($_GET['producedQuantity']) ? $_GET['producedQuantity'] : null;
$data['defectedQuantity'] = isset($_GET['defectedQuantity']) ? $_GET['defectedQuantity'] : null;
$data['netQuantity'] = isset($_GET['netQuantity']) ? $_GET['netQuantity'] : null;
$data['machineryNames'] = isset($_GET['machineryNames']) ? $_GET['machineryNames'] : null;
$data['labourIDs'] = isset($_GET['labourIDs']) ? $_GET['labourIDs'] : null;
$data['rawmaterials'] = isset($_GET['rawmaterials']) ? $_GET['rawmaterials'] : null;
$data['stockedDate'] = isset($_GET['stockedDate']) ? $_GET['stockedDate'] : null;

$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['producedQuantity'] = stripcslashes($data['producedQuantity']);
$data['defectedQuantity'] = stripcslashes($data['defectedQuantity']);
$data['netQuantity'] = stripcslashes($data['netQuantity']);
$data['machineryNames'] = stripcslashes($data['machineryNames']);
$data['labourIDs'] = stripcslashes($data['labourIDs']);
$data['rawmaterials'] = stripcslashes($data['rawmaterials']);
$data['stockedDate'] = stripcslashes($data['stockedDate']);

$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);
$producedQuantity = mysqli_real_escape_string($conn, $data['producedQuantity']);
$defectedQuantity = mysqli_real_escape_string($conn, $data['defectedQuantity']);
$netQuantity = mysqli_real_escape_string($conn, $data['netQuantity']);
$machineryNames = mysqli_real_escape_string($conn, $data['machineryNames']);
$labourIDs = mysqli_real_escape_string($conn, $data['labourIDs']);
$rawmaterials = mysqli_real_escape_string($conn, $data['rawmaterials']);
$stockedDate = mysqli_real_escape_string($conn, $data['stockedDate']);

$machineryArray = explode(",", $machineryNames);
$labourIDs = explode(",", $labourIDs);
$rawmaterials = explode(",", $rawmaterials);

$sql1 = "SELECT MAX(batch_ID) as lastbatchid FROM `gs technologies`.product_stock;";
$result1 = mysqli_query($conn, $sql1);
$recentChipId = "";
while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    $recentBatchId = $row['lastbatchid'];
}
$batchId = $recentBatchId + 1;

$chipId = (int)$chipId;
$sql2 = "INSERT INTO `product_stock` (`batch_ID`,`chip_ID`,`name`,`produced_quantity`,`defected_quantity`,`net_quantity`,`stocked_date`)
        VALUES ('$batchId','$chipId','$chipName','$producedQuantity','$defectedQuantity','$netQuantity','$stockedDate');";
$result2 = mysqli_query($conn, $sql2);

//machinery
$sql3 = "SELECT MAX(production_machinery_ID) as lastpmid FROM `gs technologies`.production_machinery;";
$result3 = mysqli_query($conn, $sql3);
$recentPMId = "";
while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $recentPMId = $row['lastpmid'];
}
$PMId = $recentPMId + 1;

foreach ($machineryArray as $name) {
    $sql4 = "INSERT INTO `production_machinery` (`production_machinery_ID`,`product_batch_ID`,`machinery_name`,`production_date`)
    VALUES ('$PMId','$batchId','$name','$stockedDate');";
    $result4 = mysqli_query($conn, $sql4);
    $PMId = $PMId + 1;
}

//rawmaterial
$sql5 = "SELECT MAX(production_rawmaterials_ID) as lastprid FROM `gs technologies`.production_rawmaterials;";
$result5 = mysqli_query($conn, $sql5);
$recentPMId = "";
while ($row = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
    $recentPRId = $row['lastprid'];
}
$PRId = $recentPRId + 1;

foreach ($rawmaterials as $name) {
    $sql6 = "INSERT INTO `production_rawmaterials` (`production_rawmaterials_ID`,`product_batch_ID`,`rawmaterial_name`,`production_date`)
    VALUES ('$PRId','$batchId','$name','$stockedDate');";
    $result6 = mysqli_query($conn, $sql6);
    $PRId = $PRId + 1;
}

//labours
$sql7 = "SELECT MAX(production_labour_ID) as lastplid FROM `gs technologies`.production_labour;";
$result7 = mysqli_query($conn, $sql7);
$recentPLId = "";
while ($row = mysqli_fetch_array($result7, MYSQLI_ASSOC)) {
    $recentPLId = $row['lastplid'];
}
$PLId = $recentPLId + 1;

foreach ($labourIDs as $ID) {
    $ID = (int)$ID;
    $sql8 = "INSERT INTO `production_labour` (`production_labour_ID`,`product_batch_ID`,`labour_ID`,`production_date`)
    VALUES ('$PLId','$batchId','$ID','$stockedDate');";
    $result8 = mysqli_query($conn, $sql8);
    $PLId = $PLId + 1;
}


$result = "";
if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6 && $result7 && $result8 == 1) {
    $result = "Product Stock Added!";
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

$conn->close();
