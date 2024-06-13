<?php
include "./connection.php";

$data = array();

$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$data['customerName'] = isset($_GET['customerName']) ? $_GET['customerName'] : null;
$data['panNumber'] = isset($_GET['panNumber']) ? $_GET['panNumber'] : null;
$data['quantity'] = isset($_GET['quantity']) ? $_GET['quantity'] : null;
$data['date'] = isset($_GET['date']) ? $_GET['date'] : null;

$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['customerName'] = stripcslashes($data['customerName']);
$data['panNumber'] = stripcslashes($data['panNumber']);
$data['quantity'] = stripcslashes($data['quantity']);
$data['date'] = stripcslashes($data['date']);


$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);
$customerName = mysqli_real_escape_string($conn, $data['customerName']);
$panNumber = mysqli_real_escape_string($conn, $data['panNumber']);
$quantity = mysqli_real_escape_string($conn, $data['quantity']);
$date = mysqli_real_escape_string($conn, $data['date']);


$recentOrderId = "";
$sql = "SELECT MAX(order_ID) as lastorderid FROM `gs technologies`.orders;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentOrderId = $row['lastorderid'];
}
$sql = "SELECT MAX(order_ID) as lastcorderid FROM `gs technologies`.cancelled_orders;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentOrderId = $row['lastcorderid'];
}
$sql = "SELECT MAX(order_ID) as lastdid FROM `gs technologies`.`distribution`;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentOrderId = $row['lastdid'];
}
$orderId = $recentOrderId + 1;


if ($chipId != "" && $chipName != "" && $customerName != "" && $panNumber != "" && $quantity != "" && $date != "") {
    $sql1 = "INSERT INTO `orders` (`order_ID`,`chip_ID`,`chip_name`,`customer_name`,`customer_PAN_NUMBER`,`quantity`,`ordered_date`)
        VALUES ('$orderId','$chipId','$chipName','$customerName','$panNumber','$quantity','$date')";

    $result = "";

    $sql2 = "SELECT * FROM customers WHERE PAN_NUMBER = '$panNumber' and `name` = '$customerName'";
    $query = mysqli_query($conn, $sql2);
    $rowcount = mysqli_num_rows($query);

    if ($rowcount == 1) {
        if (mysqli_query($conn, $sql1) === TRUE) {
            $result = "Order Added!";
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
        echo "Customer not in database";
    }
}


$conn->close();
