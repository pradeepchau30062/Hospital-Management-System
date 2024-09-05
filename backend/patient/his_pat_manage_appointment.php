<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();

if (!isset($_SESSION['pat_number'])) {
    $_SESSION['status'] = "Session expired. Please log in again.";
    header("Location: pat_login.php");
    exit();
}

$pat_number = $_SESSION['pat_number'];

$query = "SELECT appointment_id, doc_number, doc_fname,doc_lname, appointment_date, appointment_time, status FROM Appointments WHERE pat_number = ? AND status = 'Pending' ";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $pat_number);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php'); ?>

<body>

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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">My appointment</a></li>
                                        <li class="breadcrumb-item active">Manage Appointment</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Manage Appointments</h4>
                            </div>
                        </div>
                    </div>
                    
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-success" id="action-message">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                        <script>
                            setTimeout(function() {
                                var message = document.getElementById('action-message');
                                if (message) {
                                    message.style.display = 'none';
                                }
                            }, 2000); // 2000 milliseconds = 2 seconds
                        </script>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title">Scheduled Appointments</h4>
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
                                                <th data-toggle="true">Doctor Number</th>
                                                <th data-hide="phone">Doctor Name</th>
                                                <th data-hide="phone">Appointment Date</th>
                                                <th data-hide="phone">Appointment Time</th>
                                                <th data-hide="phone">Status</th>
                                                <th data-hide="phone">Action</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $serialNumber = 1; // Initialize the serial number counter
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $serialNumber . "</td>"; // Add the serial number column
                                                echo "<td>" . htmlspecialchars($row['doc_number']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['doc_fname'] . ' ' . $row['doc_lname']) . "</td>"; // Concatenate doc_fname and doc_lname

                                                echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['appointment_time']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                                echo "<td>";
                                                echo "<a href='his_pat_update_appointment.php?appointment_id=" . htmlspecialchars($row['appointment_id']) . "' class='badge badge-success'><i class='mdi mdi-check-box-outline'></i> Update</a> ";
                                                echo "<a href='appointment_action.php?action=cancel&appointment_id=" . htmlspecialchars($row['appointment_id']) . "' class='badge badge-danger'><i class='mdi mdi-trash-can-outline'></i> Cancel</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $serialNumber++; // Increment the serial number counter
                                            }
                                            ?>
                                        </tbody>

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include('assets/inc/footer.php'); ?>
    </div>
    </div>

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

<?php
$stmt->close();
$mysqli->close();
?>
