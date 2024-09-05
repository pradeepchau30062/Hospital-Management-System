<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link rel="stylesheet" href="home_minor.css">
   <link rel="stylesheet" href="home1_minor.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
   <title>Ecare-Home</title>
   <style>
     
      * {
         padding: 0px;
         margin: 0px;
         box-sizing: border-box;
      }

      .header {
         position: fixed;
         width: 100%;
         top: 0;
         left: 0;
         z-index: 1000;
      }

      .header .header-2 {
         display: flex;
         align-items: center;
         justify-content: space-between;
         padding: 2rem;
         background: linear-gradient(135deg, #1d9e93 12%, #1054a6 100%);
         max-width: 100%;
         margin: 0 auto;

      }
       
      .header .header-2 .navbar{
         display: flex;
         justify-content: space-evenly;
      }
      .header .header-2 .navbar a {
         color: white;
         margin-right: 6rem;
         font-size: 2rem;
         font-family: "Times New Roman", Times, serif;
      }

      .header .header-2 .navbar a:hover {
          text-decoration: underline;
      }

      .header .header-1 {
         background-color: #2582A154;
      }

      .header .header-2 .icons {
         display: none;
      }

      .navbar {
         display: flex;
      }
      .header-2 .logo {
        display: block;
        width: 150px;
        height: 20px;
        background-image: url('/Hospital-PHP/Homepage/Login/abc.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
   
    }

      @media (max-width: 768px) {
         .header .header-2 {
            flex-direction: column;
            align-items: flex-start;
         }

         .header .header-2 .navbar {
            display: none;
            flex-direction: column;
            width: 100%;
         }

         .header .header-2 .navbar a {
            margin: 10px 0;
         }

         .header .header-2 .icons {
            display: block;
            cursor: pointer;
            font-size: 1.5rem;
            color: white;
         }

         .header .header-2 .navbar.active {
            display: flex;
         }
      }
   </style>
</head>

<body>

   <header class="header">

      <div class="header-1">
         <div class="flex">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-viber"></a>
            </div>
            <p> New <a href="/Hospital-PHP/Homepage/Login/login.php">Login</a> </p>
         </div>
      </div>

      <div class="header-2">
      <a href="/Hospital-PHP/Homepage/Home/home_minor.php" class="logo">
     
    </a>

         <div class="navbar">
            <a href="/Hospital-PHP/Homepage/Home/home_minor.php">HOSPITAL OVERVIEW</a>
            <a href="/Hospital-PHP/Homepage/Home/home_minor.php#home-contact">OUR SERVICE</a>
            <a href="/Hospital-PHP/backend/patient/pat_login.php">BOOK AN APPOINTMENT</a>
            <a href="/Hospital-PHP/Homepage/Home/home_minor.php">FIND A DOCTOR</a>
            <a href="/Hospital-PHP/backend/patient/pat_login.php">LAB REPORT</a>
         </div>

         <div class="icons" id="menu-btn">
            <i class="fas fa-bars"></i>
         </div>
      </div>

   </header>

   <script>
      document.getElementById('menu-btn').addEventListener('click', function () {
         document.querySelector('.header .header-2 .navbar').classList.toggle('active');
      });
   </script>

</body>

</html>
