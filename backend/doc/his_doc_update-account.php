<?php
session_start();
include('assets/inc/config.php');
if (isset($_POST['update_profile'])) {
    $doc_fname = $_POST['doc_fname'];
    $doc_lname = $_POST['doc_lname'];
    $doc_id = $_SESSION['doc_id'];
    $doc_email = $_POST['doc_email'];

    $doc_dpic = $_FILES["doc_dpic"]["name"];
    move_uploaded_file($_FILES["doc_dpic"]["tmp_name"], "assets/images/users/" . $_FILES["doc_dpic"]["name"]);

    // SQL to update profile
    $query = "UPDATE his_docs SET doc_fname=?, doc_lname=?, doc_email=?, doc_dpic=? WHERE doc_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssssi', $doc_fname, $doc_lname, $doc_email, $doc_dpic, $doc_id);
    $stmt->execute();

    if ($stmt) {
        $success = "Profile Updated";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}

// Change Password
if (isset($_POST['update_pwd'])) {
    $doc_number = $_SESSION['doc_number'];
    $old_pwd = sha1(md5($_POST['old_pwd']));
    $new_pwd = sha1(md5($_POST['new_pwd']));
    $confirm_password = sha1(md5($_POST['confirm_password']));

    // Verify the old password
    $query = "SELECT doc_pwd FROM his_docs WHERE doc_number=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $doc_number);
    $stmt->execute();
    $stmt->bind_result($db_old_pwd);
    $stmt->fetch();
    $stmt->close();

    if ($db_old_pwd === $old_pwd) {
        if ($new_pwd === $confirm_password) {
            // SQL to update password
            $query = "UPDATE his_docs SET doc_pwd=? WHERE doc_number=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ss', $new_pwd, $doc_number);
            $update_password_run = $stmt->execute();
            if ($update_password_run) {
                $success = "Successfully !!! Password Updated";
            } else {
                $err = "Please Try Again Or Try Later";
            }
        } else {
            $err = "New password and confirm password do not match";
        }
    } else {
        $err = "Old password is incorrect";
    }
}
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
        <?php include('assets/inc/sidebar.php'); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <?php
        $doc_id = $_SESSION['doc_id'];
        $ret = "SELECT * FROM  his_docs where doc_id=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $doc_id);
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $row->doc_fname; ?> <?php echo $row->doc_lname; ?>'s Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="../doc/assets/images/users/<?php echo $row->doc_dpic; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">


                                    <div class="text-centre mt-3">

                                        <p class="text-muted mb-2 font-13"><strong>Doctor Full Name :</strong> <span class="ml-2"><?php echo $row->doc_fname; ?> <?php echo $row->doc_lname; ?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Doctor Department :</strong> <span class="ml-2"><?php echo $row->doc_dept; ?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Doctor Number :</strong> <span class="ml-2"><?php echo $row->doc_number; ?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Doctor Email :</strong> <span class="ml-2"><?php echo $row->doc_email; ?></span></p>


                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col-->

                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                Update Profile
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Change Password
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="aboutme">

                                            <form method="post" enctype="multipart/form-data">
                                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">First Name</label>
                                                            <input type="text" name="doc_fname" class="form-control" id="firstname" value="<?php echo $row->doc_fname; ?>" placeholder="Enter your First name.">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname">Last Name</label>
                                                            <input type="text" name="doc_lname" class="form-control" id="lastname" value="<?php echo $row->doc_lname; ?>" placeholder="Enter your last name.">
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="useremail">Email Address</label>
                                                            <input type="email" name="doc_email" class="form-control" id="useremail" value="<?php echo $row->doc_email; ?>" placeholder="Enter your email address.">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="useremail">Profile Picture</label>
                                                            <input type="file" name="doc_dpic" class="form-control btn btn-success" id="useremail">
                                                        </div>
                                                    </div>

                                                </div> <!-- end row -->


                                                <div class="text-right">
                                                    <button type="submit" name="update_profile" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                                </div>
                                            </form>


                                        </div> <!-- end tab-pane -->
                                        <!-- end about me section content -->



                                        <div class="tab-pane" id="settings">
                                            <form method="post">
                                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                                                <div class="form-group">
                                                        <label for="useremail">old Password</label>
                                                        <input type="password" class="form-control" id="useremail" name= "old_pwd" placeholder="Enter your old password">
                                                    </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="lastname">New Password</label>
                                                        <input type="password" class="form-control" name="new_pwd" id="lastname" placeholder="Enter New Password">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="useremail">Confirm Password</label>
                                                        <input type="password" class="form-control" id="useremail" placeholder="Confirm New Password" name="confirm_password">
                                                    </div>

                                                    <!-- end col -->
                                                </div> <!-- end row -->



                                                <div class="text-right">
                                                    <button type="submit" name="update_pwd" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update Password</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end settings content-->

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include("assets/inc/footer.php"); ?>
                <!-- end Footer -->

            </div>
        <?php } ?>
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