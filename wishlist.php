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
            <header class="content_header"> Wishlist </header>
            <div class="content_wrapper product_data">
                <table>
                    <tr>
                        <th><p> Image </p> </th>
                        <th><p> Name </p></th>
                        <!-- <th><p> Action </p></th> -->
                    </tr>    
                <?php
                    $items = getWishListItems();

                    if (mysqli_num_rows($items) > 0 )
                    {
                        foreach ($items as $witem) {
                    ?>
                        <tr>
                            <td> <img src="uploads/<?= $witem['image'] ?>" alt="" height="100px"> </td>
                            <td><p> <?= $witem['name'] ?> </p></td>
                            <!-- <td><Button class="deleteItem" value="<?= $witem['wid'] ?>"> Remove </Button></td> -->
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="5" style="text-align: center;"> No Items </td>
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
</body>
</html> 