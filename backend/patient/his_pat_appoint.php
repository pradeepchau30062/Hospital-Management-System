<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pat_id'];

// Retrieve doctor details from URL
$doc_id = $_GET['doc_id'];
$doc_number = $_GET['doc_number'];
$doc_fname = $_GET['doc_fname'];
$doc_lname = $_GET['doc_lname'];

// Retrieve patient number based on logged-in user
$pat_query = "SELECT pat_number, pat_fname , pat_lname FROM his_patients WHERE pat_id = ?";
$stmt = $mysqli->prepare($pat_query);
$stmt->bind_param('i', $aid);
$stmt->execute();
$stmt->bind_result($pat_number, $pat_fname, $pat_lname);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_appointment'])) {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = "Pending"; // Default status

    // Check if patient number is retrieved
    if ($pat_number) {
        // SQL to insert appointment
        $query = "INSERT INTO Appointments (doc_number, pat_number, pat_fname,pat_lname, doc_fname,doc_lname, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sssssssss', $doc_number, $pat_number, $pat_fname, $pat_lname,$doc_fname,$doc_lname, $appointment_date, $appointment_time, $status);
        $stmt->execute();
        if ($stmt) {
            $success = "Appointment added successfully.";
    
        } else {
            $_SESSION['status'] = "Something went wrong!!";
            header("Location: appointment_failure.php"); // Redirect to a failure page
        }
        $stmt->close();
    } else {
        $_SESSION['status'] = "Invalid patient or doctor.";
        header("Location: appointment_failure.php"); // Redirect to a failure page
    }
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">My appointment</a></li>
                                        <li class="breadcrumb-item active">Book an appointment</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Book an Appointment</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Fill all fields</h4>
                                    <form method="post" onsubmit="return validateAppointmentTime()">
                                        <div class="form-group">
                                            <label for="inputDate" class="col-form-label">Appointment Date</label>
                                            <input required type="date" class="form-control" name="appointment_date" id="inputDate">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTime" class="col-form-label">Appointment Time</label>
                                            <input required type="time" class="form-control" name="appointment_time" id="inputTime">
                                            <small id="timeError" class="error" style="color: red; display: none;">Please select a time between 10:00 AM and 5:00 PM.</small>
                                        </div>
                                        <button type="submit" name="add_appointment" class="btn btn-primary">Confirm Appointment</button>
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
