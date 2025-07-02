<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>
   <!-- Meta Tags -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Imports -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- CSS -->
   <link rel="stylesheet" href="css/login.css">
   <!-- Title Icon -->
   <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
   <!-- Title -->
   <title> Register </title>
</head>

<body>

   <div class="form-wrapper">

      <form action="functions/authcode.php" method="POST">
         <div class="form-header">
            <a href="index.php"><img src="img/rose_logo.png" alt="Rose"></a>
            <p> lets get you started </p>
         </div>
         <?php if(isset($_SESSION['message'])) 
         { 
         ?>
         <div class="errors">
         <?= $_SESSION['message']; ?> 
         </div>
         
         <?php 
         unset($_SESSION['message']);
         } 
         ?>
         <div  class="form-inputs">
            <label for="name"> Name </label>
            <input type="text" name="name" id="name" autocomplete="off">
         </div>
         <div  class="form-inputs">
            <label for="phone"> Phone </label>
            <input type="number" name="phone" id="phone" autocomplete="off">
         </div>
         <div  class="form-inputs">
            <label for="email"> Email </label>
            <input type="text" name="email" id="email" autocomplete="off">
         </div>
         <div  class="form-inputs">
            <label for="password"> Password </label>
            <input type="password" name="password" id="password" autocomplete="off">
         </div>
         <div  class="form-inputs">
            <label for="cpassword"> Confirm Password </label>
            <input type="password" name="cpassword" id="cpassword" autocomplete="off">
         </div>

         <div class="form-button">
            <button type="submit" name="register_btn"> Log In </button>
            <a href="login.php"> Already have an account? </a>
         </div>

         <!-- <div class="form-division">
            <hr>
            <p> or </p>
         </div>

         <div class="form-google">
            <button> <img src="img/google_logo.png" alt="">Register with Google </button>
         </div> -->
      </form>

   </div>

   <div class="register-banner-wrapper">
      
   </div>


</body>

</html>