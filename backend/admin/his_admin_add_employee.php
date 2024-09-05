<?php
session_start();
include('assets/inc/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Function to generate a random string
function generateRandomString($length = 4)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = random_int(0, $charactersLength - 1);
        $randomString .= $characters[$randomIndex];
    }

    return $randomString;
}

// Function to send email
function send_doctor_email($doc_fname, $doc_lname, $doc_number, $doc_email, $doc_pwd)
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
        $mail->addAddress($doc_email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Your Doctor ID and Password'; // Email subject

        $email_template = "
        <h2>Hello Dr. {$doc_fname} {$doc_lname}</h2>
        <h3>Your Dotor ID is: {$doc_number} and your password is: {$_POST['doc_pwd']}</h3>
        <br><br>
        <br><br>
        <h4>Welcome to Ecare Hospital</h4>
        ";

        $mail->Body    = $email_template; // HTML email body
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['add_doc'])) {
    $doc_fname = $_POST['doc_fname'];
    $doc_lname = $_POST['doc_lname'];
    $doc_number = generateRandomString(4);
    $doc_email = $_POST['doc_email'];
    $doc_pwd = sha1(md5($_POST['doc_pwd']));
    $doc_dept = $_POST['doc_dept'];

    

    // Check if the email already exists
    $check_email_query = "SELECT doc_email FROM his_docs WHERE doc_email = ?";
    $stmt = $mysqli->prepare($check_email_query);
    $stmt->bind_param('s', $doc_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $err = "Doctor already exists with this {$doc_email}";
    } else {
        // SQL to insert captured values
        $query = "INSERT INTO his_docs (doc_fname, doc_lname, doc_number, doc_email, doc_pwd ,doc_dept) VALUES (?, ?, ?, ?, ? ,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssss', $doc_fname, $doc_lname, $doc_number, $doc_email, $doc_pwd, $doc_dept);
        $stmt->execute();

        if ($stmt) {
            $success = "Doctor Details Added and email is  sent to {$doc_email}";

            // Send email to the doctor
            send_doctor_email($doc_fname, $doc_lname, $doc_number, $doc_email, $_POST['doc_pwd']);
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }
}
 
?>
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Doctors</a></li>
                                        <li class="breadcrumb-item active">Add Doctors</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Add Doctor Details</h4>
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
                                    <!-- Add Doctor Form -->
                                    <form method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="doc_fname" class="col-form-label">First Name</label>
                                                <input type="text" required="required" name="doc_fname" class="form-control" id="doc_fname">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="doc_lname" class="col-form-label">Last Name</label>
                                                <input required="required" type="text" name="doc_lname" class="form-control" id="doc_lname">
                                            </div>
                                        </div>

                                        <div class="form-group" style="display:none">
                                            <label for="doc_number" class="col-form-label">Doctor Number</label>
                                            <input type="text" name="doc_number" value="<?php echo $doc_number; ?>" class="form-control" id="doc_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="doc_email" class="col-form-label">Email</label>
                                            <input required="required" type="email" class="form-control" name="doc_email" id="doc_email">
                                        </div>
                                       


                                        <div class="form-row">
                                        <div class="form-group col-md-6">
                                                    <label for="inputState" class="col-form-label">Departments</label>
                                                    <select id="inputState" required="required" name="doc_dept" class="form-control">
                                                        <option>Choose</option>
                                                        <option>Emergency</option>
                                                        <option>Laboratory</option>
                                                        <option>X-ray</option>
                                                        <option>OPD</option>
                                                        <option>Surgery | Theatre</option>
                                                    </select>
                                            </div>   
                                            <div class="form-group col-md-6">
                                                <label for="doc_pwd" class="col-form-label">Password</label>
                                                <input required="required" type="password" name="doc_pwd" class="form-control" id="doc_pwd">
                                            </div>
                                        </div>

                                        <button type="submit" name="add_doc" class="ladda-button btn btn-success" data-style="expand-right">Add Doctor</button>
                                    </form>
                                    <!-- End Doctor Form -->
                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
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

</body>

</html>