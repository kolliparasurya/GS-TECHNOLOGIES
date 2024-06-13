<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSTECHNOLOGIES</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"> -->
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="container">
        <svg id="logo" width="100" height="40" x="1000" y="1000">
            <!-- Black circle -->
            <circle cx="20" cy="20" r="20" fill="#000000" />
            <!-- Red circle -->
            <circle cx="20" cy="20" r="10" fill="#ff0000" />
            <!-- GS text outside -->
            <text x="45" y="32" fill="#000000" font-family="Verdana" font-size="30" font-weight="bold" class="shadow">GS</text>
        </svg>
        <div id="adminidform" class="adminidform">
            <div>
                <h2 id="formTittle">Login</h2>
            </div>
            <div class="userBox"></div>
            <div>
                <div class="adminId">
                    <label class="labels" for="uname"><b>AdminId: </b></label>
                    <input type="text" placeholder="Enter username" name="uname" id="uname" required>
                </div>
                <br>
                <div class="pasword">
                    <label class="labels" for="pwd"><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required>
                </div>
                <p id="warning" style="color: red; padding: 12px 0px 8px 5% ;"></p>
                <div class="forgot-pass">
                    <a id="ForgotPassword" href="./securityPass.php">Forgot Password?</a>
                </div>
                <button class="loginButton" type="submit" onclick="checkAdminId()" id="loginbtn">Login</button>
                <br>
            </div>
        </div>
    </div>
    <script>
        function checkAdminId() {

            var adminId = document.getElementById("uname").value;
            var password = document.getElementById("pwd").value;
            // console.log(adminId, password);

            if (adminId != "" && password != "") {
                $.ajax({
                    method: "GET",
                    url: "./php/authentication.php",
                    data: {
                        adminId: adminId,
                        password: password,
                    },
                    cache: false,
                    success: function(result) {
                        if (result == "ok") {
                            console.log(result);
                            window.location.href = "./home.php";
                        } else {
                            console.log(result);
                            document.getElementById("warning").innerHTML = result;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                })
            } else {
                document.getElementById("warning").innerHTML = "Enter AdminId and Password";
            }
        }
    </script>
    <script src="./lib/jquery-3.6.0.min.js"></script>
</body>

</html>