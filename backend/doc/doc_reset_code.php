<?php
session_start();
include('assets/inc/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email)
{
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'chaudharypradeep30062@gmail.com'; // SMTP username
        $mail->Password   = 'ajip cojj tlez ayeq'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('chaudharypradeep30062@gmail.com', $get_name); // Set the sender's email and name
        $mail->addAddress($get_email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Reset Password Notification'; // Email subject
         
        

        $email_template = "
        <h2>Hello</h2>
        <h3>You are receiving this email for resetting your password.</h3>
        <br></br>
        <a href='https://localhost/Hospital-PHP/backend/doc/doc_password_update.php?doc_email=$get_email'>Click here to reset your password.</a>
         
        ";
        

        $mail->Body    = $email_template; // HTML email body
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['password_reset_link'])) {

    $doc_email = mysqli_real_escape_string($mysqli, $_POST['doc_email']);

    $check_email = "SELECT doc_fname, doc_email FROM his_docs WHERE doc_email = '$doc_email' LIMIT 1";
    $check_email_run = mysqli_query($mysqli, $check_email);
   

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);

        $get_name = $row['doc_fname'];
        $get_email = $row['doc_email'];

        send_password_reset($get_name, $get_email, );
        $_SESSION['status'] = "Reset link has been sent to your email";
        header("Location: doctor_reset.php");
        exit();
    } else {
        $_SESSION['status'] = "This email doesn't exist";
        header("Location: doctor_reset.php");
        exit();
    }
}


?>
