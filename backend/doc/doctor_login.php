<?php
session_start();
include('assets/inc/config.php'); // Get configuration file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$errorMessage = '';

// Check if the form is submitted
if (isset($_POST['doc_login'])) {
    $doc_number = $_POST['doc_number'];
    $doc_pwd = sha1(md5($_POST['doc_pwd'])); // Double encrypt to increase security

    // Prepare the SQL statement to check login credentials
    $stmt = $mysqli->prepare("SELECT doc_id, doc_email FROM his_docs WHERE doc_number=? AND doc_pwd=?");
    $stmt->bind_param('ss', $doc_number, $doc_pwd); // Bind fetched parameters
    $stmt->execute(); // Execute bind
    $stmt->store_result(); // Store result to free up connection

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($doc_id, $doc_email);
        $stmt->fetch();

        // Close the first statement
        $stmt->close();

        // If credentials match, generate OTP and send it to the doctor's email
        $otp = rand(1000, 9999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime('+30 seconds'));

        // Update OTP and expiry time in the database
        $stmt = $mysqli->prepare("UPDATE his_docs SET otp = ?, otp_expiry = ? WHERE doc_id = ?");
        $stmt->bind_param("ssi", $otp, $otp_expiry, $doc_id);
        $stmt->execute();

        // Send OTP to the doctor's email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'chaudharypradeep30062@gmail.com'; // Use your actual email
            $mail->Password   = 'ajip cojj tlez ayeq'; // Use your actual password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('chaudharypradeep30062@gmail.com', 'Admin');
            $mail->addAddress($doc_email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = 'Your OTP code is <b>' . $otp . '</b>';
            $mail->AltBody = 'Your OTP code is ' . $otp;

            $mail->send();
            $_SESSION['status'] = "OTP has been sent to your email.";
                 header("Location: otp_form.php?doc_email=$doc_email");
            exit();
        } catch (Exception $e) {
            $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['status'] = "ID and Password do not match.";
    }

    $stmt->close();
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Hospital-PHP/Homepage/Login/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Ecare-Doctor Login</title>
    <style>
        .signup_box {
            height: 600px;
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

            <div class="login-container">
                <form method="POST">
                    <h2>Doctor Login</h2>
                    <div class="alert">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo "<h4>" . $_SESSION['status'] . "</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="doc_number">Doctor ID:</label>
                        <input type="text" id="doc_number" name="doc_number" required placeholder="Enter your Doctor ID">
                    </div>
                    <div class="form-group">
                        <label for="doc_pwd">Password:</label>
                        <input type="password" id="doc_pwd" name="doc_pwd" required placeholder="Enter your password">
                    </div>
                    <button type="submit" name="doc_login">Login</button>

                    <div class="col-12-text-center">
                        <p><a href="doctor_reset.php" class="text-white-50-ml-1">Forgot your password?</a></p>
                    </div>
                </form>
            </div>
            <div class="warning">
                <h3>***Doctors must have their doctor ID and password provided by the Admin***</h3>
            </div>
            <a href="/Hospital-PHP/Homepage/Login/login.php">
                <h4>Back to login</h4>
            </a>
        </div>
    </div>
 
    <script src="/patient/index.js"></script>
</body>

</html>
