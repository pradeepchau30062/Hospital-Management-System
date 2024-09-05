<!--Server side code to handle  Patient Registration-->
<?php
session_start();
include('assets/inc/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Function to send email
function send_patient_email($pat_email, $pat_fname, $total_bill, $bill_number, $bill_descr)
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
        $mail->Subject = 'Your Hospital Bill'; // Email subject

        $email_template = "
        <h2>Hello Mr./Mrs. {$pat_fname} </h2>
        <h3>Your bill number is :{$bill_number}</h3>
        <h3>Your Total Fee is: {$total_bill}</h3>
        <h4>Your bill description: {$bill_descr}</h4>
        <h5>Please pay your Hospital Charges</h5>
       
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

if (isset($_POST['add_bill'])) {
    $bill_number = $_POST['bill_number'];
    $bill_pat_name = $_POST['bill_pat_name'];
    $bill_pat_number = $_POST['bill_pat_number'];
    $bill_pat_email = $_POST['bill_pat_email'];
    $bill_pat_fee = $_POST['bill_pat_fee'];
    $bill_descr = $_POST['bill_descr'];
    $bill_status = 'UNPAID';
   

    // Calculate the taxable amount and total bill
    $tax = 13 / 100;
    $taxable_bill = $bill_pat_fee * $tax;
    $total_bill = $bill_pat_fee + $taxable_bill;

    // Send email to patient
    send_patient_email($bill_pat_email, $bill_pat_name, $total_bill, $bill_number,$bill_descr);

    // SQL to insert captured values
    $query = "INSERT INTO his_bills (bill_number, bill_pat_name, bill_pat_number, bill_pat_email, bill_pat_fee, bill_descr, bill_tax, bill_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ssssssss', $bill_number, $bill_pat_name, $bill_pat_number, $bill_pat_email, $bill_pat_fee, $bill_descr, $total_bill, $bill_status);
        $stmt->execute();

        // Check if the statement execution was successful
        if ($stmt->affected_rows > 0) {
            $success = "Bill Record is added & bill details is sent to {$bill_pat_name}";
        } else {
            $err = "Please Try Again Or Try Later";
        }

        $stmt->close();
    } else {
        $err = "Database Error: Unable to prepare statement";
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
        <?php
        $pat_number = $_GET['pat_number'];
        $ret = "SELECT  * FROM his_patients WHERE pat_number=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('s', $pat_number);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        //$cnt=1;
        while ($row = $res->fetch_object()) {
        ?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Payrolls</a></li>
                                            <li class="breadcrumb-item active">Add Bill Record</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Patient Bill Record</h4>
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
                                        <form method="post">
                                            <div class="form-row">

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4" class="col-form-label">Patient Name</label>
                                                    <input type="text" required="required" readonly name="bill_pat_name" value="<?php echo $row->pat_fname; ?> <?php echo $row->pat_lname; ?>" class="form-control" id="inputEmail4" placeholder="Patient's Name">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Patient Email</label>
                                                    <input required="required" type="text" readonly name="bill_pat_email" value="<?php echo $row->pat_email; ?>" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Patient Number</label>
                                                    <input required="required" type="text" readonly name="bill_pat_number" value="<?php echo $row->pat_number; ?>" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="bill_pat_fee" class="col-form-label">Patient Bill (Rs.)</label>
                                                    <input type="text" required="required" name="bill_pat_fee" class="form-control" id="bill_pat_fee">
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <hr>
                                        <div class="form-row">


                                            <div class="form-group col-md-2" style="display:none">
                                                <?php
                                                $length = 5;
                                                $pay_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                                ?>
                                                <label for="inputZip" class="col-form-label">Bill Record Number</label>
                                                <input type="text" name="bill_number" value="<?php echo $pay_no; ?>" class="form-control" id="inputZip">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Bill Description</label>
                                            <textarea type="text" class="form-control" name="bill_descr" id="editor"> </textarea>
                                        </div>

                                        <button type="submit" name="add_bill" class="ladda-button btn btn-primary" data-style="expand-right">Add Bill Record</button>

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

    <script type="text/javascript">
        function validateBillFee() {
            var billFeeInput = document.getElementById("bill_pat_fee");
            billFeeInput.addEventListener("input", function() {
                var value = parseFloat(this.value);
                if (isNaN(value) || value <= 0) {
                    this.setCustomValidity("Please enter a positive number.");
                } else {
                    this.setCustomValidity("");
                }
            });
        }

        window.onload = validateBillFee;
    </script>

    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor')
    </script>

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