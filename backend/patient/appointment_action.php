<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();

if (isset($_GET['action']) && isset($_GET['appointment_id'])) {
    $action = $_GET['action'];
    $appointment_id = $_GET['appointment_id'];

    if ($action == 'cancel') {
        // SQL to delete appointment
        $query = "DELETE FROM Appointments WHERE appointment_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $appointment_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Appointment canceled successfully.";
        } else {
            $_SESSION['message'] = "Failed to cancel appointment.";
        }
        $stmt->close();
    }
    header("Location: his_pat_manage_appointment.php");
    exit();
}
?>
