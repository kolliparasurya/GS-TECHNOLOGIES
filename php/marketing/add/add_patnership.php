<?php
include "./connection.php";

$data = array();

$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$data['companyName'] = isset($_GET['companyName']) ? $_GET['companyName'] : null;
$data['patnershipSector'] = isset($_GET['patnershipSector']) ? $_GET['patnershipSector'] : null;
$data['phoneNumber'] = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['panNumber'] = isset($_GET['panNumber']) ? $_GET['panNumber'] : null;
$data['address'] = isset($_GET['address']) ? $_GET['address'] : null;

$data['platformName'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['companyName'] = stripcslashes($data['companyName']);
$data['patnershipSector'] = stripcslashes($data['patnershipSector']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['email'] = stripcslashes($data['email']);
$data['panNumber'] = stripcslashes($data['panNumber']);
$data['address'] = stripcslashes($data['address']);

$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);
$companyName = mysqli_real_escape_string($conn, $data['companyName']);
$patnershipSector = mysqli_real_escape_string($conn, $data['patnershipSector']);
$phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']);
$email = mysqli_real_escape_string($conn, $data['email']);
$panNumber = mysqli_real_escape_string($conn, $data['panNumber']);
$address = mysqli_real_escape_string($conn, $data['address']);




$sql = "SELECT MAX(patnership_ID) as lastptid FROM `gs technologies`.patnerships;";
$result = mysqli_query($conn, $sql);
$recentadId = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentptId = $row['lastptid'];
}
$patnershipId = $recentptId + 1;

if ($chipId != "" && $companyName != "") {
    $sql1 = "INSERT INTO `patnerships` (`patnership_ID`,`company_PAN_NUMBER`,`chip_ID`,`chip_name`,`patnership_sector`,`company_name`,`company_phone_number`,`company_address`,`company_email`)
        VALUES ('$patnershipId','$panNumber','$chipId','$chipName','$patnershipSector','$companyName','$phoneNumber','$address','$email')";

    $result = "";

    if (mysqli_query($conn, $sql1)) {
        $result = "Patnership Added!";
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
