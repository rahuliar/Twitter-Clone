<?php
session_start();
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!---<title> Responsive Login Form | CodingLab </title>--->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/login_css.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">


        <div id="invalid_alert"></div>
        <!-- form start  -->
        <form>
            <!-- <div class="title">Login</div> -->
            <center>
                <i class="fab fa-twitter" style="font-size:46px; color:#50b7f5; margin-bottom:10px;"></i>
            </center>
            <div class="input-box underline">
                <input type="text" placeholder="Enter Username" id="username" autofocus required>
                <div class="underline"></div>
            </div>
            <div class="input-box underline">
                <input type="email" placeholder="Enter Your Email" id="uemail" required>
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Enter Your Password" id="upassword" required>
                <div class="underline"></div>
            </div>
            <div class="input-box button">
                <input type="button" value="Login" id="login">
            </div>
        </form>
        <!-- from end  -->

        <div class="option">or Connect With Social Media</div>
        <div class="Google">
            <a href="#"><i class="fab fa-google"></i>Sign in With Google</a>
        </div>
        <div class="facebook">
            <a href="#"><i class="fab fa-facebook-f"></i>Sign in With Facebook</a>
        </div>
        <div class="option">Don't have an account?
            <a href="signup" style="color:#50b7f5;cursor:pointer" id="signup">
                Sign up
            </a>
        </div>
    </div>

    <!-- script start  -->
    <script src="./js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login").click(function() {
                var username = $("#username").val();
                var email = $("#uemail").val();
                var password = $("#upassword").val();
                // console.log(username);
                $.ajax({
                    method: "POST",
                    url: "login_logic",
                    data: {
                        user_name: username,
                        user_email: email,
                        user_password: password
                    },
                    success: function(response) {
                        if (response == 1) {
                            window.location = "home"
                        } else {
                            $("#invalid_alert").html(response);
                        }

                    }
                });
            });
        });
    </script>
    <!-- script end  -->

</body>

</html>