<?php
session_start();
include('assets/inc/config.php');

// Check if the doc_email parameter is set
if (!isset($_GET['doc_email'])) {
    die("Email not specified.");
}

$doc_email = $_GET['doc_email'];

// Fetch doc_email from the database to ensure it exists and is correct
$stmt = $mysqli->prepare("SELECT doc_email FROM his_docs WHERE doc_email = ?");
$stmt->bind_param("s", $doc_email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("Email not found in the database.");
}

$stmt->bind_result($fetched_email);
$stmt->fetch();
$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Hospital-PHP/Homepage/Login/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Ecare-OTP FORM</title>
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

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            box-shadow: 0 0 10px black;
        }

        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .otp-box {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .otp-box:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.6);
        }

        .timer {
            color: red;
        }

        .message {
            font-size: 1.5em;
            color: red;
        }

        .button-container {
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        button.expired {
            background-color: #ff0000;
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
            <div class="login-container">
                <form method="POST" action="validate_otp.php">
                    <h2>OTP</h2>
                    <div class="alert">
                        <?php
                        if (isset($_SESSION['status'])) {
                            echo "<h4>" . $_SESSION['status'] . "</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="emailaddress">Email address:</label>
                        <input type="text" id="emailaddress" name="doc_email" value="<?php echo htmlspecialchars($fetched_email); ?>" readonly required>
                    </div>
                    <div class="otp-inputs">
                        <input type="text" maxlength="1" class="otp-box" name="otp[]" required>
                        <input type="text" maxlength="1" class="otp-box" name="otp[]" required>
                        <input type="text" maxlength="1" class="otp-box" name="otp[]" required>
                        <input type="text" maxlength="1" class="otp-box" name="otp[]" required>
                    </div>
                    <div class="button-container" id="buttonContainer">
                        <button id="sendButton" type="submit" name="valid_click">VERIFY OTP</button>
                    </div>
                    <div class="col-12-text-center">
                        <p><a href="password_reset_again.php?doc_email=<?php echo urlencode($fetched_email); ?>" class="text-white-50-ml-1">Don't get OTP, send again</a></p>
                    </div>
                </form>
            </div>
            <a href="/Hospital-PHP/Homepage/Login/login.php">
                <h4>Back to login</h4>
            </a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const otpInputs = document.querySelectorAll('.otp-box');
            otpInputs.forEach((input) => {
                input.addEventListener('input', () => {
                    if (input.value && input.nextElementSibling) {
                        input.nextElementSibling.focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !input.value && input.previousElementSibling) {
                        input.previousElementSibling.focus();
                    }
                });
            });
        });
    </script>
    <script src="/patient/index.js"></script>
</body>
</html>
