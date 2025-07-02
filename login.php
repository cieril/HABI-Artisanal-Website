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
   <title> Login </title>
</head>

<body>

   <div class="login-banner-wrapper">
      
   </div>


   <div class="form-wrapper">

      <form action="functions/authcode.php" method="POST">
         <div class="form-header">
            <a href="index.php"><img src="img/rose_logo.png" alt="Rose"></a>
            <p> Welcome Back!</p>
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
            <label for="email"> Email </label>
            <input type="text" name="email" id="email" autocomplete="off">
         </div>
         <div  class="form-inputs">
            <label for="password"> Password </label>
            <input type="password" name="password" id="password" autocomplete="off">
         </div>

         <div class="form-options">
            <div class="form-options-checkbox">
               <!-- <input type="checkbox" name="remember" id="remember">
               <label for="remember"> Remember me</label> -->
            </div>
            <div class="form-options-forgotpass">
               <!-- <a href="forgot.php"> Forgot password? </a> -->
            </div>
         </div>

         <div class="form-button">
            <button type="submit" name="login_btn"> Log In </button>
            <a href="register.php"> Create an Account </a>
         </div>

         <!-- <div class="form-division">
            <hr>
            <p> or </p>
         </div>

         <div class="form-google">
            <button> <img src="img/google_logo.png" alt="">Login with Google </button>
         </div> -->
      </form>

   </div>

</body>

</html>