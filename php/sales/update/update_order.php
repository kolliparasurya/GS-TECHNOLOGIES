<?php
include "./connection.php";

$data = array();

$data['distributedDate'] = isset($_GET['distributedDate']) ? $_GET['distributedDate'] : null;
$data['distributedDate'] = stripcslashes($data['distributedDate']);
$distributedDate = mysqli_real_escape_string($conn, $data['distributedDate']);


$data['orderId'] = isset($_GET['orderId']) ? $_GET['orderId'] : null;
$data['orderId'] = stripcslashes($data['orderId']);
$orderId = mysqli_real_escape_string($conn, $data['orderId']);

$sql = "SELECT MAX(distribution_ID) as lastditributionid FROM `gs technologies`.`distribution`;";
$result = mysqli_query($conn, $sql);
$recentDistributionId = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentOrderId = $row['lastditributionid'];
}
$distrubtionId = $recentDistributionId + 1;

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

if ($orderId != "") {
    $sql1 = "INSERT INTO `distribution` (`distribution_ID`,`order_ID`,`chip_ID`,`customer_PAN_NUMBER`,`customer_name`,`distributed_date`,`quantity`,`ordered_date`,`chip_name`)
    VALUES ('$distributionId','$orderId','$chipId','$panNumber','$customerName',$distributedDate,'$quantity','$orderDate,'$chipName')";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Order Finished!";
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
