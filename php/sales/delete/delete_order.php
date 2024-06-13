<?php
include "./connection.php";

$data = array();

$data['cancelledDate'] = isset($_GET['cancelledDate']) ? $_GET['cancelledDate'] : null;
$data['cancelledDate'] = stripcslashes($data['cancelledDate']);
$cancelledDate = mysqli_real_escape_string($conn, $data['cancelledDate']);

$data['orderId'] = isset($_GET['orderId']) ? $_GET['orderId'] : null;
$data['orderId'] = stripcslashes($data['orderId']);
$orderId = mysqli_real_escape_string($conn, $data['orderId']);

$sql = "SELECT MAX(cancelled_order_ID) as lastcoid FROM `gs technologies`.`cancelled_orders`;";
$result = mysqli_query($conn, $sql);
$recentcoId = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentcoId = $row['lastcoid'];
}
$coId = $recentcoId + 1;

$sql2 = "SELECT `chip_ID`,`chip_name`,`customer_name`,`customer_PAN_NUMBER`,`quantity`,`ordered_date` FROM `orders` WHERE order_ID = '$orderId'";
$result2 = mysqli_query($conn, $sql2);
while ($row1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    $chipId = $row1['chip_ID'];
    $chipName = $row1['chip_name'];
    $customerName = $row1['customer_name'];
    $panNumber = $row1['customer_PAN_NUMBER'];
    $quantity = $row1['quantity'];
    $orderDate = $row1['ordered_date'];
}
$sql3 = "DELETE FROM `orders` WHERE order_ID = $orderId";
$result3 = mysqli_query($conn, $sql3);
if ($orderId != "" && $result3) {
    $sql1 = "INSERT INTO `cancelled_orders` (`cancelled_order_ID`,`order_ID`,`chip_ID`,`customer_PAN_NUMBER`,`customer_name`,`cancelled_date`,`quantity`,`ordered_date`,`chip_name`)
    VALUES ('$coId','$orderId','$chipId','$panNumber','$customerName','$cancelledDate','$quantity','$orderDate','$chipName')";
    $result = "";

    if (mysqli_query($conn, $sql1)) {
        $result = "Order Cancelled!";
        echo $result;
    } else {
        if (mysqli_errno($conn) == 1062) {
            $result = "Enter different details";
            echo $result;
        } else {
            echo $result;
        }
    }
}



$conn->close();
