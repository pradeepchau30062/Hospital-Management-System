<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Retrieve appointment details
    $query = "SELECT * FROM Appointments WHERE appointment_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Update appointment details
    $query = "UPDATE Appointments SET appointment_date = ?, appointment_time = ? WHERE appointment_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssi', $appointment_date, $appointment_time, $appointment_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Appointment updated successfully.";
    } else {
        $_SESSION['message'] = "Failed to update appointment.";
    }
    $stmt->close();
    header("Location: his_pat_manage_appointment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('assets/inc/head.php'); ?>

<body>
    <div id="wrapper">
        <?php include('assets/inc/nav.php'); ?>
        <?php include("assets/inc/sidebar.php"); ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Appointments</a></li>
                                        <li class="breadcrumb-item active">Update Appointment</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Update Appointment</h4>
                            </div>
                        </div>
                    </div>
                    
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-success" id="action-message">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                        <script>
                            setTimeout(function() {
                                var message = document.getElementById('action-message');
                                if (message) {
                                    message.style.display = 'none';
                                }
                            }, 2000); // 2000 milliseconds = 2 seconds
                        </script>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Update Appointment Details</h4>
                                    <form method="post" onsubmit="return validateAppointmentTime()">
                                        <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($appointment['appointment_id']); ?>">
                                        <div class="form-group">
                                            <label for="inputDate" class="col-form-label">Appointment Date</label>
                                            <input required type="date" class="form-control" name="appointment_date" id="inputDate" value="<?php echo htmlspecialchars($appointment['appointment_date']); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTime" class="col-form-label">Appointment Time</label>
                                            <input required type="time" class="form-control" name="appointment_time" id="inputTime" value="<?php echo htmlspecialchars($appointment['appointment_time']); ?>">
                                            <small id="timeError" class="error" style="color: red; display: none;">Please select a time between 10:00 AM and 5:00 PM.</small>
                                        </div>
                                        <button type="submit" name="update_appointment" class="btn btn-primary">Update Appointment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('assets/inc/footer.php'); ?>
        </div>
    </div>
    <div class="rightbar-overlay"></div>
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script>
        function validateAppointmentTime() {
            var timeInput = document.getElementById('inputTime').value;
            var timeError = document.getElementById('timeError');
            var time = new Date('1970-01-01T' + timeInput + 'Z');
            var minTime = new Date('1970-01-01T10:00:00Z');
            var maxTime = new Date('1970-01-01T17:00:00Z');

            if (time < minTime || time > maxTime) {
                timeError.style.display = 'block';
                return false;
            } else {
                timeError.style.display = 'none';
                return true;
            }
        }

        function setMinDate() {
            var today = new Date();
            var tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            var yyyy = tomorrow.getFullYear();
            var mm = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are zero based
            var dd = String(tomorrow.getDate()).padStart(2, '0');
            var minDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById('inputDate').setAttribute('min', minDate);
        }

        window.onload = function() {
            setMinDate();
        };
    </script>
</body>
</html>
