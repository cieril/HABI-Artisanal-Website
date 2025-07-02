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
     <link rel="stylesheet" href="css/nav.css">
     <link rel="stylesheet" href="css/index.css">
     <link rel="stylesheet" href="css/contact.css">
     <link rel="stylesheet" href="css/footer.css">
     <!-- Title Icon -->
     <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
     <!-- Javascript -->
     <script defer src="js/active.js"></script>
     <!-- Title -->
     <title> Contact Us </title>

</head>
<body>
    <?php
        include_once 'nav.php';
    ?>
    <main>

        <hr class="main_hr">

        <div class="contact_content">

            <div class="contact_title">
                <p> Get  in touch with us </p>
            </div>

            <div class="contact_main">
                <div class="contact_img">
                    <img src="img/contact.png" alt="image">
                </div>

                <div class="contact_form">
                    <!-- <form action="#">
                        <div class="contact_inputs">
                            <label for="name"> Name </label>
                            <input type="text" name="name" id="name">
                        </div>
                        <div class="contact_inputs">
                            <label for="email"> Email </label>
                            <input type="text" name="email" id="email">
                        </div>
                        <div class="contact_textarea">
                            <label for="concern"> Concern </label>
                            <textarea name="concern" id="concern"></textarea>
                        </div>
                        <div class="contact_button">
                            <button name="submit" type="submit"> Submit </button>
                        </div>
                    </form> -->
                    <div class="contact_title">
                        <p> Our Socials </p>
                    </div>
                    <div class="contact_socials">
                        <a href="https://www.facebook.com/profile.php?id=100076421314259" target=”_blank”><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.instagram.com/pixxelmon/" target=”_blank”><i class="fa-brands fa-instagram"></i></a>
                        <!-- <a href=""><i class="fa-brands fa-x-twitter"></i></a> -->
                    </div>
                </div>
            </div>

        </div>

    </main>
        
    <?php
        include ('footer.php');
    ?>
    
</body>
</html>