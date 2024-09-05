<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Sign up </title>
     <style>
             .signup_box{
            margin-top: 240px;
             }
        .signup_signin  {
           background-color: #66dbe3;
        }
        .signup_signin a:hover{
            color: white;
        }
      
       
        .signup_signup a:hover{
            color: black;
        }
       
     </style>
</head>

<body>
    <div class="signup_head">
        <h1>Hospital management system</h1>
        <div class="signup_img">

        </div>
    </div>
    <div class="signup_box_wrapper">
        <div class="signup_box">
            <div class="signup_box_head">

                <div class="signup_box_img">

                </div>
                <div class="signup_box_details">
                    <h2 class="description"> Ecare eAuthentication is using Login to allow you to sign in to your account safely and securely.
                    </h2>
                </div>
            </div>
            <div class="signup_case">
                <div class="signup_signin">
                    <a href="signup.php">
                        <h1>Sign in</h1>
                    </a>
                </div>
                <div class="signup_signup">
                    <a href="register.php">
                        <h1>Create an Account</h1>
                    </a>
                </div>
            </div>
            <div class="login-container">
                <form id="loginForm">
                    <h2>Login</h2>
                    <div class="form-group">
                        <label for="username">Username:</label>
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
    </div>
    <script src="/example/script.js"></script>
</body>

</html>