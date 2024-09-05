<?php
session_start();
include('assets/inc/config.php'); 

if (isset($_POST['valid_click'])) {
    $doc_email = $_POST['doc_email'];
    $otp_array = $_POST['otp'];
    $otp = implode("", $otp_array);

    // Check the OTP and its expiry
    $stmt = $mysqli->prepare("SELECT doc_id, doc_number, otp, otp_expiry FROM his_docs WHERE doc_email = ? AND otp = ?");
    $stmt->bind_param("ss", $doc_email, $otp);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($doc_id, $doc_number, $db_otp, $otp_expiry);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        $current_time = date("Y-m-d H:i:s");

        if ($current_time <= $otp_expiry) {
            // Set session variables
            $_SESSION['doc_id'] = $doc_id;
            $_SESSION['doc_number'] = $doc_number;

            // Delete the OTP after use
            $stmt = $mysqli->prepare("UPDATE his_docs SET otp = NULL, otp_expiry = NULL WHERE doc_email = ?");
            $stmt->bind_param("s", $doc_email);
            $stmt->execute();
            
            // Redirect to the dashboard
            header("Location: his_doc_dashboard.php");
            exit();
        } else {
            $_SESSION['status'] = "OTP has expired. Please request a new one.";
        }
    } else {
        $_SESSION['status'] = "Invalid OTP. Please try again.";
    }

    $stmt->close();
    $mysqli->close();
}
header("Location: otp_form.php?doc_email=" . urlencode($doc_email));
exit();
?>
