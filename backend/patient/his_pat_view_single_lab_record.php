<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();

  if (!isset($_SESSION['pat_number'])) {
    // Handle the case where patient number is not set
    $_SESSION['status'] = "Session expired. Please log in again.";
    header("Location: pat_login.php");
    exit();
}
  
  // Get the session variables
  
  $pat_number = $_SESSION['pat_number'];
  
?>
<!DOCTYPE html>
<html lang="en">
    
<?php include ('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <?php
                if (isset($_GET['lab_number']) && isset($_GET['lab_id'])) {
                    $lab_number = $_GET['lab_number'];
                    $lab_id = $_GET['lab_id'];
                
                    // Query to check if the current logged-in patient's email and number match
                    $check_query = "
                        SELECT * FROM his_patients 
                        WHERE pat_email = ? AND pat_number = ? AND pat_number = (
                            SELECT lab_pat_number FROM his_laboratory WHERE lab_id = ?
                        )";
                    $stmt_check = $mysqli->prepare($check_query);
                    $stmt_check->bind_param('ssi', $pat_email, $pat_number, $lab_id);
                    $stmt_check->execute();
                    $res_check = $stmt_check->get_result();

                    if ($res_check->num_rows > 0) {
                        // If a matching record is found, fetch the lab details
                        $ret = "SELECT * FROM his_laboratory WHERE lab_id = ?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $lab_id);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        
                        while ($row = $res->fetch_object()) {
                            $mysqlDateTime = $row->lab_date_rec;
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
                                                <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Laboratory Records</a></li>
                                                <li class="breadcrumb-item active">View Records</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">#<?php echo $row->lab_number;?></h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title --> 

                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-xl-5">

                                                <div class="tab-content pt-0">

                                                    <div class="tab-pane active show" id="product-1-item">
                                                        <img src="assets/images/medical_record.png" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </div>
                            
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-xl-7">
                                                <div class="pl-xl-3 mt-3 mt-xl-0">
                                                    <h2 class="mb-3">Patient's Name : <?php echo $row->lab_pat_name;?></h2>
                                                    <hr>
                                                    <h3 class="text-danger ">Patient Number : <?php echo $row->lab_pat_number;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Patient Ailment : <?php echo $row->lab_pat_ailment;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Date Recorded : <?php echo date("d/m/Y - h:m:s", strtotime($mysqlDateTime));?></h3>
                                                    <hr>
                                                    <h2 class="align-centre">Laboratory Test</h2>
                                                    <hr>
                                                    <p class="text-muted mb-4">
                                                        <?php echo $row->lab_pat_tests;?>
                                                    </p>
                                                    <hr>
                                                    <h2 class="align-centre">Laboratory Result</h2>
                                                    <p class="text-muted mb-4">
                                                        <?php echo $row->lab_pat_results;?>
                                                    </p>
                                                    <hr>
                                                  
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                       

                                    </div> <!-- end card-->
                                </div> <!-- end col-->
                            </div>
                            <!-- end row-->
                            
                        </div> <!-- container -->

                    </div> <!-- content -->

                    <!-- Footer Start -->
                        <?php include('assets/inc/footer.php');?>
                    <!-- end Footer -->

                </div>
            <?php 
                        }
                    } else {
                        echo "<p>No matching records found or you do not have access to this record.</p>";
                    }
                } else {
                    echo "<p>Invalid request.</p>";
                }
            ?>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>
