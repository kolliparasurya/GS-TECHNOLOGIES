<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>security Pass</title>
  <link rel="stylesheet" href="./css/securityPass.css">
</head>

<body>
  <div class="container">
    <h2>Security questions</h2>
    <div id="securityQuestions" class="securityQuestions">
      <label class="labels" for="uname"><b>AdminId:</b></label>
      <input class="username" type="text" placeholder="Enter username" name="uname" id="uname" required>
      <br>
      <br>
      <div class="labelsq"><span><b>Enter answers of security questions</b></span></div>
      <label class="labels" for="fteacher">who is your favourite teacher: </label>
      <input class="fteacher" type="text" placeholder="Enter name" name="fteacher" id="fteacher" required>
      <br>
      <label class="labels" for="nickname">what is your nickname: </label>
      <input class="nickname" type="text" placeholder="Enter name" name="nickname" id="nickname" required>
      <br>
      <p id="warning" style="color: red; padding: 12px 0px 8px 5% ;"></p>
    </div>
    <div>
      <button class="button" onclick="securityPass()" id="authentication">Authenticate</button>
    </div>

  </div>
  <script>
    function securityPass() {
      var adminId = document.getElementById("uname").value;
      var fteacher = document.getElementById("fteacher").value;
      var nickname = document.getElementById("nickname").value;

      if (adminId != "" && password != "" && nickname != "") {
        $.ajax({
          method: "GET",
          url: "./php/securityPass.php",
          data: {
            adminId: adminId,
            fteacher: fteacher,
            nickname: nickname,
          },
          cache: false,
          success: function(result) {
            if (result === "ok") {
              console.log(result);
              window.location.href = "./resetPwd.php"
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
        document.getElementById("warning").innerHTML = "Enter all";
      }
    }
  </script>
  <script src="./lib/jquery-3.6.0.min.js"></script>
</body>

</html>