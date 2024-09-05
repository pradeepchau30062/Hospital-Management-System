<?php
session_start();
include('assets/inc/config.php');

if (isset($_GET['action']) && isset($_GET['appointment_id'])) {
    $action = $_GET['action'];
    $appointment_id = $_GET['appointment_id'];

    if ($action == 'approve') {
        $query = "UPDATE Appointments SET status = 'Approved' WHERE appointment_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $appointment_id);
        $stmt->execute();
        $_SESSION['message'] = "Appointment approved successfully!";
    } elseif ($action == 'reject') {
        $query = "UPDATE Appointments SET status = 'Rejected' WHERE appointment_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $appointment_id);
        $stmt->execute();
        $_SESSION['message'] = "Appointment rejected successfully!";
    } elseif ($action == 'remove') {
        $query = "DELETE FROM Appointments WHERE appointment_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $appointment_id);
        $stmt->execute();
        $_SESSION['message'] = "Appointment removed successfully!";
    }
    $stmt->close();
}

header("Location: his_doc_appointment.php");
exit();
?>
