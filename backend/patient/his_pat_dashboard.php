<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$pat_id = $_SESSION['pat_id'];
$pat_number = $_SESSION['pat_number'];

?>
<!DOCTYPE html>
<html lang="en">

<!--Head Code-->
<?php include("assets/inc/head.php"); ?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include('assets/inc/nav.php'); ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include('assets/inc/sidebar.php'); ?>
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

                                <h4 class="page-title">Hospital Management Information System Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <!--Start OutPatients-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                        <i class="fas fa-user-md font-22 avatar-title text-danger"></i>


                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <?php
                                            //code for summing up number of out patients 
                                            $result = "SELECT count(*) FROM his_docs  ";
                                            $stmt = $mysqli->prepare($result);
                                            $stmt->execute();
                                            $stmt->bind_result($doctor);
                                            $stmt->fetch();
                                            $stmt->close();
                                            ?>
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $doctor; ?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Doctors</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End Out Patients-->


                        <!--Start InPatients-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                        <i class="mdi mdi-pill font-22 avatar-title text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <?php
                                            /* 
                                                     * code for summing up number of assets,
                                                     */
                                            $result = "SELECT count(*) FROM his_pharmaceuticals ";
                                            $stmt = $mysqli->prepare($result);
                                            $stmt->execute();
                                            $stmt->bind_result($assets);
                                            $stmt->fetch();
                                            $stmt->close();
                                            ?>
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $assets; ?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Total Pharmaceuticals</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div>
                        <!--End InPatients-->

                        <!--Start Pharmaceuticals-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                        <i class="mdi mdi-calendar font-22 avatar-title text-danger"></i>


                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">

                                            <?php
                                            // Start the session if it's not already started
                                            if (session_status() == PHP_SESSION_NONE) {
                                                session_start();
                                            }

                                            // Check if pat_number is set in the session
                                            if (isset($_SESSION['pat_number'])) {
                                                $pat_number = $_SESSION['pat_number'];

                                                // Prepare the SQL statement
                                                $query = "SELECT count(*) FROM appointments WHERE pat_number = ?";
                                                if ($stmt = $mysqli->prepare($query)) {
                                                    // Bind the parameter
                                                    $stmt->bind_param("s", $pat_number); // Assuming pat_number is a string, change "s" to "i" if it's an integer

                                                    // Execute the statement
                                                    $stmt->execute();

                                                    // Bind the result variable
                                                    $stmt->bind_result($phar);

                                                    // Fetch the result
                                                    $stmt->fetch();

                                                    // Close the statement
                                                    $stmt->close();
                                                } else {
                                                    // Handle errors in preparing the statement
                                                    echo "Error preparing statement: " . $mysqli->error;
                                                }
                                            } else {
                                                // Handle the case where pat_number is not set
                                                echo "Patient number is not set in the session.";
                                            }
                                            ?>

                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $phar; ?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">My Appointments</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End Pharmaceuticals-->

                    </div>

                    <div class="row">

                        <!--Start Vendors-->

                        <div class="col-md-6 col-xl-6">
                            <a href="his_doc_account.php">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                                <i class="fas fa-user-tag font-22 avatar-title text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"></span></h3>
                                                <p class="text-muted mb-1 text-truncate">My Profile</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </a> <!-- end widget-rounded-circle-->
                        </div>
                        <!-- end col-->
                        <!--End Vendors-->

                        <!--Start Corporation Assets-->
                        <div class="col-md-6 col-xl-6">
                            <a href="his_pat_payment_record.php">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                            <i class="mdi mdi-cash font-22 avatar-title text-danger"></i>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"></span></h3>
                                                <p class="text-muted mb-1 text-truncate">My Payments</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </a> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End Corporation Assets-->
                    </div>



                    <!--Recently Employed Doctors-->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Hospital Doctors</h4>

                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-centered m-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th colspan="2">Picture</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $ret = "SELECT * FROM his_docs ORDER BY RAND() LIMIT 10 ";
                                        //sql code to get to ten docs  randomly
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="../doc/assets/images/users/<?php echo $row->doc_dpic; ?>" alt="img" title="contact-img" class="rounded-circle avatar-sm" />
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->doc_fname; ?> <?php echo $row->doc_lname; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->doc_email; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->doc_dept; ?>
                                                    </td>
                                                    <td>
                                                        <a href="his_admin_view_single_employee.php?doc_id=<?php echo $row->doc_id; ?>&&doc_number=<?php echo $row->doc_number; ?>" class="btn btn-xs btn-primary"><i class="mdi mdi-eye"></i> View</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
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

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="dripicons-cross noti-icon"></i>
            </a>
            <h5 class="m-0 text-white">Settings</h5>
        </div>
        <div class="slimscroll-menu">
            <!-- User box -->
            <div class="user-box">
                <div class="user-img">
                    <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                    <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
                </div>

                <h5><a href="javascript: void(0);">Geneva Kennedy</a> </h5>
                <p class="text-muted mb-0"><small>Admin Head</small></p>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h5 class="pl-3">Basic Settings</h5>
            <hr class="mb-0" />

            <div class="p-3">
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox1" type="checkbox" checked>
                    <label for="Rcheckbox1">
                        Notifications
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox2" type="checkbox" checked>
                    <label for="Rcheckbox2">
                        API Access
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox3" type="checkbox">
                    <label for="Rcheckbox3">
                        Auto Updates
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox4" type="checkbox" checked>
                    <label for="Rcheckbox4">
                        Online Status
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-0">
                    <input id="Rcheckbox5" type="checkbox" checked>
                    <label for="Rcheckbox5">
                        Auto Payout
                    </label>
                </div>
            </div>

            <!-- Timeline -->
            <hr class="mt-0" />
            <h5 class="px-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
            <hr class="mb-0" />
            <div class="p-3">
                <div class="inbox-widget">
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/user-2.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                        <p class="inbox-item-text">I've finished it! See you so...</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/user-3.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                        <p class="inbox-item-text">This theme is awesome!</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/user-4.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                        <p class="inbox-item-text">Nice to meet you</p>
                    </div>

                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/user-5.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                        <p class="inbox-item-text">Hey! there I'm available...</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/user-6.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Adhamdannaway</a></p>
                        <p class="inbox-item-text">This theme is awesome!</p>
                    </div>
                </div> <!-- end inbox-widget -->
            </div> <!-- end .p-3-->

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Plugins js-->
    <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
    <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.time.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.selection.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.crosshair.js"></script>

    <!-- Dashboar 1 init js-->
    <script src="assets/js/pages/dashboard-1.init.js"></script>

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

</body>

</html>