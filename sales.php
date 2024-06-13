<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/sales.css">
</head>

<body>
    <?php
    include "./php/connection.php";
    ?>
    <div class="header">
        <!-- <div class="inner-header">
            <div class="layout-inner-header"> -->

        <a href="/home.php">
            <svg id="logo" width="100" height="40" x="1000" y="1000">
                <!-- Black circle -->
                <circle cx="20" cy="20" r="20" fill="#000000" />
                <!-- Red circle -->
                <circle cx="20" cy="20" r="10" fill="#ff0000" />
                <!-- GS text outside -->
                <text x="45" y="32" fill="#000000" font-family="Verdana" font-size="30" font-weight="bold" class="shadow">GS</text>
            </svg>
        </a>

        <div class="right-section-header">
            <a href="/">
                <p class="logout-button">
                    Logout
                </p>
            </a>
        </div>
        <!-- </div>
        </div> -->
    </div>
    <div class="container">
        <div id="main-secion" class="main-section">
            <div class="tabs">
                <div class="main-section-contents">
                    <a href="./home.php" style="text-decoration: none;">
                        <p class="main-section-p ">
                            Home
                        </p>
                    </a>
                </div>
                <div class="main-section-contents">
                    <a href="./randd.php" style="text-decoration: none;">
                        <p class="main-section-p">
                            R&D
                        </p>
                    </a>
                </div>
                <div class="main-section-contents ">
                    <a href="./sales.php" style="text-decoration: none;">
                        <p class="main-section-p main-section-p-active">
                            Sales
                        </p>
                    </a>
                </div>
                <div class="main-section-contents">
                    <a href="./production.php" style="text-decoration: none;">
                        <p class="main-section-p">
                            Production
                        </p>
                    </a>
                </div>
                <div class="main-section-contents">
                    <a href="./marketing.php" style="text-decoration: none;">
                        <p class="main-section-p">
                            Marketing
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="content-section">
            <div id="total-orders" class="total-orders">
                <p id="total-orders-ans" class="total-orders-ans">
                    Total Number Of Orders:
                    <?php
                    $sql1 = "SELECT * FROM `orders`";
                    $sql2 = "SELECT * FROM `distribution`";
                    $sql3 = "SELECT * FROM `cancelled_orders`";
                    $query1 = mysqli_query($conn, $sql1);
                    $query2 = mysqli_query($conn, $sql2);
                    $query3 = mysqli_query($conn, $sql3);
                    $rowcount1 = mysqli_num_rows($query1);
                    $rowcount2 = mysqli_num_rows($query2);
                    $rowcount3 = mysqli_num_rows($query3);
                    echo ($rowcount1 + $rowcount2 + $rowcount3);
                    ?>
                </p>
            </div>
            <div id="total-customers" class="total-customers">
                <p id="total-customers-ans" class="total-customers-ans">
                    Total Number Of Cutomers:
                    <?php
                    $sql = "SELECT * FROM `customers`";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div>
            <div id="total-chip" class="total-chip">
                <p id="total-chip-ans" class="total-chip-ans">
                    Best Customer:
                    <?php
                    $sql =  "SELECT customer_name, COUNT(customer_PAN_NUMBER) AS `cnt` 
                FROM `gs technologies`.`distribution` 
                GROUP BY customer_name
                ORDER BY `cnt` DESC
                LIMIT 1;";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        $chipName = $row['customer_name'];
                        echo "$chipName" . " ";
                    }
                    ?>
                </p>
            </div><br>
            <button class="mainButtons" onclick="addOButton()">ADD ORDER</button>
            <button class="mainButtons" onclick="addCButton()" style="display: inline;  margin-left: 47px">ADD CUSTOMER</button><br>
            <button class="mainButtons" onclick="updateOButton()">UPDATE ORDER</button>
            <button class="mainButtons" onclick="updateCButton()" style="display: inline; margin-left: 10px">UPDATE CUSTOMER</button><br>
            <button class="mainButtons" onclick="infoOButton()">ORDER INFO</button>
            <button class="mainButtons" onclick="infoCButton()" style="display: inline;  margin-left: 42px">CUSTOMER INFO</button><br>
            <div id="orders" class="order">
                <div id="add-order" class="innerBoxes" style="display: none;">
                    <h4>ORDER DETAILS</h4>
                    <label for="chip-id">Chip Id: </label><br>
                    <input type="text" id="chip-id" name="chip-id" required><br>
                    <label for="chip-name">Chip Name: </label><br>
                    <input type="text" id="chip-name" name="chip-name" required><br>
                    <label for="order-customer-name">Customer Name: </label><br>
                    <input type="text" id="order-customer-name" name="order-customer-name" required><br>
                    <label for="order-customer-pan-number">Customer PAN Number: </label><br>
                    <input type="text" id="order-customer-pan-number" name="order-customer-pan-number" required><br>
                    <label for="quantity">Quantity: </label><br>
                    <input type="text" id="quantity" name="quantity"><br>
                    <label for="order-date">Date: </label><br>
                    <input type="date" id="order-date" name="order-date"><br>
                    <button class="innerButtons" onclick="addOrder()">+Add</button>
                </div>
                <p id="addOrderResult"></p>
                <div id="update-order" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-order" class="search-bar-update-order">
                        <label for="search-order-update">Search with orderId:</label>
                        <input type="search" id="search-order-update" class="search-order-update">
                        <button class="innerButtons" onclick="searchOrder()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="cancel-and-finished-update-order-button" class="cancel-and-finished-update-order-button" style="display: none;">
                        <label for="date-order-update">Enter Date:</label>
                        <input type="date" id="date-order-update" class="date-order-update"><br><br>
                        <button class="innerButtons" onclick="updateOrder('cancelled')">Cancel</button><br><br>
                        <button class="innerButtons" onclick="updateOrder('finished')">Finished</button>
                        <p id="oUpdateResultNegative"></p>
                    </div>
                    <p id="oUpdateResult"></p>
                </div>
                <div id="info-order" class="innerBoxes" style="display: none;">
                    <h4>Enter Order Details</h4>
                    <label for="orderid-search-order-info">Enter orderId: </label>
                    <input type="text" id="orderid-search-order-info" name="orderid-search-order-info"><br>
                    <button class="innerButtons" onclick="infoOrder()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-order-details" class="info-order-details" style="display: none;">
                        <label for="info-order-Id">Order ID:</label>
                        <p id="info-order-Id" style="display: inline;"></p><br>
                        <label for="info-order-chip-Id">Chip ID:</label>
                        <p id="info-order-chip-Id" style="display: inline;"></p><br>
                        <label for="info-order-chip-name">Chip Name: </label>
                        <p id="info-order-chip-name" style="display: inline;"></p><br>
                        <label for="info-order-customer-name">Customer Name: </label>
                        <p id="info-order-customer-name" style="display: inline;"></p><br>
                        <label for="info-order-pan-number">Customer PAN Number:</label>
                        <p id="info-order-pan-number" style="display: inline;"></p><br>
                        <label for="info-order-quantity">Quantity: </label>
                        <p id="info-order-quantity" style="display: inline;"></p><br>
                        <label for="info-order-date">Order Date: </label>
                        <p id="info-order-date" style="display: inline;"></p><br>
                    </div>
                    <div id="info-distribution-details" class="info-distribution-details" style="display: none;">
                        <label for="info-distribution-Id">Distribution ID:</label>
                        <p id="info-distribution-Id" style="display: inline;"></p><br>
                        <label for="info-distribution-order-Id">Order ID:</label>
                        <p id="info-distribution-order-Id" style="display: inline;"></p><br>
                        <label for="info-distribution-chip-Id">Chip ID:</label>
                        <p id="info-distribution-chip-Id" style="display: inline;"></p><br>
                        <label for="info-distribution-chip-Name">Chip Name: </label>
                        <p id="info-distribution-chip-name" style="display: inline;"></p><br>
                        <label for="info-distribution-customer-name">Customer Name: </label>
                        <p id="info-distribution-customer-name" style="display: inline;"></p><br>
                        <label for="info-distribution-pan-number">Customer PAN Number:</label>
                        <p id="info-distribution-pan-number" style="display: inline;"></p><br>
                        <label for="info-distribution-quantity">Quantity: </label>
                        <p id="info-distribution-quantity" style="display: inline;"></p><br>
                        <label for="info-distribution-order-date">Order Date: </label>
                        <p id="info-distribution-order-date" style="display: inline;"></p><br>
                        <label for="info-distribution-date">Distributed Date: </label>
                        <p id="info-distribution-date" style="display: inline;"></p><br>
                    </div>
                    <div id="info-cancellation-details" class="info-cancelled-order-details" style="display: none;">
                        <label for="info-cancellation-Id">Cancellation ID:</label>
                        <p id="info-cancellation-Id" style="display: inline;"></p><br>
                        <label for="info-cancellation-order-Id">Order ID:</label>
                        <p id="info-cancellation-order-Id" style="display: inline;"></p><br>
                        <label for="info-cancellation-chip-Id">Chip ID:</label>
                        <p id="info-cancellation-chip-Id" style="display: inline;"></p><br>
                        <label for="info-cancellation-chip-Name">Chip Name: </label>
                        <p id="info-cancellation-chip-name" style="display: inline;"></p><br>
                        <label for="info-cancellation-customer-name">Customer Name: </label>
                        <p id="info-cancellation-customer-name" style="display: inline;"></p><br>
                        <label for="info-cancellation-pan-number">Customer PAN Number:</label>
                        <p id="info-cancellation-pan-number" style="display: inline;"></p><br>
                        <label for="info-cancellation-quantity">Quantity: </label>
                        <p id="info-cancellation-quantity" style="display: inline;"></p><br>
                        <label for="info-cancellation-order-date">Order Date: </label>
                        <p id="info-cancellation-order-date" style="display: inline;"></p><br>
                        <label for="info-cancellation-date">Cancellation Date: </label>
                        <p id="info-cancellation-date" style="display: inline;"></p><br>
                    </div>
                    <p id="infoResultNegative"></p>
                </div>
            </div>
            <div id="customers" class="customers">
                <div id="add-customer" class="innerBoxes" style="display: none;">
                    <h4>CUSTOMER DETAILS</h4>
                    <label for="customer-name">Name: </label><br>
                    <input type="text" id="customer-name" class="customer-name" required><br>
                    <label for="customer-address">Address: </label><br>
                    <input type="text" id="customer-address" class="customer-address"><br>
                    <label for="customer-phone-number">Phone Number: </label><br>
                    <input type="text" id="customer-phone-number" class="customer-phone-number"><br>
                    <label for="customer-email">Email: </label><br>
                    <input type="text" id="customer-email" class="customer-email"><br>
                    <label for="customer-pan-number">PAN Number: </label><br>
                    <input type="text" id="customer-pan-number" class="customer-pan-number"><br>
                    <button class="innerButtons" onclick="addCustomer()">+Add</button>
                </div>
                <p id="addCustomerResult"></p>
                <div id="update-customer" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-customer" class="search-bar-update-customer">
                        <h4>Enter Customer Details</h4>
                        <label for="email-search-customer-update">Email: </label><br>
                        <input type="text" id="email-search-customer-update" class="email-search-customer-update"><br>
                        <button class="innerButtons" onclick="searchCustomer()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-customer-details" class="update-customer-details" style="display: none;">
                        <h4>CUSTOMER DETAILS</h4>
                        <label for="previous-customer-name">Name: </label><br>
                        <input type="text" id="previous-customer-name" class="previous-customer-name" value=""><br>
                        <label for="previous-customer-address">Address: </label><br>
                        <input type="text" id="previous-customer-address" class="previous-customer-address"><br>
                        <label for="previous-customer-phone-number">Phone Number: </label><br>
                        <input type="text" id="previous-customer-phone-number" class="previous-customer-phone-number"><br>
                        <label for="previous-customer-email">Email: </label><br>
                        <input type="text" id="previous-customer-email" class="previous-customer-email"><br>
                        <label for="previous-customer-pan-number">PAN Number: </label><br>
                        <input type="text" id="previous-customer-pan-number" class="previous-customer-pan-number"><br>
                        <p id="cUpdateResultNegative"></p>
                        <button class="innerButtons" onclick="updateCustomer('updating')">Update</button>
                        <button class="innerButtons" onclick="updateCustomer('deleting')">Delete</button>
                    </div>
                    <p id="cUpdateResult"></p>
                </div>
                <div id="info-customer" class="innerBoxes" style="display: none;">
                    <label for="email-search-customer-info">Enter Customer Email:</label>
                    <input type="text" id="email-search-customer-info" class="email-search-customer-info">
                    <button class="innerButtons" onclick="infoCustomer()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-customer-details" class="info-customer-details" style="display: none;">
                        <label for="info-customer-name">Name:</label>
                        <p id="info-customer-name" style="display: inline;"></p><br>
                        <label for="info-customer-address">Address:</label>
                        <p id="info-customer-address" style="display: inline;"></p><br>
                        <label for="info-customer-phone-number">Phone Number: </label>
                        <p id="info-customer-phone-number" style="display: inline;"></p><br>
                        <label for="info-customer-email">Email:</label>
                        <p id="info-customer-email" style="display: inline;"></p><br>
                        <label for="info-customer-pan-number">PAN Number: </label>
                        <p id="info-customer-pan-number" style="display: inline;"></p><br>
                    </div>
                </div>
            </div><br>
            <div id="recentOrders" class="recentOrders">
                <h3>RECENT ACTIVE ORDERS</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Chip Id</th>
                            <th>Chip Name</th>
                            <th>Company Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT `chip_ID`,`chip_name`,`customer_name`,`quantity`,`ordered_date` FROM orders ORDER BY `order_ID` DESC LIMIT 5";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['chip_ID'] . "</td>";
                            echo "<td>" . $row['chip_name'] . "</td>";
                            echo "<td>" . $row['customer_name'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['ordered_date'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        function addOButton() {
            if (document.getElementById('add-order').style.display == 'block') {
                document.getElementById('add-order').style.display = 'none';
            } else if (document.getElementById('add-order').style.display == 'none') {
                document.getElementById('add-order').style.display = 'block';
            }
        }

        function updateOButton() {
            if (document.getElementById('update-order').style.display == 'block') {
                document.getElementById('update-order').style.display = 'none';
            } else if (document.getElementById('update-order').style.display == 'none') {
                document.getElementById('update-order').style.display = 'block';
            }
        }

        function infoOButton() {
            if (document.getElementById('info-order').style.display == 'block') {
                document.getElementById('info-order').style.display = 'none';
            } else if (document.getElementById('info-order').style.display == 'none') {
                document.getElementById('info-order').style.display = 'block';
            }
        }

        function addCButton() {
            if (document.getElementById('add-customer').style.display == 'block') {
                document.getElementById('add-customer').style.display = 'none';
            } else if (document.getElementById('add-customer').style.display == 'none') {
                document.getElementById('add-customer').style.display = 'block';
            }
        }

        function updateCButton() {
            if (document.getElementById('update-customer').style.display == 'block') {
                document.getElementById('update-customer').style.display = 'none';
            } else if (document.getElementById('update-customer').style.display == 'none') {
                document.getElementById('update-customer').style.display = 'block';
            }
        }

        function infoCButton() {
            if (document.getElementById('info-customer').style.display == 'block') {
                document.getElementById('info-customer').style.display = 'none';
            } else if (document.getElementById('info-customer').style.display == 'none') {
                document.getElementById('info-customer').style.display = 'block';
            }
        }
    </script>
    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script src="./scripts/sales/customer.js"></script>
    <script src="./scripts/sales/order.js"></script>
</body>

</html>