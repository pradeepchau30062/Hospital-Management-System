<?php
session_start();
include('assets/inc/config.php'); //get configuration file

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Hospital-PHP/Homepage/Login/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Ecare-Reset your password </title>
    <style>
        /* .signup_box {
            height: 580px;
        } */

        .signup_box a {
            margin-top: 20px;
        }

        .col-12-text-center p a {
            color: red;
        }

        .col-12-text-center {
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="signup_head">
        <h1>Hospital management system</h1>
        <div class="signup_img">

        </div>
    </div>
    <div class="signup_box_wrapper">
        <div class="signup_box">

            <div class="signup_box_head">

                <div class="signup_box_img">

                </div>
                <div class="signup_box_details">
                    <h2 class="description"> Ecare eAuthentication is using Login to allow you to sign in to your account safely and securely.
                    </h2>
                </div>
            </div>


            <div class="login-container">
                <form method="POST" action="reset_code.php">
                    <h2>Forgot your password</h2>
                    <div class="alert">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo "<h4>" . $_SESSION['status'] . "</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="emailaddress">Email address:</label>
                        <input type="text" id="emailaddress" name="ad_email" required="" placeholder="Enter your email">
                        <!-- <small id="usernameError" class="error"></small> -->
                    </div>

                    <button type="submit" name="password_reset_link"> Send Reset Link</button>
                    <div class="col-12-text-center">
                        <p> <a href="admin_login.php" class="text-white-50-ml-1"> Back to login </a></p>
                    </div>
                </form>
            </div>


        </div>
    </div>


    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

  <script src="/patient/index.js"></script>
</body>

</html>