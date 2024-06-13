<?php

include "./connection.php";


$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : null;
$orderId = stripcslashes($orderId);
$orderId = mysqli_real_escape_string($conn, $orderId);




if ($orderId != "") {


    $sql = "SELECT * FROM `orders` WHERE order_ID = '$orderId'";
    $result = mysqli_query($conn, $sql);
    $hello = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $hello = $hello + 1;
    }

    if ($hello == 1) {
        echo "present";
    } else {
        echo "Not In Activ Orders";
    }
}
