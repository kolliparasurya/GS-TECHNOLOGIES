<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/randd.css">
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
    <div id="container" class="container">
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
                        <p class="main-section-p main-section-p-active">
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
        <div class="content-section" id="content-section">
            <div>
                <p id="oldest-scientist" class="oldest-scientist">
                    Oldest Scientist:
                    <?php
                    $sql = "SELECT `name`
                FROM `gs technologies`.scientists
                ORDER BY dob ASC LIMIT 1";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        $chipName = $row['name'];
                        echo "$chipName";
                    }
                    ?>
                </p>
            </div>
            <div>
                <p id="highest-inventions-scientist" class="highest-inventions-scientist">
                    Highest Invnetions:
                    <?php
                    $sql =  "SELECT scientist_name, COUNT(scientist_ID) AS `cnt` 
                FROM `gs technologies`.invention 
                GROUP BY scientist_name
                ORDER BY `cnt` DESC
                LIMIT 1;";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        $chipName = $row['scientist_name'];
                        echo "$chipName" . " ";
                    }
                    ?>
                </p>
            </div>
            <br>
            <div id="invention" class="invention">
                <button id="s1" class="mainButtons" onclick="addSButton()">ADD SCIENTIST</button>
                <button id="i1" style="display: inline; margin-left: 80px;" class="mainButtons" onclick="addIButton()">ADD INVENTION</button><br>
                <button id="s2" class="mainButtons" onclick="updateSButton()">UPDATE SCIENTIST</button>
                <button id="i2" style="display: inline;  margin-left: 44px;" class="mainButtons" onclick="updateIButton()">UPDATE INVENTION</button><br>
                <button id="s3" class="mainButtons" onclick="infoSButton()">SCIENTIST INFO</button>
                <button id="i3" style="display: inline; margin-left: 75px;" class="mainButtons" onclick="infoIButton()">INVENTION INFO</button><br>
                <div id="add-invention" class="innerBoxes" style="display: none;">
                    <h4>INVENTION DETAILS</h4>
                    <label for="invention-scientist-id">Scientist Id: </label><br>
                    <input type="text" id="invention-scientist-id" class="invnetion-scientist-id" required><br>
                    <label for="invention-scientist-name">Scientist Name: </label><br>
                    <input type="text" id="invention-scientist-name" class="inveniton-scientist-name" required><br>
                    <label for="invention-chip-Id">Chip Id: </label><br>
                    <input type="text" name="invention-chip-Id" id="invention-chip-Id"><br>
                    <label for="invention-chip-name">Chip Name: </label><br>
                    <input type="text" name="invention-chip-name" id="invention-chip-name"><br>
                    <label for="invention-date">Date: </label><br>
                    <input type="date" name="invention-date" id="invention-date"><br>
                    <label for="invention-place">Place: </label><br>
                    <input type="text" name="invention-place" id="invention-place"><br>
                    <button class="innerButtons" onclick="addInvention()">+Add</button>
                </div>
                <p id="addInventionResult"></p>
                <div id="update-invetion" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-invention" class="search-bar-update-invention">
                        <label for="search-invention-update">Search with invention Id:</label>
                        <input type="search" id="search-invention-update" class="search-invention-update">
                        <button class="innerButtons" onclick="searchInvention()"><img src="../img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-details-invention" class="update-details-invention" style="display: none;">
                        <label for="previous-invention-id">Invention Id: </label><br>
                        <input type="text" id="previous-invention-id" class="previous-invention-id" value="" required><br>
                        <label for="previous-invention-scientist-id">Scientist Id: </label><br>
                        <input type="text" id="previous-invention-scientist-id" class="previous-invention-scientist-id" value="" required><br>
                        <label for="previous-invention-scientist-name">Scientist Name: </label><br>
                        <input type="text" id="previous-invention-scientist-name" class="previous-scientist-name" value="" required><br>
                        <label for="previous-invention-chip-Id">Chip Id: </label><br>
                        <input type="text" name="previous-invention-chip-Id" id="previous-invention-chip-Id" value="" readonly><br>
                        <label for="previous-invention-chip-name">Chip Name: </label><br>
                        <input type="text" name="previous-invention-chip-name" id="previous-invention-chip-name" value="" readonly><br>
                        <label for="previous-invetion-date">Date: </label><br>
                        <input type="text" name="previous-invention-date" id="previous-invention-date" value=""><br>
                        <label for="previous-invention-place">Place: </label><br>
                        <input type="text" name="previous-invention-place" id="previous-invention-place" value=""><br>
                        <p id="iUpdateResultNegative"></p>
                        <button class="innerButtons" onclick="updateInvention('updating')">Update</button>
                        <button class="innerButtons" onclick="updateInvention('deleting')">Delete</button>
                    </div>
                    <p id="iUpdateResult"></p>
                </div>
                <div id="info-invention" class="innerBoxes" style="display: none;">
                    <label for="chip-name-search-invention-info">Enter chip name:</label>
                    <input type="search" id="chip-name-search-invention-info" class="search-invention-info">
                    <br>
                    <label for="scientist-id-search-invention-info">Enter scientist id:</label>
                    <input type="search" id="scientist-id-search-invention-info" class="search-invention-info">
                    <button class="innerButtons" onclick="infoInvention()"><img src="../img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    <div id="info-invention-details" class="info-invention-details" style="display: none;">
                        <label for="info-invention-Id">Invention Id:</label>
                        <p id="info-invention-Id" style="display: inline;"></p><br>
                        <label for="info-invention-scientist-Id">Scientist Id:</label>
                        <p id="info-invention-scientist-Id" style="display: inline;"></p><br>
                        <label for="info-invention-scientist-name">Scientist Name:</label>
                        <p id="info-invention-scientist-name" style="display: inline;"></p><br>
                        <label for="info-invention-chip-Id">Chip Id: </label>
                        <p id="info-invention-chip-Id" style="display: inline;"></p><br>
                        <label for="info-invention-chip-name">Chip Name: </label>
                        <p id="info-invention-chip-name" style="display: inline;"></p><br>
                        <label for="info-invention-date">Date:</label>
                        <p id="info-invention-date" style="display: inline;"></p><br>
                        <label for="info-invention-place">Place: </label>
                        <p id="info-invention-place" style="display: inline;"></p><br>
                    </div>
                </div>
            </div>
            <div id="scientist" class="scientist">
                <div id="add-scientist" class="innerBoxes" style="display: none;">
                    <h4>ENTER SCIENTIST DETAILS</h4>
                    <label for="scientist-name">Name: </label><br>
                    <input type="text" id="scientist-name" name="scientist-name" required><br>
                    <label for="scientist-phone-number">Phone Number: </label><br>
                    <input type="text" id="scientist-phone-number" name="scientist-phone-number" required><br>
                    <label for="scientist-email">Email: </label><br>
                    <input type="text" id="scientist-email" name="scientist-email" required><br>
                    <label for="scientist-degree">Degree: </label><br>
                    <input type="text" id="scientist-degree" name="scientist-degree" required><br>
                    <label for="scientist-address">Address: </label><br>
                    <input type="text" id="scientist-address" name="scientist-address" required><br>
                    <label for="scientist-dob">DOB: </label><br>
                    <input type="date" id="scientist-dob" name="scientist-dob" required><br>
                    <button class="innerButtons" onclick="addScientist()">+Add</button>
                </div>
                <p id="addScientistResult"></p>
                <div id="update-scientist" class="innerBoxes" style="display: none;">
                    <div id="search-bar-update-scientist" class="search-bar-update-scientist">
                        <label for="search-scientist-update">Search with Scientist Id:</label>
                        <input type="search" id="search-scientist-update" class="search-scientist-update">
                        <button class="innerButtons" onclick="searchScientist()"><img src="../img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="update-scientist-details" class="update_scientist-details" style="display: none;">
                        <label for="previous-scientist-Id">Scientist Id: </label><br>
                        <input type="text" id="previous-scientist-Id" name="previous-scientist-Id" required><br>
                        <label for="previous-scientist-name">Name: </label><br>
                        <input type="text" id="previous-scientist-name" name="scientist-name" required><br>
                        <label for="previous-scientist-phone-number">Phone Number: </label><br>
                        <input type="text" id="previous-scientist-phone-number" name="scientist-phone-number" required><br>
                        <label for="previous-scientist-email">Email: </label><br>
                        <input type="text" id="previous-scientist-email" name="scientist-email" required><br>
                        <label for="previous-scientist-degree">Degree: </label><br>
                        <input type="text" id="previous-scientist-degree" name="scientist-degree" required><br>
                        <label for="previous-scientist-address">Address: </label><br>
                        <input type="text" id="previous-scientist-address" name="scientist-address" required><br>
                        <label for="previous-scientist-dob">DOB: </label><br>
                        <input type="text" id="previous-scientist-dob" name="scientist-dob" required><br>
                        <button class="innerButtons" onclick="updateScientist('updating')">Update</button>
                        <button class="innerButtons" onclick="updateScientist('deleting')">Delete</button>
                        <p id="sUpdateResultNegative"></p>
                    </div>
                    <p id="sUpdateResult"></p>
                </div>
                <div id="info-scientist" class="innerBoxes" style="display: none;">
                    <div id="search-bar-info-scientist" class="search-bar-info-scientist">
                        <h4>Enter Scientist Details</h4>
                        <label for="email-search-scientist-info">Search with Email:</label><br>
                        <input type="text" id="email-search-scientist-info" class="email-search-scientist-info">
                        <button class="innerButtons" onclick="infoScientist()"><img src="../img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                    </div>
                    <div id="info-scientist-details" class="info-scientist-details" style="display: none;">
                        <label for="info-scientist-Id">Scientist ID:</label>
                        <p id="info-scientist-Id" style="display: inline;"></p><br>
                        <label for="info-scientist-name">Scientist Name:</label>
                        <p id="info-scientist-name" style="display: inline;"></p><br>
                        <label for="info-scientist-email">Email: </label>
                        <p id="info-scientist-email" style="display: inline;"></p><br>
                        <label for="info-scientist-phone-number">Phone Number: </label>
                        <p id="info-scientist-phone-number" style="display: inline;"></p><br>
                        <label for="info-scientist-degree">Degree: </label>
                        <p id="info-scientist-degree" style="display: inline;"></p><br>
                        <label for="info-scientist-address">Address:</label>
                        <p id="info-scientist-address" style="display: inline;"></p><br>
                        <label for="info-scientist-dob">DOB: </label>
                        <p id="info-scientist-dob" style="display: inline;"></p><br>
                    </div>
                </div>
            </div><br><br>
            <div id="latest-invention">
                <h3>RECENT INVENTIONS</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invention Id</th>
                            <th>Chip Name</th>
                            <th>Scientist Name</th>
                            <th>Invention Date</th>
                        </tr>
                    </thead>
                    <tbody id="chipShowData">
                        <?php
                        $sql = "SELECT `invention_ID`,`chip_name`,`scientist_name`,`added_date` FROM invention ORDER BY `invention_ID` DESC LIMIT 10";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['invention_ID'] . "</td>";
                            echo "<td>" . $row['chip_name'] . "</td>";
                            echo "<td>" . $row['scientist_name'] . "</td>";
                            echo "<td>" . $row['added_date'] . "</td>";
                            echo "<tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div><br>
            <div id="latest-scientist">
                <h3>LATEST SCIENTISTS</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Scientist Id</th>
                            <th>Scientist Name</th>
                            <th>Scientist email</th>
                        </tr>
                    </thead>
                    <tbody id="chipShowData">
                        <?php
                        $sql = "SELECT `sc_ID`,`name`,`email` FROM scientists ORDER BY `sc_ID` DESC LIMIT 5";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['sc_ID'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div><br>
        </div>
    </div>
    <script>
        function addIButton() {
            if (document.getElementById('add-invention').style.display == 'block') {
                document.getElementById('i1').style.opacity = 1;
                document.getElementById('add-invention').style.display = 'none'
            } else if (document.getElementById('add-invention').style.display == 'none') {
                document.getElementById('i1').style.opacity = 0.7;
                document.getElementById('add-invention').style.display = 'block'
            }
        }

        function updateIButton() {
            if (document.getElementById('update-invetion').style.display == 'block') {
                document.getElementById('i2').style.opacity = 1;
                document.getElementById('update-invetion').style.display = 'none'
            } else if (document.getElementById('update-invetion').style.display == 'none') {
                document.getElementById('i2').style.opacity = 0.7;
                document.getElementById('update-invetion').style.display = 'block'
            }
        }

        function infoIButton() {
            if (document.getElementById('info-invention').style.display == 'block') {
                document.getElementById('i3').style.opacity = 1;
                document.getElementById('info-invention').style.display = 'none'
            } else if (document.getElementById('info-invention').style.display == 'none') {
                document.getElementById('i3').style.opacity = 0.7;
                document.getElementById('info-invention').style.display = 'block'
            }
        }

        function addSButton() {
            if (document.getElementById('add-scientist').style.display == 'block') {
                document.getElementById('s1').style.opacity = 1;
                document.getElementById('add-scientist').style.display = 'none'
            } else if (document.getElementById('add-scientist').style.display == 'none') {
                document.getElementById('s1').style.opacity = 0.7;
                document.getElementById('add-scientist').style.display = 'block'
            }
        }

        function updateSButton() {
            if (document.getElementById('update-scientist').style.display == 'block') {
                document.getElementById('s2').style.opacity = 1;
                document.getElementById('update-scientist').style.display = 'none'
            } else if (document.getElementById('update-scientist').style.display == 'none') {
                document.getElementById('s2').style.opacity = 0.7;
                document.getElementById('update-scientist').style.display = 'block'
            }
        }

        function infoSButton() {
            if (document.getElementById('info-scientist').style.display == 'block') {
                document.getElementById('s3').style.opacity = 1;
                document.getElementById('info-scientist').style.display = 'none'
            } else if (document.getElementById('info-scientist').style.display == 'none') {
                document.getElementById('s3').style.opacity = 0.7;
                document.getElementById('info-scientist').style.display = 'block'
            }
        }
    </script>
    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script src="./scripts/randd/invention.js"></script>
    <script src="./scripts/randd/scientist.js"></script>
</body>

</html>