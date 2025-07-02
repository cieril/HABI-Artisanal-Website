<?php
    session_start();
    include('functions/userfunction.php');

    if (isset($_GET['product'])) {
        $product_slug = $_GET['product'];
        $product = getSlugActive("products",$product_slug);
        $product = mysqli_fetch_array($product);

        if ($product) {
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
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type"> 
    <!-- Title -->
    <title> Products </title>

</head>
<body>
    <?php
        include_once 'nav.php';
    ?>
<main>
    <div class="product_main_container">
        <div class="product_image_container">
            <div class="product_image_main">
                <img class="main_image" src="uploads/<?= $product['image']?>" alt="Product Image">
            </div>
            <!-- <div class="product_image_scroll">
                <img src="img/Flower.png" alt="">
                <img src="img/Flower.png" alt="">
                <img src="img/Flower.png" alt="">
            </div> -->
        </div>
        <div class="product_description_container product_data">
            <div class="product_decription">
                <p class="desc_title"> <?= $product['name']?> <span><?php if ($product['trending']){echo "Trending";} ?></span></p>
                <hr>
                <p class="price"> &#8369; <?= $product['original_price']?> </p>
                <p class="description_title"> Description </p>
                <p class="description"> <?= $product['description']?> </p>
                <hr>
            </div>
            <div class="product_action">
                <div class="quantity_wrapper">
                    <div class="quantity_title">
                        <p> Quantity </p>
                    </div>
                    <div class="quantity_button_wrapper">
                        <button class="minus decrement_btn"> - </button>
                        <input type="text" value="1" class="input_qty" disabled>
                        <button class="plus increment_btn"> + </button>
                    </div>
                </div>
                <div class="product_button">
                    <button class="addwishlist addToWishListBtn" value="<?= $product['id']?>"> Add to Wishlist </button>
                    <?php
                        if ($product['qty'] > 0) {
                    ?>
                            <button class="addcart addToCartBtn" value="<?= $product['id']?>"> Add to Cart </button>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

        <hr class="main_hr">
        <div class="reviews_container">
            <div class="review_title">
                <p> Website Feedback </p>
            </div>
            <?php
                // $user_id = $_SESSION['auth_user']['user_id'];
                $review_query = "SELECT * FROM reviews";
                $review_query_run = mysqli_query($con, $review_query);

                if(mysqli_num_rows($review_query_run) > 0) {
                    foreach ($review_query_run as $item) {
            ?>
            <div class="review_rating">
                <p><span class="rating_number"> <?= $item['ratings'] ?> </span><span class="rating_star"><i class="fa-solid fa-star"></i></span></p>
            </div>
            <div class="reviewer_name">
                <p> 
                <?php
                    if ($item['anonymous'] == 0 ) {
                    ?>
                        <p><?=$item['name'] ?> </p> 
                        <?php
                    } else {
                        ?>
                          <p> Anonymous User </p> 
                        <?php
                    }
                ?> 
                </p>
            </div>
            <div class="review">
                <p> <?= $item['comment'] ?> </p>
            </div>
            <hr class="review_hr">
            <?php
                    }
                }
            ?>
        </div>
</main>

   

    <?php
        include ('footer.php');
    ?>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier','position', 'top-right'); 
        <?php if(isset($_SESSION['message'])) { ?>
        alertify.success('<?= $_SESSION['message']; ?>');
        <?php 
        unset($_SESSION['message']);
        } ?>
    </script>
</body>
</html>
<?php
    } else {
        echo "Product not found";
    }
} else {
    echo "Something went wrong";
}
?> 