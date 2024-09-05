<?php
session_start();
include('assets/inc/config.php'); // Get configuration file

if (isset($_POST['add_patient'])) {
    $pat_fname = $_POST['pat_fname'];
    $pat_lname = $_POST['pat_lname'];
    $pat_number = $_POST['pat_number'];
    $pat_phone = $_POST['pat_phone'];
    $pat_type = $_POST['pat_type'];
    $pat_addr = $_POST['pat_addr'];
    $pat_age = $_POST['pat_age'];
    $pat_dob = $_POST['pat_dob'];
    $pat_ailment = $_POST['pat_ailment'];
    $pat_email = $_POST['pat_email'];
    $pat_pwd = sha1(md5($_POST['pat_pwd']));
    $pat_cpwd = sha1(md5($_POST['pat_cpwd']));

    // Check if the email already exists
    $check_email_query = "SELECT pat_email FROM his_patients WHERE pat_email = ?";
    $stmt = $mysqli->prepare($check_email_query);
    $stmt->bind_param('s', $pat_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        if ($pat_pwd == $pat_cpwd) {
            // SQL to insert captured values
            $query = "INSERT INTO his_patients (pat_fname, pat_ailment, pat_lname, pat_age, pat_dob, pat_number, pat_phone, pat_type, pat_addr, pat_email, pat_pwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('sssssssssss', $pat_fname, $pat_ailment, $pat_lname, $pat_age, $pat_dob, $pat_number, $pat_phone, $pat_type, $pat_addr, $pat_email, $pat_pwd);
            $stmt->execute();

            if ($stmt) {
                $_SESSION['status'] = "Register Successfully.";
                header("Location: pat_login.php");
            } else {
                $_SESSION['status'] = "Something went wrong!!";
            }
        } else {
            $_SESSION['status'] = "Passwords and confirm password do not match.";
        }
    } else {
        $_SESSION['status'] = "Email already exists.";
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
    <title>Ecare-Patient Registration</title>
    <style>
        .signup_box {
            margin-top: 600px;
        }

        .signup_signup {
            background-color: #66dbe3;
        }

        .signup_signup a:hover {
            color: white;
        }

        .signup_signin a:hover {
            color: black;
        }

        .form-group_1 {
            display: flex;
            justify-content: space-between;
        }

        .form-group_1 .form-group {
            width: 48%;
        }

        select {
            width: 96%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="date"] {
            width: 96%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        <h1>Hospital management system</h1>
        <div class="signup_img"></div>
    </div>
    <div class="signup_box_wrapper">
        <div class="signup_box">
            <div class="signup_box_head">
                <div class="signup_box_img"></div>
                <div class="signup_box_details">
                    <h2 class="description">Ecare eAuthentication is using Login to allow you to sign in to your account safely and securely.</h2>
                </div>
            </div>
            <div class="signup_case">
                <div class="signup_signin">
                    <a href="/Hospital-PHP/backend/patient/pat_login.php">
                        <h1>Sign in</h1>
                    </a>
                </div>
                <div class="signup_signup">
                    <a href="/Hospital-PHP/backend/patient/pat_register.php">
                        <h1>Create an Account</h1>
                    </a>
                </div>
            </div>
            <div class="login-container">
                <form id="loginForm" method="post" onsubmit="return validateTime()">
                    <h2>Registration Form</h2>
                    <div class="alert">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo "<h4>" . $_SESSION['status'] . "</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="form-group_1">
                        <div class="form-group">
                            <label for="pat_fname">First name:</label>
                            <input type="text" id="pat_fname" name="pat_fname" placeholder="Enter your First name" required>
                            <small id="fnameError" class="error"></small>
                        </div>
                        <div class="form-group">
                            <label for="pat_lname">Last name:</label>
                            <input type="text" id="pat_lname" name="pat_lname" placeholder="Enter your Last name" required>
                            <small id="lnameError" class="error"></small>
                        </div>
                    </div>
                    <div class="form-group_1">
                        <div class="form-group col-md-6">
                            <label for="inputDob" class="col-form-label">Date Of Birth</label>
                            <input type="date" required name="pat_dob" class="form-control" id="inputDob" placeholder="DD/MM/YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAge" class="col-form-label">Age</label>
                            <input required type="text" name="pat_age" class="form-control" id="inputAge" placeholder="Patient's Age" readonly>
                        </div>

                        <script type="text/javascript">
                            function validateAge() {
                                var ageInput = document.getElementById("pat_age");
                                ageInput.addEventListener("input", function() {
                                    var value = parseInt(this.value);
                                    if (isNaN(value) || value <= 0) {
                                        this.setCustomValidity("Please enter a valid Age.");
                                    } else {
                                        this.setCustomValidity("");
                                    }
                                });
                            }

                            document.addEventListener('DOMContentLoaded', validateAge);
                        </script>

                    </div>
                    <div class="form-group_1">
                        <div class="form-group">
                            <label for="pat_addr">Patient Address:</label>
                            <input type="text" id="pat_addr" name="pat_addr" placeholder="Enter your Address" required>
                            <small id="addrError" class="error"></small>
                        </div>
                        <div class="form-group">
                            <label for="pat_phone">Mobile number:</label>
                            <input type="text" id="pat_phone" name="pat_phone" placeholder="Enter your mobile Number" required>
                            <small id="phoneError" class="error"></small>
                            <script type="text/javascript">
                                function validateMobileNumber() {
                                    var mobileInput = document.getElementById("pat_phone");
                                    mobileInput.addEventListener("input", function() {
                                        var value = this.value;
                                        if (!/^\d{10}$/.test(value)) {
                                            this.setCustomValidity("Please enter a 10-digit Mobile number.");
                                        } else {
                                            this.setCustomValidity("");
                                        }
                                    });
                                }

                                window.onload = validateMobileNumber;
                            </script>
                        </div>
                    </div>
                    <div class="form-group_1">
                        <div class="form-group">
                            <label for="pat_ailment">Patient Ailment:</label>
                            <input type="text" id="pat_ailment" name="pat_ailment" placeholder="Your Ailment" required>
                            <small id="ailmentError" class="error"></small>
                        </div>
                        <div class="form-group">
                            <label for="pat_type">Patient Type:</label>
                            <select id="pat_type" name="pat_type" class="form-control" required>
                                <option value="">Choose</option>
                                <option value="InPatient">InPatient</option>
                                <option value="OutPatient">OutPatient</option>
                            </select>
                            <small id="typeError" class="error"></small>
                        </div>
                    </div>
                    <div class="form-group" style="display:none">
                        <?php
                        $length = 5;
                        $min = pow(10, $length - 1); // 10000 for a 5-digit number
                        $max = pow(10, $length) - 1; // 99999 for a 5-digit number
                        $patient_number = random_int($min, $max);
                        ?>
                        <label for="inputZip" class="col-form-label">Patient Number</label>
                        <input type="text" name="pat_number" value="<?php echo $patient_number; ?>" class="form-control" id="inputZip">
                    </div>
                    <div class="form-group">
                        <label for="pat_email">Email:</label>
                        <input type="email" id="pat_email" name="pat_email" placeholder="Enter your Email address" required>
                        <small id="emailError" class="error"></small>
                    </div>
                    <div class="form-group">
                        <label for="pat_pwd">Password:</label>
                        <input type="password" id="pat_pwd" name="pat_pwd" placeholder="Enter your password" required>
                        <small id="passwordError" class="error"></small>
                    </div>
                    <div class="form-group">
                        <label for="pat_cpwd">Confirm Password:</label>
                        <input type="password" id="pat_cpwd" name="pat_cpwd" placeholder="Confirm your password" required>
                        <small id="confirmPasswordError" class="error"></small>
                        <ul id="passwordCriteria">
                            <li id="lengthCriteria" class="invalid"><input type="checkbox" disabled>At least 8 characters</li>
                            <li id="uppercaseCriteria" class="invalid"><input type="checkbox" disabled>Contains an uppercase letter</li>
                            <li id="lowercaseCriteria" class="invalid"><input type="checkbox" disabled>Contains a lowercase letter</li>
                        </ul>
                    </div>
                    <button type="submit" name="add_patient" id="registerButton">Register Account</button>
                </form>
            </div>
            <div class="warning">
                <h3>
                    ***Users password must contain at least 8 characters, at least 1 lowercase and 1 uppercase***
                </h3>
            </div>
            <a href="/Hospital-PHP/Homepage/Login/login.php">
                <h4>Back to login</h4>
            </a>
        </div>
    </div>
    <script src="/patient/index.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('pat_pwd');
            const confirmPassword = document.getElementById('pat_cpwd');
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
                const passwordError = document.getElementById('confirmPasswordError');
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
     <script>
        function validateTime() {
            var timeInput = document.getElementById('inputTime').value;
            var timeError = document.getElementById('timeError');
            var time = new Date('1970-01-01T' + timeInput + 'Z');
            var minTime = new Date('1970-01-01T10:00:00Z');
            var maxTime = new Date('1970-01-01T17:00:00Z');

            if (time < minTime || time > maxTime) {
                timeError.style.display = 'block';
                return false;
            } else {
                timeError.style.display = 'none';
                return true;
            }
        }

        function setMaxDate() {
            var today = new Date();
            var yyyy = today.getFullYear();
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            var dd = String(today.getDate()).padStart(2, '0');
            var maxDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById('inputDob').setAttribute('max', maxDate);
        }

        function calculateAge() {
            var dob = new Date(document.getElementById('inputDob').value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            document.getElementById('inputAge').value = age;
        }

        window.onload = function() {
            setMaxDate();
            document.getElementById('inputDob').addEventListener('change', calculateAge);
        };
    </script>
</body>

</html>