<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Sign up </title>
    <style>
        .signup_box {
            height: 680px; 
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
                <h2>Doctor login</h2>
                <div class="form-group">
                    <label for="username">Docotor Id:</label>
                    <input type="text" id="username" name="username" required>
                    <small id="usernameError" class="error"></small>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <small id="passwordError" class="error"></small>
                    <ul id="passwordCriteria">
                        <li id="lengthCriteria" class="invalid"> <input type="checkbox">At least 8 characters</li>
                        <li id="uppercaseCriteria" class="invalid"> <input type="checkbox">Contains an uppercase letter</li>
                        <li id="lowercaseCriteria" class="invalid"> <input type="checkbox">Contains a lowercase letter</li>
                    </ul>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="warning">
            <h3>
                ***Users passeord must contain at least 8 characters, at least 1 lowercase and 1 uppercase***
            </h3>

        </div>
        <a href="login.php">
            <h4>Back to login</h4>
        </a>
    </div>
    <script src="/example/script.js"></script>
</body>

</html>