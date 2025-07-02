<?php       
    session_start();
    include ('functions/userfunction.php');
    include ('functions/authenticate.php');
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
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
    <!-- Javascript -->
    <script defer src="js/active.js"></script>  
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Title -->
    <title> Account </title>

</head>
<body>
    <?php
        include_once 'nav.php';
    ?>

    <main class="user_containter">

        <div class="sidebar">
            <header class="sidebar_header"> My Account </header>
            <ul class="sidebar_list">
                <li class="sidebar_links profile"><a href="user.php"> Profile </a></li>
                <li class="sidebar_links my_orders"><a href="order.php"> My orders </a></li>
                <li class="sidebar_links my_orders"><a href="order_history.php"> Order History </a></li>
                <li class="sidebar_links my_orders"><a href="wishlist.php"> Wishlist </a></li>
            </ul>
        </div> 
        <div class="content">
            <header class="content_header"> Order History </header>
            <div class="content_wrapper">
                <table>
                    <tr>
                        <th><p> ID </p> </th>
                        <th><p> Tracking No </p></th>
                        <th><p> Price </p></th>
                        <th><p> Date </p></th>
                        <th colspan="2"><p> Action </p></th>
                    </tr>    
                <?php
                    $orders = getOrderHistory('categories');

                    if (mysqli_num_rows($orders) > 0)
                    {
                        foreach ($orders as $item) {
                    ?>
                        <tr>
                            <td><p> <?= $item['id'] ?> </p></td>
                            <td><p> <?= $item['tracking_no'] ?> </p></td>
                            <td><p> <?= $item['total_price'] ?> </p></td>
                            <td><p> <?= $item['created_at'] ?> </p></td>
                            <td><a href="view_order.php?t=<?= $item['tracking_no']?>" class="view"> View Details </a></td>
                            <td><a href="review_product.php?id=<?= $item['id']?>" class="review"> Review product </a></td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="5" style="text-align: center;"> No orders Yet </td>
                        </tr>
                    <?php
                    }
                ?>
                </table>
            </div>
        </div>
    </main>

    <?php
        include ('footer.php');
    ?>
    <!-- JQuery -->
    <script src="assets/jquery-3.7.1.min.js"></script>                  
    <!-- JS -->
    <script src="js/scripts.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/custom.js"></script> 
    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>

        <?php if(isset($_SESSION['message'])) { ?>
        alertify.set('notifier','position', 'top-right');
        alertify.success('<?= $_SESSION['message']; ?>');
        <?php 
        unset($_SESSION['message']);
        } ?>
    </script>
</body>
</html> 