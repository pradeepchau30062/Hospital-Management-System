<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Sign up </title>
    <style>
        .signup_box {
            height: 580px; 
        }
        .signup_box a{
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="signup_head">
        <h1>Hospital management system</h1>
        <div class="signup_img">

        </div>
    </div>

    <div class="signup_box">
        <div class="signup_box_head">

            <div class="signup_box_img">

            </div>
            <div class="signup_box_details">
                <h2> Ecare eAuthentication is using Login to allow you to sign in to your account safely and securely.
                </h2>
            </div>
        </div>

        <div class="login-container">
            <form id="loginForm">
                <h2>Admin login</h2>
                <div class="form-group">
                    <label for="username">Admin user_id:</label>
                    <input type="text" id="username" name="username" required>
                    <small id="usernameError" class="error"></small>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <small id="passwordError" class="error"></small>
                    
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
       
        <a href="login.php">
            <h4>Back to login</h4>
        </a>
    </div>

</body>

</html>