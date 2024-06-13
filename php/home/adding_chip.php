<?php
include "./connection.php";

$data = array();

$data['chipName'] = $_GET['chipName'];
$data['chipStage'] = isset($_GET['chipStage']) ? $_GET['chipStage'] : null;
$data['chipApplication'] = $_GET['chipApplication'];
$data['chipGPUType'] = isset($_GET['chipGPUType']) ? $_GET['chipGPUType'] : null;
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


$sql = "SELECT MAX(chip_ID) as lastchipid FROM `gs technologies`.gpu_chips;";
$result = mysqli_query($conn, $sql);
$recentChipId = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentChipId = $row['lastchipid'];
}
$chipId = $recentChipId + 1;


$sql1 = "INSERT INTO `gpu_chips` (`chip_ID`,`name`,`stage`,`application`,`gpu_type`,`process_size`,`transistors`,`die_size`,`foundry`,`added_date`)
        VALUES ('$chipId','$chipName','$chipStage','$chipApplication','$chipGPUType','$chipProcessSize','$chipTransistors','$chipDieSize','$chipFoundry','$chipDate');
        INSERT INTO `memory` (`chip_ID`,`memory_type`,`memory_bus`,`band_width`)
        VALUES ('$chipId','$chipMemoryType','$chipMemoryBus','$chipBandWidth');
        INSERT INTO `clock_speeds`(`chip_ID`,`base_clock`,`memory_clock`)
        VALUES ('$chipId','$chipBaseClockSpeed','$chipMemoryClockSpeed');
        INSERT INTO `render_configs` (`chip_ID`,`shading_units`,`TMUs`,`cores`)
        VALUES ('$chipId','$chipShadingUnits','$chipTMUs','$chipCores' );";

$result = "";

if (mysqli_multi_query($conn, $sql1)) {
    $result = "Chip Added!";
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
