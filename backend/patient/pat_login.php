<?php
session_start();
include('assets/inc/config.php'); //get configuration file

if (isset($_POST['pat_login'])) {
    $pat_identifier = $_POST['pat_identifier'];
    $pat_pwd = sha1(md5($_POST['pat_pwd'])); //double encrypt to increase security

    // Prepare SQL query to log in user either by email or patient number
    $stmt = $mysqli->prepare("SELECT pat_email, pat_pwd, pat_id, pat_number FROM his_patients WHERE (pat_email=? OR pat_number=?) AND pat_pwd=?");
    $stmt->bind_param('sss', $pat_identifier, $pat_identifier, $pat_pwd); //bind fetched parameters
    $stmt->execute(); //execute bind
    $stmt->bind_result($pat_email, $pat_pwd, $pat_id, $pat_number); //bind result
    $rs = $stmt->fetch();
    
    if ($rs) { //if its successful
        $_SESSION['pat_id'] = $pat_id; //Assign session to patient id
        $_SESSION['pat_number'] = $pat_number; //Assign session to patient number
        header("location:his_pat_dashboard.php");
    } else {
        $_SESSION['status'] = "Email/Patient Number and Password do not match.";
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Hospital-PHP/Homepage/Login/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Ecare-Patient Login</title>
    <style>
        .signup_box {
            margin-top: 100px;
        }

        .signup_signin {
            background-color: #66dbe3;
        }

        .signup_signin a:hover {
            color: white;
        }


        .signup_signup a:hover {
            color: black;
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
        <div class="signup_img"></div>
    </div>
    <div class="signup_box_wrapper">
        <div class="signup_box">
            <div class="signup_box_head">
                <div class="signup_box_img"></div>
                <div class="signup_box_details">
                    <h2 class="description">Ecare eAuthentication is using Login to allow you to sign in to your account safely and securely.</h2>
                </div>
            </div>
            <div class="signup_case">
                <div class="signup_signin">
                    <a href="/Hospital-PHP/backend/patient/pat_login.php">
                        <h1>Sign in</h1>
                    </a>
                </div>
                <div class="signup_signup">
                    <a href="/Hospital-PHP/backend/patient/pat_register.php">
                        <h1>Create an Account</h1>
                    </a>
                </div>
            </div>
            <div class="login-container">
                <form id="loginForm" method="post" action="">
                    <h2>Patient Login Form</h2>
                    <div class="alert">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo "<h4>" . $_SESSION['status'] . "</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="identifier">Email address or Patient Number:</label>
                        <input type="text" id="identifier" name="pat_identifier" required="" placeholder="Enter your email or patient number">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="pat_pwd" required="" placeholder="Enter Your Password">
                    </div>
                    <button type="submit" name="pat_login">Patient Login</button>
                    <div class="col-12-text-center">
                        <p><a href="pat_reset.php" class="text-white-50-ml-1">Forgot your password?</a></p>
                    </div>
                </form>
            </div>
            <br>
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