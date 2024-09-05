<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ecare-HomePage</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="special.css">
   <link rel="stylesheet" href="home.css">
   <link rel="stylesheet" href="home_minor.css">
   <link rel="stylesheet" href="home1_minor.css">
   <link rel="shortcut icon" href="/Hospital-PHP/backend/admin/assets/images/favicon.ico">


   <!-- <link rel="stylesheet" href="home.css"> -->
   <style>
      .about .flex .content {
         height: 374px;
         flex: 1 1 40rem;
         padding: 2rem;
         background-color: #f8f8ff;
         text-align: center;

      }

      .home-contact {
         background-color: #20b2aa;
      }

      .home-contact .content p {
         color: black;
      }

      body {
         background-color: #eaeaea;
         overflow: hidden;
      }

      .home {
         height: 700px;
         background-size: cover;
         background-position: center;
         display: flex;
         align-items: center;
         justify-content: center;

      }

      .slide {
         width: max-content;
         margin-top: 50px;
      }

      .item {
         width: 200px;
         height: 300px;
         background-position: center;
         display: inline-block;
         transition: 0.5s;
         background-size: cover;
         position: absolute;
         z-index: 1;
         top: 50%;
         transform: translate(0, -50%);
         border-radius: 20px;
         box-shadow: 0 30px 50px #505050;
         display: flex;
      }

      .item:nth-child(1),
      .item:nth-child(2) {
         left: 0;
         top: 0;
         transform: translate(0, 0);
         border-radius: 0;
         width: 100%;
         height: 100%;
         box-shadow: none;
      }

      .item:nth-child(3) {
         left: 50%;
      }

      .item:nth-child(4) {
         left: calc(50% + 220px);
      }

      .item:nth-child(5) {
         left: calc(50% + 440px);
      }

      .item:nth-child(n+6) {
         left: calc(50% + 660px);
         opacity: 0;
      }

      .item .content {
         position: absolute;
         top: 50%;
         left: 100px;
         width: 300px;
         text-align: left;
         padding: 0;
         color: #eee;
         transform: translate(0, -50%);
         display: none;
         font-family: system-ui;
      }

      .item:nth-child(2) .content {
         display: block;
         z-index: 11111;
      }

      .item .name {
         font-size: 50px;
         font-weight: bold;
         opacity: 0;
         animation: showcontent 1s ease-in-out 1 forwards
      }

      .item .des {
         margin: 20px 0;
         opacity: 0;
         animation: showcontent 1s ease-in-out 0.3s 1 forwards
      }

      .item button {
         padding: 10px 20px;
         border: none;
         opacity: 0;
         animation: showcontent 1s ease-in-out 0.6s 1 forwards
      }

      @keyframes showcontent {
         from {
            opacity: 0;
            transform: translate(0, 100px);
            filter: blur(33px);
         }

         to {
            opacity: 1;
            transform: translate(0, 0);
            filter: blur(0);
         }
      }

      .buttons {
         position: absolute;
         bottom: 30px;
         z-index: -1;
         text-align: center;
         width: 100%;
      }

      .buttons button {
         width: 50px;
         height: 50px;
         border-radius: 50%;
         border: 1px solid #555;
         transition: 0.5s;
      }

      .buttons button:hover {
         background-color: #bac383;
      }

      .service_head {
         margin-top: 74px;

      }

      .home-contact {
         margin: 0;
         padding: 0;
         background-color: white;
      }

      .home-contact h1 {
         color: rgb(20, 170, 220);
         text-align: center;
         font-size: 3rem;
      }
   </style>
</head>

<body>

   <?php include 'header_minor.php'; ?>
   <section class="home">
      <div id="slide">
         <div class="item" style="background-image: url('/Hospital-PHP/Homepage/Home/images/hospital7.jpg');">
            <div class="content">
               <div class="name">Intensive care unit(ICU)</div>
               <div class="des">An intensive care unit (ICU), also known as an intensive therapy unit or intensive treatment unit (ITU)</div>
               <button><a href="about.php">Discover more</a></button>
            </div>
         </div>
         <div class="item" style="background-image: url('/Hospital-PHP/Homepage/Home/images/hospital2.jpeg');">
            <div class="content">
               <div class="name">EMERGENCY</div>
               <div class="des">"An emergency is an urgent, unexpected, and usually dangerous situation"</div>
               <button><a href="about.php">Discover more</a></button>
            </div>
         </div>
         <div class="item" style="background-image: url('/Hospital-PHP/Homepage/Home/images/hospital3.jpg');">
            <div class="content">
               <div class="name">OT TABLE</div>
               <div class="des">An operating tableis a table on which a patient lies during a surgical procedure.</div>
               <button><a href="about.php">Discover more</a></button>
            </div>
         </div>
         <div class="item" style="background-image: url('/Hospital-PHP/Homepage/Home/images/hospital4.jpeg');">
            <div class="content">
               <div class="name">MEDICAL TOOLS</div>
               <div class="des">A medical device is any device intended to be used for medical purposes.</div>
               <button><a href="about.php">Discover more</a></button>
            </div>
         </div>
         <div class="item" style="background-image: url('/Hospital-PHP/Homepage/Home/images/hospital5.jpeg');">
            <div class="content">
               <div class="name">GENERAL BEDS</div>
               <div class="des">General wards in hospitals are rooms with several beds</div>
               <button><a href="about.php">Discover more</a></button>
            </div>
         </div>
         <div class="item" style="background-image: url('/Hospital-PHP/Homepage/Home/images/hospital6.jpg');">
            <div class="content">
               <div class="name">HEART BEAT</div>
               <div class="des">A normal resting heart rate for adults ranges from 60 to 100 beats per minute</div>
               <button><a href="about.php">Discover more</a></button>
            </div>
         </div>
      </div>
      <div class="buttons">
         <button id="prev"><i class="fa-solid fa-angle-left"></i></button>
         <button id="next"><i class="fa-solid fa-angle-right"></i></button>
      </div>

   </section>


   <section class="service_head">
      Our services
   </section>

   <div class="service_section">
      <div class="box1 box_service">
         <div class="box_content">
            <h2>Emergency Room Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/emergency.jpg');"></div>
            <p>see more</p>
         </div>
      </div>
      <div class="box1 box_service">
         <div class="box_content">
            <h2>Radiology Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/radio.jpg');"></div>
            <p>see more</p>
         </div>
      </div>
      <div class="box1 box_service">
         <div class="box_content">
            <h2>Blood Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/blood.jpg');"></div>
            <p>see more</p>
         </div>
      </div>
      <div class="box1 box_service">
         <div class="box_content">
            <h2>Diagnosis Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/diag.jpeg');"></div>
            <p>see more</p>
         </div>
      </div>
      <div class="box1 box_service">
         <div class="box_content">
            <h2>Laboratory Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/lab.jpeg');"></div>
            <p>see more</p>
         </div>
      </div>
      <div class="box1 box_service">
         <div class="box_content">
            <h2>OT Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/ot.jpg');"></div>
            <p>see more</p>
         </div>
      </div>
      <div class="box1 box_service">
         <div class="box_content">
            <h2>Pharmacy Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/pharmacy.jpg');"></div>
            <p>see more</p>
         </div>
      </div>
      <div class="box1 box_service">
         <div class="box_content">
            <h2>MRI Service</h2>
            <div class="box_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/mri.jpg');"></div>
            <p>see more</p>
         </div>
      </div>
   </div>

   <div class="video-container">
      <video autoplay muted loop id="background-video">
         <source src="/Hospital-PHP/Homepage/Home/images/video.mp4" type="video/mp4">
      </video>
   </div>

   <section class="about">

   </section>

   <div class="special">
      <div class="special_container">
         <div class="special_container_req">
            <h1> Specialist for Cardiologist & Surgeon</h1>
         </div>
      </div>
      <div class="special_container">
         <div class="sbox1 sbox">
            <div class="sbox_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/doc5.jpg');"></div>
            <div class="special_name_1">Dr. Adam</div>
         </div>
         <div class="sbox1 sbox">
            <div class="sbox_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/doc2.jpg');"></div>
            <div class="special_name">Dr. Harry</div>
         </div>


      </div>
   </div>


   <div class="special">

      <div class="special_container">
         <div class="sbox1 sbox">
            <div class="sbox_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/doc3.jpg');"></div>
            <div class="special_name">Dr. Sheira</div>
         </div>
         <div class="sbox1 sbox">
            <div class="sbox_img" style="background-image: url('/Hospital-PHP/Homepage/Home/images/doc4.jpg');"></div>
            <div class="special_name_1">Dr. Any</div>
         </div>

      </div>
      <div class="special_container">
         <div class="special_container_req">
            <h1>Specialist for Gynecologist & ENT</h1>
         </div>
      </div>
   </div>

   <section class="home-contact">
      <h1>
         Our Location
      </h1>
      <div id="map-container">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1626.9645404581868!2d85.29505045832163!3d27.687421663661933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb18418341dcc1%3A0x6df427d5d1f261cf!2sKumari%20Temple!5e0!3m2!1sen!2snp!4v1721888646385!5m2!1sen!2snp" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                   </iframe>
      </div>
   </section>






   <?php include 'footer_minor.php'; ?>

   <!-- custom js file link  -->
   <script src="home_minor.js"></script>
   <script src="slide_minor.js"></script>


</body>

</html>