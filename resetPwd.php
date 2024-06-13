<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset password</title>
    <link rel="stylesheet" href="./css/resetPwd.css">
</head>

<body>
    <div class="container">
        <div id="resetPasswordForm" class="resetPasswordForm">
            <label class="labels" for="uname"><b>AdminId:</b></label>
            <input class="uname" type="text" placeholder="Enter username" name="uname" id="uname" required><br>
            <label class="labels" for="new Password"><b>New Password:</b></label>
            <input class="newPassword" type="password" placeholder="Enter username" name="newPassword" id="newPassword" required>
            <br>
            <label class="labels" for="confirm Password"><b>Confirm Password:</b></label>
            <input class="cnfPassword" type="password" placeholder="Enter Password" name="confirmPassword" id="confirmPassword" required>
            <br>
            <p id="warning" style="color: red; padding: 12px 0px 8px 5% ;"></p>
        </div>
        <div>
            <button class="button" type="submit" onclick="resetPwd()" id="resetbtn">Reset password</button>
        </div>
    </div>
    <script>
        function resetPwd() {
            var adminId = document.getElementById("uname").value;
            var newPassword = document.getElementById("newPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (newPassword == confirmPassword) {
                $.ajax({
                    method: "GET",
                    url: "./php/authentication_resetPwd.php",
                    data: {
                        adminId: adminId,
                        newPassword: newPassword,
                        confirmPassword: confirmPassword,
                    },
                    cache: false,
                    success: function(result) {
                        if (result === "Password Successfully Saved!") {
                            console.log(result);
                            document.getElementById("warning").innerHTML = result;
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
                document.getElementById("warning").innerHTML = "Password not matched";
            }
        }
    </script>
</body>

</html>