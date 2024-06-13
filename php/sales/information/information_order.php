<?php

include "./connection.php";


$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : null;
$orderId = stripcslashes($orderId);
$orderId = mysqli_real_escape_string($conn, $orderId);

$response = array();
$response['orderId'] = $orderId;
$response['chipId'] =  "";
$response['chipName'] =  "";
$response['customerName'] =  "";
$response['panNumber'] =  "";
$response['quantity'] =  "";
$response['date'] =  "";
$response['mark'] = "";



if ($orderId != "" && $response['chipId'] == "") {


    $sql = "SELECT `chip_ID`,`chip_name`,`customer_name`,`customer_PAN_NUMBER`,`quantity`,`ordered_date` FROM `orders` WHERE order_ID = '$orderId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['chipId'] = $row['chip_ID'];
        $response['chipName'] =  $row['chip_name'];
        $response['customerName'] = $row['customer_name'];
        $response['panNumber'] = $row['customer_PAN_NUMBER'];
        $response['quantity'] = $row['quantity'];
        $response['date'] = $row['ordered_date'];
        $response['mark'] = "order";
    }

    if ($response['mark'] == "order") {
        echo json_encode($response);
    }
}
if ($orderId != "" && $response['chipId'] == "") {

    $response['distributionId'] = "";
    $response['distributionDate'] = "";

    $sql = "SELECT `distribution_ID`,`chip_ID`,`chip_name`,`customer_name`,`customer_PAN_NUMBER`,`quantity`,`ordered_date`,`distributed_date` FROM `distribution` WHERE order_ID = '$orderId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['distributionId'] =  $row['distribution_ID'];
        $response['chipId'] =  $row['chip_ID'];
        $response['chipName'] = $row['chip_name'];
        $response['customerName'] =  $row['customer_name'];
        $response['panNumber'] =   $row['customer_PAN_NUMBER'];
        $response['quantity'] =  $row['quantity'];
        $response['distributionDate'] =  $row['distributed_date'];
        $response['orderDate'] =  $row['ordered_date'];
        $response['mark'] = "distributed";
    }
    if ($response['mark'] == "distributed") {
        echo json_encode($response);
    }
}
if ($orderId != "" && $response['chipId'] == "") {

    $response['cancelledOrderId'] = "";
    $response['cancelledDate'] = "";
    $sql = "SELECT `cancelled_order_ID`,`chip_ID`,`chip_name`,`customer_name`,`customer_PAN_NUMBER`,`quantity`,`ordered_date`,`cancelled_date` FROM `cancelled_orders` WHERE order_ID = '$orderId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['cancelledOrderId'] =  $row['cancelled_order_ID'];
        $response['chipId'] =  $row['chip_ID'];;
        $response['chipName'] =  $row['chip_name'];
        $response['customerName'] =  $row['customer_name'];
        $response['panNumber'] =  $row['customer_PAN_NUMBER'];
        $response['quantity'] =  $row['quantity'];
        $response['cancelledDate'] = $row['canclled_date'];
        $response['orderDate'] = $row['ordered_date'];
        $response['mark'] = "cancelled";
    }

    if ($response['mark'] == "cancelled") {
        echo json_encode($response);
    }
}
if ($orderId != "" && $response['chipId'] == "") {
    $response['mark'] = "outOfOrder";
    echo "Order Id not matched";
}
