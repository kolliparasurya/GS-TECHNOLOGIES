<?php
include "./connection.php";

$data = array();

$data['chip_ID'] = $_GET['chip_ID'];
$data['chipName'] = $_GET['chipName'];
$data['chipStage'] = $_GET['chipStage'];
$data['chipApplication'] = $_GET['chipApplication'];
$data['chipGPUType'] = $_GET['chipGPUType'];
$data['chipProcessSize'] = $_GET['chipProcessSize'];
$data['chipTransistors'] = $_GET['chipTransistors'];
$data['chipDieSize'] = $_GET['chipDieSize'];
$data['chipFoundry'] = $_GET['chipFoundry'];
$data['chipDate'] = $_GET['chipDate'];
$data['chipShadingUnits'] = $_GET['chipShadingUnits'];
$data['chipTMUs'] = $_GET['chipTMUs'];
$data['chipCores'] = $_GET['chipCores'];
$data['chipMemoryBus'] = $_GET['chipMemoryBus'];
$data['chipMemoryType'] = $_GET['chipMemoryType'];
$data['chipBandWidth'] = $_GET['chipBandWidth'];
$data['chipBaseClockSpeed'] = $_GET['chipBaseClockSpeed'];
$data['chipMemoryClockSpeed'] = $_GET['chipMemoryClockSpeed'];

$data['chip_ID'] = stripcslashes($data['chip_ID']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['chipStage'] = stripcslashes($data['chipStage']);
$data['chipApplication'] = stripcslashes($data['chipApplication']);
$data['chipGPUType'] = stripcslashes($data['chipGPUType']);
$data['chipProcessSize'] = stripcslashes($data['chipProcessSize']);
$data['chipTransistors'] = stripcslashes($data['chipTransistors']);
$data['chipDieSize'] = stripcslashes($data['chipDieSize']);
$data['chipFoundry'] = stripcslashes($data['chipFoundry']);
$data['chipDate'] = stripcslashes($data['chipDate']);
$data['chipShadingUnits'] = stripcslashes($data['chipShadingUnits']);
$data['chipTMUs'] = stripcslashes($data['chipTMUs']);
$data['chipCores'] = stripcslashes($data['chipCores']);
$data['chipMemoryBus'] = stripcslashes($data['chipMemoryBus']);
$data['chipMemoryType'] = stripcslashes($data['chipMemoryType']);
$data['chipBandWidth'] = stripcslashes($data['chipBandWidth']);
$data['chipBaseClockSpeed'] = stripcslashes($data['chipBaseClockSpeed']);
$data['chipMemoryClockSpeed'] = stripcslashes($data['chipMemoryClockSpeed']);

$chip_ID = mysqli_real_escape_string($conn, $data['chip_ID']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);
$chipStage = mysqli_real_escape_string($conn, $data['chipStage']);
$chipApplication = mysqli_real_escape_string($conn, $data['chipApplication']);
$chipGPUType = mysqli_real_escape_string($conn, $data['chipGPUType']);
$chipProcessSize = mysqli_real_escape_string($conn, $data['chipProcessSize']);
$chipTransistors = mysqli_real_escape_string($conn, $data['chipTransistors']);
$chipDieSize = mysqli_real_escape_string($conn, $data['chipDieSize']);
$chipFoundry = mysqli_real_escape_string($conn, $data['chipFoundry']);
$chipDate = mysqli_real_escape_string($conn, $data['chipDate']);
$chipShadingUnits = mysqli_real_escape_string($conn, $data['chipShadingUnits']);
$chipTMUs = mysqli_real_escape_string($conn, $data['chipTMUs']);
$chipCores = mysqli_real_escape_string($conn, $data['chipCores']);
$chipMemoryBus = mysqli_real_escape_string($conn, $data['chipMemoryBus']);
$chipMemoryType = mysqli_real_escape_string($conn, $data['chipMemoryType']);
$chipBandWidth = mysqli_real_escape_string($conn, $data['chipBandWidth']);
$chipBaseClockSpeed = mysqli_real_escape_string($conn, $data['chipBaseClockSpeed']);
$chipMemoryClockSpeed = mysqli_real_escape_string($conn, $data['chipMemoryClockSpeed']);


$sql1 = "UPDATE `gpu_chips` SET `name` = '$chipName',`stage` = '$chipStage',`application` = '$chipApplication',`gpu_type` = '$chipGPUType',`process_size` = '$chipProcessSize',`transistors` = '$chipTransistors',`die_size` = '$chipDieSize',`foundry` = '$chipFoundry',`added_date` = '$chipDate' WHERE (`chip_ID` = '$chip_ID');
        UPDATE `gpu_chips` SET `memory_type` = '$chipMemoryType',`memory_bus` = '$chipMemoryBus',`band_width` = '$chipBandWidth' WHERE (`chip_ID` = '$chip_ID');
        UPDATE `gpu_chips` SET `shading_units` = '$chipShadingUnits',`TMUs` = '$chipTMUs',`cores` = '$chipCores' WHERE (`chip_ID` = '$chip_ID')";


$result = "";

if (mysqli_multi_query($conn, $sql1)) {
    $result = "Chip Updated!";
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
