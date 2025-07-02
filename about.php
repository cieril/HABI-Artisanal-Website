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
     <link rel="stylesheet" href="css/flower.css">
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
    <section class="intro">
        <p>ABOUT US</p>
    </section>
    <main>

    <section class="aboutcont">
        <h2>Welcome to Habi!</h2>
        <p class="acontent">Habi is the brainchild of two passionate students who share a love for creativity and craftsmanship. Founded in 2023, our small business specializes in ordering and curating beautiful crochet handmade products, with a special focus on stunning flower bouquets.</p>
    </section>

    <section class="aboutcont1">
        <img src="img/a5.png">
        <div>
        <h2>Our Story</h2>
        <p class="acontent1">As students, we often found ourselves seeking unique and meaningful gifts for our loved ones. Frustrated with the mass-produced, impersonal options available, we decided to take matters into our own hands. Drawing inspiration from the timeless art of crochet, we envisioned a space where people could find handcrafted treasures that convey love, care, and individuality.</p>
        </div>
    </section>

    <section class="aboutcont2">
        <h2>Our Mission</h2>
        <p class="acontent2">At Habi, our mission is simple: to bring joy and warmth into your life with our handmade crochet creations. Each item in our collection is crafted with meticulous attention to detail, ensuring that every piece is as unique as the person receiving it. We believe in the power of handmade gifts to create lasting memories and spread happiness.</p>
    </section>

    <section class="aboutcont3">
        <div>
        <h2>Our Products</h2>
        <p class="acontent3">Our flagship product is our exquisite crochet flower bouquet. These bouquets are not only beautiful but also eco-friendly and long-lasting. Unlike traditional flowers, our crochet blooms never wilt, making them a perfect keepsake for any occasion. Whether it's a birthday, anniversary, or just a gesture of appreciation, our bouquets are designed to bring a smile to your face.</p>
        </div>
        <img src="img/a6.JPG">
    </section>

    <section class="aboutcont4">
        <div>
        <h2>Meet the Founders</h2>
        <p class="acontent4">We are the students behind Habi. Balancing our studies and our passion for crochet has been an incredible journey, and we are thrilled to share our creations with you. Our goal is to make the world a little brighter, one crochet flower at a time.</p>
        </div>
        <img src="img/a8.jpg">
    </section>
    </main>
        
    <?php
        include ('footer.php');
    ?>
    
</body>
</html>