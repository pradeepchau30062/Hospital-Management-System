<?php
session_start();
include('assets/inc/config.php'); // Get configuration file

// Function to handle file upload
function uploadProfilePicture($file) {
    $target_dir = "uploads/";
    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Use basename() function to avoid directory traversal attacks
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (500KB limit)
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}

// Process the form data
if (isset($_POST['admin_register'])) {
    $ad_fname = $_POST['ad_fname'];
    $ad_lname = $_POST['ad_lname'];
    $ad_email = $_POST['ad_email'];
    $ad_pwd = sha1(md5($_POST['ad_pwd'])); // Double encrypt to increase security
    $ad_dpic = uploadProfilePicture($_FILES["ad_dpic"]);

    // Validate form data
    if (!empty($ad_fname) && !empty($ad_lname) && !empty($ad_email) && !empty($ad_pwd) && $ad_dpic) {
        // Check if user already exists
        $stmt = $mysqli->prepare("SELECT ad_email FROM his_admin WHERE ad_email = ?");
        $stmt->bind_param('s', $ad_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "User already exists!";
        } else {
            // Prepare SQL statement to insert new user
            $stmt = $mysqli->prepare("INSERT INTO his_admin (ad_fname, ad_lname, ad_email, ad_pwd, ad_dpic) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $ad_fname, $ad_lname, $ad_email, $ad_pwd, $ad_dpic);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Registration successful!";
                header("location:admin_login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        // Close statement
        $stmt->close();
    } else {
        echo "All fields are required!";
    }
}

// Close connection
$mysqli->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post" enctype="multipart/form-data">
   
        <label for="ad_fname">First Name:</label><br>
        <input type="text" id="ad_fname" name="ad_fname" required><br><br>
        <label for="ad_lname">Last Name:</label><br>
        <input type="text" id="ad_lname" name="ad_lname" required><br><br>
        <label for="ad_email">Email:</label><br>
        <input type="email" id="ad_email" name="ad_email" required><br><br>
        <label for="ad_pwd">Password:</label><br>
        <input type="password" id="ad_pwd" name="ad_pwd" required><br><br>
        <label for="ad_dpic">Profile Picture:</label><br>
        <input type="file" id="ad_dpic" name="ad_dpic" required><br><br>
        <input type="submit" name="admin_register" value="Register">
    </form>
</body>
</html>

