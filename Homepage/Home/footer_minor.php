<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Footer</title>
   <style>
      
.footer{
    background-color: #89d2e8;
 }
 
 .footer .box-container{
    max-width: 1200px;
    margin:0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
    gap:3rem;
 }
 
 .footer .box-container .box h3{
    text-transform: uppercase;
    color:var(--black);
    font-size: 2rem;
    padding-bottom: 2rem;
 }
 
 .footer .box-container .box p,
 .footer .box-container .box a{
    display: block;
    font-size: 1.7rem;
    color:var(--light-color);
    padding:1rem 0;
 }
 
 .footer .box-container .box p i,
 .footer .box-container .box a i{
    color:var(--purple);
    padding-right: .5rem;
 }
 
 .footer .box-container .box a:hover{
    color:var(--purple);
    text-decoration: underline;
 }
 
 .footer .credit{
    text-align: center;
    font-size: 2rem;
    color:var(--light-color);
    border-top: var(--border);
    margin-top: 2.5rem;
    padding-top: 2.5rem;
 }
 
 .footer .credit span{
    color:var(--purple);
 }
 
 .footer .credit h3{
    color: dodgerblue;
 }
 
 
   </style>
</head>

<body>
   <section class="footer">

      <div class="box-container">

         <div class="box">
            <h3>quick links</h3>
            <a href="">Home</a>
            <a href="">About</a>
            <a href="">Emergency</a>
            <a href="">Contact</a>
         </div>

         <div class="box">
            <h3>extra links</h3>
            <a href="">Login</a>
            <a href="">Register a patient</a>
            <a href="">Appointment</a>
            <a href="">Schedule</a>
         </div>

         <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-phone"></i> +977-9806884715</p>
            <p> <i class="fas fa-phone"></i> +977-9808531663 </p>
            <p> <i class="fas fa-envelope"></i> TeamSecret@gmail.com </p>
            <p> <i class="fas fa-map-marker-alt"></i> Kathmandu, Lalitpur</p>
         </div>

         <div class="box">
            <h3>follow us</h3>
            <a href="https://www.facebook.com/pradeepchaudhary30062/"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="https://twitter.com/prabinyadav362?t=LhW7b1WSLhdwSBbBeNaM0w&s=09"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="https://instagram.com/anishh_kumar?utm_source=qr&igshid=MzNlNGNkZWQ4Mg%3D%3D"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-viber"></i> viber </a>
         </div>

      </div>
      <p class="credit"> Made by Team Secret<span></span> </p>
     
   </section>
  
  


<script src="time.js"></script>
</body>

</html>