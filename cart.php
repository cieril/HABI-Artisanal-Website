<?php
    session_start();
    include('functions/userfunction.php');
    include('functions/authenticate.php');
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
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
    <!-- Javascript -->
    <script defer src="js/active.js"></script>
    <!-- Title -->
    <title> Cart </title>

</head>
<body>
    <?php
        include_once 'nav.php';
    ?>
    <main>
        <section class="cart_section">

            <p class="title"> Your Cart </p>

            <hr class="main_hr">
        <div id="mycart">
        <?php
            $items = getCartItems();
            if (mysqli_num_rows($items) > 0 ) {
        ?>
        <div class="cart_container">

            <div class="cart_items_wrapper product_data">
                <div id="mycart">
                        <?php 
                            foreach ($items as $citem) {
                        ?>
                        <div class="cart_items product_data">
                            <div class="cart_product">
                                <div class="cart_product_img">
                                    <img src="uploads/<?= $citem['image'] ?>" alt="image">
                                </div>
                                <div class="cart_product_name">
                                    <p> <?= $citem['name'] ?> </p>
                                </div>
                                <div class="cart_product_price">   
                                    <p> &#8369; <?= $citem['selling_price'] ?> </p>
                                </div>
                                <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                <div class="cart_product_quantity">
                                    <button class="minus decrement_btn updateQty"> - </button>
                                    <input type="text" value="<?= $citem['prod_qty'] ?>" class="input_qty" disabled>
                                    <button class="plus increment_btn updateQty"> + </button>
                                </div>
                                <div class="cart_product_button">
                                    <Button class="deleteItem" value="<?= $citem['cid'] ?>"> Remove </Button>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>  
                </div>                 
            </div>
            <div class="checkout">
                <a href="checkout.php" class="checkout"> <p>Check Out</p> </a>
            </div>

        </div>

        <?php
                } else {
                    ?>
                        <div class="empty_cart">
                            <p> Your cart is empty </p>
                        </div>
                    <?php
                }
        ?>
        </div>

        </section>
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