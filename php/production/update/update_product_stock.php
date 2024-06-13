<?php
include "./connection.php";


$data = array();

$data['batchId'] = isset($_GET['batchId']) ? $_GET['batchId'] : null;
$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$data['producedQuantity'] = isset($_GET['producedQuantity']) ? $_GET['producedQuantity'] : null;
$data['defectedQuantity'] = isset($_GET['defectedQuantity']) ? $_GET['defectedQuantity'] : null;
$data['netQuantity'] = isset($_GET['netQuantity']) ? $_GET['netQuantity'] : null;
$data['machineryNames'] = isset($_GET['machineryNames']) ? $_GET['machineryNames'] : null;
$data['labourIDs'] = isset($_GET['labourIDs']) ? $_GET['labourIDs'] : null;
$data['rawmaterials'] = isset($_GET['rawmaterials']) ? $_GET['rawmaterials'] : null;
$data['stockedDate'] = isset($_GET['stockedDate']) ? $_GET['stockedDate'] : null;

$data['batchId'] = stripcslashes($data['batchId']);
$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['producedQuantity'] = stripcslashes($data['producedQuantity']);
$data['defectedQuantity'] = stripcslashes($data['defectedQuantity']);
$data['netQuantity'] = stripcslashes($data['netQuantity']);
$data['machineryNames'] = stripcslashes($data['machineryNames']);
$data['labourIDs'] = stripcslashes($data['labourIDs']);
$data['rawmaterials'] = stripcslashes($data['rawmaterials']);
$data['stockedDate'] = stripcslashes($data['stockedDate']);

$batchId = mysqli_real_escape_string($conn, $data['batchId']);
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

$batchId = (int)$batchId;



$chipId = (int)$chipId;
$sql2 = "UPDATE `product_stock` SET `chip_ID` = '$chipId',`name` = '$chipName',`produced_quantity` = '$producedQuantity',`defected_quantity` = '$defectedQuantity',`net_quantity` = '$netQuantity', `stocked_date` = '$stockedDate' WHERE (`batch_ID` = '$batchId');";
$result2 = mysqli_query($conn, $sql2);

//machinery
$sql3 = "SELECT `production_machinery_ID` as pmi FROM `gs technologies`.production_machinery WHERE (`product_batch_ID` = '$batchId');";
$result3 = mysqli_query($conn, $sql3);
$factor = 0;
$recentPMId = "";
while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $recentPMId = $row['pmi'];
    $sql3 = "DELETE FROM `production_machinery` WHERE (`production_machinery_ID` = '$recentPMId');";
    $factor = $factor + 1;
}

$sql3 = "SELECT MAX(production_machinery_ID) as lastpmid FROM `gs technologies`.production_machinery;";
$result3 = mysqli_query($conn, $sql3);
$lastPMId = "";
while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $lastPMId = $row['lastpmid'];
}
$lastPMId = (int)$lastPMId + 1;

$recentPMId = (int)$recentPMId + 1;
while ($recentPMId < $lastPMId) {
    $newPMId = $recentPMId - $factor;
    $usql = "UPDATE `production_machinery` SET `production_machinery_ID` = '$newPMId' WHERE (`production_machinery_ID` = '$recentPMId'";
    $recentPMId = $recentPMId + 1;
}

foreach ($machineryArray as $name) {
    $sql4 = "INSERT INTO `production_machinery` (`production_machinery_ID`,`product_batch_ID`,`machinery_name`,`production_date`)
    VALUES ('$recentPMId','$batchId','$name','$stockedDate');";
    $result4 = mysqli_query($conn, $sql4);
    $recentPMId = $recentPMId + 1;
}

// //rawmaterial
$sql3 = "SELECT `production_rawmaterials_ID` as pmi FROM `gs technologies`.production_rawmaterials WHERE (`product_batch_ID` = '$batchId');";
$result3 = mysqli_query($conn, $sql3);
$factor = 0;
$recentPMId = "";
while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $recentPMId = $row['pmi'];
    $sql3 = "DELETE FROM `production_rawmaterials` WHERE (`production_rawmaterials_ID` = '$recentPMId');";
    $factor = $factor + 1;
}

$sql3 = "SELECT MAX(production_rawmaterials_ID) as lastpmid FROM `gs technologies`.production_rawmaterials;";
$result3 = mysqli_query($conn, $sql3);
$lastPMId = "";
while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $lastPMId = $row['lastpmid'];
}
$lastPMId = (int)$lastPMId + 1;

$recentPMId = (int)$recentPMId + 1;
while ($recentPMId < $lastPMId) {
    $newPMId = $recentPMId - $factor;
    $usql = "UPDATE `production_rawmaterials` SET `production_rawmaterials_ID` = '$newPMId' WHERE (`production_rawmaterials_ID` = '$recentPMId'";
    $recentPMId = $recentPMId + 1;
}

foreach ($rawmaterials as $name) {
    $sql4 = "INSERT INTO `production_rawmaterials` (`production_rawmaterials_ID`,`product_batch_ID`,`rawmaterial_name`,`production_date`)
    VALUES ('$recentPMId','$batchId','$name','$stockedDate');";
    $result4 = mysqli_query($conn, $sql4);
    $recentPMId = $recentPMId + 1;
}

//labours
$sql3 = "SELECT `production_labour_ID` as pmi FROM `gs technologies`.production_labour WHERE (`product_batch_ID` = '$batchId');";
$result3 = mysqli_query($conn, $sql3);
$factor = 0;
$recentPMId = "";
while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $recentPMId = $row['pmi'];
    $sql3 = "DELETE FROM `production_labour` WHERE (`production_labour_ID` = '$recentPMId');";
    $factor = $factor + 1;
}

$sql3 = "SELECT MAX(production_labour_ID) as lastpmid FROM `gs technologies`.production_labour;";
$result3 = mysqli_query($conn, $sql3);
$lastPMId = "";
while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $lastPMId = $row['lastpmid'];
}
$lastPMId = (int)$lastPMId + 1;

$recentPMId = (int)$recentPMId + 1;
while ($recentPMId < $lastPMId) {
    $newPMId = $recentPMId - $factor;
    $usql = "UPDATE `production_labour` SET `production_labour` = '$newPMId' WHERE (`production_labour_ID` = '$recentPMId'";
    $recentPMId = $recentPMId + 1;
}

foreach ($labourIDs as $id) {
    $id = (int)$id;
    $sql4 = "INSERT INTO `production_labour` (`production_labour_ID`,`product_batch_ID`,`labour_ID`,`production_date`)
    VALUES ('$recentPMId','$batchId','$id','$stockedDate');";
    $result4 = mysqli_query($conn, $sql4);
    $recentPMId = $recentPMId + 1;
}


$result = "";
if ($result4 == 1) {
    $result = "Product Stock Updated!";
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
