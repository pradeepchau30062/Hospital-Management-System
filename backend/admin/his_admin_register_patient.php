<!--Server side code to handle  Patient Registration-->
<?php
session_start();
include('assets/inc/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
// Function to generate a random string
function generateRandomNumber($length = 5)
{
    $min = pow(10, $length - 1); // 10000 for a 5-digit number
    $max = pow(10, $length) - 1; // 99999 for a 5-digit number

    return random_int($min, $max);
}


// Function to send email
function send_patient_email($pat_fname, $pat_ailment, $pat_lname, $pat_age, $pat_dob, $pat_number, $pat_phone, $pat_type, $pat_addr, $pat_email, $pat_pwd)
{
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'chaudharypradeep30062@gmail.com'; // SMTP username
        $mail->Password   = 'ajip cojj tlez ayeq'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('chaudharypradeep30062@gmail.com', 'Admin'); // Set the sender's email and name
        $mail->addAddress($pat_email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'USE PATIENT NUMBER OR YOUR GMAIL TO LOGIN'; // Email subject

        $email_template = "
        <h2>Hello Mr. {$pat_fname} {$pat_lname}</h2>
        <h3>Your Patient  Number is: {$pat_number} and your password is: {$_POST['pat_pwd']}</h3>
        <h4>Your details are:-</h4>
        <h5>Address:{$pat_addr}
        <br>
        DOB:{$pat_dob}
        <br>
        Age:{$pat_age}
        <br>
        Mobile number:{$pat_phone}
        <br>
        Patient Problem: {$pat_ailment} 
        <br>
        Patient Type:{$pat_type}
        </h5>
       
        <br>
        <br>
        <h4>Welcome to Ecare Hospital</h4>
        ";

        $mail->Body    = $email_template; // HTML email body
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


if (isset($_POST['add_patient'])) {
    $pat_fname = $_POST['pat_fname'];
    $pat_lname = $_POST['pat_lname'];
    $pat_number = generateRandomNumber(5);
    $pat_phone = $_POST['pat_phone'];
    $pat_type = $_POST['pat_type'];
    $pat_addr = $_POST['pat_addr'];
    $pat_age = $_POST['pat_age'];
    $pat_dob = $_POST['pat_dob'];
    $pat_ailment = $_POST['pat_ailment'];
    $pat_email = $_POST['pat_email'];
    $pat_pwd = sha1(md5($_POST['pat_pwd']));


    // Check if the email already exists
    $check_email_query = "SELECT pat_email FROM his_patients WHERE pat_email = ?";
    $stmt = $mysqli->prepare($check_email_query);
    $stmt->bind_param('s', $pat_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $err = "patient already exists with this {$pat_email}";
    } else {
        //sql to insert captured values
        $query = "insert into his_patients (pat_fname, pat_ailment, pat_lname, pat_age, pat_dob, pat_number, pat_phone, pat_type, pat_addr, pat_email, pat_pwd) values(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssssssssss', $pat_fname, $pat_ailment, $pat_lname, $pat_age, $pat_dob, $pat_number, $pat_phone, $pat_type, $pat_addr, $pat_email, $pat_pwd);
        $stmt->execute();
        /*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
        //declare a varible which will be passed to alert function
        if ($stmt) {
            $success = "Patient is Added and Email is  sent to {$pat_email}";

            //send email to the patient
            send_patient_email($pat_fname, $pat_ailment, $pat_lname, $pat_age, $pat_dob, $pat_number, $pat_phone, $pat_type, $pat_addr, $pat_email, $_POST['pat_pwd']);
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }
}
?>
<!--End Server Side-->
<!--End Patient Registration-->
<!DOCTYPE html>
<html lang="en">

<!--Head-->
<?php include('assets/inc/head.php'); ?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include("assets/inc/nav.php"); ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("assets/inc/sidebar.php"); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                        <li class="breadcrumb-item active">Add Patient</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Add Patient Details</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Fill all fields</h4>
                                    <!--Add Patient Form-->
                                    <form method="post" onsubmit="return validateTime()">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="col-form-label">First Name</label>
                                                <input type="text" required="required" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Last Name</label>
                                                <input required="required" type="text" name="pat_lname" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Address</label>
                                                <input required="required" type="text" name="pat_addr" class="form-control" id="inputPassword4" placeholder="Patient's Address">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputDob" class="col-form-label">Date Of Birth</label>
                                                <input type="date" required name="pat_dob" class="form-control" id="inputDob" placeholder="DD/MM/YYYY">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputAge" class="col-form-label">Age</label>
                                                <input required type="text" name="pat_age" class="form-control" id="inputAge" placeholder="Patient's Age" readonly>
                                            </div>
                                            <script type="text/javascript">
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var ageInput = document.getElementById("inputAge");
                                                    ageInput.addEventListener("input", function() {
                                                        var value = parseFloat(this.value);
                                                        if (isNaN(value) || value <= 0) {
                                                            this.setCustomValidity("Please enter a valid Age.");
                                                        } else {
                                                            this.setCustomValidity("");
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="inputAddress" class="col-form-label">Email</label>
                                                <input required="required" type="email" class="form-control" name="pat_email" id="inputAddress" placeholder="Patient's Email ">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress" class="col-form-label">Password</label>
                                                <input required="required" type="password" class="form-control" name="pat_pwd" id="inputAddress" placeholder="Password for patient">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                <input required="required" type="text" name="pat_phone" class="form-control" id="number_v" placeholder="Patient's Mobile Number">
                                                <script type="text/javascript">
                                                    function validateMobileNumber() {
                                                        var mobileInput = document.getElementById("number_v");
                                                        mobileInput.addEventListener("input", function() {
                                                            var value = this.value;
                                                            if (!/^\d{10}$/.test(value)) {
                                                                this.setCustomValidity("Please enter a 10-digit Mobile number.");
                                                            } else {
                                                                this.setCustomValidity("");
                                                            }
                                                        });
                                                    }

                                                    window.onload = validateMobileNumber;
                                                </script>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputCity" class="col-form-label">Patient Ailment</label>
                                                <input required="required" type="text" name="pat_ailment" class="form-control" id="inputCity">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState" class="col-form-label">Patient's Type</label>
                                                <select id="inputState" required="required" name="pat_type" class="form-control">
                                                    <option>Choose</option>
                                                    <option>InPatient</option>
                                                    <option>OutPatient</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2" style="display:none">

                                                <label for="inputZip" class="col-form-label">Patient Number</label>
                                                <input type="text" name="pat_number" value="<?php echo $pat_number; ?>" class="form-control" id="inputZip">
                                            </div>
                                        </div>

                                        <button type="submit" name="add_patient" class="ladda-button btn btn-primary" data-style="expand-right">Add Patient</button>

                                    </form>
                                    <!--End Patient Form-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include('assets/inc/footer.php'); ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

    <!-- Loading buttons js -->
    <script src="assets/libs/ladda/spin.js"></script>
    <script src="assets/libs/ladda/ladda.js"></script>

    <!-- Buttons init js-->
    <script src="assets/js/pages/loading-btn.init.js"></script>
    <script>
        function validateTime() {
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

        function setMaxDate() {
            var today = new Date();
            var yyyy = today.getFullYear();
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            var dd = String(today.getDate()).padStart(2, '0');
            var maxDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById('inputDob').setAttribute('max', maxDate);
        }

        function calculateAge() {
            var dob = new Date(document.getElementById('inputDob').value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            document.getElementById('inputAge').value = age;
        }

        window.onload = function() {
            setMaxDate();
            document.getElementById('inputDob').addEventListener('change', calculateAge);
        };
    </script>

</body>

</html>