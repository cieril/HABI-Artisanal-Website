<?php
    session_start();
    include('functions/userfunction.php');
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
    <link rel="stylesheet" href="css/footer.css">
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
    <!-- Javascript -->
    <script defer src="js/active.js"></script>  
    <!-- Title -->
    <title> Home - Habi </title>

</head>
<body>
    <?php
        include_once 'nav.php';
    ?>
    <header>

        <div class="hero">  
            <img class="gif1" src="img/Flower_gif_1.gif" alt="gif">
            <img class="gif2" src="img/Flower_gif_2.gif" alt="gif">
        </div>

    </header>

    <Main>

        <section class="recommended">

            <p class="title"> Our Categories </p>

            <hr class="main_hr">

        <divc class="card_recommended_container">
            <?php 
                $categories = getAllActive("categories");

                if (mysqli_num_rows($categories) > 0 ) {
                    foreach($categories as $item) {
                        ?>
                        <a href="products.php?category=<?= $item['slug'] ?>">
                            <div class="card_container">
                                <div class="card">
                                    <img src="uploads/<?= $item['image'] ?>" alt="category image">
                                </div>
                                <div class="card_wrapper">  
                                    <div class="recommended_card_divider">
                                        <p class="card_name"> <?= $item['name'] ?> </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo "No category available";
                }
            ?>
            
        </div>

        </section>

        <hr class="main_hr">

        <section class="our_services">  
            <div class="services_card">
                <i class="fa-solid fa-truck-fast"></i>
                <p> Nationwide Delivery </p>
            </div>
            <div class="services_card">
                <i class="fa-regular fa-envelope"></i>
                <p> Nationwide Delivery </p>
            </div>
            <div class="services_card">
                <i class="fa-regular fa-star"></i>
                <p> Quality Product </p>
            </div>
        </section>

        <section>

            <p class="title"> Our Products </p>

            <hr class="main_hr">

                 
        <divc class="card_product_container">
        <?php
            $products = getAllActive("products");

            if (mysqli_num_rows($products) > 0 ) {
                foreach($products as $item) {
        ?>
            <div class="card_container">
            <a href="product_view.php?product=<?= $item['slug'] ?>">
                <div class="card">
                    <img src="uploads/<?= $item['image'] ?>" alt="flower">
                </div>
            </a>
                <div class="card_wrapper">  
                    <div class="card_divider">
                        <p class="card_name"> <?= $item['name'] ?> </p>
                        <p class="card_price"> &#8369; <?= $item['original_price'] ?> </p>
                    </div>
                    <div class="card_divider">
                    <p> <?php 
                            if ($item['qty'] > 0 ) {
                        ?>
                            <p class="istock"> In stock </p>
                        <?php
                            } else {
                        ?>
                            <p class="ostock"> Out of stock </p>
                        <?php
                            }
                        ?> 
                        </p>
                    </div>
                </div>
            </div>
        <?php
                }
            } else {
                echo "No products Available";
            }
        ?>

        </div>

        </section>

        <hr class="main_hr">

        <section class="our_story">
            <div class="story_image">
                <img src="img/Orange_Flower.png" alt="">
            </div>
            <div class="story">
                <p class="story_title"> How we started </p>
                <p class="story_content"> HABI became more than just a business; it was a symbol of friendship, creativity, and the power of following one's passion. Maria and Elena often reflected on their journey, grateful for the rainy afternoon that sparked the idea and the unwavering support they had for each other. </p>
                <div class="story_button">
                    <button><a href="about.php"> Learn More </a></button>
                </div>
            </div>
        </section>

    </Main>

    <?php
        include ('footer.php');
    ?>
    
</body>
</html>