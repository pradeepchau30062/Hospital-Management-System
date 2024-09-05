<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $pat_id=$_SESSION['pat_id'];
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include("assets/inc/nav.php");?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include ('assets/inc/sidebar.php');?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <?php
                $bill_number = $_GET['bill_number'];
                $ret="SELECT  * FROM his_bills WHERE bill_number = ?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$bill_number);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                $cnt=1;
                while($row=$res->fetch_object())
                {
                    $mysqlDateTime = $row->bill_date_generated;//trim timestamp to DD/MM/YYYY formart

                    //calculate bill total bill after 16% taxation
                    $tax = 13/100;
                    $bill = $row->bill_pat_fee;
                    $total_bill = $tax*$bill;
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
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Bills</a></li>
                                                <li class="breadcrumb-item active"> Bills Status</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Bills</h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title --> 

                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <!-- Logo & title -->
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <img src="assets/images/abc.png" alt="" height="20">
                                            </div>
                                            <div class="float-right">
                                            <h4 class="m-0 d-print-none">Patient Name  : <?php echo $row->bill_pat_name;?> </h4>
                                            </div>
                                        </div>
            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <p><b></b></p>
                                                    <p class="text-muted"></p>
                                                </div>
            
                                            </div><!-- end col -->
                                            <div class="col-md-4 offset-md-2">
                                            <div class="mt-3 float-right">
                                                    <p class="m-b-10"><strong>Generated Date : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo date("d-m-Y - h:m:s", strtotime($mysqlDateTime));?> </span></p>
                                                    <p class="m-b-10"><strong>Bill Status : </strong> <span class="float-right"><span class="badge badge-success"><?php echo $row->bill_status;?></span></span></p>
                                                    <p class="m-b-10"><strong>Bill Number. : </strong> <span class="float-right"><?php echo $row->bill_number;?></span></p>
                                                    <p class="m-b-10"><strong>Patient Number. : </strong> <span class="float-right"><?php echo $row->bill_pat_number;?></span></p>

                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->
            
                                       
                                        <!-- end row -->
            
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table mt-4 table-centered table-bordered">
                                                        <thead>
                                                        <tr><th style="width: 5%">#</th>
                                                            <th>Description</th>
                                                            <th style="width: 10%">Bill</th>
                                                            <th style="width: 10%">(PAYE)Tax Rate</th>
                                                            <th style="width: 10%" class="text-right">Total Tax</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><?php echo $cnt;?></td>
                                                           <td>
                                                           <?php echo $row->bill_descr;?>

                                                                </td>
                                                                <?php
                                                                    $bill_number = $_GET['bill_number'];
                                                                    $ret="SELECT  * FROM his_bills WHERE bill_number = ?";
                                                                    $stmt= $mysqli->prepare($ret) ;
                                                                    $stmt->bind_param('s',$bill_number);
                                                                    $stmt->execute() ;//ok
                                                                    $res=$stmt->get_result();
                                                                    $cnt=1;
                                                                    while($row=$res->fetch_object())
                                                                    {
                                                                        $mysqlDateTime = $row->bill_date_generated;//trim timestamp to DD/MM/YYYY formart

                                                                        //calculate bill total bill after 16% taxation
                                                                        $tax = 13/100;
                                                                        $bill = $row->bill_pat_fee;
                                                                        $taxable_bill = $tax*$bill;

                                                                        //get total bill after tax reduction
                                                                        $total_bill = $bill + $taxable_bill;
                                                                ?>
                                                            <td>Rs. <?php echo $row->bill_pat_fee;?></td>
                                                            <td>13%</td>
                                                            
                                                            <td class="text-right">Rs. <?php echo $taxable_bill;?></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive -->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
            
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="clearfix pt-5">
                                                    <h6 class="text-muted">Remarks:</h6>
            
                                                    <small class="text-muted">
                                                        
                                                    </small>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="float-right">
                                                    <p><b>Sub-total:</b> <span class="float-right">Rs. <?php echo $row->bill_pat_fee;?></span></p>
                                                    <p><b>PAYE Tax (13%) :</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; <?php echo $taxable_bill;?> </span></p>
                                               <h3>  Rs. <?php echo $total_bill;?></h3>
                                                   
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
            
                                        <div class="mt-4 mb-1">
                                            <div class="text-right d-print-none">
                                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Print</a>
                                            </div>
                                        </div>
                                    </div> <!-- end card-box -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row --> 
                            
                        </div> <!-- container -->

                    </div> <!-- content -->

                    <!-- Footer Start -->
                        <?php include ("assets/inc/footer.php");?>
                    <!-- end Footer -->

                </div>
            <?php $cnt =  $cnt + 1 ; }}?>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>