<?php
session_start();
include('assets/inc/config.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$errorMessage = '';

if (isset($_POST['doc_login'])) {
    if (isset($_POST['doc_email'])) {
        $doc_email = $_POST['doc_email'];
        $otp = rand(1000, 9999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime('+30 seconds'));

        // Check if the doc_email exists in the database
        $stmt = $mysqli->prepare("SELECT doc_email FROM his_docs WHERE doc_email = ?");
        $stmt->bind_param("s", $doc_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Email exists, insert or update OTP in the database
            $stmt = $mysqli->prepare("UPDATE his_docs SET otp = ?, otp_expiry = ? WHERE doc_email = ?");
            $stmt->bind_param("sss", $otp, $otp_expiry, $doc_email);
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
            $errorMessage = "Email does not exist.";
        }

        $stmt->close();
        $mysqli->close();
    } else {
        $errorMessage = "Email not specified.";
    }
} else if (isset($_GET['doc_email'])) {
    $doc_email = $_GET['doc_email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Hospital-PHP/Homepage/Login/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Ecare-Send OTP Again</title>
   <style>
 
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
                <form method="POST" action="password_reset_again.php">
                    <div class="form-group">
                        <label for="emailaddress">Email address:</label>
                        <input  style="color: #f52718;" type="email" id="emailaddress" name="doc_email" class="form-control" value="<?php echo htmlspecialchars($doc_email ?? ''); ?>" readonly required>
                    </div>
                    <button type="submit" name="doc_login">Send OTP Again</button>
                    <?php
                    if ($errorMessage) {
                        echo "<div class='alert alert-danger'>$errorMessage</div>";
                    }
                    ?>
                </form>
                <div class="col-12-text-center">
                    <a href="otp_form.php?doc_email=<?php echo urlencode($doc_email ?? ''); ?>" class="text-white-50 ml-1">Back to OTP Form</a>
                </div>
            </div>
            <a href="/Hospital-PHP/Homepage/Login/login.php">
                <h4>Back to login</h4>
            </a>
        </div>
    </div>
</body>
</html>
