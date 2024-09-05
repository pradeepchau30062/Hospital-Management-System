<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$pat_id = $_SESSION['pat_id'];



?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php'); ?>

<body>

    <?php

    if (isset($_SESSION['transaction_msg'])) {
        echo $_SESSION['transaction_msg'];
        unset($_SESSION['transaction_msg']);
    }

    if (isset($_SESSION['validate_msg'])) {
        echo $_SESSION['validate_msg'];
        unset($_SESSION['validate_msg']);
    }
    ?>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include('assets/inc/nav.php'); ?>
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Payments</a></li>
                                        <li class="breadcrumb-item active">My due Payments</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">My Due Payments</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title"></h4>
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-12 text-sm-center form-inline">
                                            <div class="form-group mr-2" style="display:none">
                                                <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                                    <option value="">Show all</option>
                                                    <option value="Discharged">Discharged</option>
                                                    <option value="OutPatients">OutPatients</option>
                                                    <option value="InPatients">InPatients</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Bill Description</th>
                                                <th data-toggle="true">My Number</th>
                                                <th data-hide="phone">Bill Number</th>
                                                <th data-hide="phone">Hospital Charge</th>
                                                <th data-hide="phone">Total Bill with Tax(13%)</th>
                                                <th data-hide="phone">Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $bill_pat_number = $_SESSION['pat_number'];
                                        $ret = "SELECT  * FROM his_bills WHERE bill_pat_number = ? AND bill_status = 'UNPAID' ";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->bind_param('s', $bill_pat_number);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                           
                                        ?>

                                            <tbody>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row->bill_descr; ?></td>
                                                    <td><?php echo $row->bill_pat_number; ?></td>
                                                    <td><?php echo $row->bill_number; ?></td>
                                                    <td>Rs. <?php echo $row->bill_pat_fee; ?></td>
                                                    <td>Rs. <?php echo $row->bill_tax; ?></td>
                                                    

                                                    <td>
                                                        <form action="payment-request.php" method="POST">
                                                            <div class="hsp" style="display: none;">
                                                                <label for="">Product Details:</label>
                                                                <div class="col-md-6">
                                                                    <label for="inputAmount4" class="form-label">Amount</label>
                                                                    <input type="Amount" class="form-control" id="inputAmount4" name="inputAmount4" value="<?php echo $row->bill_tax; ?>">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="inputPurchasedOrderId4" class="form-label">Purchased Order Id</label>
                                                                    <input type="PurchasedOrderId" class="form-control" id="inputPurchasedOrderId4" name="inputPurchasedOrderId4" value="1">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="inputPurchasedOrderName" class="form-label">Purchased Order Name</label>
                                                                    <input type="text" class="form-control" id="inputPurchasedOrderName" name="inputPurchasedOrderName" value="2">
                                                                </div>
                                                                <label for="">Customer Details:</label>
                                                                <div class="col-12">
                                                                    <label for="inputName" class="form-label">Name</label>
                                                                    <input type="text" class="form-control" id="inputName" name="inputName" value="Ecare Hospital">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="inputEmail" class="form-label">Email</label>
                                                                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" value="teamsecret30062@gmail.com">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="inputPhone" class="form-label">Phone</label>
                                                                    <input type="text" class="form-control" id="inputPhone" name="inputPhone" value="9845808155">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button type="submit" name="submit" class="btn btn-success">Pay with khalti</button>
                                                            </div>
                                                        </form>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        <?php $cnt = $cnt + 1;
                                        } ?>
                                        <tfoot>
                                            <tr class="active">
                                                <td colspan="8">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div> <!-- end .table-responsive-->
                            </div> <!-- end card-box -->
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

    <!-- Footable js -->
    <script src="assets/libs/footable/footable.all.min.js"></script>

    <!-- Init js -->
    <script src="assets/js/pages/foo-tables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>