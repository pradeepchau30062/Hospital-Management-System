<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();

// Query to fetch all appointments including doc_lname
$query = "SELECT doc_number, pat_number, pat_fname, pat_lname, doc_fname, doc_lname, appointment_date, appointment_time, status FROM Appointments";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<?php include('assets/inc/head.php'); ?>

<body>
    <div id="wrapper">
        <?php include('assets/inc/nav.php'); ?>
        <?php include('assets/inc/sidebar.php'); ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">View Appointments</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">All Appointments</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
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
                                                <th data-hide="phone">Patient Number</th>
                                                <th data-hide="phone">Patient Name</th>
                                                <th data-hide="phone">Doctor Name</th>
                                                <th data-hide="phone">Appointment Date</th>
                                                <th data-hide="phone">Appointment Time</th>
                                                <th data-hide="phone">Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $serialNumber = 1; // Initialize the serial number counter

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $serialNumber . "</td>"; // Add the serial number column
                                                echo "<td>" . htmlspecialchars($row['doc_number']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['pat_number']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['pat_fname'] . ' ' . $row['pat_lname']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['doc_fname'] . ' ' . $row['doc_lname']) . "</td>"; // Concatenate doc_fname and doc_lname
                                                echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['appointment_time']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
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
                                </div> <!-- end .table-responsive-->
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
            </div>
            <?php include('assets/inc/footer.php'); ?>
             <!-- end Footer -->
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
$mysqli->close();
?>
