<?php
session_start();
include('assets/inc/config.php'); //get configuration file
if (isset($_POST['admin_login'])) {
    $ad_email = $_POST['ad_email'];
    $ad_pwd = sha1(md5($_POST['ad_pwd'])); //double encrypt to increase security
    $stmt = $mysqli->prepare("SELECT ad_email ,ad_pwd , ad_id FROM his_admin WHERE ad_email=? AND ad_pwd=? "); //sql to log in user
    $stmt->bind_param('ss', $ad_email, $ad_pwd); //bind fetched parameters
    $stmt->execute(); //execute bind
    $stmt->bind_result($ad_email, $ad_pwd, $ad_id); //bind result
    $rs = $stmt->fetch();
    $_SESSION['ad_id'] = $ad_id; //Assign session to admin id
    //$uip=$_SERVER['REMOTE_ADDR'];
    //$ldate=date('d/m/Y h:i:s', time());
    if ($rs) { //if its sucessfull
        header("location:his_admin_dashboard.php");
    } else {
        #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
        $_SESSION['status'] = "Email and Password does not match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Hospital-PHP/Homepage/Login/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Ecare-Admin Login </title>
    <style>
        .signup_box {
            height: 580px;
        }

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

    <script src="assets/js/swal.js"></script>
    <!--Inject SWAL-->
    <?php if (isset($success)) { ?>
        <!--This code for injecting an alert-->
        <script>
            setTimeout(function() {
                    swal("Success", "<?php echo $success; ?>", "success");
                },
                100);
        </script>

    <?php } ?>

    <?php if (isset($err)) { ?>
        <!--This code for injecting an alert-->
        <script>
            setTimeout(function() {
                    swal("Failed", "<?php echo $err; ?>", "Failed");
                },
                100);
        </script>

    <?php } ?>

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
                <form method="POST">
                    <h2>Admin login</h2>
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
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="ad_pwd" required="" placeholder="Enter Your Password "   >
                       
                        
                        <!-- <small id="passwordError" class="error"></small> -->

                    </div>
                    <button type="submit" name="admin_login"> Admin Login</button>
                    <div class="col-12-text-center">
                        <p> <a href="admin_reset.php" class="text-white-50-ml-1"> Forgot your password?</a></p>
                    </div>
                </form>
            </div>

            <a href="/Hospital-PHP/Homepage/Login/login.php">
                <h4>Back to login</h4>
            </a>
        </div>
    </div>
  

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    <script src="/patient/index.js"></script>
</body>

</html>