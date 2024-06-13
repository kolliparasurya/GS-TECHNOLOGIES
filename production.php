<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    <link rel="stylesheet" href="./css/production.css">
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
                        <p class="main-section-p">
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
                <div class="main-section-contents">
                    <a href="./sales.php" style="text-decoration: none;">
                        <p class="main-section-p">
                            Sales
                        </p>
                    </a>
                </div>
                <div class="main-section-contents">
                    <a href="./production.php" style="text-decoration: none;">
                        <p class="main-section-p main-section-p-active">
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
        <div id="content-section" class="content-section">
            <div>
                <p id="chips-product-stock" class="chips-product-stock">
                    Total Number Of Chips In Stock:
                    <?php
                    $sql = "SELECT * FROM `product_stock`";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div>
            <div>
                <p id="chips-highest-product-stock" class="chips-highest-product-stock">
                    Highest Product Stock Chip:
                    <?php
                    $sql = "SELECT `name`,`net_quantity` FROM `gs technologies`.`product_stock` ORDER BY `net_quantity` LIMIT 1";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        $name = $row['name'];
                        echo "$name";
                    }
                    ?>
                </p>
            </div>
            <div>
                <p id="chips-highest-rawmaterial-stock" class="chips-highest-rawmaterial-stock">
                    Highest Rawmaterial Stock:
                    <?php
                    $sql = "SELECT `name`, `quantity`FROM `gs technologies`.`raw_material_stock`ORDER BY `quantity` DESC LIMIT 1";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        $name = $row['name'];
                        echo "$name";
                    }
                    ?>
                </p>
            </div>
            <br>
            <button class="mainButtons" id="pc1" onclick="addPSButton()">ADD PRODUCT STOCK</button>
            <button class="mainButtons" id="pc2" onclick="updatePSButton()">UPDATE PRODUCT STOCK</button>
            <button class="mainButtons" id="pc3" onclick="infoPSButton()">PRODUCT STOCK INFO</button>
            <button class="mainButtons" id="mc1" onclick="addMSButton()">ADD MATERIAL STOCK</button>
            <button class="mainButtons" id="mc2" onclick="updtaeMSButton()">UPDATE MATERIAL STOCK</button>
            <button class="mainButtons" id="mc3" onclick="infoMSButton()">MATERIAL STOCK INFO</button>
            <button class="mainButtons" id="m1" onclick="addMButton()">ADD MATERIAL</button>
            <button class="mainButtons" id="m2" onclick="updateButton()">UPDATE MATERIAL</button>
            <button class="mainButtons" id="m3" onclick="infoButton()">MATERIAL INFO</button><br>
            <button class="mainButtons" id="l1" onclick="addLButton()">ADD LABOUR</button>
            <button class="mainButtons" id="l2" onclick="updateLButton()">UPDATE LABOUR</button>
            <button class="mainButtons" id="l3" onclick="infoLButton()">LABOUR INFO</button><br>
            <button class="mainButtons" id="ma1" onclick="addMAButton()">ADD MACHINERY</button>
            <button class="mainButtons" id="ma2" onclick="updateMAButton()">UPDATE MACHINERY</button>
            <button class="mainButtons" id="ma3" onclick="infoMAButton()">MACHINERY INFO</button>
            <div id="product-stock" class="product-stock">
                <div id="add-product-stock" class="innerBoxes" style="display: none;">
                    <h3>ENTER PRODUCT STOCK DETAILS</h3>
                    <label for="produt-stock-chip-Id">Chip Id:</label><br>
                    <input type="text" id="product-stock-chip-Id" class="product-stock-chip-Id"><br>
                    <label for="product-stock-chip-name">Chip Name: </label><br>
                    <input type="text" id="product-stock-chip-name" class="product-stock-chip-name"><br>
                    <label for="product-stock-produced-quantity">Produced Quantity: </label><br>
                    <input type="text" id="product-stock-produced-quantity" class="product-stock-produced-quantity"><br>
                    <label for="produced-stock-defected-quantity">Defected Quantity: </label><br>
                    <input type="text" id="produced-stock-defected-quantity" class="produced-stock-defected-quantity"><br>
                    <label for="produced-stock-net-quantity">Net Quantity: </label><br>
                    <input type="text" id="produced-stock-net-quantity" class="produced-stock-net-quantity"><br>
                    <label for="produced-stock-machinery">Machinery(seperate with comma): </label><br>
                    <input type="text" id="produced-stock-machinery" class="produced-stock-machinery"><br>
                    <label for="produced-stock-labour">Labour's(seperate ID's with comma): </label><br>
                    <input type="text" id="produced-stock-labour" class="produced-stock-labour"><br>
                    <label for="produced-stock-rawmaterial">Rawmaterial's: </label><br>
                    <input type="text" id="produced-stock-rawmaterial" class="produced-stock-rawmaterial"><br>
                    <label for="produced-stock-stocked-date">Stocked Date: </label><br>
                    <input type="date" id="produced-stock-stocked-date" class="produced-stock-stocked-date"><br>
                    <p id="addingResult"></p>
                    <button class="innerButtons" onclick="addingProductStock()">+Add</button>
                </div>
                <div id="update-product-stock" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-product-stock" class="search-bar-update-product-stock">
                        <label for="batchId-search-product-stock-update">Search with batch Id:</label><br>
                        <input type="text" id="batchId-search-product-stock-update" class="batchId-search-product-stock-update">
                        <button class="innerButtons" onclick="searchingProductStock()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-product-stock" class="update-details-product-stock" style="display: none;">
                        <h3>UPDATE PRODUCTSTOCK DETAILS</h3>
                        <label for="previous-product-stock-batch-Id">Batch Id:</label><br>
                        <input type="text" id="previous-product-stock-batch-Id" class="previous-product-stock-batch-Id"><br>
                        <label for="previous-product-stock-chip-Id">Chip Id:</label><br>
                        <input type="text" id="previous-product-stock-chip-Id" class="previous-product-stock-chip-Id"><br>
                        <label for="previous-product-stock-chip-name">Chip Name: </label><br>
                        <input type="text" id="previous-product-stock-chip-name" class="previous-product-stock-chip-name"><br>
                        <label for="previous-product-stock-produced-quantity">Produced Quantity(mention units):
                        </label><br>
                        <input type="text" id="previous-product-stock-produced-quantity" class="previous-product-stock-produced-quantity"><br>
                        <label for="previous-produced-stock-defected-quantity">Defected Quantity(mention units):
                        </label><br>
                        <input type="text" id="previous-produced-stock-defected-quantity" class="previous-produced-stock-defected-quantity"><br>
                        <label for="previous-produced-stock-net-quantity">Net Quantity(mention units): </label><br>
                        <input type="text" id="previous-produced-stock-net-quantity" class="previous-produced-stock-net-quantity"><br>
                        <label for="previous-produced-stock-machinery">Machinery(seperate with comma): </label><br>
                        <input type="text" id="previous-produced-stock-machinery" class="previous-produced-stock-machinery"><br>
                        <label for="previous-produced-stock-labour">Labour's(seperate ID with comma): </label><br>
                        <input type="text" id="previous-produced-stock-labour" class="previous-produced-stock-labour"><br>
                        <label for="previous-produced-stock-rawmaterial">Rawmaterial's: </label><br>
                        <input type="text" id="previous-produced-stock-rawmaterial" class="previous-produced-stock-rawmaterial"><br>
                        <label for="previous-produced-stock-stocked-date">Stocked Date: </label><br>
                        <input type="text" id="previous-produced-stock-stocked-date" class="previous-produced-stock-stocked-date"><br>
                        <p id="psUpdatingResultNegative"></p>
                        <button class="innerButtons" onclick="updatingProductStock('updating')">Update</button>
                        <button class="innerButtons" onclick="updatingProductStock('deleting')">Delete</button>
                    </div>
                    <p id="psUpdateResult"></p>
                </div>
                <div id="info-prouduct-stock" class="innerBoxes" style="display: none;">
                    <h3>PRODUCT STOCK INFO</h3>
                    <label for="batchId-search-product-stock-info">Search with batch Id:</label><br>
                    <input type="text" id="batchId-search-product-stock-info" class="batchId-search-product-stock-info"><br>
                    <h5>OR</h5>
                    <label for="date-search-product-stock-info">Search with stocked date: </label><br>
                    <input type="date" id="date-search-stock-info" name="date-search-product-stock-info">
                    <button class="innerButtons" onclick="productStockInfo()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-productStock" class="info-product-stock" style="display: none;">
                        <label for="info-BatchId">Batch ID:</label>
                        <p id="info-BatchId" style="display: inline;"></p><br>
                        <label for="info-chipId">Chip ID: </label>
                        <p id="info-chipId" style="display: inline;"></p><br>
                        <label for="info-chipName">Chip Name: </label>
                        <p id="info-chipName" style="display: inline;"></p><br>
                        <label for="info-produced-quantity">Produced Quantity: </label>
                        <p id="info-produced-quantity" style="display: inline;"></p><br>
                        <label for="info-defected-quantity">Defected Quantity: </label>
                        <p id="info-defected-quantity" style="display: inline;"></p><br>
                        <label for="info-net-quantity">Net Quantity: </label>
                        <p id="info-net-quantity" style="display: inline;"></p><br>
                        <label for="info-machinery-names">Machinery Names: </label>
                        <p id="info-machinery-names" style="display: inline;"></p><br>
                        <label for="info-labour-names">Labour ID's: </label>
                        <p id="info-labour-names" style="display: inline;"></p><br>
                        <label for="info-rawmaterials">Rawmaterials: </label>
                        <p id="info-rawmaterials" style="display: inline;"></p><br>
                        <label for="info-stocked-date">Stocked Date: </label>
                        <p id="info-stocked-date" style="display: inline;"></p><br>
                    </div>
                </div>
            </div>
            <div id="rawmaterial-stock" class="rawmaterial-stock">
                <div id="add-rawmaterial-stock" class="innerBoxes" style="display: none;">
                    <h4>ENTER MATERIAL STOCK DETAILS</h4>
                    <label for="rawmaterial-name">Name: </label><br>
                    <input type="text" id="stock-rawmaterial-name" form="rawmaterial-name" required><br>
                    <label for="rawmaterial-Id">Id: </label><br>
                    <input type="text" id="stock-rawmaterial-Id" form="rawmaterial-Id" required><br>
                    <label for="rawmaterial-quantity">Quantity(mention units): </label><br>
                    <input type="text" id="stock-rawmaterial-quantity" form="rawmaterial-quantity" required><br>
                    <label for="rawmaterial-date">Date: </label><br>
                    <input type="date" id="stock-rawmaterial-date" form="rawmaterial-date" required><br>
                    <p id="addRawmaterialStockResult"></p>
                    <button class="innerButtons" onclick="addRawmaterialStock()">+Add</button>
                </div>
                <div id="update-rawmaterial-stock" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-rawmaterial-stock" class="search-bar-update-rawmaterial-stock">
                        <label for="batchId-search-rawmaterial-stock-update">Enter batch Id:</label><br>
                        <input type="text" id="batchId-search-rawmaterial-stock-update" class="batchId-search-rawmaterial-stock-update">
                        <button class="innerButtons" onclick="searchRawmaterialStock()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-rawmaterial-stock" class="update-details-rawmaterial-stock" style="display: none;">
                        <h3>UPDATE MATERIALSTOCK DETAILS</h3>
                        <label for="previous-stock-rawmaterial-batch-id">Batch Id: </label><br>
                        <input type="text" id="previous-stock-rawmaterial-batch-id" form="previous-stock-rawmaterial-batch-id" value="" required readonly><br>
                        <label for="previous-stock-rawmaterial-name">Name: </label><br>
                        <input type="text" id="previous-stock-rawmaterial-name" form="previous-stock-rawmaterial-name" value="" required><br>
                        <label for="previous-stock-rawmaterial-Id">Id: </label><br>
                        <input type="text" id="previous-stock-rawmaterial-Id" form="previous-stock-rawmaterial-Id" value="" required><br>
                        <label for="previous-stock-rawmaterial-quantity">Quantity(mention units): </label><br>
                        <input type="text" id="previous-stock-rawmaterial-quantity" form="previous-rawmaterial-quantity" value="" required><br>
                        <label for="previous-stock-rawmaterial-stocked-date">Stocked Date: </label>
                        <input type="text" id="previous-stock-rawmaterial-stocked-date" class="previous-stock-rawmaterial-stocked-date">
                        <p id="rmsUpdatingResultNegative"></p>
                        <button class="innerButtons" onclick="updateRawmaterialStock('updating')">Update</button>
                        <button class="innerButtons" onclick="updateRawmaterialStock('deleting')">Delete</button>
                    </div>
                    <p id="rmsUpdateResult"></p>
                </div>
                <div id="info-rawmaterial-stock" class="innerBoxes" style="display: none;">
                    <label for="batchId-search-rawmaterial-stock-info">Enter batchId:</label><br>
                    <input type="text" id="batchId-search-rawmaterial-stock-info" class="batchId-search-rawmaterial-stock-info"><br>
                    <h5>OR</h5>
                    <label for="date-search-product-rawmaterial-stock-info">Search by stock date: </label><br>
                    <input type="date" id="date-search-rawmaterial-stock-info" name="date2-search-product-rawmaterial-stock-info">
                    <button class="innerButtons" onclick="rawmaterialStockInfo()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info" class="info-rawmaterial-stock" style="display: none;">
                        <label for="info-rawmaterial-stock-BatchId">Batch ID:</label>
                        <p id="info-rawmaterial-stock-BatchId" style="display: inline;"></p><br>
                        <label for="info-rawmaterial-stock-rawmaterialId">Rawmaterial ID: </label>
                        <p id="info-rawmaterial-stock-rawmaterialId" style="display: inline;"></p><br>
                        <label for="info-rawmaterial-stock-rawmaterial-name">Rawmaterial Name: </label>
                        <p id="info-rawmaterial-stock-rawmaterial-name" style="display: inline;"></p><br>
                        <label for="info-rawmaterial-stock-quantity">Quantity: </label>
                        <p id="info-rawmaterial-stock-quantity" style="display: inline;"></p><br>
                        <label for="info-rawmaterial-stock-stocked-date">Stocked Date: </label>
                        <p id="info-rawmaterial-stock-stocked-date" style="display: inline;"></p><br>
                    </div>
                </div>
            </div>
            <div id="rawmaterial" class="rawmaterial">
                <div id="add-rawmaterial" class="innerBoxes" style="display: none;"><br>
                    <h3>ENTER RAWMATERIAL DETAILS</h3>
                    <label for="rawmaterial-name">Name: </label><br>
                    <input type="text" id="rawmaterial-name" form="rawmaterial-name"><br>
                    <button class="innerButtons" onclick="addRawmaterial()">+Add</button>
                    <p id="addRawmaterialResult"></p>
                </div>
                <div id="update-rawmaterial" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-rawmaterial" class="search-bar-update-rawmaterial">
                        <label for="id-search-rawmaterial-update">Enter Id:</label><br>
                        <input type="text" id="id-search-rawmaterial-update" class="id-search-rawmaterial-update">
                        <button class="innerButtons" onclick="searchRawmaterial()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-rawmaterial" class="update-details-rawmaterial" style="display: none;">
                        <h3>UPDATE RAWMATERIAL DETAILS</h3>
                        <label for="previous-rawmaterial-Id">Id: </label><br>
                        <input type="text" id="previous-rawmaterial-Id" form="previous-rawmaterial-Id"><br>
                        <label for="previous-rawmaterial-name">Name: </label><br>
                        <input type="text" id="previous-rawmaterial-name" form="previous-rawmaterial-name"><br>
                        <button class="innerButtons" onclick="updateRawmaterial('updating')">Update</button>
                        <button class="innerButtons" onclick="updateRawmaterial('deleting')">Delete</button>
                        <p id="rmUpdateResultNegative"></p>
                    </div>
                    <p id="rmUpdateResult"></p>
                </div>
                <div id="info-rawmaterial" class="innerBoxes" style="display: none;">
                    <label for="name-search-rawmaterial-info">Enter name:</label><br>
                    <input type="text" id="" class="name-search-rawmaterial-info"><br>
                    <h5>OR</h5>
                    <label for="Id-search-rawmaterial-info">Enter Id:</label><br>
                    <input type="text" id="Id-search-rawmaterial-info" class="Id-search-rawmaterial-info">
                    <button class="innerButtons" onclick="infoRawmaterial()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="infoRawmaterial" class="infoRawmaterial" style="display: none;">
                        <label for="rawmaterial-id-info">Rawmaterial Id: </label>
                        <p id="rawmaterial-id-info" style="display: inline;"></p><br>
                        <label for="rawmaterial-name-info">Rawmaterial Name: </label>
                        <p id="rawmaterial-name-info" style="display: inline;"></p><br>
                    </div>
                </div>
            </div>
            <div id="machinery" class="machinery">
                <div id="add-machinery" class="innerBoxes" style="display: none;">
                    <h3>ENTER MACHINERY DETAILS</h3>
                    <label for="machinery-name">Name: </label><br>
                    <input type="text" id="machinery-name" class="machinery-name"><br>
                    <label for="machinery-use">Use: </label><br>
                    <input type="text" id="machinery-use" class="machinery-use"><br>
                    <button class="innerButtons" onclick="addMachinery()">+Add</button>
                    <p id="addMachineryResult"></p>
                </div>
                <div id="update-machinery" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-machinery" class="search-bar-update-machinery">
                        <label for="Id-search-machinery-update">Enter Id:</label><br>
                        <input type="text" id="Id-search-machinery-update" class="Id-search-machinery-update">
                        <button class="innerButtons" onclick="searchMachinery()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-machinery" class="update-details-machinery" style="display: none;">
                        <label for="previous-machinery-Id">Id: </label><br>
                        <input type="text" id="previous-machinery-Id" class="machinery-Id"><br>
                        <label for="previous-machinery-name">Name: </label><br>
                        <input type="text" id="previous-machinery-name" class="previous-machinery-name" value="" required><br>
                        <label for="previous-machinery-use">Use: </label><br>
                        <input type="text" id="previous-machinery-use" class="previous-machinery-use" value="" required><br>
                        <button class="innerButtons" onclick="updateMachinery('updating')">Update</button>
                        <button class="innerButtons" onclick="updateMachinery('deleting')">Delete</button>
                        <p id="mUpdateResultNegative"></p>
                    </div>
                    <p id="mUpdateResult"></p>
                </div>
                <div id="info-machinery" class="innerBoxes" style="display: none;">
                    <label for="name-search-machinery-info">Enter Name:</label><br>
                    <input type="text" id="name-search-machinery-info" class="name-search-machinery-info">
                    <button class="innerButtons" onclick="infoMachinery()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-machinery-details" class="info-machinery-details" style="display: none;">
                        <label for="info-machinery-Id">Labour ID:</label>
                        <p id="info-machinery-Id" style="display: inline;"></p><br>
                        <label for="info-machinery-name">Name: </label>
                        <p id="info-machinery-name" style="display: inline;"></p><br>
                        <label for="info-machinery-use">Use: </label>
                        <p id="info-machinery-use" style="display: inline;"></p><br>
                    </div>
                </div>
            </div>
            <div id="labour" class="labour">
                <div id="add-labour" class="innerBoxes" style="display: none;">
                    <h3>ENTER LABOUR DETAILS</h3>
                    <label for="labour-name">Name: </label>
                    <input type="text" id="labour-name" form="labour-name"><br>
                    <label for="labour-division">Division: </label><br>
                    <input type="text" id="labour-division" form="labour-division"><br>
                    <label for="labour-phone-number">Phone Number: </label><br>
                    <input type="text" id="labour-phone-number" form="labour-phone-number"><br>
                    <label for="labour-email">Email: </label><br>
                    <input type="text" id="labour-email" form="labour-email"><br>
                    <label for="labour-address">Address: </label><br>
                    <input type="text" id="labour-address" form="labour-address"><br>
                    <button class="innerButtons" onclick="addLabour()">Add</button><br>
                    <p id="addLabourResult"></p>
                </div>
                <div id="update-labour" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-labour" class="search-bar-update-labour">
                        <label for="Id-search-labour-update">Enter Id:</label><br>
                        <input type="text" id="Id-search-labour-update" class="Id-search-labour-update">
                        <button class="innerButtons" onclick="searchLabour()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-labour" class="update-details-labour" style="display: none;">
                        <h3>UPDATE LABOUR DETAILS</h3>
                        <label for="previous-labour-Id">Labour Id: </label><br>
                        <input type="text" id="previous-labour-Id" form="previous-labour-Id" required><br>
                        <label for="previous-labour-name">Name: </label><br>
                        <input type="text" id="previous-labour-name" form="previous-labour-name" required><br>
                        <label for="previous-labour-division">Division: </label><br>
                        <input type="text" id="previous-labour-division" form="previous-labour-division" required><br>
                        <label for="previous-labour-phone-number">Phone Number: </label><br>
                        <input type="text" id="previous-labour-phone-number" form="previous-labour-phone-number" required><br>
                        <label for="previous-labour-email">Email: </label><br>
                        <input type="text" id="previous-labour-email" form="previous-labour-email" required><br>
                        <label for="previous-labour-address">Address: </label><br>
                        <input type="text" id="previous-labour-address" form="previous-labour-address" required><br>
                        <p id="lUpdateResultNegative"></p>
                        <button class="innerButtons" onclick="updateLabour('updating')">Update</button>
                        <button class="innerButtons" onclick="updateLabour('deleting')">Delete</button><br>
                    </div>
                    <p id="lUpdateResult"></p>
                </div>
                <div id="info-labour" class="innerBoxes" style="display: none;">
                    <label for="email-search-labour-info">Enter Email:</label><br>
                    <input type="text" id="email-search-labour-info" class="email-search-labour-info">
                    <button class="innerButtons" onclick="infoLabour()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-labour-details" class="info-labour-details" style="display: none;">
                        <label for="info-labour-Id">Labour ID:</label>
                        <p id="info-labour-Id" style="display: inline;"></p><br>
                        <label for="info-labour-name">Name: </label>
                        <p id="info-labour-name" style="display: inline;"></p><br>
                        <label for="info-labour-division">Division: </label>
                        <p id="info-labour-division" style="display: inline;"></p><br>
                        <label for="info-labour-phone-number">Phone Number: </label>
                        <p id="info-labour-phone-number" style="display: inline;"></p><br>
                        <label for="info-labour-email">Email: </label>
                        <p id="info-labour-email" style="display: inline;"></p><br>
                        <label for="info-labour-address">Address: </label>
                        <p id="info-labour-address" style="display: inline;"></p><br>
                    </div>
                </div>
            </div>
            <br>
            <div id="get-latest-product-stock" class="get-latest-product-stock">
                <h3>LATEST PRODUCT STOCK</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Batch Id</th>
                            <th>Chip Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT `batch_ID`,`name`,`net_quantity`,`stocked_date` FROM product_stock ORDER BY `batch_ID` DESC LIMIT 10";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['batch_ID'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['net_quantity'] . "</td>";
                            echo "<td>" . $row['stocked_date'] . "</td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div><br>
            <div id="get-latest-material-stock" class="get-latest-material-stock">
                <h3>LATEST RAWMATERIAL STOCK</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Batch Id</th>
                            <th>Rawmaterial Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT `batch_ID`,`name`,`quantity`,`stocked_date` FROM raw_material_stock ORDER BY `batch_ID` DESC LIMIT 10";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['batch_ID'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['stocked_date'] . "</td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div><br>
            <div id="get-latest-labour" class="get-latest-labour">
                <h3>LATEST LABOUR</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Rawmaterial Id</th>
                            <th>Rawmaterial Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT `raw_material_ID`,`name` FROM raw_materials ORDER BY `raw_material_ID` DESC LIMIT 5";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['raw_material_ID'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function addPSButton() {
            if (document.getElementById('add-product-stock').style.display == 'none') {
                document.getElementById('pc1').style.opacity = 0.7;
                document.getElementById('add-product-stock').style.display = 'block';
            } else if (document.getElementById('add-product-stock').style.display == 'block') {
                document.getElementById('pc1').style.opacity = 1;
                document.getElementById('add-product-stock').style.display = 'none';
            }

        }

        function updatePSButton() {
            if (document.getElementById('update-product-stock').style.display == 'none') {
                document.getElementById('pc2').style.opacity = 0.7;
                document.getElementById('update-product-stock').style.display = 'block';
            } else if (document.getElementById('update-product-stock').style.display == 'block') {
                document.getElementById('pc2').style.opacity = 1;
                document.getElementById('update-product-stock').style.display = 'none';
            }

        }

        function infoPSButton() {
            if (document.getElementById('info-prouduct-stock').style.display == 'none') {
                document.getElementById('pc3').style.opacity = 0.7;
                document.getElementById('info-prouduct-stock').style.display = 'block';
            } else if (document.getElementById('info-prouduct-stock').style.display == 'block') {
                document.getElementById('pc3').style.opacity = 1;
                document.getElementById('info-prouduct-stock').style.display = 'none';
            }
        }

        function addMSButton() {
            if (document.getElementById('add-rawmaterial-stock').style.display == 'none') {
                document.getElementById('mc1').style.opacity = 0.7;
                document.getElementById('add-rawmaterial-stock').style.display = 'block';
            } else if (document.getElementById('add-rawmaterial-stock').style.display == 'block') {
                document.getElementById('mc1').style.opacity = 1;
                document.getElementById('add-rawmaterial-stock').style.display = 'none';
            }
        }

        function updtaeMSButton() {
            if (document.getElementById('update-rawmaterial-stock').style.display == 'none') {
                document.getElementById('mc2').style.opacity = 0.7;
                document.getElementById('update-rawmaterial-stock').style.display = 'block';
            } else if (document.getElementById('update-rawmaterial-stock').style.display == 'block') {
                document.getElementById('mc2').style.opacity = 1;
                document.getElementById('update-rawmaterial-stock').style.display = 'none';
            }
        }

        function infoMSButton() {
            if (document.getElementById('info-rawmaterial-stock').style.display == 'none') {
                document.getElementById('mc3').style.opacity = 0.7;
                document.getElementById('info-rawmaterial-stock').style.display = 'block';
            } else if (document.getElementById('info-rawmaterial-stock').style.display == 'block') {
                document.getElementById('mc3').style.opacity = 1;
                document.getElementById('info-rawmaterial-stock').style.display = 'none';
            }
        }

        function addMButton() {
            if (document.getElementById('add-rawmaterial').style.display == 'none') {
                document.getElementById('m1').style.opacity = 0.7;
                document.getElementById('add-rawmaterial').style.display = 'block';
            } else if (document.getElementById('add-rawmaterial').style.display == 'block') {
                document.getElementById('m1').style.opacity = 1;
                document.getElementById('add-rawmaterial').style.display = 'none';
            }
        }

        function updateButton() {
            if (document.getElementById('update-rawmaterial').style.display == 'none') {
                document.getElementById('m2').style.opacity = 0.7;
                document.getElementById('update-rawmaterial').style.display = 'block';
            } else if (document.getElementById('update-rawmaterial').style.display == 'block') {
                document.getElementById('m2').style.opacity = 1;
                document.getElementById('update-rawmaterial').style.display = 'none';
            }
        }

        function infoButton() {
            if (document.getElementById('info-rawmaterial').style.display == 'none') {
                document.getElementById('m3').style.opacity = 0.7;
                document.getElementById('info-rawmaterial').style.display = 'block';
            } else if (document.getElementById('info-rawmaterial').style.display == 'block') {
                document.getElementById('m3').style.opacity = 1;
                document.getElementById('info-rawmaterial').style.display = 'none';
            }
        }

        function addLButton() {
            if (document.getElementById('add-labour').style.display == 'none') {
                document.getElementById('l1').style.opacity = 0.7;
                document.getElementById('add-labour').style.display = 'block';
            } else if (document.getElementById('add-labour').style.display == 'block') {
                document.getElementById('l1').style.opacity = 1;
                document.getElementById('add-labour').style.display = 'none';
            }
        }

        function updateLButton() {
            if (document.getElementById('update-labour').style.display == 'none') {
                document.getElementById('l2').style.opacity = 0.7;
                document.getElementById('update-labour').style.display = 'block';
            } else if (document.getElementById('update-labour').style.display == 'block') {
                document.getElementById('l2').style.opacity = 1;
                document.getElementById('update-labour').style.display = 'none';
            }
        }

        function infoLButton() {
            if (document.getElementById('info-labour').style.display == 'none') {
                document.getElementById('l3').style.opacity = 0.7;
                document.getElementById('info-labour').style.display = 'block';
            } else if (document.getElementById('info-labour').style.display == 'block') {
                document.getElementById('l3').style.opacity = 1;
                document.getElementById('info-labour').style.display = 'none';
            }
        }

        function addMAButton() {
            if (document.getElementById('add-machinery').style.display == 'none') {
                document.getElementById('ma1').style.opacity = 0.7;
                document.getElementById('add-machinery').style.display = 'block';
            } else if (document.getElementById('add-machinery').style.display == 'block') {
                document.getElementById('ma1').style.opacity = 1;
                document.getElementById('add-machinery').style.display = 'none';
            }
        }

        function updateMAButton() {
            if (document.getElementById('update-machinery').style.display == 'none') {
                document.getElementById('ma2').style.opacity = 0.7;
                document.getElementById('update-machinery').style.display = 'block';
            } else if (document.getElementById('update-machinery').style.display == 'block') {
                document.getElementById('ma2').style.opacity = 1;
                document.getElementById('update-machinery').style.display = 'none';
            }
        }

        function infoMAButton() {
            if (document.getElementById('info-machinery').style.display == 'none') {
                document.getElementById('ma3').style.opacity = 0.7;
                document.getElementById('info-machinery').style.display = 'block';
            } else if (document.getElementById('info-machinery').style.display == 'block') {
                document.getElementById('ma3').style.opacity = 1;
                document.getElementById('info-machinery').style.display = 'none';
            }
        }
    </script>
    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script id="productStockjs" src="./scripts/production/product_stock.js"></script>
    <script id="rawmaterialStockjs" src="./scripts/production/rawmaterial_stock.js"></script>
    <script id="rawmaterialjs" src="./scripts/production/rawmaterial.js"></script>
    <script id="labourjs" src="./scripts/production/labour.js"></script>
    <script id="machineryjs" src="./scripts/production/machinery.js"></script>
</body>

</html>