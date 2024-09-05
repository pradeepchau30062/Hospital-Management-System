<?php
session_start();
include('assets/inc/config.php'); //get configuration file

if (isset($_POST['update_password'])) {
    $doc_email = $_POST['doc_email'];
    $doc_pwd = sha1(md5($_POST['doc_pwd']));
    $confirm_password = sha1(md5($_POST['confirm_password']));

    // Check if doc_email exists using prepared statement
    $check_email_query = "SELECT doc_email FROM his_docs WHERE doc_email = ? LIMIT 1";
    $stmt = $mysqli->prepare($check_email_query);
    $stmt->bind_param('s', $doc_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        if ($doc_pwd == $confirm_password) {
            // Update the password in the database using prepared statement
            $update_password_query = "UPDATE his_docs SET doc_pwd=? WHERE doc_email=? LIMIT 1";
            $stmt_update = $mysqli->prepare($update_password_query);
            $stmt_update->bind_param('ss', $doc_pwd, $doc_email);
            $update_password_run = $stmt_update->execute();

            if ($update_password_run) {
                $_SESSION['status'] = "New password successfully updated.";
                header("Location: doctor_login.php");
                exit();
            } else {
                $_SESSION['status'] = "Something went wrong. Please try again.";
                header("Location: doc_password_update.php?doc_email=$doc_email");
                exit();
            }
        } else {
            $_SESSION['status'] = "Passwords do not match.";
            header("Location: doc_password_update.php?doc_email=$doc_email");
            exit();
        }
    } else {
        $_SESSION['status'] = "Email not found.";
        header("Location: doc_password_update.php?doc_email=$doc_email");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Hospital-PHP/Homepage/Login/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Ecare-Update Password</title>
    <style>
        .signup_box a {
            margin-top: 20px;
        }

        .col-12-text-center p a {
            color: red;
        }

        .col-12-text-center {
            text-align: center;
        }
        .valid {
            color: green;
        }

        .invalid {
            color: red;
        }

        .error {
            color: red;
            display: none;
        }

        button[disabled] {
            background-color: grey;
            cursor: not-allowed;
        }
    </style>

</head>

<body>
    <div class="signup_head">
        <h1>Hospital Management System</h1>
        <div class="signup_img">
        </div>
    </div>
    <div class="signup_box_wrapper">
        <div class="signup_box">
            <div class="signup_box_head">
                <div class="signup_box_img">
                </div>
                <div class="signup_box_details">
                    <h2 class="description">Ecare eAuthentication is using Login to allow you to sign in to your account safely and securely.</h2>
                </div>
            </div>
            <div class="login-container">
                <form method="POST">
                    <h2>Update your password</h2>
                    <div class="alert">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo "<h4>" . $_SESSION['status'] . "</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="doc_email">Email address:</label>
                        <input style="background-color: #bdded4;" type="text" id="doc_email" name="doc_email" value="<?php if(isset($_GET['doc_email'])){echo htmlspecialchars($_GET['doc_email']);}?>" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="doc_pwd">New Password:</label>
                        <input type="password" id="doc_pwd" name="doc_pwd" placeholder="Enter your new password" required>
                        <small id="passwordError" class="error"></small>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                        <small id="passwordError" class="error"></small>
                        <ul id="passwordCriteria">
                            <li id="lengthCriteria" class="invalid"><input type="checkbox" disabled>At least 8 characters</li>
                            <li id="uppercaseCriteria" class="invalid"><input type="checkbox" disabled>Contains an uppercase letter</li>
                            <li id="lowercaseCriteria" class="invalid"><input type="checkbox" disabled>Contains a lowercase letter</li>
                        </ul>
                    </div>
                    <button type="submit" name="update_password" id="registerButton">Update your password</button>
                    <div class="col-12-text-center">
                        <p><a href="doctor_login.php" class="text-white-50-ml-1">Back to login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const password = document.getElementById('doc_pwd');
            const confirmPassword = document.getElementById('confirm_password');
            const registerButton = document.getElementById('registerButton');
            const lengthCriteria = document.getElementById('lengthCriteria');
            const uppercaseCriteria = document.getElementById('uppercaseCriteria');
            const lowercaseCriteria = document.getElementById('lowercaseCriteria');

            function validatePassword() {
                let valid = true;

                // Check length
                if (password.value.length >= 8) {
                    lengthCriteria.querySelector('input').checked = true;
                    lengthCriteria.classList.remove('invalid');
                    lengthCriteria.classList.add('valid');
                } else {
                    lengthCriteria.querySelector('input').checked = false;
                    lengthCriteria.classList.remove('valid');
                    lengthCriteria.classList.add('invalid');
                    valid = false;
                }

                // Check uppercase letter
                if (/[A-Z]/.test(password.value)) {
                    uppercaseCriteria.querySelector('input').checked = true;
                    uppercaseCriteria.classList.remove('invalid');
                    uppercaseCriteria.classList.add('valid');
                } else {
                    uppercaseCriteria.querySelector('input').checked = false;
                    uppercaseCriteria.classList.remove('valid');
                    uppercaseCriteria.classList.add('invalid');
                    valid = false;
                }

                // Check lowercase letter
                if (/[a-z]/.test(password.value)) {
                    lowercaseCriteria.querySelector('input').checked = true;
                    lowercaseCriteria.classList.remove('invalid');
                    lowercaseCriteria.classList.add('valid');
                } else {
                    lowercaseCriteria.querySelector('input').checked = false;
                    lowercaseCriteria.classList.remove('valid');
                    lowercaseCriteria.classList.add('invalid');
                    valid = false;
                }

                registerButton.disabled = !valid;
            }

            function checkPasswordMatch() {
                const passwordError = document.getElementById('passwordError');
                if (password.value !== confirmPassword.value) {
                    passwordError.textContent = 'Passwords do not match.';
                    passwordError.style.display = 'block';
                    registerButton.disabled = true;
                } else {
                    passwordError.style.display = 'none';
                    registerButton.disabled = false;
                }
            }

            password.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', checkPasswordMatch);
        });
    </script>
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    <script src="/patient/index.js"></script>
</body>

</html>
