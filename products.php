<?php
    session_start();
    include('functions/userfunction.php');

    if (isset($_GET['category'])) {

    
    $category_slug = $_GET['category'];
    $category_data = getSlugActive("categories",$category_slug);
    $category = mysqli_fetch_array($category_data);

    if ($category) {

    
    $cid = $category['id'];
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
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
    <!-- Title -->
    <title> Flowers </title>

</head>
<body>
    <?php
        include_once 'nav.php';
    ?>
    
    <Main>

        <section class="recommended">

            <p class="title"> <?= $category['name'] ?> </p>

            <hr class="main_hr">
            <?php 
                $products = getProdByCategory($cid);

                if (mysqli_num_rows($products) > 0 ) {
                    foreach($products as $item) {
            ?>
                    <divc class="card_product_container">
                        <divc class="card_recommended_container">
                            <div class="card_container">
                            <a href="product_view.php?product=<?= $item['slug'] ?>">
                                <div class="card">
                                    <img src="uploads/<?= $item['image'] ?>" alt="product image">
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
                    </div>
        <?php
                    }
                } else {
                    echo "No data available";
                }
            ?>

        </section>
    </Main>
    
    

    <footer>
        <div class="footer_content">
            <img src="img/habi_logo_light.png" alt="logo">
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla sint dolor sequi obcaecati. Totam laborum libero doloremque sequi nisi corporis voluptates a. Tempore vero dignissimos nobis, harum iure sit nesciunt! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nulla, temporibus atque! Harum sequi quisquam sapiente magnam minus dolorum impedit, obcaecati ipsa quas dicta, nulla fuga reprehenderit incidunt. Porro, fugiat rem.</p>
                <div class="footer_socials">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-x-twitter"></i>
                </div>
        </div>

        <div class="footer_contact">
            <div class="contacts">
                <i class="fa-regular fa-envelope"></i>
                <p> Test@email.com </p>
            </div>
            <div class="contacts">
                <i class="fa-solid fa-phone"></i>
                <p> (+63) 9952705568 </p>
            </div>
        </div>
    </footer>

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
            echo "Something went wrong";
        }
    } else {
        echo "Something went wrong";
    }
?> 