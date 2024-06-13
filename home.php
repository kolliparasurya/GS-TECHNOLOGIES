<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/home.css">
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
                        <p class="main-section-p main-section-p-active">
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
        <div id="content-section" class="content-section">
            <div id="total-chip" class="total-chip">
                <p id="total-chip-ans" class="total-chip-ans">
                    Total Number Of Chips:
                    <?php
                    $sql = "SELECT (chip_ID) FROM `gpu_chips`";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div>
            <div id="get-gaming-chip" class="get-gaming-chip">
                <p id="gaming-chip-ans" class="gaming-chip-ans">
                    Total Number Of Gaming Chips:
                    <?php
                    $sql = "SELECT * FROM `gpu_chips` WHERE `application` = 'gaming'";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div>
            <div id="get-integrated-chip" class="get-integrated-chip">
                <p id="integrated-chip-ans" class="integrated-chip-ans">
                    Total Number Of Integrated Chips:
                    <?php
                    $sql = "SELECT * FROM `gpu_chips` WHERE `gpu_type` = 'integrated'";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div>
            <div id="get-production-chip" class="get-production-chip">
                <p id="production-chip-ans" class="production-chip-ans">
                    Total Number Of Production Chips:
                    <?php
                    $sql = "SELECT * FROM `gpu_chips` WHERE `stage` = 'production'";
                    $query = mysqli_query($conn, $sql);
                    $rowcount = mysqli_num_rows($query);
                    echo ($rowcount)
                    ?>
                </p>
            </div>
            <br>
            <button class="mainButtons" onclick="openAddBox()">ADD CHIP</button>
            <button class="mainButtons" onclick="openUpdateBox()">UPDATE CHIP</button>
            <button class="mainButtons" onclick="openInfoBox()">CHIP INFO</button>
            <br>
            <div id="add-new-chip" class="innerBoxes" style="display: none;">
                <h4>MAIN DETAILS</h4>
                <label for="chip-name">Name:</label><br>
                <input type="text" id="chip-name" name="chip-name" required autofocus><br>
                <label for="chip-stage">Stage:</label><br>
                <input list="stages" required><br>
                <datalist id="stages">
                    <option value="" selected></option>
                    <option value="production">production</option>
                    <option value="development">development</option>
                    <option value="prototype">prototype</option>
                </datalist>
                <label for="chip-application">Application:</label><br>
                <input type="text" id="chip-application" name="chip-application" required><br>
                <label for="chip-gpu-type">GPU-type: </label><br>
                <input list="types" required><br>
                <datalist id="types">
                    <option value=""></option>
                    <option value="integrated">integrated</option>
                    <option value="discreet">discreet</option>
                </datalist>
                <label for="chip-process-size">Process Size (mention unit): </label><br>
                <input type="text" id="chip-process-size" name="chip-process-size" required><br>
                <label for="chip-transistors">Transistors (mention count): </label><br>
                <input type="text" id="chip-transistors" name="chip-transistors" required><br>
                <label for="chip-die-size">Die size: </label><br>
                <input type="text" id="chip-die-size" name="chip-die-size" requried><br>
                <label for="chip-foundry">Foundry: </label><br>
                <input type="text" id="chip-foundry" name="chip-foundry"><br>
                <label for="chip-added-date">Date: </label><br>
                <input type="date" id="chip-added-date" name="chip-added-date">
                <h4>RENDER CONFIGS</h4>
                <label for="chip-shading-units">Shading units:</label><br>
                <input type="text" id="chip-shading-units" name="chip-shading-units"><br>
                <label for="chip-TMUs">TMU:</label><br>
                <input type="text" id="chip-TMUs" name="chip-TMUs"><br>
                <label for="chip-cores">Cores: </label><br>
                <input type="text" id="chip-cores" name="chip-cores"><br>
                <h4>MEMORY</h4>
                <label for="chip-memory-bus">Memory Bus:</label><br>
                <input type="text" id="chip-memory-bus" name="chip-memory-bus"><br>
                <label for="chip-memroy-type">Memory Type:</label><br>
                <input type="text" id="chip-memory-type" name="chip-memroy-type"><br>
                <label for="chip-band-width">Band Width: </label><br>
                <input type="text" id="chip-band-width" name="chip-band-width"><br>
                <h4>CLOCK SPEEDS</h4>
                <label for="chip-base-clock-speed">Base Clock Speed: </label><br>
                <input type="text" id="chip-base-clock-speed" name="chip-base-clock-speed"><br>
                <label for="chip-memory-clock-speed">Memory Clock Speed: </label><br>
                <input type="text" id="chip-memory-clock-speed" name="chip-memory-clock-speed"><br>
                <button id="chipAdding" class="innerButtons" onclick="addingChip()">+Add</button>
                <p id="addingResult" class="addingResult"></p>
            </div>
            <div id="update-chip" class="innerBoxes" style="display: none;">
                <div id="search-bar-update-chip" class="search-bar-update-chip">
                    <label for="search-chip-update">Search with chipId:</label>
                    <input type="search" id="search-chip-update" class="innerButtons">
                    <button id="update-search-button" class="update-search-button" onclick="searchingChip()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                </div>
                <div id="update-details-chip" class="" style="display: none;">
                    <h4>MAIN DETAILS</h4>
                    <label for="chip-id">Id: </label><br>
                    <input type="text" id="update-chip-id" class="update-chip-id" value="" readonly><br>
                    <label for="chip-name">Name:</label><br>
                    <input type="text" id="update-chip-name" name="chip-name" value="" required autofocus><br>
                    <label for="chip-stage">Stage:</label><br>
                    <input list="stages" value="" required><br>
                    <datalist id="update-stages">
                        <option value="production">production</option>
                        <option value="development">development</option>
                        <option value="prototype">prototype</option>
                    </datalist>
                    <label for="chip-application">Application:</label><br>
                    <input type="text" id="update-chip-application" name="chip-application" value="" required><br>
                    <label for="chip-gpu-type">GPU-type: </label><br>
                    <input list="update-types" value="" required><br>
                    <datalist id="update-types">
                        <option value="integrated">integrated</option>
                        <option value="discreet">discreet</option>
                    </datalist>
                    <label for="chip-process-size">Process Size (mention unit): </label><br>
                    <input type="text" id="update-chip-process-size" name="chip-process-size" value="" required><br>
                    <label for="chip-transistors">Transistors (mention count): </label><br>
                    <input type="text" id="update-chip-transistors" name="chip-transistors" value="" required><br>
                    <label for="chip-die-size">Die size: </label><br>
                    <input type="text" id="update-chip-die-size" name="chip-die-size" value="" requried><br>
                    <label for="chip-foundry">Foundry: </label><br>
                    <input type="text" id="update-chip-foundry" name="chip-foundry" value=""><br>
                    <label for="chip-added-date">Date: </label><br>
                    <input type="text" id="udate-chip-added-date" name="chip-added-date" value="">
                    <h4>RENDER CONFIGS</h4>
                    <label for="chip-shading-units">Shading units:</label><br>
                    <input type="text" id="update-chip-shading-units" name="chip-shading-units" value=""><br>
                    <label for="chip-TMUs">TMU:</label><br>
                    <input type="text" id="update-chip-TMUs" name="chip-TMUs" value=""><br>
                    <label for="chip-cores">Cores: </label><br>
                    <input type="text" id="update-chip-cores" name="chip-cores" value=""><br>
                    <h4>MEMORY</h4>
                    <label for="chip-memory-bus">Memory Bus:</label><br>
                    <input type="text" id="update-chip-memory-bus" name="chip-memory-bus" value=""><br>
                    <label for="chip-memroy-type">Memory Type:</label><br>
                    <input type="text" id="update-chip-memory-type" name="chip-memroy-type" value=""><br>
                    <label for="chip-band-width">Band Width: </label><br>
                    <input type="text" id="update-chip-band-width" name="chip-band-width" value=""><br>
                    <h4>CLOCK SPEEDS</h4>
                    <label for="chip-base-clock-speed">Base Clock Speed: </label><br>
                    <input type="text" id="update-chip-base-clock-speed" name="chip-base-clock-speed" value=""><br>
                    <label for="chip-memory-clock-speed">Memory Clock Speed: </label><br>
                    <input type="text" id="update-chip-memory-clock-speed" name="chip-memory-clock-speed" value=""><br>
                    <button id="chipUpdating" class="innerButtons" onclick="updatingChip('chipUpdating')">Update</button>
                    <button id="chipDeleting" class="innerButtons" onclick="updatingChip('chipDeleting')">Delete</button>
                    <p id="updatingResultNegative" class="updatingResultNegative"></p>
                </div>
                <p id="updatingResult" class="updatingResult"></p>
            </div>
            <div id="info-chip" class="innerBoxes" style="display: none;">
                <label for="search-chip-info">Search with chip name:</label>
                <input type="search" id="search-chip-info" class="search-chip-info">
                <button id="search-info-chip-button" class="innerButtons" onclick="chipInformation()"><img src="./img/searchImage.png" alt="search-symbol" width="10" height="10"></button>
                <div id="informationOfChip" class="info-of-chip" style="display: none;">
                    <h3>INFORMATION OF CHIP</h3>
                    <label for="infochipId">Chip ID: </label>
                    <p id="chip_info" style="display: inline;">n</p><br>
                    <label for="infoname">Name: </label>
                    <p id="name_info" style="display: inline;">n</p><br>
                    <label for="infostage">Stage: </label>
                    <p id="stage_info" style="display: inline;">n</p><br>
                    <label for="infoapplication">Application: </label>
                    <p id="application_info" style="display: inline;">n</p><br>
                    <label for="infogpu_type">GPU_Type: </label>
                    <p id="gpu_type_info" style="display: inline;">n</p><br>
                    <label for="infoprocessor_size">Processor Size: </label>
                    <p id="processor_size_info" style="display: inline;">n</p><br>
                    <label for="infotransistors">Transistors: </label>
                    <p id="transistors_info" style="display: inline;">n</p><br>
                    <label for="infodie_size">Die size: </label>
                    <p id="die_size-info" style="display: inline;">n</p><br>
                    <label for="infofoundry">Foundry: </label>
                    <p id="foundry-info" style="display: inline;">n</p><br>
                    <label for="infodate">Added Date: </label>
                    <p id="date-info" style="display: inline;">n</p><br>
                    <label for="infoshadingUnits">Shading Units: </label>
                    <p id="shadingUnits-info" style="display: inline;">n</p><br>
                    <label for="infotmus">TMUs: </label>
                    <p id="tmus-info" style="display: inline;">n</p><br>
                    <label for="infocores">Cores: </label>
                    <p id="cores-info" style="display: inline;">n</p><br>
                    <label for="infomemoryBus">Memory Bus: </label>
                    <p id="memoryBus-info" style="display: inline;">n</p><br>
                    <label for="infomemoryType">Memory Type: </label>
                    <p id="memoryType-info" style="display: inline;">n</p><br>
                    <label for="infobandWidth">Bandwidth: </label>
                    <p id="bandWidth-info" style="display: inline;">n</p><br>
                    <label for="infobaseClockSpeed">Base Clock Speed: </label>
                    <p id="baseClockSpeed-info" style="display: inline;">n</p><br>
                    <label for="infomemoryClockSpeed">Memory Clock Speed: </label>
                    <p id="memoryCloackSpeed-info" style="display: inline;">n</p><br>
                    </section>
                </div>
            </div>

            <div id="get-latest-chip" class="get-latest-chip">
                <table class="table table-striped">
                    <br>
                    <h3>LATEST CHIPS</h3>
                    <thead>
                        <tr>
                            <th>Chip Id</th>
                            <th>Chip Name</th>
                            <th>Stage</th>
                            <th>Application</th>
                            <th>GPU Type</th>
                            <th>Process Size</th>
                            <th>Transistors</th>
                            <th>Die Size</th>
                            <th>Foundry</th>
                            <th>Date</th>

                        </tr>
                    </thead>
                    <tbody id="chipShowData">
                        <?php
                        $sql = "SELECT `chip_ID`,`name`,`stage`,`application`,`gpu_type`,`process_size`,`transistors`,`die_size`,`foundry`,`added_date` FROM gpu_chips ORDER BY `chip_ID` DESC LIMIT 10";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['chip_ID'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['stage'] . "</td>";
                            echo "<td>" . $row['application'] . "</td>";
                            echo "<td>" . $row['gpu_type'] . "</td>";
                            echo "<td>" . $row['process_size'] . "</td>";
                            echo "<td>" . $row['transistors'] . "</td>";
                            echo "<td>" . $row['die_size'] . "</td>";
                            echo "<td>" . $row['foundry'] . "</td>";
                            echo "<td>" . $row['added_date'] . "</td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script>
        function openAddBox() {
            if (document.getElementById("add-new-chip").style.display == 'block') {
                document.getElementById("add-new-chip").style.display = 'none';
            } else if (document.getElementById("add-new-chip").style.display == 'none') {
                document.getElementById("add-new-chip").style.display = 'block';
            }
        }

        function openUpdateBox() {
            if (document.getElementById("update-chip").style.display == 'block') {
                document.getElementById("update-chip").style.display = 'none';
            } else if (document.getElementById("update-chip").style.display == 'none') {
                document.getElementById("update-chip").style.display = 'block';
            }
        }

        function openInfoBox() {
            if (document.getElementById("info-chip").style.display == 'block') {
                document.getElementById("info-chip").style.display = 'none';
            } else if (document.getElementById("info-chip").style.display == 'none') {
                document.getElementById("info-chip").style.display = 'block';
            }
        }
    </script>

    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script src="./scripts/home/gpuchips.js">
    </script>
    <script src="./scripts/home/extra.js"></script>
</body>

</html>