<!--Server side code to handle  Patient Registration-->
<?php
session_start();
include('assets/inc/config.php');

if (isset($_POST['update_bill'])) {
    $bill_number = $_GET['bill_number'];
    $bill_pat_name = $_POST['bill_pat_name'];
    $bill_pat_number = $_POST['bill_pat_number'];
    $bill_pat_email = $_POST['bill_pat_email'];
    $bill_pat_fee = $_POST['bill_pat_fee'];
    $bill_descr = $_POST['bill_descr'];

    // Calculate the taxable amount and total bill
    $tax = 13 / 100;
    $taxable_bill = $bill_pat_fee * $tax;
    $total_bill = $bill_pat_fee + $taxable_bill;

    // SQL to update captured values
    $query = "UPDATE his_bills SET bill_pat_name=?, bill_pat_number=?, bill_pat_email=?, bill_pat_fee=?, bill_descr=?, bill_tax=? WHERE bill_number=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sssssss', $bill_pat_name, $bill_pat_number, $bill_pat_email, $bill_pat_fee, $bill_descr, $total_bill, $bill_number);
    $stmt->execute();

    // Declare a variable which will be passed to alert function
    if ($stmt->affected_rows > 0) {
        $success = "Bill Record Updated ";
    } else {
        $err = "Please Try Again Or Try Later";
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
        $bill_number = $_GET['bill_number'];
        $ret = "SELECT  * FROM his_bills WHERE bill_number=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('s', $bill_number);
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
                                            <li class="breadcrumb-item active">Update Bill Record</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Patient Bill Record</h4>
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
                                                    <input type="text" required="required" readonly name="bill_pat_name" value="<?php echo $row->bill_pat_name; ?>" class="form-control" id="inputEmail4" placeholder="Patient's Name">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Patient Email</label>
                                                    <input required="required" type="text" readonly name="bill_pat_email" value="<?php echo $row->bill_pat_email; ?>" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Patient Number</label>
                                                    <input required="required" type="text" readonly name="bill_pat_number" value="<?php echo $row->bill_pat_number ?>" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="form-group col-md-6">
                                                    <label for="bill_pat_fee" class="col-form-label">Patient Bill (Rs.)</label>
                                                    <input type="text" required="required" name="bill_pat_fee" value="<?php echo $row->bill_pat_fee; ?>" class="form-control" id="bill_pat_fee">
                                                </div>
                                                <script type="text/javascript">
                                                    function validateBillFee() {
                                                        var billFeeInput = document.getElementById("bill_pat_fee");
                                                        billFeeInput.addEventListener("input", function() {
                                                            var value = parseFloat(this.value);
                                                            if (isNaN(value) || value <= 0) {
                                                                this.setCustomValidity("Please enter a positive amount.");
                                                            } else {
                                                                this.setCustomValidity("");
                                                            }
                                                        });
                                                    }

                                                    window.onload = function() {
                                                        validateBillFee();
                                                    };
                                                </script>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Bill Description</label>
                                                <textarea type="text" class="form-control" name="bill_descr" id="editor"> <?php echo $row->bill_descr; ?></textarea>
                                            </div>

                                            <button type="submit" name="update_bill" class="ladda-button btn btn-primary" data-style="expand-right">Update Bill Record</button>

                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        <?php } ?>
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