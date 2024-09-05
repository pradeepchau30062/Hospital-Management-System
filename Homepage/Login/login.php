<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="/Hospital-PHP/backend/admin/assets/images/favicon.ico">
    <title>Ecare-Login page</title>
    <style>
        body {
            background-color: white;
        }

        .body a {

            color: rgb(6, 72, 53);
        }

        @keyframes description {
            0% {
                color: red;
            }

            25% {
                color: blue;
            }

            50% {
                color: green;
            }

            75% {
                color: Grey;
            }

            100% {
                color: red;
            }
        }

        .description {
            animation: description 3s infinite;
        }
    </style>
</head>

<body>
    <div class="login_head">
        <div class="login_image">
        </div>
        <div class="login_description">
            <div class="description">
                <h1>Ecare</h1>
            </div>
            <div class="description_1">
                <marquee behavior="" direction="">
                    <h2>Your Ultimate Destination for Health-Care Solutions.</h2>
                </marquee>
            </div>
        </div>
        <div class="login_logo">

        </div>
    </div>
    <div class="logo_nav">
        <div class="logo_navbar">
            <a href="/Hospital-PHP/Homepage/Login/login.php">Home </a>
            <a href="/Hospital-PHP/backend/patient/pat_register.php">Create Account </a>
            <a href="/Hospital-PHP/Homepage/Login/login.php">Manage Account </a>
            <a href="/Hospital-PHP/Homepage/Home/home_minor.php">Help</a>
        </div>
    </div>

    <div class="login_body">

        <div class="login_form">
            <div class="body1">
                <div class="body1_img">

                </div>
                <div class="body1_details">
                    <h1>Ecare Login</h1>
                    <a href="/Hospital-PHP/Homepage/Home/home_minor.php">
                        <h4>Back to home</h4>
                    </a>
                </div>
            </div>
            <div class="body">
                <a href="/Hospital-PHP/backend/admin/admin_login.php">Admin login</a>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="body">
                <a href="/Hospital-PHP/backend/doc/doctor_login.php">Doctor login</a>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="body">
                <a href="/Hospital-PHP/backend/patient/pat_register.php">Pateint login</a>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>
    </div>

    <div class="login_warning">
        <div class="logo_warning_box" style="color: red;">
            <div class="logo_warning_box1">
                <h1>!!! Warning !!!</h1>
            </div>
            <div class="logo_warning_box2">
                <h3>
                    Doctor must have their own ID and password
                    Patient have to first Register their personal details and email
                </h3>
            </div>

        </div>

    </div>
  

</body>

</html>