<?php
session_start();
include('assets/inc/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if (isset($_POST['doc_login'])) {
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

        // Send OTP to the user's doc_email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'chaudharypradeep30062@gmail.com'; // Use your actual doc_email
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
            $_SESSION['status'] = "OTP has been sent to your doc_email.";
            header("Location: otp_form.php?doc_email=$doc_email");
            exit();
        } catch (Exception $e) {
            $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
       
    }

    $stmt->close();
    $mysqli->close();
}
?>

