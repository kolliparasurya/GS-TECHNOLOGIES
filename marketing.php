<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/marketing.css">

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
                        <p class="main-section-p ">
                            Production
                        </p>
                    </a>
                </div>
                <div class="main-section-contents">
                    <a href="./marketing.php" style="text-decoration: none;">
                        <p class="main-section-p main-section-p-active">
                            Marketing
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div id="content-section" class="content-section">
            <div>
                <p id="highest-chip-advertisments" class="highest-chip-advertisments">
                    Highest Advertisments:
                    <?php
                    $sql = "SELECT chip_name, COUNT(chip_name) AS `cnt` 
                FROM `gs technologies`.advertisments 
                GROUP BY chip_name
                ORDER BY `cnt` DESC
                LIMIT 1;";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        $chipName = $row['chip_name'];
                        echo "$chipName";
                    }
                    ?>
                </p>
            </div>
            <div>
                <p id="total-advertisments" class="total-advertisments">
                    Total Advertisment:
                    <?php
                    $sql = "SELECT * FROM `advertisments`";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div>
            <div>
                <p id="total-patnerships" class="total-patnerships">
                    Total Patnerships:
                    <?php
                    $sql = "SELECT * FROM `patnerships`";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div><br>
            <button class="mainButtons" id="a1" onclick="addAButton()">ADD PATNERSHIP</button>
            <button class="mainButtons" id="a2" onclick="updateAButton()">UPDATE PATNERSHIP</button>
            <button class="mainButtons" id="a3" onclick="infoAButton()">PATNERSHIP INFO</button>
            <button class="mainButtons" id="p1" onclick="addPButton()">ADD ADVERTISMENT</button>
            <button class="mainButtons" id="p2" onclick="updatePButton()">UPDATE ADVERTISMENT</button>
            <button class="mainButtons" id="p3" onclick="infoPButton()">INFO ADVERTISMENT</button><br>
            <div id="advertisments" class="advertisments">
                <div id="add-advertisment" class="innerBoxes" style="display: none;">
                    <h3>ENTER ADVERTISMENT DETAILS</h3>
                    <label for="advertisment-platform-name">Platform Name: </label><br>
                    <input type="text" id="advertisment-platform-name" class="advertisment-platform-name" required><br>
                    <label for="advertisment-chip-Id">Chip Id: </label><br>
                    <input type="text" id="advertisment-chip-Id" class="advertisment-chip-Id" required><br>
                    <label for="advertisment-chip-name">Chip Name: </label><br>
                    <input type="text" id="advertisment-chip-name" class="advertisment-chip-name" required><br>
                    <button class="innerButtons" onclick="addAdvertisment()">+Add</button>
                </div>
                <p id="addAdvertismentResult"></p>
                <div id="update-advertisment" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-advertisment" class="search-bar-update-advertisment">
                        <label for="Id-search-advertisment-update">Enter Advertisment Id:</label><br>
                        <input type="text" id="Id-search-advertisment-update" class="Id-search-advertisment-update">
                        <button class="innerButtons" onclick="searchAdvertisment()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-advertisment" class="update-details-advertisment" style="display: none;"><br>
                        <h3>UPDATE ADVERTISMENT DETAILS</h3>
                        <label for="previous-advertisment-Id">Advertisment Id: </label><br>
                        <input type="text" id="previous-advertisment-Id" class="previous-advertisment-Id" value="" readonly required><br>
                        <label for="previous-advertisment-platform-name">Platform Name: </label><br>
                        <input type="text" id="previous-advertisment-platform-name" value="" class="previous-advertisment-platform-name" required><br>
                        <label for="previous-advertisment-chip-Id">Chip Id: </label><br>
                        <input type="text" id="previous-advertisment-chip-Id" class="previous-advertisment-chip-Id" value="" required><br>
                        <label for="previous-advertisment-chip-name">Chip Name: </label><br>
                        <input type="text" id="previous-advertisment-chip-name" class="previous-advertisment-chip-name" value="" required><br>
                        <button class="innerButtons" onclick="updateAdvertisment('updating')">Update</button>
                        <button class="innerButtons" onclick="updateAdvertisment('deleting')">Delete</button>
                        <p id="aUpdateResultNegative"></p>
                    </div>
                    <p id="aUpdateResult"></p>
                </div>
                <div id="info-advertisment" class="innerBoxes" style="display: none;">
                    <label for="Id-search-advertisment-info">Enter Advertisment Id:</label><br>
                    <input type="text" id="Id-search-advertisment-info" class="Id-search-advertisment-info"><br>
                    <button class="innerButtons" onclick="infoAdvertisment()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-advertisment-details" class="info-advertisment-details" style="display: none;">
                        <label for="info-advertisment-Id">Advertisment ID:</label>
                        <p id="info-advertisment-Id" style="display: inline;"></p><br>
                        <label for="info-advertisment-platform-name">Platform Name:</label>
                        <p id="info-advertisment-platform-name" style="display: inline;"></p><br>
                        <label for="info-advertisment-chip-Id">Chip Id: </label>
                        <p id="info-advertisment-chip-Id" style="display: inline;"></p><br>
                        <label for="info-advertisment-chip-name">Chip Name: </label>
                        <p id="info-advertisment-chip-name" style="display: inline;"></p><br>
                    </div>
                </div>
            </div>
            <div id="patnerships" class="patnerships">
                <div id="add-patnership" class="innerBoxes" style="display: none;">
                    <h3>ENTER PATNERSHIP DETAILS</h3>
                    <label for="patnership-chip-Id">Chip Id: </label><br>
                    <input type="text" id="patnership-chip-Id" class="patnership-chip-Id" required><br>
                    <label for="patnership-chip-name">Chip Name: </label><br>
                    <input type="text" id="patnership-chip-name" class="patnership-chip-name" required><br>
                    <label for="patnership-company-name">Company Name: </label><br>
                    <input type="text" id="patnership-company-name" class="patnership-company-name" required><br>
                    <label for="patnership-sector">Patnership Sector: </label><br>
                    <input type="text" id="patnership-sector" class="patnership-sector" required><br>
                    <label for="patnership-company-phone-number">Company Phone Number: </label><br>
                    <input type="text" id="patnership-company-phone-number" class="patnership-company-phone-number"><br>
                    <label for="patnership-email">Company Email: </label><br>
                    <input type="text" id="patnership-email" class="patnership-email"><br>
                    <label for="patnership-pan-number">Company PAN Number: </label><br>
                    <input type="text" id="patnership-pan-number" class="patnership-pan-number" required><br>
                    <label for="patnership-company-address">Company Address: </label><br>
                    <input type="text" id="patnership-company-address" class="patnership-company-address"><br>
                    <button class="innerButtons" onclick="addPatnership()">+Add</button>
                </div>
                <p id="pUpdateResult"></p>
                <div id="update-patnership" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-patnership" class="search-bar-update-patnership">
                        <label for="Id-search-patnership-update">Enter Patnership Id:</label><br>
                        <input type="text" id="Id-search-patnership-update" class="Id-search-patnership-update">
                        <button class="innerButtons" onclick="searchPatnership()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-patnership" class="update-details-patnership" style="display: none;">
                        <h3>UPDATE PATNERSHIP DETAILS</h3>
                        <label for="previous-patnership-Id">Patnership ID:</label>
                        <input type="text" id="previous-patnership-Id" class="previous-patnership-Id" required value=""><br>
                        <label for="previous-patnership-chip-Id">Chip Id: </label><br>
                        <input type="text" id="previous-patnership-chip-Id" class="previous-patnership-chip-Id" required value=""><br>
                        <label for="previous-patnership-chip-name">Chip Name: </label><br>
                        <input type="text" id="previous-patnership-chip-name" class="previous-patnership-chip-name" required value=""><br>
                        <label for="previous-patnership-company-name">Comapany Name: </label><br>
                        <input type="text" id="previous-patnership-company-name" class="previous-patnership-company-name" required value=""><br>
                        <label for="previous-patnership-sector">Patnership Sector: </label><br>
                        <input type="text" id="previous-patnership-sector" class="previous-patnership-sector" required value=""><br>
                        <label for="previous-patnership-company-phone-number">Company Phone Number: </label><br>
                        <input type="text" id="previous-patnership-company-phone-number" class="previous-patnership-company-phone-number" value=""><br>
                        <label for="previous-patnership-email">Company Email: </label><br>
                        <input type="text" id="previous-patnership-email" class="previous-patnership-email" value=""><br>
                        <label for="previous-patnership-pan-number">Company PAN Number: </label><br>
                        <input type="text" id="previous-patnership-pan-number" class="previous-patnership-pan-number" required value=""><br>
                        <label for="previous-patnership-company-address">Company Address: </label><br>
                        <input type="text" id="previous-patnership-company-address" class="previous-patnership-company-address" value=""><br>
                        <button class="innerButtons" onclick="updatePatnership('updating')">Update</button>
                        <button class="innerButtons" onclick="updatePatnership('deleting')">Delete</button>
                        <p id="pUpdateResultNegative"></p>
                    </div>
                    <p id="pUpdateResult"></p>
                </div>
                <div id="info-patnership" class="innerBoxes" style="display: none;">
                    <label for="chip-name-search-patnership-info">Enter Chip Name:</label><br>
                    <input type="text" id="chip-name-search-patnership-info" class="chip-name-search-patnership-info"><br>
                    <label for="comapny-email-search-patnership-info">Enter Comapny Email:</label><br>
                    <input type="text" id="comapny-email-search-patnership-info" class="comapny-email-search-patnership-info"><br>
                    <button class="innerButtons" onclick="infoPatnership()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-patnership-details" class="info-patnership-details" style="display: none;">
                        <label for="info-patnership-Id">Patnership ID:</label>
                        <p id="info-patnership-Id" style="display: inline;"></p><br>
                        <label for="info-patnership-chip-Id">Chip Id::</label>
                        <p id="info-patnership-chip-Id" style="display: inline;"></p><br>
                        <label for="info-patnership-chip-name">Chip Name: </label>
                        <p id="info-patnership-chip-name" style="display: inline;"></p><br>
                        <label for="info-patnership-company-name">Comapany Name: </label>
                        <p id="info-patnership-comapny-name" style="display: inline;"></p><br>
                        <label for="info-patnership-sector">Patnership Sector:</label>
                        <p id="info-patnership-sector" style="display: inline;"></p><br>
                        <label for="info-patnership-phone-number">Company Phone Number:</label>
                        <p id="info-patnership-phone-number" style="display: inline;"></p><br>
                        <label for="info-patnership-company-email">Company Email: </label>
                        <p id="info-patnership-company-email" style="display: inline;"></p><br>
                        <label for="info-patnership-pan-number">Company PAN Number: </label>
                        <p id="info-patnership-pan-number" style="display: inline;"></p><br>
                        <label for="info-patnership-company-address">Company Address:</label>
                        <p id="info-patnership-company-address" style="display: inline;"></p><br>
                    </div>
                </div>
            </div><br>
            <div id="latest-patnerships">
                <h3>LATEST PATNERSHIPS</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Patership Id</th>
                            <th>Chip Name</th>
                            <th>Patnership Sector</th>
                            <th>Company Name</th>
                            <th>Company Email</th>
                            <th>Company Address</th>
                        </tr>
                    </thead>
                    <tbody id="chipShowData">
                        <?php
                        $sql = "SELECT `patnership_ID`,`chip_name`,`patnership_sector`,`company_name`,`company_email`,`company_address` FROM patnerships ORDER BY `patnership_ID` DESC LIMIT 10";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['patnership_ID'] . "</td>";
                            echo "<td>" . $row['chip_name'] . "</td>";
                            echo "<td>" . $row['patnership_sector'] . "</td>";
                            echo "<td>" . $row['company_name'] . "</td>";
                            echo "<td>" . $row['company_email'] . "</td>";
                            echo "<td>" . $row['company_address'] . "</td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div><br>
            <div id="latest-advertisments">
                <h3>LATEST ADVERTISMENTS</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Platform Name</th>
                            <th>Chip Name</th>
                        </tr>
                    </thead>
                    <tbody id="chipShowData">
                        <?php
                        $sql = "SELECT `platform_name`,`chip_name` FROM advertisments ORDER BY `advertisment_ID` DESC LIMIT 5";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['platform_name'] . "</td>";
                            echo "<td>" . $row['chip_name'] . "</td>";
                            echo "<tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function addAButton() {
            if (document.getElementById('add-advertisment').style.display == 'none') {
                document.getElementById('a1').style.opacity = 0.7;
                document.getElementById('add-advertisment').style.display = 'block'
            } else if (document.getElementById('add-advertisment').style.display = 'block') {
                document.getElementById('a1').style.opacity = 1;
                document.getElementById('add-advertisment').style.display = 'none';
            }
        }

        function updateAButton() {
            if (document.getElementById('update-advertisment').style.display == 'none') {
                document.getElementById('a2').style.opacity = 0.7;
                document.getElementById('update-advertisment').style.display = 'block'
            } else if (document.getElementById('update-advertisment').style.display = 'block') {
                document.getElementById('a2').style.opacity = 1;
                document.getElementById('update-advertisment').style.display = 'none';
            }
        }

        function infoAButton() {
            if (document.getElementById('info-advertisment').style.display == 'none') {
                document.getElementById('a3').style.opacity = 0.7;
                document.getElementById('info-advertisment').style.display = 'block'
            } else if (document.getElementById('info-advertisment').style.display = 'block') {
                document.getElementById('a3').style.opacity = 1;
                document.getElementById('info-advertisment').style.display = 'none';
            }
        }

        function addPButton() {
            if (document.getElementById('add-patnership').style.display == 'none') {
                document.getElementById('p1').style.opacity = 0.7;
                document.getElementById('add-patnership').style.display = 'block'
            } else if (document.getElementById('add-patnership').style.display = 'block') {
                document.getElementById('p1').style.opacity = 1;
                document.getElementById('add-patnership').style.display = 'none';
            }
        }

        function updatePButton() {
            if (document.getElementById('update-patnership').style.display == 'none') {
                document.getElementById('p2').style.opacity = 0.7;
                document.getElementById('update-patnership').style.display = 'block'
            } else if (document.getElementById('').style.display = 'block') {
                document.getElementById('p2').style.opacity = 1;
                document.getElementById('update-patnership').style.display = 'none';
            }
        }

        function infoPButton() {
            if (document.getElementById('info-patnership').style.display == 'none') {
                document.getElementById('p3').style.opacity = 0.7;
                document.getElementById('info-patnership').style.display = 'block'
            } else if (document.getElementById('info-patnership').style.display = 'block') {
                document.getElementById('p3').style.opacity = 1;
                document.getElementById('info-patnership').style.display = 'none';
            }
        }
    </script>
    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script src="./scripts/marketing/advertisment.js"></script>
    <script src="./scripts/marketing/patnership.js"></script>
</body>

</html>