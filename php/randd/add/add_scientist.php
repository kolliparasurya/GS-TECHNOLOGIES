<?php
include "./connection.php";

$data = array();

$data['name'] = isset($_GET['name']) ? $_GET['name'] : null;
$data['phoneNumber'] = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['degree'] = isset($_GET['degree']) ? $_GET['degree'] : null;
$data['address'] = isset($_GET['address']) ? $_GET['address'] : null;
$data['DOB'] = isset($_GET['DOB']) ? $_GET['DOB'] : null;


$data['name'] = stripcslashes($data['name']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['email'] = stripcslashes($data['email']);
$data['degree'] = stripcslashes($data['degree']);
$data['address'] = stripcslashes($data['address']);
$data['DOB'] = stripcslashes($data['DOB']);


$name = mysqli_real_escape_string($conn, $data['name']);
$phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']);
$email = mysqli_real_escape_string($conn, $data['email']);
$degree = mysqli_real_escape_string($conn, $data['degree']);
$address = mysqli_real_escape_string($conn, $data['address']);
$DOB = mysqli_real_escape_string($conn, $data['DOB']);


$sql = "SELECT MAX(sc_ID) as lastscid FROM `gs technologies`.scientists;";
$result = mysqli_query($conn, $sql);
$recentScId = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentScId = $row['lastscid'];
}
$scId = $recentScId + 1;

if ($scId != "" && $name != "" && $phoneNumber != "" && $email != "" && $degree != "" && $address != "" && $DOB != "") {
    $sql1 = "INSERT INTO `scientists` (`sc_ID`,`name`,`phone_number`,`email`,`degree`,`address`,`dob`)
        VALUES ('$scId','$name','$phoneNumber','$email','$degree','$address','$DOB')";

    $result = "";

    if (mysqli_query($conn, $sql1)) {
        $result = "Scientist Added!";
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
