<!--Server side code to handle  Patient Registration-->
<?php
session_start();
include('assets/inc/config.php');
if (isset($_POST['add_payroll'])) {
    $pay_number = $_POST['pay_number'];
    $pay_doc_name = $_POST['pay_doc_name'];
    //$pres_pat_type = $_POST['pres_pat_type'];
    $pay_doc_number = $_POST['pay_doc_number'];
    $pay_doc_email = $_POST['pay_doc_email'];
    $pay_emp_salary = $_POST['pay_emp_salary'];
    $pay_descr = $_POST['pay_descr'];
    $pay_status = "PAID";

    //$mdr_pat_ailment = $_POST['mdr_pat_ailment'];
    //sql to insert captured values
    $query = "INSERT INTO  his_payrolls  (pay_number, pay_doc_name, pay_doc_number, pay_doc_email, pay_emp_salary, pay_descr,pay_status) VALUES(?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss', $pay_number, $pay_doc_name, $pay_doc_number, $pay_doc_email, $pay_emp_salary, $pay_descr, $pay_status);
    $stmt->execute();
    /*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success = "Payroll Record Addded";
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
        $doc_number = $_GET['doc_number'];
        $ret = "SELECT  * FROM his_docs WHERE doc_number=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('s', $doc_number);
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
                                            <li class="breadcrumb-item active">Add Payroll Record</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Doctors Payroll Record</h4>
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
                                                    <label for="inputEmail4" class="col-form-label">Doctors Name</label>
                                                    <input type="text" required="required" readonly name="pay_doc_name" value="<?php echo $row->doc_fname; ?> <?php echo $row->doc_lname; ?>" class="form-control" id="inputEmail4" placeholder="Patient's Name">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Doctors Email</label>
                                                    <input required="required" type="text" readonly name="pay_doc_email" value="<?php echo $row->doc_email; ?>" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4" class="col-form-label">Doctors Number</label>
                                                    <input required="required" type="text" readonly name="pay_doc_number" value="<?php echo $row->doc_number; ?>" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4" class="col-form-label">Doctors Payroll (Rs. )</label>
                                                    <input type="text" required="required" name="pay_emp_salary" class="form-control" id="pay_emp_salary">
                                                </div>


                                            </div>
                                            <script type="text/javascript">
                                                function validateBillFee() {
                                                    var billFeeInput = document.getElementById("pay_emp_salary");
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
                                        <?php } ?>
                                        <hr>
                                        <div class="form-row">


                                            <div class="form-group col-md-2" style="display:none">
                                                <?php
                                                $length = 5;
                                                $pay_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                                ?>
                                                <label for="inputZip" class="col-form-label">Payroll Record Number</label>
                                                <input type="text" name="pay_number" value="<?php echo $pay_no; ?>" class="form-control" id="inputZip">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Payroll Description</label>
                                            <textarea type="text" class="form-control" name="pay_descr" id="editor"> </textarea>
                                        </div>

                                        <button type="submit" name="add_payroll" class="ladda-button btn btn-primary" data-style="expand-right">Provide Payroll</button>

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